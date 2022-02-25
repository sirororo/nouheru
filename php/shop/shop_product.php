<!--
shop_product.php
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
ini_set('display_errors',1);

/*
try
{
*/



// 最後に//を消しておく
 $pro_code=$_GET['procode'];





$dsn='mysql:dbname=site;host=handson.czoyfw5itcgq.ap-northeast-1.rds.amazonaws.com;charset=utf8;';
$user='admin';
$password='50Aruki20';
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

<?php
  if($member_code=='')
    {
      $no_member = "<span style='color:red;'>ログイン後に無料相談がご利用できるようになります。</span>\n";

    }

  $staff=true;

  if($shop_code==$member_code)
  {
    $staff=false;

    $no_staff = "<span style='color:red;'>ご本人は申込ができません。</span>\n";


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
    <?php print $disp_face_gazou; ?>
      <h2>サービス内容</h2>

      <p class="lead">
      <br />
      <?php

          if($member_code=='')
          {
           ?>

          <?php echo nl2br ($no_member); ?>

           <?php
          }
          ?>

          <?php

          if($staff==false)
          {
          ?>

          <?php echo nl2br ($no_staff); ?>

          <?php
          }
          ?>

          相談は無料ですので気軽にご利用ください。<br /><br />

        </p>
    </div>

   

      <div class="col-md-7 col-lg-8">

          <form method="post" class="needs-validation" action="shop_iraityu_check1.php" novalidate>
            <?php
            print '<input type="hidden" name="procode" value="'.$pro_code.'">';
            ?>
            <?php
            if($member_code=='' || $staff==false)
            {
              ?>

            <button  class="w-100 btn btn-primary btn-lg" type="submit" disabled>無料相談をする</button>

            <?php
            }else
            {
              ?>

            <button  class="w-100 btn btn-primary btn-lg" type="submit" >無料相談をする &raquo;</button>

            <?php
            }
            ?>
          </form>





        <h4 class="mb-3"></h4>

        <h4 class="mb-3"></h4>
          <div class="row g-3">

            <div class="col-sm-5">
              <label for="username" class="form-label">氏名</label>
              <input  id="username" type="text" class="form-control" name="title"   value="<?php print $name; ?>"  disabled>
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


          </div>

        <hr class="my-4" size="8" >


           
          <h4 class="mb-3"></h4>

            <h6 class="mb-3">作業写真</h6>

            <div class="container page-header">
            <div class="py-5 text-center">

            <p class="lead">
            <br />
            <?php print $disp_gazou; ?>

              </p>
    </div>

   

      <div class="col-md-7 col-lg-8">

            </div>

          <hr class="my-4"size="8" >

          <h4 class="mb-3"></h4>

          <div class="py-5 text-center">
            <h2>口コミ</h2>
            <p class="lead">
            <br />

            過去にサービスを受けた人の口コミと実際に支払った金額を表示します。<br />
              </p>
          </div>


          <?php

          $dsn='mysql:dbname=site;host=localhost;charset=utf8';
          $user='root';
          $password='root';
          $dbh=new PDO($dsn,$user,$password);
          $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

          /*  業者の評価の口コミと金額 */
          $sql='SELECT
          ok_sales_product.word_mouth,
          ok_sales_product.pay
          FROM ok_sales_product
          LEFT JOIN ok_sales
          ON ok_sales.code=ok_sales_product.ok_sales	/* on は結合 両テーブルとも同じタイミングて登録されているため、codeは同じくなる */

          WHERE ok_sales.shop_code=?';

          $stmt=$dbh->prepare($sql);
          $data=array();
          $data[]=$shop_code;
          $stmt->execute($data);

          $dbh=null;

          while(true)
          {
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            if($rec==false)
            {
              break;
            }

          ?>



          <h4 class="mb-3"></h4>
            <div class="col-12">
              <label for="word_mouth" class="form-label">お店のクチコミ</label>
              <textarea  id="word_mouth" type="text" class="form-control"   value="" rows="5" disabled><?php print  $rec['word_mouth'];?></textarea>
            </div>

            

          <h4 class="mb-3"></h4>
            <div class="col-sm-3">
              <label for="pay" class="form-label">支払い金額の実績</label>
              <input  id="pay" type="text" class="form-control"   value="<?php print $rec['pay']; ?>"  disabled>
            </div>

            <hr class="my-4">

          <?php
          }
          ?>





          <form>
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
