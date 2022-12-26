<!--http insertの情報を、テーブルに格納する文。（ファイルは、一時保存場所から移動させる事を事前にしておく）-->
<?php
mb_internal_encoding("utf8");
$pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","");

$stmt = $pdo->prepare("
    insert into login_mypage(name,mail,password,picture,comments)values(?,?,?,?,?)
    ");
//prepared文　予めinsert文を作っておく（中身は後から入れる）
$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['path_filename']);
$stmt->bindValue(5,$_POST['comments']);
//各カラムに何をinsertするのか記述



$stmt->execute();//実行
$pdo = NULL;//DB切断
header("Location:after_register.html");//リダイレクトでafter_register.htmlページへ飛ぶ

?>
    