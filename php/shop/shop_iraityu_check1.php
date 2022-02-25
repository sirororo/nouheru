<!--
shop_iraityu_check1.php
-->

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


/*
try
{
*/


require_once('../common/common.php');

	$post=sanitize($_POST);

  $pro_code=$post['procode'];




  $dsn='mysql:dbname=site;host=localhost;charset=utf8';
  $user='root';
  $password='root';
  $dbh=new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
  
  /*  業者の情報  */
  $sql='SELECT
  dat_member.code,
  dat_member.name,
  dat_member.face_gazou,
  dat_member.assess,
  mst_product.title,
  mst_product.price,
  mst_product.gazou,
  mst_product.serves,
  mst_product.business_hours,
  mst_product.support_place,
  mst_product.pay,
  mst_product.profile
  
   FROM mst_product
   LEFT JOIN dat_member
   ON dat_member.code=mst_product.shop_code	/* on は結合 両テーブルとも同じタイミングて登録されているため、codeは同じくなる */
   WHERE mst_product.code=?';
  
  $stmt=$dbh->prepare($sql);
  //$data=array();
  $data[]=$pro_code;
  $stmt->execute($data);
  $rec=$stmt->fetch(PDO::FETCH_ASSOC);
  
  $shop_code=$rec['code'];
  $name=$rec['name'];
  $face_gazou=$rec['face_gazou'];
  $assess=$rec['assess'];
  
  $title=$rec['title'];
  $price=$rec['price'];
  $gazou_name=$rec['gazou'];
  $serves=$rec['serves'];
  $business_hours=$rec['business_hours'];
  $support_place=$rec['support_place'];
  $pay_way=$rec['pay'];
  $profile=$rec['profile'];
  
  
  $dbh=null;
  
  // サービス画像
  if($gazou_name=='')
  {
    $disp_gazou='<img src="../product/gazou/gazou_image.png">';
  }
  else
  {
    //	画像はDBから出した後、以下のようにする
    $disp_gazou='<img src="../product/gazou/'.$gazou_name.'">';
  }
  
  // 商品画像
  if($face_gazou=='')
  {
    $disp_face_gazou='<img class="rounded-circle" alt="" width="152" height="187" src="../product/gazou/figure_standing.png">';		//
  }
  else
  {
    //	画像はDBから出した後、以下のようにする
    $disp_face_gazou='<img class="rounded-circle"alt="" width="200" height="187" src="../product/gazou/'.$face_gazou.'">';
  }
  
  // ログインの有無で変える
  if($member_code==''){
  
    $disp_soudan="会員ログイン後に相談できるようになります（赤字）";
  
  }else{
  
    $disp_soudan='<a href="../shop/shop_iraityu_check1.php?procode='.$pro_code.'">個人無料相談</a>';
  
  }
  
  /*
}
catch(Exception $e)
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
      <h2>業務内容の項目</h2>
      <p class="lead">業務内容は登録後に変更も可能です。</p>
    </div>


      <div class="col-md-7 col-lg-8">

      <h4 class="mb-3">作業内容の詳細を記入して下さい。</h4>

      <form method="post" class="needs-validation" action="shop_iraityu_check2.php"  novalidate>



        <h4 class="mb-3"></h4>
        <h4 class="mb-3"></h4>

          <div class="row g-3">

            <div class="col-12">
              <label for="contents" class="form-label">作業内容を入力して下さい。 <span class="text-muted">(最大３５０文字)</span></label>
              <textarea  id="contents" type="text" class="form-control" name="contents" placeholder="例１：畑仕事をするため機械を借りたい。例２：野菜の収穫のための人手が欲しい" value="" maxlength="350"rows="10" required></textarea>
              <div class="invalid-feedback">
              作業内容を入力して下さい。
              </div>
            </div>

            <div class="col-12">
              <label for="request_day" class="form-label">作業日付を入力してください。<span class="text-muted">(最大３５０文字)</span></label>
              <textarea  id="request_day" type="text" class="form-control" name="request_day"  placeholder="例：６月１３・１４日の２日間で午前４時〜１２時を希望しています。" value="" maxlength="350" rows="10" required></textarea>
              <div class="invalid-feedback">
              作業日付を入力してください。
              </div>
            </div>

            <div class="col-12">
              <label for="address1" class="form-label">作業場所の郵便番号（上３桁）<span class="text-muted">(半角英数字)</span></label>
              <input id="address1" name="postal1" type="text" class="form-control" placeholder="xxx" maxlength="3" required>
              <div class="invalid-feedback">
                郵便番号を３桁入力してください。
              </div>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">作業場所の郵便番号（下４桁）<span class="text-muted">(半角英数字)</span></label>
              <input id="address2" name="postal2" type="text" class="form-control"  placeholder="xxxx" maxlength="4" required>
              <div class="invalid-feedback">
              郵便番号を４桁入力してください。
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">作業場所の住所</label>
              <input name="address" type="text" class="form-control" id="address" placeholder="東京都xxx市" required>
              <div class="invalid-feedback">
                住所を入力して下さい。
              </div>
            </div>

            <h4 class="mb-3"></h4>

            <button class="w-100 btn btn-primary btn-lg" type="submit">確認して進む &raquo;</button>

            <button type="button" class="w-100 btn btn-primary btn-lg" onclick="history.back()" >戻る</button>

            <hr class="my-4" size="8">

            <div class="col-sm-5">
              <label for="username" class="form-label">氏名</label>
              <input  id="username" type="text" class="form-control" name="title"   value="<?php print $name; ?>"  disabled>
              <?php print $disp_face_gazou; ?>
            </div>

            <h4 class="mb-3"></h4>
            <div class="col-sm-3">
              <label for="good" class="form-label">いいね数</label>
              <input  id="good" type="text" class="form-control" name="title"   value="<?php print $assess; ?>"  disabled>
            </div>


            <h4 class="mb-3"></h4>
            <div class="col-sm-13">
              <label for="title class="form-label">タイトル名</label>
              <input  id="title" type="text" class="form-control" name="title"   value="<?php print  $title;?>"  disabled>
            </div>

            <h4 class="mb-3"></h4>
            <div class="col-12">
              <label for="profile" class="form-label">プロフィール </label>
              <textarea  id="profile" type="text" class="form-control" name="profile"  value="" rows="10" disabled><?php print  $profile;?></textarea>
            </div>

            <h4 class="mb-3"></h4>
            <div class="col-12">
              <label for="serves" class="form-label">サービス内容。</label>
              <textarea  id="serves" type="text" class="form-control" name="serves"   value=""  rows="10" disabled><?php print  $serves;?></textarea>
            </div>

            <h4 class="mb-3"></h4>
            <div class="col-12">
              <label for="price" class="form-label">サービスの価格</label>
              <textarea  id="price" type="text" class="form-control" name="price"  value=""  rows="10" disabled><?php print  $price;?></textarea>
            </div>

            <h4 class="mb-3"></h4>
            <div class="col-12">
              <label for="business_hours"  class="form-label">営業時間</label>
              <textarea  id="business_hours"  type="text" class="form-control" name="business_hours"   value="" rows="10" disabled><?php print  $business_hours;?></textarea>
            </div>

            <h4 class="mb-3"></h4>
            <div class="col-12">
              <label for="support_place" class="form-label">対応可能地域</label>
              <textarea  id="support_place" type="text" class="form-control" name="support_place"  value="" rows="10" disabled><?php print  $support_place;?></textarea>
            </div>

            <h4 class="mb-3"></h4>
            <div class="col-12">
              <label for="pay" class="form-label">支払い方法</label>
              <textarea  id="pay" type="text" class="form-control" name="pay"   value="" rows="10" disabled><?php print  $pay_way;?></textarea>
            </div>


            <hr class="my-4" >

          <h4 class="mb-3"></h4>
            <h6 class="mb-3">作業写真</h6>
            <div class="container page-header">
            <div class="py-5 text-center">
            <p class="lead">
            <br />
            <?php print $disp_gazou; ?>
              </p>

        </div>

        <h4 class="mb-3"></h4>

        <?php print '<input type="hidden" name="procode" value="'.$pro_code.'">'; ?>

        <button class="w-100 btn btn-primary btn-lg" type="submit">確認して進む &raquo;</button>
          <h6 class="mb-3"></h6>
        <button type="button" class="w-100 btn btn-primary btn-lg" onclick="history.back()" >戻る</button>
        </form>
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
