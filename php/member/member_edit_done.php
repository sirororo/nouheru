
<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	$member_name='ゲスト';
	$member_code=0;
	//$disp_member_login='<a href="../member/member_login.html">会員ログイン</a>';
	//$disp_member_new='<a href="../member/member_new.html">無料会員登録</a><br />';
}
else
{
	$member_name=$_SESSION['member_name'];
	$member_code=$_SESSION['member_code'];

}
?>

<?php
ini_set('display_errors',1);

try
{

    $member_code=$_SESSION['member_code'];

    require_once('../common/common.php');

    $post=sanitize($_POST);

    $user_name=$post['user_name'];
    $email=$post['email'];
    $postal1=$post['postal1'];
    $postal2=$post['postal2'];
    $address=$post['address'];
    $tel=$post['tel'];

	$face_gazou=$_POST['face_gazou'];

	$face_gazou=htmlspecialchars($face_gazou);

$dsn='mysql:dbname=site;host=handson.czoyfw5itcgq.ap-northeast-1.rds.amazonaws.com;charset=utf8;';
$user='admin';
$password='50Aruki20';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='UPDATE dat_member SET 

name=?,
email=?,
postal1=?,
postal2=?,
address=?,
tel=?,
face_gazou=?

 WHERE 
 code=?';
$stmt=$dbh->prepare($sql);

$data[]=$user_name;
$data[]=$email;
$data[]=$postal1;
$data[]=$postal2;
$data[]=$address;
$data[]=$tel;
$data[]=$face_gazou;

$data[]=$member_code;

$stmt->execute($data);

$dbh=null;

//ログアウトする
$_SESSION=array();
if(isset($_COOKIE[session_name()])==true)
{
	setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();

}

catch (Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

<!---------------------------------------------------------------------------------------------------------------->

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <title>らくらく</title>
  <link rel="stylesheet" href="../top/css/reset.css"/>
  <link rel="stylesheet" href="../top/css/style.css"/>

<script>
  (function(d) {
    var config = {
      kitId: 'dsd7crf',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>
</head>

<body>
<div class="container">
    <header class="header">
        <h1>農家をお助けするアプリ</h1>
        <ul>


<?php
if($member_code==0)
{
?>

<!--ログアウト中-->

            <li><a href="#"><?php print  $disp_member_login;?></a></li>
            <li><a href="#"><?php print  $disp_member_new;?></a></li>

<?php
}else{
?>

<!--ログイン中-->

            <li><a href="#"><?php print  $disp_member_logout;?></a></li>
            <li><a href="#"><?php print  $disp_pro_list;?></a></li>

<?php
}
?>

</ul>

    </header>
    <div class="TopPhoto">
        <img src="../top/images/TopPhoto.png" alt="メインイメージ画像">
    </div>
    
    <nav>
        <ul>
            <li><a href="../shop/shop_list.php">管理画面</a></li>
            <li><a href="../shop/daikou_list.php">農業代行</a></li>
            <li><a href="../shop/noukigu_list.php">農機具レンタル</a></li>
            <li><a href="../shop/help_list.php">栽培システム設置の代行</a></li>
            <li><a href="../shop/house_list.php">専門の経理・会計</a></li>
            <li><a href="../shop/sonota_list.php">その他のお手伝い</a></li>
        </ul>
    </nav>
    





<?php print $user_name; ?>さんの個人設定を修正の完了しました。<br /><br />


ログアウトしました。<br />

<br />
<a href="member_login.html">ログイン画面へ</a>



</body>
</html>