

<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	$member_name='ゲスト';
	$member_code=0;
	$disp_member_login='<a href="../member/member_login.html">会員ログイン</a>';
	$disp_member_new='<a href="../member/member_new.html">無料会員登録</a><br />';
}
else
{
	$member_name=$_SESSION['member_name'];
	$member_code=$_SESSION['member_code'];
	$disp_member_logout='<a href="../member/member_logout.php">ログアウト</a><br />';
	$disp_pro_list='<a href="../product/pro_list.php">業種の追加や変更</a><br />';

}
?>

<?php
if($_POST["csrf_token"] != $_SESSION['csrf_token'])
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>



<?php

try
{

	//ini_set('display_errors',1);
//	自分のsessionからcodeを取り出す
//	request_code に変えて、後でiraityu_salesに入れる
ini_set('display_errors',1);
$member_code=$_SESSION['member_code'];
$member_name=$_SESSION['member_name'];


$request_code=$member_code;
//$member_name=$member_name;



require_once('../common/common.php');

$post=sanitize($_POST);


    $iraityu_sales_product=$post['iraityu_sales_product'];
    $iraityu_sales=$post['iraityu_sales'];

    // iraityu_sales （人間）
    $shop_code=$post['shop_code'];
    $request_code=$post['request_code'];

     // iraityu_sales_product（商品情報）
    $code_product=$post['code_product'];
    $request_day=$post['request_day'];

    $contents=$post['contents'];
    $request_postal1=$post['request_postal1'];
    $request_postal2=$post['request_postal2'];
    $request_address=$post['request_address'];

    //  感想、評価、金額
    $word_mouth=$post['word_mouth'];
    $pay=$post['pay'];
    $assess=$post['assess'];

    //var_dump($assess);

    $assess=(int)$assess;
    //var_dump($assess);

$dsn='mysql:dbname=site;host=handson.czoyfw5itcgq.ap-northeast-1.rds.amazonaws.com;charset=utf8;';
$user='admin';
$password='50Aruki20';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


	// mst_productから、shop_codeを取り出す
	//	shop_codeは商品を掲載した人
	$sql='SELECT title,price,shop_code FROM mst_product WHERE code=?';
	$stmt=$dbh->prepare($sql);
	$data[]=$code_product;
	$stmt->execute($data);

	$rec=$stmt->fetch(PDO::FETCH_ASSOC);

	$shop_code=$rec['shop_code'];

	//	依頼者のアドレス
	$sql='SELECT email FROM dat_member WHERE code=?';
	$stmt=$dbh->prepare($sql);
	$data=array();
	$data[]=$request_code;

	$stmt->execute($data);
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);

	$member_code_email=$rec['email'];

	//	業者のアドレス
	$sql='SELECT email,assess FROM dat_member WHERE code=?';
	$stmt=$dbh->prepare($sql);
	$data=array();
	$data[]=$shop_code;

	$stmt->execute($data);

	$rec=$stmt->fetch(PDO::FETCH_ASSOC);

	$shop_code_email=$rec['email'];
	$assess_source=$rec['assess'];	//  assessを取り出し変更する
  $assess_source=(int)$assess_source;

  //var_dump($assess_source);

// iraityu_sales,iraityu_sales_productを入れていく
$sql='LOCK TABLES 
dat_member WRITE,
ok_sales WRITE,
ok_sales_product WRITE,
iraityu_sales WRITE,
iraityu_sales_product WRITE';
$stmt=$dbh->prepare($sql);
$stmt->execute();

if($assess_source==0){

	
	$sql='UPDATE dat_member  
	SET assess=?
	WHERE code=?';
	$stmt=$dbh->prepare($sql);
	$data=array();
	$data[]=$assess;
	$data[]=$shop_code; //業者側のcode
	$stmt->execute($data);
	

}else{

	
	$assess_source=$assess_source+1;

	$sql='UPDATE dat_member  
	SET assess=?
	WHERE code=?';
	$stmt=$dbh->prepare($sql);
	$data=array();
	$data[]=$assess_source;
	$data[]=$shop_code; //業者側のcode
	$stmt->execute($data);
	

}

    $sql='INSERT INTO ok_sales (shop_code,request_code) VALUES (?,?)';
    $stmt=$dbh->prepare($sql);
    $data=array();
    $data[]=$shop_code;
    $data[]=$request_code;

    $stmt->execute($data);


	//	上記には無いが、自動的にprimeryのコードが作られている
	//	そのため、そのcode_salesのコードを以下に入れて関係を持たせる
	$sql='SELECT LAST_INSERT_ID()';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);

	$lastcode=$rec['LAST_INSERT_ID()'];

	//	code_salesのコードを入れていく
	// code_sales と　dat_sales_product のprimeryは同じにならない
	$sql='INSERT INTO ok_sales_product 
	(ok_sales,
	code_product,
	request_day,

    request_postal1,
	request_postal2,
	request_address,
	contents,
	word_mouth,
	pay)
	VALUES (?,?,?,?,?,?,?,?,?)';
	$stmt=$dbh->prepare($sql);
	$data=array();
	$data[]=$lastcode;
	$data[]=$code_product;
	$data[]=$request_day;
	$data[]=$request_postal1;
	$data[]=$request_postal2;
	$data[]=$request_address;
	$data[]=$contents;
	$data[]=$word_mouth;
	$data[]=$pay;

	$stmt->execute($data);
//      デリート

    $sql='DELETE FROM iraityu_sales WHERE code=?';
    $stmt=$dbh->prepare($sql);
    $data=array();
    $data[]=$iraityu_sales;

    $stmt->execute($data);

    $sql='DELETE FROM iraityu_sales_product WHERE code=?';
    $stmt=$dbh->prepare($sql);
    $data=array();
    $data[]=$iraityu_sales_product;

    $stmt->execute($data);

$sql='UNLOCK TABLES';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;

//  以下はメール文のため

$honbun='';
$honbun.=$member_name."様\n\nこのたびはサービスをご利用頂きありがとうございました。\n";
$honbun.="\n";

$honbun.="ご相談内容\n";
$honbun.="--------------------\n";

$honbun.="□□□□□□□□□□□□□□\n";
$honbun.="このサイトの連絡先\n";
$honbun.="　～ラクラク農園～\n";
$honbun.="\n";
$honbun.="○○県六丸郡六丸村123-4\n";
$honbun.="電話 090-6060-xxxx\n";
$honbun.="メール info@rokumarunouen.co.jp\n";
$honbun.="□□□□□□□□□□□□□□\n";
//print nl2br($honbun);

// 以下は双方にメールを送るプログラム、メールアドレスを入れる

// お客
$title='サービスのご利用ありがとうございます。';
$header='From:info@rakuraku.co.jp';
$honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail($member_code_email,$title,$honbun,$header);

//店
$title='手続が全て完了致しました。';
$header='From:info@rakuraku.co.jp';
$honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail($shop_code_email,$title,$honbun,$header);


ini_set('display_errors',1);


}
catch (Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>






<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Top navbar example · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-static/">

    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="navbar-top.css" rel="stylesheet">
  </head>
  <body>

  <header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="btn btn-outline-light me-2" role="button" href="../shop/shop_list.php" >マイページ</a>
      <a class="btn btn-outline-light me-2" role="button" href="../dashboard/data.php">運用管理データ</a>
      <a class="btn btn-outline-light me-2" role="button" href="../shop/index.php" >カテゴリ一覧</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">

        </ul>
        <div class="text-end">

        <?php

          if(isset($_SESSION['member_login'])==false)
          {
        ?>

        <a class="btn btn-outline-light me-2" href="../member/member_login.php" role="button">ログイン</a>
        <a class="btn btn-info" href="../member/member_new.php" role="button">無料会員登録</a>

        <?php

          }
          else
          {
        ?>

        <a class="btn btn-outline-light me-2" href="../member/member_logout.php" role="button">ログアウト</a>
        <a class="btn btn-success" href="../member/member_disp.php" role="button"><?php print $member_name;?></a>

        <?php

          }
          ?>

        </div>

      </div>
    </div>
  </nav>
</header>

<main class="container">
  <div class="bg-light p-5 rounded">
    <br><br>
    <h1>ご利用ありがとうございました。</h1>
    <p class="lead"><?php print $member_name; ?>様のご意見・感想は今後のサービス向上に繋げてまいります。<br />今後ともよろしくお願いします。</p>
    <a class="btn btn-lg btn-primary" href="../shop/index.php" role="button">トップに移動する &raquo;</a>
  </div>
</main>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
