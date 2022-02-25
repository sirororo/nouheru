
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
      <h2>業務内容の項目</h2>
      <p class="lead"><br>
      <?php echo nl2br ($no_member);?>
        業務内容は登録後に変更も可能です。
      </p>
    </div>

   

      <div class="col-md-7 col-lg-8">

      <h4 class="mb-3">業種を以下から１つ選んで下さい。</h4>

      <form method="post" class="needs-validation" action="pro_add_check.php" enctype="multipart/form-data"  novalidate>

        <div class="my-3">
            <div class="form-check">
              <input id="danjo" value="daikou" name="gyousyu" type="radio" class="form-check-input" checked required>
              <label class="form-check-label" for="credit">農業代行</label>
            </div>
            <div class="form-check">
              <input id="danjo" value="noukigu" name="gyousyu"type="radio" class="form-check-input" required>
              <label class="form-check-label" for="danjo">農機具レンタル</label>
            </div>
            <div class="form-check">
              <input id="danjo" value="house" name="gyousyu" type="radio" class="form-check-input"  required>
              <label class="form-check-label" for="credit">栽培システム設置代行</label>
            </div>
            <div class="form-check">
              <input id="danjo" value="help"name="gyousyu"type="radio" class="form-check-input"  required>
              <label class="form-check-label" for="credit">農家専門の経理・会計士</label>
            </div>
            <div class="form-check">
              <input id="danjo" value="sonota" name="gyousyu"type="radio" class="form-check-input" required>
              <label class="form-check-label" for="credit">無料のサービス</label>
            </div>

        </div>

        <hr class="my-4">


        <h4 class="mb-3"></h4>

        <h4 class="mb-3"></h4>
       
          <div class="row g-3">

            <div class="col-sm-13">
              <label for="username" class="form-label">タイトル名を入力して下さい。<span class="text-muted">(最大３２文字数)</span></label>
              <input  id="username" type="text" class="form-control" name="title"   placeholder="例：[チェンソー]農機具の宅配レンタルなら〇〇店！小型農機の取扱い業界No.1！" value="" maxlength="32" required>
              <div class="invalid-feedback">
                タイトルを入力してください。
              </div>
            </div>

           
            <div class="col-12">
              <label for="profile" class="form-label">あなたのプロフィールを入力して下さい。 <span class="text-muted">(最大３５０文字)</span></label>
              <textarea  id="profile" type="text" class="form-control" name="profile" placeholder="例：当店は創業昭和〇〇年、東京都に本社を置く株式会社〇〇が運営を行なっております。事業概要は・・・" value="" maxlength="350"rows="10" required></textarea>
              <div class="invalid-feedback">
                プロフィールを入力してください。
              </div>
            </div>

            <div class="col-12">
              <label for="serves" class="form-label">あなたのサービス内容を入力してください。<span class="text-muted">(最大３５０文字)</span></label>
              <textarea  id="serves" type="text" class="form-control" name="serves"  placeholder="例：取扱商品は主に畑・土を改良するための機器を・・・" value="" maxlength="350" rows="10" required></textarea>
              <div class="invalid-feedback">
              サービス内容を入力してください。
              </div>
            </div>

            <div class="col-12">
              <label for="price" class="form-label">サービスの価格を入力してください。<span class="text-muted">(最大３５０文字)</span></label>
              <textarea  id="price" type="text" class="form-control" name="price" placeholder="例：「根切りチェンソー RC6200P-16」を送料込み最低価格４９８０円から・・・" value="" maxlength="350" rows="10" required></textarea>
              <div class="invalid-feedback">
                タイトルを入力してください。
              </div>
            </div>

            <div class="col-12">
              <label for="business_hours"  class="form-label">サービスの営業時間を入力してください。<span class="text-muted">(最大３５０文字)</span></label>
              <textarea  id="business_hours"  type="text" class="form-control" name="business_hours"  placeholder="例：営業時間は8時～18時　※お盆期間、年末年始のみ定休" value="" maxlength="350" rows="10" required></textarea>
              <div class="invalid-feedback">
              営業時間を入力してください。
              </div>
            </div>

            <div class="col-12">
              <label for="support_place" class="form-label">サービスの対応可能地域を入力してください。<span class="text-muted">(最大３５０文字)</span></label>
              <textarea  id="support_place" type="text" class="form-control" name="support_place" placeholder="例：関東地区（東京、千葉、埼玉、神奈川、群馬、栃木、茨城、山梨）　/　東北地区（青森、秋田、・・・" value="" maxlength="350" rows="10" required></textarea>
              <div class="invalid-feedback">
              対応可能地域を入力してください。
              </div>
            </div>　

            <div class="col-12">
              <label for="pay" class="form-label">サービスの支払い方法を入力してください。<span class="text-muted">(最大３５０文字)</span></label>
              <textarea  id="pay" type="text" class="form-control" name="pay"  placeholder="例：クレジットカード　/　後払い決済(銀行・ゆうちょ・コンビニ払い)" value="" maxlength="350" rows="10" required></textarea>
              <div class="invalid-feedback">
              支払い方法を入力してください。
              </div>
          </div>


        </div>


              <hr class="my-4">



          <h4 class="mb-3"></h4>

          <h6 class="mb-3">作業写真（任意）</h6>

          <div class="container page-header">
            <div class="col-sm-4">
                
                    <div class="imagePreview"></div>
                    <div class="input-group">
                        <label class="input-group-btn">
                            <span class="btn btn-primary">
                                画像を選ぶ<input name="gazou" type="file" style="display:none" class="uploadFile" accept="image/*">
                            </span>
                        </label>
                        <input type="text" class="form-control" readonly="">
                    </div>
                
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script>
        $(document).on('change', ':file', function() {
            var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.parent().parent().next(':text').val(label);

            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
                reader.onloadend = function(){ // set image data as background of div
                    input.parent().parent().parent().prev('.imagePreview').css("background-image", "url("+this.result+")");
                }
            }
        });
        </script>


          <hr class="my-4">

          <?php
          if($member_code==0)
          {
            ?>

          <button class="w-100 btn btn-primary btn-lg" type="submit" disabled>確認して進む &raquo;</button>

          <?php
          }else
          {
            ?>

          <button class="w-100 btn btn-primary btn-lg" type="submit">確認して進む &raquo;</button>

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
