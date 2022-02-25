

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

if($member_code==0)
{
  $no_member="<span style='color:red;'>ログイン後に利用できるようになります。</span>\n";

}

?>


<?php

try
{

  ini_set('display_errors',1);

  $dsn='mysql:dbname=site;host=localhost;charset=utf8';
  $user='root';
  $password='root';
  $dbh=new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
  $sql='SELECT 
  dat_member.name,
  dat_member.face_gazou,
  dat_member.assess,
  iraityu_sales_product.request_day,
  iraityu_sales_product.code
   FROM iraityu_sales_product 
   LEFT JOIN iraityu_sales
   ON iraityu_sales.code=iraityu_sales_product.code	/* on は結合 両テーブルとも同じタイミングて登録されているため、codeは同じくなる */
   LEFT JOIN dat_member
   ON iraityu_sales.request_code=dat_member.code	/* 顧客の個人情報  */
   
   WHERE iraityu_sales.shop_code=?';
  
  $stmt=$dbh->prepare($sql);
  $data=array();
  $data[]=$member_code;
  $stmt->execute($data);
  
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

<main>

  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    
    <div class="carousel-inner">

      <div class="carousel-item active">
      <img src="../top/images/jyutyu_gazou.jpg" width="100%" height="100%" alt="メインイメージ画像">
        <div class="container">
          <div class="carousel-caption ">
            <h1>受注画面</h1>
            <p>
            <?php if($member_code==0)
            {
              ?>

               <?php echo nl2br ($no_member);?>

            <?php
            }
            ?>
            受注されている顧客をリストアップしています。
          </p>
          </div>
        </div>
      </div>

    </div>
   
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
	if($face_gazou=='')
	{
		$disp_gazou='<img src="../product/gazou/figure_standing.png" class="rounded-circle" width="139" height="139" x="50%" y="50%"  dy=".3em">';
	}
	else
	{
		//	画像はDBから出した後、以下のようにする
		$disp_gazou='<img src="../product/gazou/'.$face_gazou.'" class="rounded-circle" width="139" height="139" x="50%" y="50%"  dy=".3em">';
	}


?>


      <div class="col-lg-4">
      <?php print  $disp_gazou;?>
          <title>Placeholder</title>
          <rect width="100%" height="100%" fill="#777"/>


        <h2><?php print  $rec['name'];?></h2>
        <h7>いいね数:<?php print  $rec['assess'];?></h7><br>
        <h7>サービスの希望日</h7>
        <div class="col-12">
        <textarea  id="request_day" type="text" class="form-control" name="request_day"   value="" rows="3" disabled><?php print  $rec['request_day'];?></textarea>
        </div>

        <p><?php //print  $rec['title'];?></p>
        <p><?php   print '<a class="btn btn-secondary" href="../iraityu/iraityu_check.php?procode='.$rec['code'].'">'; ?>内容を確認する &raquo;</a></p>
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


  </div>


  <!-- FOOTER -->
  <footer class="container">
    <p class="float-end"><a href="#">上へ移動する</a></p>
  </footer>
</main>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
