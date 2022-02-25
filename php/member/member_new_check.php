<?php

require_once('../common/common.php');

$post=sanitize($_POST);

$onamae=$post['onamae'];
$email=$post['email'];
$postal1=$post['postal1'];
$postal2=$post['postal2'];
$address=$post['address'];
$tel=$post['tel'];

$pass=$post['pass'];
$pass2=$post['pass2'];
$danjo=$post['danjo'];
$birth=$post['birth'];

$face_gazou=$_FILES['face_gazou'];

//var_dump($face_gazou);

// okflg を初期化にする
$okflg=true;




if(preg_match('/^[\w\-\.]+\@[\w\-\.]+\.([a-z]+)$/',$email)==0)
{
	$email_no="<span style='color:red;'>メールアドレスを正確に入力してください。</span>\n";
	$okflg=false;
}


if(preg_match('/^[0-9]+$/',$postal1)==0)
{
	$postal1_no="<span style='color:red;'>郵便番号（上３桁）は半角数字で入力してください。</span>\n";
	$okflg=false;
}


if(preg_match('/^[0-9]+$/',$postal2)==0)
{
	$postal2_no="<span style='color:red;'>郵便番号（下４桁）は半角数字で入力してください。</span>\n";
	$okflg=false;
}




if(preg_match('/^\d{2,5}-?\d{2,5}-?\d{4,5}$/',$tel)==0)
{
	$tel_no="<span style='color:red;'>電話番号を正確に入力してください。</span>\n";
	$okflg=false;
}



if($pass!=$pass2)
{
	$pass_no="<span style='color:red;'>パスワードが一致しません。</span>\n";
	$okflg=false;
}


if($danjo=='dan')
{
	$disp_danjo='男性';
}
else
{
	$disp_danjo='女性';
}





?>



<?php

// 今後の課題
// アップロード時にEXIFの削除
//
// 以下を実施
//・ファイル名をランダムに変更
//・複数の指定した拡張子以外は「.png」に変更
//・


// 画像が入っていれば
if($face_gazou['size']>0)
{
	if($face_gazou['size']>1000000)
	{

		$no_size = "<span style='color:red;'>画像が大き過ぎます。</span>\n";
		$okflg=false;
	}
	else
	{


	

		// 拡張子変更（画像以外の拡張子変更だとヤバイ）
		if($face_gazou['type'] == 'image/png' || $face_gazou['type'] == 'image/jpeg' || $face_gazou['type'] == 'image/jpg')
		{
			$ok_gazou = true;

		}else
		{
			var_dump($face_gazou['type']);
			//$face_gazou['type'] = 'image/png';
			$no_file = "<span style='color:red;'>この画像ファイルは無効です。</span>\n";
			$okflg=false;


		}


		// 拡張子が問題なければアップロード
		if($ok_gazou == true)
		{




						// ランダムファイル名
		 $face_gazou['name']=sha1(time().mt_rand());

		// アップロードファイルは実行権限のない状態へ
		chmod($face_gazou['tmp_name'], 0644);


		$upload_path = '../product/gazou/';
		


		// 一時的のサーバーの所から、指定のフォルダにアップロード（移動）する
		 move_uploaded_file($face_gazou['tmp_name'],$upload_path.$face_gazou['name']);

		// 画像を変数に入れる
		 $output = '<img src="../product/gazou/'.$face_gazou["name"].'" width="600" height="600">';






		}


		

	}
}else
{
		// 仮の画像
		$output = '<img src="../product/gazou/guest.png">';

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
      <h2>確認画面</h2>
      <p class="lead">
        <br />
        <?php
        // 入力に適さないエラー表示
        if($okflg==false)
        {
          ?>

          <?php echo nl2br ($email_no);  ?>
          <?php echo nl2br ($pass_no); ?>
          <?php echo nl2br ($postal1_no); ?>
          <?php echo nl2br ($postal2_no); ?>
          <?php echo nl2br ($tel_no); ?>
          <?php echo nl2br ($no_size) ; ?>
          <?php echo nl2br ($no_file); ?>

        <?php
        }
        ?>
        以下の項目はポートフォリオを目的に作成したため、会員登録後にメールアドレス宛へ登録完了のメールは送信しますが、異なっていても本人確認の処理はしないので問題なくサイトを利用できます。<br />従ってログインに必要な<mark>パスワード</mark> と<mark> 仮のメールアドレス</mark> のみ忘れないようにして下さい。
      </p>
    </div>

   

      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">設定</h4>
        
          <div class="row g-3">

            <div class="col-sm-6">
              <label for="username" class="form-label">お名前</label>
              <input  id="username" type="text" class="form-control" name="onamae"  placeholder="" value="<?php print $onamae;?>" disabled>
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

          

          <h4 class="mb-3">パスワード</h4>

          <div class="col-12">
              <label for="password1" class="form-label">password</label>
              <input type="password" name="pass" class="form-control" id="password1" value="<?php print $pass;?>"  disabled>
              <div class="invalid-feedback">
                パスワードを入力してください。
              </div>
            </div>




        </div>


              <hr class="my-4">



          <h4 class="mb-3">プロフィール</h4>




          <h6 class="mb-3">性別</h6>

          <div class="my-3">
              <div class="form-check">
                <input id="danjo" value="<?php print $disp_danjo;?>" name="danjo" type="text" class="form-control"  disabled>
              
              </div>
              

          </div>


          <h4 class="mb-3"></h4>

          <h6 class="mb-3">生まれ年</h6>

          <div class="my-3">
            <div class="form-check">
              <input id="birth" value="<?php print $birth.'年代';?>" name="birth" type="text" class="form-control"  disabled>
             
            </div>
          </div>

          <h4 class="mb-3"></h4>

          

          


          <hr class="my-4">

          <?php
          if($okflg==true)
          {
            // 進む
            // 戻る
            // 登録情報

            ?>



           <form  method="post" action="member_new_done.php" class="needs-validation" novalidate>

            <?php

            print '<input type="hidden" name="onamae" value="'.$onamae.'">';
            print '<input type="hidden" name="email" value="'.$email.'">';
            print '<input type="hidden" name="postal1" value="'.$postal1.'">';
            print '<input type="hidden" name="postal2" value="'.$postal2.'">';
            print '<input type="hidden" name="address" value="'.$address.'">';
            print '<input type="hidden" name="tel" value="'.$tel.'">';


            print '<input type="hidden" name="pass" value="'.$pass.'">';
            print '<input type="hidden" name="danjo" value="'.$danjo.'">';
            print '<input type="hidden" name="birth" value="'.$birth.'">';
            print '<input type="hidden" name="face_gazou_name" value="'.$face_gazou['name'].'">';


          ?>


          <button class="w-100 btn btn-primary btn-lg" type="submit">登録する</button>

          <h6 class="mb-3"></h6>

          <button type="button" class="w-100 btn btn-primary btn-lg" onclick="history.back()" >戻る</button>
          </form>

        <?php
          }else
          {
          // 戻る

         ?>




          <form>
          <button type="button" class="w-100 btn btn-primary btn-lg" onclick="history.back()" >戻る</button>
          </form>


          <?php
          }
          ?>

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
