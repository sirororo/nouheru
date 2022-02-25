

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

/*
try
{
*/

ini_set('display_errors',1);
	//	店舗側のmember_codeを商品のDBに入れておく

	require_once('../common/common.php');

	$post=sanitize($_POST);

	$title=$post['title'];
	$gyousyu=$post['gyousyu'];
	$price=$post['price'];
	$serves=$post['serves'];
	$business_hours=$post['business_hours'];
	$support_place=$post['support_place'];
	$pay=$post['pay'];
	$profile=$post['profile'];

	$gazou_name=$post['gazou_name'];

	if($gyousyu=='daikou'){

		$gyousyu=1;
	
	}elseif($gyousyu=='noukigu'){
	
		$gyousyu=2;
	
	}elseif($gyousyu=='house'){
	
		$gyousyu=3;
	
	}elseif($gyousyu=='help'){
	
		$gyousyu=4;
	
	}elseif($gyousyu=='sonota'){
	
		$gyousyu=5;
	
	}else{
		print '';
	}	


$dsn='mysql:dbname=site;host=handson.czoyfw5itcgq.ap-northeast-1.rds.amazonaws.com;charset=utf8;';
$user='admin';
$password='50Aruki20';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='INSERT INTO mst_product(
title,
gyousyu,
price,
gazou,
serves,
business_hours,
support_place,
pay,
profile,
shop_code)
VALUES (?,?,?,?,?,?,?,?,?,?)';
$stmt=$dbh->prepare($sql);
$data=array();
$data[]=$title;
$data[]=$gyousyu;
$data[]=$price;
$data[]=$gazou_name;
$data[]=$serves;

$data[]=$business_hours;
$data[]=$support_place;
$data[]=$pay;
$data[]=$profile;
$data[]=$member_code;

$stmt->execute($data);

$dbh=null;


/*
}

catch(Exception$e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}
*/

?>





<!doctype html>
<html lang="ja">
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
    <h1>ご登録完了致しました。</h1>
    <p class="lead">登録後サービスの依頼が来た場合メールでお知らせいたします。<br />サービス設定の変更も可能です。</p>
    <a class="btn btn-lg btn-primary" href="../shop/index.php" role="button">トップ画面に戻る &raquo;</a>
    <a class="btn btn-lg btn-primary" href="../product/pro_add.php" role="button">続けてサービス内容を登録する &raquo;</a>
  </div>
</main>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
