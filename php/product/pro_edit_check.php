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
// $pro_gazou=$_FILES['gazou']; は選択した画像を持ってくる専用
$post=sanitize($_POST);
$pro_code=$post['pro_code'];

$title=$post['title'];
$price=$post['price'];
$serves=$post['serves'];
$business_hours=$post['business_hours'];
$support_place=$post['support_place'];
$pay=$post['pay'];
$profile=$post['profile'];
$gyousyu=$post['gyousyu'];

$gazou=$_FILES['gazou'];



$okflg=true;


if($title=='')
{
	$title='タイトル名が入力されていません。';
	$okflg=false;
}


if($gyousyu==1){

	$disp_gyousyu='農業代行';
	
	}elseif($gyousyu==2){
	
	$disp_gyousyu='農機具レンタル';
	
	}elseif($gyousyu==3){
	
	$disp_gyousyu='ビニールハウス作成';
	
	}elseif($gyousyu==4){
	
	$disp_gyousyu='様々なお手伝い';
	
	}elseif($gyousyu==5){
	
	$disp_gyousyu='その他';
	
	}else{
	print '';
	}	
	

if($price=='')
{
	$price='価格設定をきちんと入力してください。';
	$okflg=false;
}


if($serves=='')
{
	$serves='サービス内容をきちんと入力してください。';
	$okflg=false;
}

if($business_hours=='')
{
	$business_hours='営業時間をきちんと入力してください。';
	$okflg=false;
}


if($support_place=='')
{
	$support_place='対応可能地域をきちんと入力してください。';
	$okflg=false;
}


if($pay=='')
{
	$pay='支払い方法をきちんと入力してください。';
	$okflg=false;
}


if($profile=='')
{
	$profile='プロフィールをきちんと入力してください。';
	$okflg=false;
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
    




<br />
<?php
if($gazou['size']>0)
{
	if($gazou['size']>1000000)
	{
		$err_gazou='画像が大き過ぎます';
		print $err_gazou;
	}
	else
	{
		move_uploaded_file($gazou['tmp_name'],'./gazou/'.$gazou['name']);
		$disp_gazou='<img src="./gazou/'.$gazou['name'].'">';
		print $disp_gazou;
		
	}
}
?>


<br /><br />

タイトル名<br />
<?php print nl2br($price);?><br />
<br /><br />

業種<br />
<?php print $disp_gyousyu;?><br />
<br /><br />

価格設定<br />
<?php print nl2br($price);?><br />
<br /><br />

サービス内容<br />
<?php print nl2br($serves);?><br />
<br /><br />

営業時間<br />
<?php print nl2br($business_hours);?><br />
<br /><br />

対応可能地域<br />
<?php print nl2br($support_place);?><br />
<br /><br />

支払い方法<br />
<?php print nl2br($pay);?><br />
<br /><br />

プロフィール<br />
<?php print nl2br($profile);?><br />
<br /><br />
















<?php

if($okflg==true)
{

	print '上記の商品を修正します。<br />';
	print '<form method="post" action="pro_edit_done.php">';
	print '<input type="hidden" name="pro_code" value="'.$pro_code.'">';

	print '<input type="hidden" name="title" value="'.$title.'">';
	print '<input type="hidden" name="gyousyu" value="'.$gyousyu.'">';
	print '<input type="hidden" name="price" value="'.$price.'">';
	print '<input type="hidden" name="serves" value="'.$serves.'">';
	print '<input type="hidden" name="profile" value="'.$profile.'">';
	print '<input type="hidden" name="business_hours" value="'.$business_hours.'">';
	print '<input type="hidden" name="support_place" value="'.$support_place.'">';
	print '<input type="hidden" name="pay" value="'.$pay.'">';
	print '<input type="hidden" name="gazou_name" value="'.$gazou['name'].'">';
	
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