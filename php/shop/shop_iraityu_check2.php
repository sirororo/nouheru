<!--
shop_iraityu_check2.php
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

  $csrf_token=$_SESSION['csrf_token'];

}
?>


<?php

require_once('../common/common.php');

$post=sanitize($_POST);

$pro_code=$post['procode'];



$contents=$post['contents'];
$request_day=$post['request_day'];

$request_postal1=$post['postal1'];
$request_postal2=$post['postal2'];
$request_address=$post['address'];


$okflg=true;


if(preg_match('/^[0-9]+$/',$request_postal1)==0)
{
	$request_postal1_no="<span style='color:red;'>郵便番号（上３桁）は半角数字で入力してください。</span>\n";
	$okflg=false;
}


if(preg_match('/^[0-9]+$/',$request_postal2)==0)
{
	$request_postal2_no="<span style='color:red;'>郵便番号（下４桁）は半角数字で入力してください。</span>\n";
	$okflg=false;
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

                        <?php echo nl2br ($request_postal1_no); ?>
                        <?php echo nl2br ($request_postal2_no); ?>

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
            


                    <div class="col-12">
                    <label for="$contents" class="form-label">作業内容を入力して下さい。<span class="text-muted">(最大３５０文字)</span></label>
                    <textarea  id="$contents" type="text" class="form-control" name="$contents"  value="" rows="10" disabled><?php print  $contents;?></textarea>

                    </div>

                    <div class="col-12">
                    <label for="request_day" class="form-label">作業日付を入力してください。<span class="text-muted">(最大３５０文字)</span></label>
                    <textarea  id="request_day" type="text" class="form-control" name="request_day"   value="" rows="10" disabled><?php print  $request_day;?></textarea>
                    </div>

                    <div class="col-12">
                    <label for="request_postal1" class="form-label">作業場所の郵便番号（上３桁）</label>
                    <input id="request_postal1" name="request_postal1" type="text" class="form-control" value="<?php print $request_postal1; ?>"  disabled>
                    </div>

                    <div class="col-12">
                    <label for="request_postal2" class="form-label">作業場所の郵便番号（下４桁）</label>
                    <input id="request_postal2" name="request_postal2" type="text" class="form-control"  value="<?php print $request_postal2; ?>"  disabled>
                    </div>

                    <div class="col-12">
                    <label for="request_address" class="form-label">作業場所の住所</label>
                    <input name="request_address" type="text" class="form-control" id="request_address" value="<?php print $request_address;?>"  disabled>
                    </div>


                </div>

    

        <hr class="my-4">


                    <?php
                    if($okflg==true)
                    {
                        // 進む
                        // 戻る
                        // 登録情報

                        ?>

                    <form method="post" class="needs-validation" action="shop_iraityu_done.php"  novalidate>

                    <?php

                    print '<input type="hidden" name="csrf_token" value="'.$csrf_token.'">';

                    print '<input type="hidden" name="pro_code" value="'.$pro_code.'">';
                    print '<input type="hidden" name="contents" value="'.$contents.'">';
                    print '<input type="hidden" name="request_day" value="'.$request_day.'">';
                    print '<input type="hidden" name="request_postal1" value="'.$request_postal1.'">';
                    print '<input type="hidden" name="request_postal2" value="'.$request_postal2.'">';
                    print '<input type="hidden" name="request_address" value="'.$request_address.'">';

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
