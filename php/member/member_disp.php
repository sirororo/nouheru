

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
//$member_code=$_SESSION['member_code'];

$dsn='mysql:dbname=site;host=handson.czoyfw5itcgq.ap-northeast-1.rds.amazonaws.com;charset=utf8;';
$user='admin';
$password='50Aruki20';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT 
name,

email,
postal1,
postal2,
address,
tel,
face_gazou
 FROM dat_member WHERE code=?';
$stmt=$dbh->prepare($sql);
$data[]=$member_code;
$stmt->execute($data);

$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$user_name=$rec['name'];

$email=$rec['email'];
$postal1=$rec['postal1'];
$postal2=$rec['postal2'];
$address=$rec['address'];
$tel=$rec['tel'];

$face_gazou=$rec['face_gazou'];

$dbh=null;

if($face_gazou=='')
{
	$disp_gazou='<img src="../product/gazou/guest.png" class="rounded-circle" width="139" height="139" x="50%" y="50%" >';
}
else
{
	$disp_gazou='<img src="../product/gazou/'.$face_gazou.'" class="rounded-circle" width="139" height="139" x="50%" y="50%" >';

  
}

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}


if($member_code==0)
{
  $no_member="<span style='color:red;'>ログイン後に利用できるようになります。</span>\n";

}




?>







<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Checkout example · Bootstrap v5.0</title>




    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    

    
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <?php print $disp_gazou;?>
      <h2>登録情報</h2>
      <p class="lead">
        <br>
        <?php echo nl2br ($no_member);?>

      </p>
    </div>

   

      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">設定</h4>
        
          <div class="row g-3">

            <div class="col-sm-6">
              <label for="username" class="form-label">お名前</label>
              <input  id="username" type="text" class="form-control" name="onamae"  placeholder="" value="<?php print $user_name;?>" disabled>
              <div class="invalid-feedback">
                お名前を入力してください。
              </div>
            </div>

           
            <div class="col-12">
              <label for="email" class="form-label">メールアドレス <span class="text-muted">(Optional)</span></label>
              <input id="email" type="email" class="form-control" name="email"  placeholder="you@example.com" value="<?php print $email;?>" disabled>
              <div class="invalid-feedback">
                メールアドレスを入力してください。
              </div>
            </div>

            <div class="col-12">
              <label for="address1" class="form-label">郵便番号（上３桁）</label>
              <input id="address1" name="postal1" type="text" class="form-control" value="<?php print $postal1; ?>"  disabled>
              <div class="invalid-feedback">
                郵便番号を３桁入力してください。
              </div>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">郵便番号（下４桁）</label>
              <input id="address2" name="postal2" type="text" class="form-control"  value="<?php print $postal2; ?>"  disabled>
              <div class="invalid-feedback">
              郵便番号を４桁入力してください。
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">住所</label>
              <input name="address" type="text" class="form-control" id="address" value="<?php print $address;?>"  disabled>
              <div class="invalid-feedback">
                住所を入力して下さい。
              </div>
            </div>

            <div class="col-12">
              <label for="tel" class="form-label">電話番号<span class="text-muted">(ハイフン無し)</span></label>
              <input name="tel" type="text" class="form-control" id="tel" value="<?php print $tel;?>"  disabled>
              <div class="invalid-feedback">
                電話番号を入力して下さい。
              </div>
            </div>

          <hr class="my-4">


        </div>

          <form   action="member_edit.php" class="needs-validation" novalidate>

          <?php
          if($member_code==0)
          {
            ?>

          <button class="w-100 btn btn-primary btn-lg" type="submit" disabled>修正する</button>


          <?php
          }else
          {
            ?>

          <button class="w-100 btn btn-primary btn-lg" type="submit" disabled>修正する（作成中）</button>

          <?php
          }
          ?>
          <h6 class="mb-3"></h6>
          <button type="button" class="w-100 btn btn-primary btn-lg" onclick="history.back()" >戻る</button>
          </form>



      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small">
  <p class="float-none"><a href="#">上へ移動する</a></p>
  </footer>
</div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="form-validation.js"></script>
  </body>
</html>
