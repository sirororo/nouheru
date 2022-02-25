<?php

session_start();
if(!isset($_SESSION['loginCount']))
$_SESSION['loginCount']=0;

// csrf対策
$toke_byte = openssl_random_pseudo_bytes(16);
$csrf_token = bin2hex($toke_byte);
// 生成したトークンをセッションに保存します

$_SESSION['csrf_token']=$csrf_token;





?>


<?php


//var_dump($_SESSION['csrf_token']);
//var_dump($_POST["csrf_token"]);
//var_dump($_SESSION['loginCount']);




?>




<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Signin Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  
</head>
<body class="text-center">
    
    <main class="form-signin">
      <form method="post" action="./member_login_check.php">
        <h1 class="h3 mb-3 fw-normal">ログイン画面</h1>
    
        <div class="form-floating">
          <input type="email" class="form-control" name="email" placeholder="name@example.com">
          <label for="floatingInput">メールアドレス</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" name="pass" placeholder="Password">
          <label for="floatingPassword">パスワード</label>
        </div>
        <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">

    
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>

      </form>
    </main>
    
    
        
      </body>
</html>