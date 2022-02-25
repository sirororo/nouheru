<?php
	// セッションを呼んで
	session_start();

	//セッション内を改ざんされないように、暗号化する
	session_regenerate_id(true);
?>


<?php

/*
try
{
*/
ini_set('display_errors',1);
require_once('../common/common.php');

$post=sanitize($_POST);

$onamae=$post['onamae'];
$email=$post['email'];
$postal1=$post['postal1'];
$postal2=$post['postal2'];
$address=$post['address'];
$tel=$post['tel'];

$pass=$post['pass'];
$danjo=$post['danjo'];
$birth=$post['birth'];

$face_gazou_name=$post['face_gazou_name'];

//		お客様にメールを送るためや、データに登録するために変数に入れて後で使う。　下の方で行う		//

//   以下はメール文。メール文での改行は　　"\n"　で表示。必ずダブルクォーテーション。
$honbun='';
$honbun.=$onamae."様\n\nこのたびはご登録ありがとうございました。\n";
$honbun.="\n";

$honbun.="--------------------\n";

$dsn='mysql:dbname=site;host=handson.czoyfw5itcgq.ap-northeast-1.rds.amazonaws.com;charset=utf8;';
$user='admin';
$password='50Aruki20';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//			会員登録をする			//


	$assess=0;

//  会員登録していく

	$sql='INSERT INTO dat_member (
	password,
	name,
	email,
	postal1,
	postal2,
	address,
	tel,
	danjo,
	born,
	face_gazou,
	assess) 
	VALUES (?,?,?,?,?,?,?,?,?,?,?)';
	$stmt=$dbh->prepare($sql);
	$data=array();
	$data[]=md5($pass);		//	パスワードは暗号化
	$data[]=$onamae;
	$data[]=$email;
	$data[]=$postal1;
	$data[]=$postal2;
	$data[]=$address;
	$data[]=$tel;

	if($danjo=='dan')	// danは男性
	{
		$data[]=1;		//１は男性
	}
	else
	{
		$data[]=2;		// ２は女性
	}
	$data[]=$birth;
	$data[]=$face_gazou_name;
	$data[]=$assess;

	$stmt->execute($data);

	$sql='SELECT LAST_INSERT_ID()';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	$lastcode=$rec['LAST_INSERT_ID()'];	

	//session_start();
	$_SESSION['member_login']=1;
	$_SESSION['member_code']=$lastcode;
	$_SESSION['member_name']=$onamae;

	$dbh=null;

//			２、お客様にメールを送る		//


//   以下はメール文。メール文での改行は　　"\n"　で表示。必ずダブルクォーテーション。



$honbun.="会員登録が完了いたしました。\n";
$honbun.="次回からメールアドレスとパスワードでログインしてください。\n";
$honbun.="ご利用が簡単にできるようになります。\n";
$honbun.="\n";



$honbun.="□□□□□□□□□□□□□□\n";
$honbun.="　～株式会社ラクラク～\n";
$honbun.="\n";
$honbun.="〒100-8111 東京都千代田区千代田１−１\n";
$honbun.="電話  03-3213-1111\n";
$honbun.="メール info@rakuraku.co.jp\n";
$honbun.="□□□□□□□□□□□□□□\n";

//print '<br />';
// nl2br($oooo) でブラウザでメール本文を確認できる。実際のメール文は何も変わらない。
//print nl2br($honbun);


// 以下は顧客にメールを送るプログラム

$title='ご登録ありがとうございます。'; //  メールタイトル
$header='From:info@rakuraku.co.jp'; //　送信元のアドレス（店舗側）
$honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');  
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail($email,$title,$honbun,$header);  //メールを送信する（＄emailが最初）

/*
}

catch (Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}
*/


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
    <div class="text-end">
      <a class="btn btn-outline-light me-2" role="button" href="../shop/shop_list.php" >マイページ</a>
      <a class="btn btn-outline-light me-2" role="button" href="../dashboard/data.php">運用管理データ</a>
      <a class="btn btn-outline-light me-2" role="button" href="../shop/index.php" >カテゴリ一覧</a>
    </div>
  </nav>
</header>

<br><br><br>

<main class="container">
  <div class="bg-light p-5 rounded">
    <h1>ご登録完了致しました。</h1>
    <p class="lead"><?php print $onamae;?>様の<?php print $email; ?>にメールを送りましたのでご確認ください。<br />メールが届かない場合は、設定でメールアドレスを変更してください。</p>
    <a class="btn btn-lg btn-primary" href="../shop/daikou_list.php" role="button">トップへ移動する &raquo;</a>
    <a class="btn btn-lg btn-primary" href="../product/pro_add.php" role="button">仕事を登録する &raquo;</a>
  </div>
</main>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
