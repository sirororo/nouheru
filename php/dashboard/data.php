

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

/* ----------------------------------------------------------------------------------------------------------- */


$sql='SELECT
COUNT(ok_sales_product.code) AS sum_pay_free
FROM
ok_sales_product
INNER JOIN mst_product WHERE mst_product.code = ok_sales_product.code_product AND mst_product.gyousyu = 5';

$stmt=$dbh->prepare($sql);
//$data=array();
$stmt->execute();
$rec=$stmt->fetch(PDO::FETCH_ASSOC);

$sum_pay_free=$rec['sum_pay_free'];

$sum_pay_free = (int)$sum_pay_free;

$sen=1000;

$sum_pay_free = $sum_pay_free * $sen;


/* ----------------------------------------------------------------------------------------------------------- */

$sql='SELECT
SUM(ok_sales_product.pay) AS sum_pay_keiri
FROM
ok_sales_product
INNER JOIN mst_product WHERE mst_product.code = ok_sales_product.code_product AND mst_product.gyousyu = 4';

$stmt=$dbh->prepare($sql);
$stmt->execute();
$rec=$stmt->fetch(PDO::FETCH_ASSOC);

$sum_pay_keiri=$rec['sum_pay_keiri'];

// 取引金額累計
$sum_pay_keiri=(int)$sum_pay_keiri;

$commission = 0.2;

// 手数料
$sum_pay_keiri_com = $sum_pay_keiri * $commission;


$sql='SELECT
  COUNT(*) AS kazu_pay_keiri
FROM
  ok_sales_product
INNER JOIN mst_product WHERE mst_product.code = ok_sales_product.code_product AND mst_product.gyousyu = 4';

$stmt=$dbh->prepare($sql);
$stmt->execute();
$rec=$stmt->fetch(PDO::FETCH_ASSOC);

$kazu_pay_keiri = $rec['kazu_pay_keiri'];

$average_pay_keiri = $sum_pay_keiri / $kazu_pay_keiri;


/* ----------------------------------------------------------------------------------------------------------- */


$sql='SELECT
SUM(ok_sales_product.pay) AS sum_pay_saibai
FROM
ok_sales_product
INNER JOIN mst_product WHERE mst_product.code = ok_sales_product.code_product AND mst_product.gyousyu = 3';

$stmt=$dbh->prepare($sql);
$stmt->execute();
$rec=$stmt->fetch(PDO::FETCH_ASSOC);

$sum_pay_saibai=$rec['sum_pay_saibai'];

// 取引金額累計
$sum_pay_saibai=(int)$sum_pay_saibai;

// 手数料
$sum_pay_saibai_com = $sum_pay_saibai * $commission;


$sql='SELECT
  COUNT(*) AS kazu_pay_saibai
FROM
  ok_sales_product
INNER JOIN mst_product WHERE mst_product.code = ok_sales_product.code_product AND mst_product.gyousyu = 3';

$stmt=$dbh->prepare($sql);
$stmt->execute();
$rec=$stmt->fetch(PDO::FETCH_ASSOC);

$kazu_pay_saibai = $rec['kazu_pay_saibai'];

$average_pay_saibai = $sum_pay_saibai / $kazu_pay_saibai;


/* ----------------------------------------------------------------------------------------------------------- */


$sql='SELECT
SUM(ok_sales_product.pay) AS sum_pay_noukigu
FROM
ok_sales_product
INNER JOIN mst_product WHERE mst_product.code = ok_sales_product.code_product AND mst_product.gyousyu = 2';

$stmt=$dbh->prepare($sql);
$stmt->execute();
$rec=$stmt->fetch(PDO::FETCH_ASSOC);

$sum_pay_noukigu=$rec['sum_pay_noukigu'];

// 取引金額累計
$sum_pay_noukigu=(int)$sum_pay_noukigu;

// 手数料
$sum_pay_noukigu_com = $sum_pay_noukigu * $commission;



$sql='SELECT
  COUNT(*) AS kazu_pay_noukigu
FROM
  ok_sales_product
INNER JOIN mst_product WHERE mst_product.code = ok_sales_product.code_product AND mst_product.gyousyu = 2';

$stmt=$dbh->prepare($sql);
$stmt->execute();
$rec=$stmt->fetch(PDO::FETCH_ASSOC);

$kazu_pay_noukigu = $rec['kazu_pay_noukigu'];

$average_pay_noukigu = $sum_pay_noukigu / $kazu_pay_noukigu;

 //$average_pay_noukigu = $kazu_pay_noukigu / $sum_pay_noukigu;


/* ----------------------------------------------------------------------------------------------------------- */


$sql='SELECT
SUM(ok_sales_product.pay) AS sum_pay_daikou
FROM
ok_sales_product
INNER JOIN mst_product WHERE mst_product.code = ok_sales_product.code_product AND mst_product.gyousyu = 1';

$stmt=$dbh->prepare($sql);
$stmt->execute();
$rec=$stmt->fetch(PDO::FETCH_ASSOC);

$sum_pay_daikou=$rec['sum_pay_daikou'];


$sql='SELECT
  COUNT(*) AS kazu_pay_daikou
FROM
  ok_sales_product
INNER JOIN mst_product WHERE mst_product.code = ok_sales_product.code_product AND mst_product.gyousyu = 1';

$stmt=$dbh->prepare($sql);
$stmt->execute();
$rec=$stmt->fetch(PDO::FETCH_ASSOC);

$kazu_pay_daikou = $rec['kazu_pay_daikou'];

$average_pay_daikou = $sum_pay_daikou / $kazu_pay_daikou;


/* ----------------------------------------------------------------------------------------------------------- */


// 取引金額累計
$sum_pay_daikou=(int)$sum_pay_daikou;

// 手数料
$sum_pay_daikou_com = $sum_pay_daikou * $commission;


// 取引金額累計の合計
$sum_pay_total=$sum_pay_free + $sum_pay_keiri + $sum_pay_noukigu + $sum_pay_saibai + $sum_pay_daikou;

// 取引金額累計の合計（手数料）
$sum_pay_total_com = $sum_pay_free + intval($sum_pay_keiri_com) + intval($sum_pay_noukigu_com) + intval($sum_pay_saibai_com) + intval($sum_pay_daikou_com);


/* ----------------------------------------------------------------------------------------------------------- */




try
{


$sql='SELECT
mst_product.gyousyu,
ok_sales_product.code AS ok_sales_product,
mst_product.code,

ok_sales_product.code_product,
ok_sales_product.pay

 FROM ok_sales_product
 INNER JOIN mst_product
 WHERE mst_product.code=ok_sales_product.code_product';

$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;





?>











<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

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

    
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
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
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="trending-up"></span>
              売上
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="users"></span>
              ユーザー
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart"></span>
              サービス
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
       <br><br><br>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">手数料売上　<span style="color:red"><?php print $sum_pay_total_com;?></span></h1>
      </div>

      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

      <h2>売上の内訳</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">農業代行</th>
              <th scope="col">農機具</th>
              <th scope="col">栽培システム</th>
              <th scope="col">経理</th>
              <th scope="col">FREE(*1)</th>
              <th scope="col">合計金額</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>取引金額累計</td>
              <td><?php print $sum_pay_daikou;?></td>
              <td><?php print  $sum_pay_noukigu;?></td>
              <td><?php print  $sum_pay_saibai;?></td>
              <td><?php print  $sum_pay_keiri;?></td>
              <td><?php print  $sum_pay_free;?></td>
              <td><?php print  $sum_pay_total;?></td>
            </tr>
            <tr>
              <td>手数料売上(*2)</td>
              <td><?php print intval($sum_pay_daikou_com);?></td>
              <td><?php print intval($sum_pay_noukigu_com);?></td>
              <td><?php print intval($sum_pay_saibai_com);?></td>
              <td><?php print intval($sum_pay_keiri_com);?></td>
              <td><?php print $sum_pay_free;?>(*3)</td>
              <td><?php print $sum_pay_total_com;?></td>
            </tr>
            <tr>
              <td>平均取引金額</td>
              <td><?php print intval($average_pay_daikou);?></td>
              <td><?php print intval($average_pay_noukigu);?></td>
              <td><?php print intval($average_pay_saibai);?></td>
              <td><?php print intval($average_pay_keiri);?></td>
              <td>###</td>
              <td>###</td>
            </tr>
          </tbody>
        </table>
        *1　「無料サービス」の成約後に事業者から１回につき１０００円を頂戴すると仮定します。<br>
        *2　取引金額から２０％を手数料として頂戴すると仮定します（小数点切り捨て）。<br>
        *3　「FREE」のみそのまま表示させます。<br><br>
      </div>

      <h2>詳細データ</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">業種</th>
              <th scope="col">取引コード</th>
              <th scope="col">サービス品コード</th>
              <th scope="col">取引金額</th>
            </tr>
          </thead>
          <tbody>


<?php

/*
while(1){
//無限に繰り返す処理を記載
}
while(true){
//無限に繰り返す処理を記載
}

ここでは$recが、空になったらbreakになる
*/
while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
		break;
	}


	// 業種を取り出す
	$gyousyu=$rec['gyousyu'];
	if($gyousyu==1){

		$disp_gyousyu='農業代行';
	
	}elseif($gyousyu==2){
		
		$disp_gyousyu='農機具レンタル';
	
	}elseif($gyousyu==3){
	
		$disp_gyousyu='栽培システム';
	
	}elseif($gyousyu==4){
	
		$disp_gyousyu='経理・会計';
	
	}elseif($gyousyu==5){
	
		$disp_gyousyu='FREE';
	
	}else{
		print '';
	}


?>

            <tr>
              <td><?php print $disp_gyousyu;?></td>
              <td><?php print $rec['ok_sales_product'];?></td>
              <td><?php print $rec['code_product'];?></td>
              <td><?php print $rec['pay'];?></td>
            </tr>


<?php

}



}
catch (Exception $e)
{
	 //print 'ただいま障害により大変ご迷惑をお掛けしております。';
	 //exit();
}



?>

          </tbody>
        </table>
      </div>

    </main>
  </div>
</div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" integrity="sha384-EbSscX4STvYAC/DxHse8z5gEDaNiKAIGW+EpfzYTfQrgIlHywXXrM9SUIZ0BlyfF" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha384-i+dHPTzZw7YVZOx9lbH5l6lP74sLRtMtwN2XjVqjf3uAGAREAF4LMIUDTWEVs4LI" crossorigin="anonymous">

      </script><script>
      
      
      
      
      (function () {
  'use strict'

  feather.replace({ 'aria-hidden': 'true' })

  var ctx = document.getElementById('myChart')
  var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      
      labels: [
        '農業代行',
        '農機具',
        '栽培システム',
        '経理',
        'FREE'
      ],
      datasets: [{
        backgroundColor: [
          "#2ecc71",
          "#3498db",
          "#95a5a6",
          "#9b59b6",
          "#f1c40f"
        ],
        data: [
          <?php print intval($sum_pay_daikou_com);?>,
          <?php print intval($sum_pay_noukigu_com);?>,
          <?php print intval($sum_pay_saibai_com);?>,
          <?php print intval($sum_pay_keiri_com);?>,
          <?php print $sum_pay_free;?>
        ],
        
      }]
    }
  })
})()
</script>
  </body>
</html>
