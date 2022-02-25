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
	$member_code=$_SESSION['member_code'];
	$member_name=$_SESSION['member_name'];
	$disp_member_logout='<a href="../member/member_logout.php">ログアウト</a><br />';
	$disp_pro_list='<a href="../product/pro_list.php">業種の追加や変更</a><br />';



}
?>




<?php

try
{

$iraityu_sales_product=$_GET['procode'];

$dsn='mysql:dbname=site;host=handson.czoyfw5itcgq.ap-northeast-1.rds.amazonaws.com;charset=utf8;';
$user='admin';
$password='50Aruki20';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

// 相談内容
$sql='SELECT 
request_day,
contents,
request_postal1,
request_postal2,
request_address,
code_product,
iraityu_sales
 FROM iraityu_sales_product WHERE code=?';
$stmt=$dbh->prepare($sql);
//$data=array();
$data[]=$iraityu_sales_product;

//var_dump($data);

$stmt->execute($data);
$rec=$stmt->fetch(PDO::FETCH_ASSOC);

$request_day=$rec['request_day'];
$contents=$rec['contents'];
$request_postal1=$rec['request_postal1'];
$request_postal2=$rec['request_postal2'];
$request_address=$rec['request_address'];

// 商品code
$code_product=$rec['code_product'];

// iraityu_salesにつなげるために出す
$iraityu_sales=$rec['iraityu_sales'];


// request_code,shop_codeを取り出す
$sql='SELECT  shop_code,request_code FROM iraityu_sales WHERE code=?';
$stmt=$dbh->prepare($sql);
$data=array();
$data[]=$iraityu_sales;
$stmt->execute($data);
$rec=$stmt->fetch(PDO::FETCH_ASSOC);



// 店舗の人と相談者がログインした時に、codeが一致する人は表示されるようにする
$shop_code=$rec['shop_code'];
$request_code=$rec['request_code'];


// 商品の内容
$sql='SELECT title,price,gazou,shop_code  FROM mst_product WHERE code=?';
$stmt=$dbh->prepare($sql);
$data=array();
$data[]=$code_product;
$stmt->execute($data);
$rec=$stmt->fetch(PDO::FETCH_ASSOC);

$title=$rec['title'];
$price=$rec['price'];
$gazou=$rec['gazou'];

if($rec['gazou']=='')
	{
		$gazou='<img src="../product/gazou/gazou_image.png">';
	}
	else
	{
		$gazou='<img src="../product/gazou/'.$rec['gazou'].'">';
	}

$dbh=null;

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
    

<?php

try
{
// 名前はDBから出して表示させるだけ。
//　code のみ次に持っていけば消せる


$code_product=$_POST['code_product'];

$dsn='mysql:dbname=site;host=handson.czoyfw5itcgq.ap-northeast-1.rds.amazonaws.com;charset=utf8;';
$user='admin';
$password='50Aruki20';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

// 表示だけなので名前と画像のみ表示
$sql='SELECT name,gazou FROM mst_product WHERE code=?';
$stmt=$dbh->prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);

// 選択したコードの名前と画像を取得
$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$pro_name=$rec['name'];
$pro_gazou_name=$rec['gazou'];

$dbh=null;

if($pro_gazou_name=='')
{
	$disp_gazou='';
}
else
{
	$disp_gazou='<img src="./gazou/'.$pro_gazou_name.'">';
}


}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

商品スタッフ削除<br />
<br />
商品コード<br />
<?php print $pro_code; ?>
<br />
商品名<br />
<?php print $pro_name; ?>
<br />
<?php print $disp_gazou; ?>
<br />
この商品を削除してよろしいですか？<br />
<br />
<form method="post" action="pro_delete_done.php">
<input type="hidden" name="code" value="<?php print $pro_code; ?>">
<input type="hidden" name="gazou_name" value="<?php print $pro_gazou_name; ?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="ＯＫ">
</form>

</body>
</html>