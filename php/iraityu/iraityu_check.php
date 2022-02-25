

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
	$member_code=$_SESSION['member_code'];
	$member_name=$_SESSION['member_name'];
	$disp_member_logout='<a href="../member/member_logout.php">ログアウト</a><br />';
	$disp_pro_list='<a href="../product/pro_list.php">業種の追加や変更</a><br />';



}
?>




<?php

try
{

$iraityu_sales_product=$_GET['procode'];

$dsn='mysql:dbname=site;host=handson.czoyfw5itcgq.ap-northeast-1.rds.amazonaws.com;charset=utf8;';
$user='admin';
$password='50Aruki20';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

// 相談内容
$sql='SELECT 
request_day,
contents,
request_postal1,
request_postal2,
request_address,
code_product,
iraityu_sales
 FROM iraityu_sales_product WHERE code=?';
$stmt=$dbh->prepare($sql);
//$data=array();
$data[]=$iraityu_sales_product;

//var_dump($data);

$stmt->execute($data);
$rec=$stmt->fetch(PDO::FETCH_ASSOC);

$request_day=$rec['request_day'];
$contents=$rec['contents'];
$request_postal1=$rec['request_postal1'];
$request_postal2=$rec['request_postal2'];
$request_address=$rec['request_address'];

// 商品code
$code_product=$rec['code_product'];

// iraityu_salesにつなげるために出す
$iraityu_sales=$rec['iraityu_sales'];


// request_code,shop_codeを取り出す
$sql='SELECT  shop_code,request_code FROM iraityu_sales WHERE code=?';
$stmt=$dbh->prepare($sql);
$data=array();
$data[]=$iraityu_sales;
$stmt->execute($data);
$rec=$stmt->fetch(PDO::FETCH_ASSOC);



// 店舗の人と相談者がログインした時に、codeが一致する人は表示されるようにする
$shop_code=$rec['shop_code'];
$request_code=$rec['request_code'];


// 商品の内容
$sql='SELECT title,price,gazou,shop_code  FROM mst_product WHERE code=?';
$stmt=$dbh->prepare($sql);
$data=array();
$data[]=$code_product;
$stmt->execute($data);
$rec=$stmt->fetch(PDO::FETCH_ASSOC);

$title=$rec['title'];
$price=$rec['price'];
$gazou=$rec['gazou'];

if($rec['gazou']=='')
	{
		$gazou='<img src="../product/gazou/gazou_image.png">';
	}
	else
	{
		$gazou='<img src="../product/gazou/'.$rec['gazou'].'">';
	}

$dbh=null;

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}


?>








<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Checkout example · Bootstrap v5.0</title>


    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
  <link href="form-validation.css" rel="stylesheet">

  </head>
  <body class="bg-light">
    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <h2>確認画面</h2>

      <p class="lead">
      <br />
          サービス内容の確認をします。
        </p>
    </div>


      <div class="col-md-7 col-lg-8">



        <h4 class="mb-3"></h4>
        <h4 class="mb-3"></h4>
          <div class="row g-3">

          <h4 class="mb-3">サービス内容。</h4>


                  <div class="col-sm-13">
                    <label for="username" class="form-label">タイトル名を入力して下さい。</label>
                    <input  id="username" type="text" class="form-control" name="title"   value="<?php print  $title;?>"  disabled>
                  </div>

                  <h4 class="mb-3"></h4>

                  <div class="col-12">
                    <label for="price" class="form-label">サービスの価格を入力してください。</label>
                    <textarea  id="price" type="text" class="form-control" name="price"  value=""  rows="10" disabled><?php print  $price;?></textarea>
                  </div>

          </div>

                  <hr class="my-4">

                  <h4 class="mb-3"></h4>

                    <h6 class="mb-3">作業写真（任意）</h6>

                    <div class="container page-header">
                    <div class="py-5 text-center">

                  <p class="lead">
                  <br />
                    <?php
                    print $gazou;
                    ?>

                    </p>

<hr class="my-4" size="8">

          <h4 class="mb-3">相談内容</h4>

                    <div class="col-12">
                    <label for="$contents" class="form-label">作業内容を入力して下さい。</label>
                    <textarea  id="$contents" type="text" class="form-control" name="$contents"  value="" rows="10" disabled><?php print  $contents;?></textarea>
                    </div>

                    <h4 class="mb-3"></h4>

                    <div class="col-12">
                    <label for="request_day" class="form-label">作業日付を入力してください。</label>
                    <textarea  id="request_day" type="text" class="form-control" name="request_day"   value="" rows="10" disabled><?php print  $request_day;?></textarea>
                    </div>

                    <h4 class="mb-3"></h4>

                    <div class="col-12">
                    <label for="request_postal1" class="form-label">作業場所の郵便番号（上３桁）</label>
                    <input id="request_postal1" name="request_postal1" type="text" class="form-control" value="<?php print $request_postal1; ?>"  disabled>
                    </div>

                    <h4 class="mb-3"></h4>

                    <div class="col-12">
                    <label for="request_postal2" class="form-label">作業場所の郵便番号（下４桁）</label>
                    <input id="request_postal2" name="request_postal2" type="text" class="form-control"  value="<?php print $request_postal2; ?>"  disabled>
                    </div>

                    <h4 class="mb-3"></h4>

                    <div class="col-12">
                    <label for="request_address" class="form-label">作業場所の住所</label>
                    <input name="request_address" type="text" class="form-control" id="request_address" value="<?php print $request_address;?>"  disabled>
                    </div>

                    <h4 class="mb-3"></h4>

          <?php
          if($request_code==$member_code)
          {
              // 進む
              // 戻る
              // 登録情報

              ?>

          <form method="post" class="needs-validation" action="iraityu_done1.php"  novalidate>

          <?php

          //var_dump($iraityu_sales_product);


          // テーブルコード
            print '<input type="hidden" name="iraityu_sales_product" value="'.$iraityu_sales_product.'">';
            print '<input type="hidden" name="iraityu_sales" value="'.$iraityu_sales.'">';

              // iraityu_sales
            print '<input type="hidden" name="shop_code" value="'.$shop_code.'">';
            print '<input type="hidden" name="request_code" value="'.$request_code.'">';

              // iraityu_sales_product
            print '<input type="hidden" name="code_product" value="'.$code_product.'">';
            print '<input type="hidden" name="request_day" value="'.$request_day.'">';
            print '<input type="hidden" name="contents" value="'.$contents.'">';
            print '<input type="hidden" name="request_postal1" value="'.$request_postal1.'">';
            print '<input type="hidden" name="request_postal2" value="'.$request_postal2.'">';
            print '<input type="hidden" name="request_address" value="'.$request_address.'">';

          ?>

          <button class="w-100 btn btn-primary btn-lg" type="submit">依頼の完了手続きに進む &raquo;</button>

          <h6 class="mb-3"></h6>

          <button type="button" class="w-100 btn btn-primary btn-lg" onclick="history.back()" >戻る</button>
          </form>

          <h6 class="mb-3"></h6>

          <form method="post" class="needs-validation" action="pro_delete_done.php"  novalidate>
          <input type="hidden" name="code_product" value="<?php print $code_product; ?>">
          <button class="w-100 btn btn-primary btn-lg" type="submit" disabled>業務を取り消す（作成中） &raquo;</button>
          </form>

          <?php
          }else
          {
          // 戻る

         ?>




          <form>
          <button type="button" class="w-100 btn btn-primary btn-lg" onclick="history.back()" >戻る</button>
          </form>


          <?php
          }
          ?>


      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small">
  <p class="float-none"><a href="#">上へ移動する</a></p>
  </footer>
</div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="form-validation.js"></script>
  </body>
</html>
