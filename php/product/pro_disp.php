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

try
{

//　Locationから来たためGETになっている
$pro_code=$_GET['procode'];

$dsn='mysql:dbname=site;host=handson.czoyfw5itcgq.ap-northeast-1.rds.amazonaws.com;charset=utf8;';
$user='admin';
$password='50Aruki20';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

// code=?　は　$data[]=$pro_code　に当てはまる条件
$sql='SELECT 
code,
title,
price,
gazou,
serves,
business_hours,
support_place,
pay,
profile,
gyousyu
 FROM mst_product WHERE code=?';
$stmt=$dbh->prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);

// 取得したカラムを入れ替える
// この際DBから出したものは$rec['']に入れて持ってくる
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$pro_code=$rec['code'];
$title=$rec['title'];
$price=$rec['price'];
$gazou_name=$rec['gazou'];
$serves=$rec['serves'];
$business_hours=$rec['business_hours'];
$support_place=$rec['support_place'];
$pay=$rec['pay'];
$profile=$rec['profile'];
$gyousyu=$rec['gyousyu'];

$dbh=null;



if($gazou_name=='')
{
	$disp_gazou='<img src="./gazou/gazou_image.png">';
}
else
{
	$disp_gazou='<img src="./gazou/'.$gazou_name.'">';
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

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
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
    




商品情報参照<br />
<br />
タイトル名<br />
<?php print $title; ?>
<br />
価格<br />
<?php print nl2br($price); ?>
<br />
<?php print $disp_gazou; ?>
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
業種:
<?php print $disp_gyousyu; ?>


<br />
<br />
<?php var_dump($gazou_name) ?>



<?php
  //var_dump($disp_gazou)


    print '<br />';

    print '<form method="post" action="pro_edit.php" enctype="multipart/form-data">';
	print '<input type="hidden" name="pro_code" value="'.$pro_code.'">';
	print '<input type="hidden" name="title" value="'.$title.'">';
    print '<input type="hidden" name="price" value="'.$price.'">';
    print '<input type="hidden" name="serves" value="'.$serves.'">';
	print '<input type="hidden" name="business_hours" value="'.$business_hours.'">';
	print '<input type="hidden" name="support_place" value="'.$support_place.'">';
	print '<input type="hidden" name="pay" value="'.$pay.'">';
	print '<input type="hidden" name="profile" value="'.$profile.'">';

	print '<input type="hidden" name="gyousyu" value="'.$gyousyu.'">';
	print '<br />';
?>

<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="商品プロフィールを修正する">
</form>











</body>
</html>