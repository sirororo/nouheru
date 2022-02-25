
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
    





    個人設定を入力してください。<br /><br />
<br />
<form method="post" action="member_edit_check.php"enctype="multipart/form-data">



お名前<br />
<input type="text" name="user_name" style="width:200px" placeholder=山田　五郎 ><br />


メールアドレス<br />
<input type="text" name="email" style="width:200px"placeholder= xxxx@xxx.xx ><br />


郵便番号（半角入力）<br />
<input type="text" name="postal1" style="width:50px" placeholder=xxx oninput="value = value.replace(/[０-９]/g,s => String.fromCharCode(s.charCodeAt(0) - 65248)).replace(/\D/g,'');" >
 - <input type="text" name="postal2" style="width:80px" placeholder=xxxx oninput="value = value.replace(/[０-９]/g,s => String.fromCharCode(s.charCodeAt(0) - 65248)).replace(/\D/g,'');"><br />


住所<br />
<input type="text" name="address" style="width:500px" placeholder=xxx県xxx市xxx丁目xxxx番地 ><br />


電話番号（半角入力）<br />
<input type="text" name="tel" style="width:150px" placeholder=xxxx-xx-xxxx oninput="value = value.replace(/[０-９]/g,s => String.fromCharCode(s.charCodeAt(0) - 65248)).replace(/\D/g,'');"><br />



<br />
画像を選んでください。（任意）<br />
<input type="file" name="face_gazou" style="width:400px"><br /><br />



<br />
<br />
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="確認"><br />
</form>


</body>
</html>



