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
      <h2>会員登録</h2>
      <p class="lead">以下の項目はポートフォリオを目的に作成したため、会員登録後にメールアドレス宛へ登録完了のメールは送信しますが、異なっていても本人確認の処理はしないので問題なくサイトを利用できます。<br />従ってログインに必要な<mark>パスワード</mark> と<mark> 仮のメールアドレス</mark> のみ忘れないようにして下さい。</p>
    </div>

   

      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">設定</h4>
        <form method="post" class="needs-validation" action="member_new_check.php" enctype="multipart/form-data"  novalidate>
          <div class="row g-3">

            <div class="col-sm-6">
              <label for="username" class="form-label">お名前</label>
              <input  id="username" type="text" class="form-control" name="onamae"  placeholder="" value="" required>
              <div class="invalid-feedback">
                お名前を入力してください。
              </div>
            </div>

           
            <div class="col-12">
              <label for="email" class="form-label">メールアドレス </label>
              <input id="email" type="email" class="form-control" name="email"  placeholder="you@example.com" required>
              <div class="invalid-feedback">
                メールアドレスを入力してください。
              </div>
            </div>

            <div class="col-12">
              <label for="address1" class="form-label">郵便番号（上３桁）<span class="text-muted">(半角英数字)</span></label>
              <input id="address1" name="postal1" type="text" class="form-control" placeholder="xxx" maxlength="3" required>
              <div class="invalid-feedback">
                郵便番号を３桁入力してください。
              </div>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">郵便番号（下４桁）<span class="text-muted">(半角英数字)</span></label>
              <input id="address2" name="postal2" type="text" class="form-control"  placeholder="xxxx" maxlength="4" required>
              <div class="invalid-feedback">
              郵便番号を４桁入力してください。
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">住所</label>
              <input name="address" type="text" class="form-control" id="address" placeholder="東京都xxx市" required>
              <div class="invalid-feedback">
                住所を入力して下さい。
              </div>
            </div>

            <div class="col-12">
              <label for="tel" class="form-label">電話番号<span class="text-muted">(ハイフン無し・半角英数字)</span></label>
              <input name="tel" type="text" class="form-control" id="tel" placeholder="11122223333" required>
              <div class="invalid-feedback">
                電話番号を入力して下さい。
              </div>
            </div>


          

          <hr class="my-4">

          

          <h4 class="mb-3">パスワード</h4>

          <div class="col-12">
              <label for="password1" class="form-label">password</label>
              <input type="password" name="pass" class="form-control" id="password1" placeholder="" required>
              <div class="invalid-feedback">
                パスワードを入力してください。
              </div>
            </div>

          <div class="col-12">
              <label for="password2" class="form-label">password（確認）</label>
              <input type="password" name="pass2" class="form-control" id="password2" placeholder="" required>
              <div class="invalid-feedback">
                パスワードをもう一度入力して下さい。
              </div>
          </div>


        </div>


              <hr class="my-4">



          <h4 class="mb-3">プロフィール</h4>




          <h6 class="mb-3">性別</h6>

          <div class="my-3">
              <div class="form-check">
                <input id="danjo" value="dan" name="danjo" type="radio" class="form-check-input" checked required>
                <label class="form-check-label" for="credit">男性</label>
              </div>
              <div class="form-check">
                <input id="danjo" value="jo" name="danjo" type="radio" class="form-check-input" required>
                <label class="form-check-label" for="danjo">女性</label>
              </div>

          </div>


          <h4 class="mb-3"></h4>

          <h6 class="mb-3">生まれ年</h6>

          <div class="my-3">
            <div class="form-check">
              <input id="birth" value="1970" name="birth" type="radio" class="form-check-input"  required>
              <label class="form-check-label" for="birth">1970年代以前</label>
            </div>
            <div class="form-check">
              <input id="birth" value="1980" name="birth"type="radio" class="form-check-input" checked required>
              <label class="form-check-label" for="birth">1980年代</label>
            </div>
            <div class="form-check">
              <input id="birth" value="1990" name="birth" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="birth">1990年代</label>
            </div>
            <div class="form-check">
              <input id="birth" value="2000" name="birth" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="birth">2000年代</label>
            </div>
            <div class="form-check">
              <input id="birth" value="2010" name="birth" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="birth">2010年代以降</label>
            </div>
          </div>

          <h4 class="mb-3"></h4>

          <h6 class="mb-3">顔写真（任意）</h6>

          <div class="container page-header">
            <div class="col-sm-4">
                
                    <div class="imagePreview"></div>
                    <div class="input-group">
                        <label class="input-group-btn">
                            <span class="btn btn-primary">
                                画像を選ぶ<input name="face_gazou" type="file" style="display:none" class="uploadFile" accept="image/*">
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

          <button class="w-100 btn btn-primary btn-lg" type="submit">確認して進む</button>
        </form>
      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2017–2021 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="form-validation.js"></script>
  </body>
</html>
