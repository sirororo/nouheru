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

  $csrf_token=$_SESSION['csrf_token'];

}
?>


<?php

require_once('../common/common.php');

$post=sanitize($_POST);
$title=$post['title'];
$gyousyu=$post['gyousyu'];
$price=$post['price'];




$serves=$post['serves'];
$business_hours=$post['business_hours'];
$support_place=$post['support_place'];
$pay=$post['pay'];
$profile=$post['profile'];

$gazou=$_FILES['gazou'];

$okflg=true;





if(strpos($title,'http') !== false){
	$no_title= "<span style='color:red;'>タイトルにURLを含めることはできません。</span>\n";
	$okflg=false;
  }


if($gyousyu=='daikou'){

	$disp_gyousyu='農業代行';
	//print '農業代行';

}elseif($gyousyu=='noukigu'){

	$disp_gyousyu='農機具レンタル';
	

}elseif($gyousyu=='house'){

	$disp_gyousyu='栽培システムのレンタル';
	
}elseif($gyousyu=='help'){

	$disp_gyousyu='専門の経理・会計';

}elseif($gyousyu=='sonota'){

	$disp_gyousyu='無料サービス';

}else{
	print '';
}	


if(strpos($price,'http') !== false){
	$no_price= "<span style='color:red;'>価格設定にURLを含めることはできません。</span>\n";
	$okflg=false;
  }



if(strpos($serves,'http') !== false){
	$no_serves= "<span style='color:red;'>サービス内容にURLを含めることはできません。</span>\n";
	$okflg=false;
  }



if(strpos($business_hours,'http') !== false){
	$no_business_hours= "<span style='color:red;'>営業時間にURLを含めることはできません。</span>\n";
	$okflg=false;
  }



if(strpos($support_place,'http') !== false){
	$no_support_place= "<span style='color:red;'>対応可能地域にURLを含めることはできません。</span>\n";
	$okflg=false;
  }


if(strpos($pay,'http') !== false){
	$no_pay= "<span style='color:red;'>支払い方法にURLを含めることはできません。</span>\n";
	$okflg=false;
  }

if(strpos($profile,'http') !== false){
	$no_profile= "<span style='color:red;'>プロフィールにURLを含めることはできません。</span>\n";
	$okflg=false;
  }







?>




<?php

// 今後の課題
// アップロード時にEXIFの削除
//
// 以下を実施
//・ファイル名をランダムに変更



// 画像が入っていれば
if($gazou['size']>0)
{
	if($gazou['size']>1000000)
	{

		$no_size = "<span style='color:red;'>画像が大き過ぎます。</span>\n";
		$okflg=false;
	}
	else
	{


	

		// 拡張子変更（画像以外の拡張子変更だとヤバイ）
		if($gazou['type'] == 'image/png' || $gazou['type'] == 'image/jpeg' || $gazou['type'] == 'image/jpg')
		{
			$ok_gazou = true;

		}else
		{
			var_dump($gazou['type']);
			//$face_gazou['type'] = 'image/png';
			$no_file = "<span style='color:red;'>この画像ファイルは無効です。</span>\n";
			$okflg=false;


		}


		// 拡張子が問題なければアップロード
		if($ok_gazou == true)
		{




						// ランダムファイル名
		 $gazou['name']=sha1(time().mt_rand());

		// アップロードファイルは実行権限のない状態へ
		chmod($gazou['tmp_name'], 0644);


		$upload_path = '../product/gazou/';
		//var_dump($gazou);


		// 一時的のサーバーの所から、指定のフォルダにアップロード（移動）する
		 move_uploaded_file($gazou['tmp_name'],$upload_path.$gazou['name']);

		// 画像を変数に入れる
		 $output = '<img src="../product/gazou/'.$gazou["name"].'" width="600" height="600">';






		}


		

	}
}else
{
		// 仮の画像
		$output = '<img src="../product/gazou/guest.png">';

}

?>



<!--
             value="daikou" name="gyousyu"
             農業代行

              value="noukigu" name="gyousyu"
             農機具レンタル

             value="house" name="gyousyu"
              栽培システム設置代行

            value="help"name="gyousyu"
             農家専門の経理・会計士

             value="sonota" name="gyousyu"
            >無料の業務
-->

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


          <?php echo nl2br ($no_size) ; ?>
          <?php echo nl2br ($no_file); ?>
          <?php echo nl2br ($no_title); ?>
          <?php echo nl2br ($no_profile); ?>
          <?php echo nl2br ($no_serves); ?>
          <?php echo nl2br ($no_pay); ?>
          <?php echo nl2br ($no_business_hours); ?>
          <?php echo nl2br ($no_support_place); ?>

        <?php
        }
        ?>
          業務内容は登録後に変更も可能です。
        </p>
    </div>


      <div class="col-md-7 col-lg-8">

        <h4 class="mb-3"></h4>

        <h4 class="mb-3"></h4>
          <div class="row g-3">

             <div class="col-sm-13">
              <label for="username" class="form-label">選択された業種。</label>
              <input  id="danjo" type="text" class="form-control" name="gyousyu"   value="<?php print  $disp_gyousyu;?>"  disabled>
              
            </div>

            <div class="col-sm-13">
              <label for="username" class="form-label">タイトル名を入力して下さい。<span class="text-muted">(最大３２文字数)</span></label>
              <input  id="username" type="text" class="form-control" name="title"   value="<?php print  $title;?>"  disabled>
             
            </div>

           
            <div class="col-12">
              <label for="profile" class="form-label">あなたのプロフィールを入力して下さい。 <span class="text-muted">(最大３５０文字)</span></label>
              <textarea  id="profile" type="text" class="form-control" name="profile"  value="" rows="10" disabled><?php print  $profile;?></textarea>
              
            </div>

            <div class="col-12">
              <label for="serves" class="form-label">あなたのサービス内容を入力してください。<span class="text-muted">(最大３５０文字)</span></label>
              <textarea  id="serves" type="text" class="form-control" name="serves"   value=""  rows="10" disabled><?php print  $serves;?></textarea>
              
            </div>

            <div class="col-12">
              <label for="price" class="form-label">サービスの価格を入力してください。<span class="text-muted">(最大３５０文字)</span></label>
              <textarea  id="price" type="text" class="form-control" name="price"  value=""  rows="10" disabled><?php print  $price;?></textarea>
              
            </div>

            <div class="col-12">
              <label for="business_hours"  class="form-label">サービスの営業時間を入力してください。<span class="text-muted">(最大３５０文字)</span></label>
              <textarea  id="business_hours"  type="text" class="form-control" name="business_hours"   value="" rows="10" disabled><?php print  $business_hours;?></textarea>
              
            </div>

            <div class="col-12">
              <label for="support_place" class="form-label">サービスの対応可能地域を入力してください。<span class="text-muted">(最大３５０文字)</span></label>
              <textarea  id="support_place" type="text" class="form-control" name="support_place"  value="" rows="10" disabled><?php print  $support_place;?></textarea>
              
            </div>

            <div class="col-12">
              <label for="pay" class="form-label">サービスの支払い方法を入力してください。<span class="text-muted">(最大３５０文字)</span></label>
              <textarea  id="pay" type="text" class="form-control" name="pay"   value="" rows="10" disabled><?php print  $pay;?></textarea>
             
            </div>


        </div>

        <hr class="my-4">


           
          <h4 class="mb-3"></h4>

            <h6 class="mb-3">作業写真（任意）</h6>

            <div class="container page-header">
            <div class="py-5 text-center">

      <p class="lead">
      <br />
        <?php
        print $output;
        ?>

        </p>
    </div>

   

      <div class="col-md-7 col-lg-8">

            </div>

            



        


          <hr class="my-4">

          <?php
          if($okflg==true)
          {
            // 進む
            // 戻る
            // 登録情報

            ?>

        <form method="post" class="needs-validation" action="pro_add_done.php" enctype="multipart/form-data"  novalidate>

        <?php

        print '<input type="hidden" name="csrf_token" value="'.$csrf_token.'">';


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

        <button class="w-100 btn btn-primary btn-lg" type="submit">登録する &raquo;</button>

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
