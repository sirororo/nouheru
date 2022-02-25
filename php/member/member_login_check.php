<?php

session_start();
// var_dump($_SESSION["csrf_token"]);
// var_dump($_POST["csrf_token"]);
// var_dump($_SESSION['loginCount']);
// var_dump($_SESSION['no_ligin']);


$okflg=true;

// ログインブロック解除用
// $_SESSION['no_ligin']=0;
// $_SESSION['loginCount'] = 0;

?>



<?php

session_start();

if($_SESSION['loginCount'] >= 3){
  //3回以上失敗
  $no_count="<span style='color:red;'>３回間違えましたのでログインできません。</span>\n";
  $okflg=false;

  //３回以上間違えた場合もうログインできないようにする
   $_SESSION['no_ligin']=1;


}



?>


<?php



try
{

require_once('../common/common.php');

$post=sanitize($_POST);
$member_email=$post['email'];
$member_pass=$post['pass'];
$member_pass=md5($member_pass);

$dsn='mysql:dbname=site;host=handson.czoyfw5itcgq.ap-northeast-1.rds.amazonaws.com;charset=utf8;';
$user='admin';
$password='50Aruki20';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,name FROM dat_member WHERE email=? AND password=?';
$stmt=$dbh->prepare($sql);
$data[]=$member_email;
$data[]=$member_pass;
$stmt->execute($data);

$dbh=null;

$rec=$stmt->fetch(PDO::FETCH_ASSOC);

//  WHEREの条件に適した$recがあれば
session_start();
// 会員情報あるいは３回以上間違えていれば
if($rec==false || $_SESSION['no_ligin']==1)
{
	 $_SESSION['loginCount']++;


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
    <h1>メールアドレスかパスワードが間違っています。</h1>
    <p class="lead"><br>
    <?php
        // 入力に適さないエラー表示
        if($okflg==false)
        {
          ?>
    
    <?php echo nl2br ($no_csrf);?>
    <?php echo nl2br ($no_count);?>
    <?php
        }
        ?>
      ３回連続間違えるとログインできなくなります。</p>
    <a class="btn btn-lg btn-primary" href="member_login.php" role="button">戻る</a>
  </div>
</main>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>


<?php

}
else
{
    //  条件にあった、テーブルdat_memberの$recの中の中身を出してセッションに入れる



	session_start();
	$_SESSION['no_ligin']=true;
	$_SESSION['member_login']=0;
	$_SESSION['member_code']=$rec['code'];
	$_SESSION['member_name']=$rec['name'];
	header('Location:../shop/index.php');
	exit();

  
}

}
catch(Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

