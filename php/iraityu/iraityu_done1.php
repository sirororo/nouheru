

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

     // テーブルコード
    $iraityu_sales_product=$post['iraityu_sales_product'];
    $iraityu_sales=$post['iraityu_sales'];

    // iraityu_sales
    $shop_code=$post['shop_code'];
    $request_code=$post['request_code'];

     // iraityu_sales_product
    $code_product=$post['code_product'];
    $request_day=$post['request_day'];
    $contents=$post['contents'];
    $request_postal1=$post['request_postal1'];
    $request_postal2=$post['request_postal2'];
    $request_address=$post['request_address'];

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
      <h2>業務内容の評価</h2>
      <p class="lead">下記に記入された内容は今後サービス説明とともに表示されます。</p>
    </div>


<div class="col-md-7 col-lg-8">
<div class="row g-3">

      <form method="post" class="needs-validation" action="iraityu_done2.php"  novalidate>

        <di class="my-3">
            <div class="form-check">
              <input id="assess" value="1" name="assess" type="radio" class="form-check-input" checked required>
              <label class="form-check-label" for="assess">満足した</label>
            </div>
            <div class="form-check">
              <input id="assess" value= "0" name="assess"type="radio" class="form-check-input" required>
              <label class="form-check-label" for="assess">不満足だった</label>
            </div>

        <h4 class="mb-3"></h4>
        <h4 class="mb-3"></h4>
       <?php //var_dump($iraityu_sales_product);?>

            <div class="col-sm-8">
              <label for="pay" class="form-label">金額を入力してください。<span class="text-muted">(半角英数字)</span></label>
              <input  id="pay" type="text" class="form-control" name="pay"   placeholder="例：12000" value="" maxlength="10" required>
              <div class="invalid-feedback">
              入力してください
              </div>
            </div>

            <h4 class="mb-3"></h4>

            <div class="col-12">
              <label for="word_mouth" class="form-label">感想を入力してください。 <span class="text-muted">(最大３５０文字)</span></label>
              <textarea  id="word_mouth" type="text" class="form-control" name="word_mouth" placeholder="例：とても良かったです。特に〇〇さんには・・・" value="" maxlength="350"rows="10" required></textarea>
              <div class="invalid-feedback">
              入力してください
              </div>
            </div>

          <h4 class="mb-3"></h4>

                      <?php

                      // テーブルコード
                      print '<input type="hidden" name="iraityu_sales_product" value="'.$iraityu_sales_product.'">';
                      print '<input type="hidden" name="iraityu_sales" value="'.$iraityu_sales.'">';

                      // iraityu_sales
                      print '<input type="hidden" name="shop_code" value="'.$shop_code.'">';
                      print '<input type="hidden" name="request_code" value="'.$request_code.'">';

                      // iraityu_sales_product
                      print '<input type="hidden" name="code_product" value="'.$code_product.'">';
                      print '<input type="hidden" name="request_day" value="'.$request_day.'">';
                      print '<input type="hidden" name="contents" value="'.$contents.'">';
                      print '<input type="hidden" name="request_postal1" value="'.$request_postal1.'">';
                      print '<input type="hidden" name="request_postal2" value="'.$request_postal2.'">';
                      print '<input type="hidden" name="request_address" value="'.$request_address.'">';

                      ?>


          <button class="w-100 btn btn-primary btn-lg" type="submit">確認して進む &raquo;</button>
          <h6 class="mb-3"></h6>
          <button type="button" class="w-100 btn btn-primary btn-lg" onclick="history.back()" >戻る</button>
        </form>
      </div>
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
