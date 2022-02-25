

<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	$member_name='ゲスト';
	$member_code=0;
	$disp_member_login='<a href="../member/member_login.html">会員ログイン</a>';
	$disp_member_new='<a href="../member/member_new.html">無料会員登録</a><br />';

  $disp_member_left='<a href="../member/member_login.html">ログイン</a>';
	$disp_member_right='<a href="../member/member_new.html">無料登録</a><br />';
}
else
{
	$member_name=$_SESSION['member_name'];
	$member_code=$_SESSION['member_code'];
	$disp_member_logout='<a href="../member/member_logout.php">ログアウト</a><br />';
	$disp_pro_list='<a href="../product/pro_list.php">サービス追加</a><br />';

  $disp_member_left='<a href="../member/member_login.html">ログアウト</a>';
	//$disp_member_right='<a href="../product/pro_list.php">サービス追加</a><br />';

}
?>


<?php

try
{

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
 WHERE mst_product.shop_code=dat_member.code AND mst_product.gyousyu=5';		/* 検索  */

$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;


?>






<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Carousel Template · Bootstrap v5.0</title>

    <link rel="stylesheet" href="reset.css"/>
  <link rel="stylesheet" href="style.css"/>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/carousel/">

    

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
    <link href="carousel.css" rel="stylesheet">
  </head>
  <body>

  <header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="btn btn-outline-light me-2" role="button" href="../shop/shop_list.php" >マイページ</a>
      <a class="btn btn-outline-light me-2" role="button" href="../dashboard/data.php">運用管理データ</a>
      <a class="btn btn-outline-light me-2" role="button" href="../shop/daikou_list.php" >カテゴリ一覧</a>

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

<main>

  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>


    </div>
    <div class="carousel-inner">

      <div class="carousel-item active">
      <img src="../top/images/free.jpg" width="100%" height="100%" alt="メインイメージ画像">
        <div class="container">
          <div class="carousel-caption">
            <h1>無料サービス</h1>
            <p>無料の代わりにアンケートに答えてもらうことでサービスの向上と宣伝に繋がります。</p>
            <p><a class="btn btn-lg btn-primary" href="../shop/index.php">確認する</a></p>
          </div>
        </div>
      </div>

    <div class="carousel-item">
      <img src="../top/images/daikou.jpg" width="100%" height="100%" alt="メインイメージ画像">
        <div class="container">
          <div class="carousel-caption ">
            <h1>農業代行・委託サービス</h1>
            <p>栽培代行から耕運・草刈りまで経験豊富な専門家に業務を代行できます。</p>
            <p><a class="btn btn-lg btn-primary" href="../shop/daikou_list.php">確認する</a></p>
          </div>
        </div>
      </div>

      <div class="carousel-item">
      <img src="../top/images/noukigu.jpg" width="100%" height="100%" alt="メインイメージ画像">
        <div class="container">
          <div class="carousel-caption">
            <h1>農機具レンタル</h1>
            <p>レンタルすることで高額な機械を購入するよりも導入費用やメンテナンスなどコストを大幅に減らすことができます。</p>
            <p><a class="btn btn-lg btn-primary" href="../shop/noukigu_list.php">確認する</a></p>
          </div>
        </div>
      </div>

      <div class="carousel-item">
      <img src="../top/images/saibai.jpg" width="100%" height="100%" alt="メインイメージ画像">
        <div class="container">
          <div class="carousel-caption">
            <h1>栽培システムのレンタル</h1>
            <p>最新の農業設備をレンタルすることで低予算から始められます。</p>
            <p><a class="btn btn-lg btn-primary" href="../shop/saibai_list.php">確認する</a></p>
          </div>
        </div>
      </div>

      <div class="carousel-item">
      <img src="../top/images/keiri.jpg" width="100%" height="100%" alt="メインイメージ画像">
        <div class="container">
          <div class="carousel-caption">
            <h1>専門の経理・会計</h1>
            <p>会計業務を農業の専門家に委託することで事業に専念できるようになります。</p>
            <p><a class="btn btn-lg btn-primary" href="../shop/keiri_list.php">確認する</a></p>
          </div>
        </div>
      </div>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


  <div class="container marketing">

  <nav>
        <ul>
            <li><a href="daikou_list.php">農業代行</a></li>
            <li><a href="noukigu_list.php">農機具レンタル</a></li>
            <li><a href="saibai_list.php">栽培システムのレンタル</a></li>
            <li><a href="keiri_list.php">専門の経理・会計</a></li>
            <li><a href="index.php">無料サービス</a></li>
        </ul>
    </nav>


    <br>

            <h1 class="text-center">無料サービス</h1>

    <br>


    <div class="row">


    <?php


while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}

	// 画像を取り出す
	$face_gazou=$rec['face_gazou'];
  //var_dump($face_gazou);

	if($face_gazou=='')
	{
		$disp_gazou='<img src="../product/gazou/figure_standing.png" class="rounded-circle" width="139" height="139" x="50%" y="50%"  dy=".3em">';
	}
	else
	{
		//	画像はDBから出した後、以下のようにする
    //$disp_gazou='<img src="'.$face_gazou.'" class="rounded-circle" width="139" height="139" x="50%" y="50%"  dy=".3em">';

		$disp_gazou='<img src="../product/gazou/'.$face_gazou.'" class="rounded-circle" width="139" height="139" x="50%" y="50%"  dy=".3em">';
	}


?>


      <div class="col-lg-4">
      <?php print  $disp_gazou;?>
          <title>Placeholder</title>
          <rect width="100%" height="100%" fill="#777"/>


        <h2><?php print  $rec['name'];?></h2>
        <h7>いいね数:<?php print  $rec['assess'];?></h7>
        <p><?php print  $rec['title'];?></p>
        <p><?php   print '<a class="btn btn-secondary" href="../shop/shop_product.php?procode='.$rec['code'].'">'; ?>内容を確認する &raquo;</a></p>
      </div>



      <?php

}



}
catch (Exception $e)
{
	 print 'ただいま障害により大変ご迷惑をお掛けしております。';
	 exit();
}

?>





    </div>

    


  
    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">なぜ無料でサービスを受けられるの？</h2>
        <p class="lead">企業の広告宣伝とサービス向上のための検証などを兼ねているため、無料にして多くの人に利用してもらうことを目的にしています。</p>
      </div>
      <div class="col-md-5">
      <img src="../product/gazou/free1.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500"  x="50%" y="50%"  dy=".3em">

      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">無料サービスを受けた後も気に入ればそのまま購入ができる。</h2>
        <p class="lead">最新の機械や栽培システムの導入には高いコストと事業者ごとのビジネスモデルが適さないリスクがあるが、無料で実際に試せるため購入のハードルを下げることができる。</p>
      </div>
      <div class="col-md-5 order-md-1">
      <img src="../product/gazou/free2.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500"  x="50%" y="50%"  dy=".3em">

      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">無料サービスの依頼の際の注意</h2>
        <p class="lead">ルール：サービス向上のために良い点・悪い点ともに評価してください。</p>
      </div>
      <div class="col-md-5">
      <img src="../product/gazou/free3.jpg" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500"  x="50%" y="50%"  dy=".3em">

      </div>
    </div>

    <hr class="featurette-divider">

   

  </div>


  <!-- FOOTER -->
  <footer class="container">
    <p class="float-end"><a href="#">上へ移動する</a></p>
  </footer>
</main>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
