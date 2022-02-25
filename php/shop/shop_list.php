<!--
pro_list.php
-->



<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{

$disp_gazou='<img src="../product/gazou/guest.png">';		//イメージ画像

$member_name='ゲスト';
$member_code=0;
$disp_member_login='<a href="../member/member_login.php">会員ログイン</a>';
$disp_member_new='<a href="../member/member_new.php">無料会員登録</a><br />';

}
else
{

$member_code=$_SESSION['member_code'];

$dsn='mysql:dbname=site;host=handson.czoyfw5itcgq.ap-northeast-1.rds.amazonaws.com;charset=utf8;';
$user='admin';
$password='50Aruki20';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT 
name,
face_gazou
FROM dat_member WHERE code=?';
$stmt=$dbh->prepare($sql);
$data[]=$member_code;
$stmt->execute($data);

$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$member_name=$rec['name'];
$member_name="$member_name";
$face_gazou=$rec['face_gazou'];

$dbh=null;

if($face_gazou=='')
{
	$disp_gazou='<img src="../product/gazou/figure_standing.png">';		//イメージ画像
}
else
{
	//	画像はDBから出した後、以下のようにする
	$disp_gazou='<img src="../product/gazou/'.$face_gazou.'">';
}

$disp_member_logout='<a href="../member/member_logout.php">ログアウト</a><br />';
//$disp_pro_list='<a href="../product/pro_list.php">業種の追加や変更</a><br />';

}



?>



<?php

/*
try
{
*/
$dsn='mysql:dbname=site;host=handson.czoyfw5itcgq.ap-northeast-1.rds.amazonaws.com;charset=utf8;';
$user='admin';
$password='50Aruki20';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT
mst_product.code,
mst_product.title,
mst_product.price,
mst_product.gyousyu,
dat_member.name,
dat_member.face_gazou,
dat_member.assess

 FROM mst_product
 INNER JOIN dat_member		/* INNER JOINは条件が満たされていない不要な行を削ぎ落とします。  */
 ON mst_product.shop_code=dat_member.code	/* on は結合  */
 WHERE mst_product.shop_code=dat_member.code';		/* 検索  */

/*
gyousyu
1=代行
2=農機具レンタル
3=ビニールハウス
4=手伝い
5=その他
*/

$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;

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

<br><br><br>

<main class="container">
  <div class="bg-light p-5 rounded">
    <h1>個人設定</h1><br />
    <p class="lead">自分の登録情報を確認できるようになります。<br /><br /></p>
    <a class="btn btn-lg btn-primary" href="../member/member_disp.php" role="button">確認をする &raquo;</a>
  </div>
</main>

<h4 class="mb-3"></h4>

<main class="container">
  <div class="bg-light p-5 rounded">
    <h1>サービス設定</h1><br />
    <p class="lead">自分のサービス情報を確認できるようになります。<br /><br /></p>
    <a class="btn btn-lg btn-primary" href="../product/pro_list.php" role="button">確認をする &raquo;</a>
  </div>
</main>

<h4 class="mb-3"></h4>

<main class="container">
  <div class="bg-light p-5 rounded">
    <h1>依頼中のリスト</h1><br />
    <p class="lead">サービスを依頼している業者のリストを表示します。<br /><br />
      </p>
    <a class="btn btn-lg btn-primary" href="../shop/iraityu_list.php" role="button">確認をする &raquo;</a>
  </div>
</main>

<h4 class="mb-3"></h4>

<main class="container">
  <div class="bg-light p-5 rounded">
    <h1>受注中のリスト</h1><br />
    <p class="lead">自分が提供しているサービスに依頼があった場合、依頼者のリストが表示されます。<br /><br /></p>
    <a class="btn btn-lg btn-primary" href="../shop/jyutyu_list.php" role="button">確認をする &raquo;</a>
  </div>
</main>

<h4 class="mb-3"></h4>



    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
