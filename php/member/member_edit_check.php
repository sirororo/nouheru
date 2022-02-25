
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

require_once('../common/common.php');

$post=sanitize($_POST);

$user_name=$post['user_name'];
$email=$post['email'];
$postal1=$post['postal1'];
$postal2=$post['postal2'];
$address=$post['address'];
$tel=$post['tel'];

$face_gazou=$_FILES['face_gazou'];

// okflg を初期化にする
$okflg=true;

if($user_name=='')
{
	$err_user_name='お名前が入力されていません。(赤字）';
	//print 'お名前が入力されていません。<br /><br />';
	$okflg=false;
}

if(preg_match('/^[\w\-\.]+\@[\w\-\.]+\.([a-z]+)$/',$email)==0)
{
	$err_uemail='メールアドレスを正確に入力してください。';
	//print 'メールアドレスを正確に入力してください。<br /><br />';
	$okflg=false;
}

if(preg_match('/^[0-9]+$/',$postal1)==0)
{
	$err_postal1='郵便番号は半角数字で入力してください。';
	//print '郵便番号は半角数字で入力してください。<br /><br />';
	$okflg=false;
}

if(preg_match('/^[0-9]+$/',$postal2)==0)
{
	$err_postal2='郵便番号が入力されていません。';
	//print '郵便番号は半角数字で入力してください。<br /><br />';
	$okflg=false;
}

if($address=='')
{
	$err_address='住所が入力されていません。';
	//print '住所が入力されていません。<br /><br />';
	$okflg=false;
}

if(preg_match('/^\d{2,5}-?\d{2,5}-?\d{4,5}$/',$tel)==0)
{
	$err_tel='電話番号を正確に入力してください。';
	//print '電話番号を正確に入力してください。<br /><br />';
	$okflg=false;
}

// 画像が入っている場合

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
    



<?php

if($face_gazou['size']>0)
{
	if($face_gazou['size']>1000000)
	{

		print '画像が大き過ぎます（赤字）';
		$okflg=false;
	}
	else
	{
		move_uploaded_file($face_gazou['tmp_name'],'./gazou/'.$face_gazou['name']);
		print '<img src="../product/gazou/'.$face_gazou['name'].'">';

	}
}

?>



<br /><br />
お名前<br />
<?php print $err_user_name; ?>
<?php print $user_name;?>
<br /><br />


メールアドレス<br />
<?php print $err_email; ?>
<?php print $email;?>
<br /><br />


郵便番号<br />

<?php print $err_postal1;?><br />
<?php print $err_postal2;?>
<br />
<?php print $postal1;?> - <?php print $postal2;?>

<br /><br />

住所<br />
<?php print $err_address;?>
<?php print $address;?>
<br /><br />



電話番号<br />
<?php print $err_tel;?>
<?php print  $tel;?>
<br /><br />






<?php
// okflgが初期化のままだったらtrue
if($okflg==true)
{
	print '<form method="post" action="member_edit_done.php">';


	print '<input type="hidden" name="user_name" value="'.$user_name.'">';
	print '<input type="hidden" name="email" value="'.$email.'">';
	print '<input type="hidden" name="postal1" value="'.$postal1.'">';
	print '<input type="hidden" name="postal2" value="'.$postal2.'">';
	print '<input type="hidden" name="address" value="'.$address.'">';
	print '<input type="hidden" name="tel" value="'.$tel.'">';
	print '<input type="hidden" name="face_gazou" value="'.$face_gazou['name'].'">';
?>

	<input type="button" onclick="history.back()" value="戻る">
	<input type="submit" value="ＯＫ"><br />
	</form>

<?php
}
else
{
?>

	<form>
	<input type="button" onclick="history.back()" value="戻る">
	</form>

<?php
}
?>

</body>
</html>