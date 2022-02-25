<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>



<!DOCTYPE html>
<html>
<head>
<title>文書のタイトル</title>
</head>
<body>





<?php

/*
try
{
*/

#$dsn='mysql:dbname=site;host=localhost;charset=utf8';
#$user='root';
#$password='secret';
#$dbh=new PDO($dsn,$user,$password);

$dsn='mysql:dbname=site;host=db;charset=utf8;';
# $user='docker_user';
# $password='docker_pass';
# $dbh=new PDO($dsn,$user,$password);


# $db = new PDO($dsn,'docker_user','docker_pass');
$dbh = new PDO($dsn,'docker_user','docker_pass');




#$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT 
code,
name
 FROM dat_member';

$stmt=$dbh->prepare($sql);

$stmt->execute();

$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$user_code=$rec['code'];
$user_name=$rec['name'];

$dbh=null;

var_dump($user_code);
var_dump($user_code);

print $user_code;
print $user_name;

/*
}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}
*/

?>




</body>
</html>