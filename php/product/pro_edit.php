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

$pro_code=$post['pro_code'];

$title=$post['title'];
$price=$post['price'];
$serves=$post['serves'];
$business_hours=$post['business_hours'];
$support_place=$post['support_place'];
$pay=$post['pay'];
$profile=$post['profile'];

$gyousyu=$post['gyousyu'];


?>

<?php
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
    







商品情報参照<br />
<br />
タイトル名<br />
<?php print $title; ?>
<br />
価格<br />
<?php print nl2br($price); ?>
<br />

<br />
作業の内容<br />
<?php print nl2br($serves); ?>
<br />
営業時間と定休日<br />
<?php print nl2br($business_hours); ?>
<br />
対応可能地域<br />
<?php print nl2br($support_place); ?>
<br />
支払い方法<br />
<?php print nl2br($pay); ?>
<br />
プロフィール<br />
<?php print nl2br($profile); ?>
<br />

<br />
業種<br />
<?php print $disp_gyousyu;?>
<br />

<br /><br />














商品修正<br />
<br />


<!-- foomにenctype="multipart/form-data"を入れないと画像を次で受け取れない-->
<form method="post" action="pro_edit_check.php" enctype="multipart/form-data">







業種を選択してください。<br />
<input type="radio" name="gyousyu" value="1" checked="checked">農業代行<br />
<input type="radio" name="gyousyu" value="2">農機具レンタル<br />
<input type="radio" name="gyousyu" value="3" >ビニールハウス作成<br />
<input type="radio" name="gyousyu" value="4" >様々なお手伝い<br />
<input type="radio" name="gyousyu" value="5" >その他<br />
<br />

タイトル名を入力してください。<br />
<input type="text" name="title" style="width:200px"><br /><br /><br /> 

あなたのプロフィールを入力してください。<br />
<textarea type="text" name="profile" style="width:200px"></textarea><br /><br /><br /> 

サービス内容を入力してください。<br />
<textarea type="text" name="serves" style="width:200px"></textarea><br /><br /><br />

価格を入力してください。<br />
<textarea type="text" name="price" style="width:200px"></textarea><br /><br /><br />

営業時間を入力してください。<br />
<textarea type="text" name="business_hours" style="width:200px"></textarea><br /><br /><br />

対応可能地域を入力してください。<br />
<textarea type="text" name="support_place" style="width:200px"></textarea><br /><br /><br />

支払い方法を入力してください。<br />
<textarea type="text" name="pay" style="width:200px"></textarea><br /><br /><br />




<br /><br /><br /><br /><br />


画像を選んでください。（任意）<br />
<input type="file" name="gazou" style="width:400px"><br /><br />

<input type="hidden" name="pro_code" value="<?php print $pro_code; ?>">
<input type="submit" value="ＯＫ">
</form>
<br />




</body>
</html>