<?php
mb_internal_encoding("utf8");
session_start();

if(empty($_SESSION['id'])) {
    $pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","mysql");
    try {
        $pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","mysql");
    } catch(PDOException $e) {
        die("
            <p>申し訳ございません、現在サーバーが混みあっており一時的にアクセスが出来ません。<br>
            しばらくしてから再度ログインをして下さい。</p>
            <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>
        ");
    }
    $stmt = $pdo->prepare("select * from login_mypage where mail=? && password=?");

    $stmt->bindValue(1,$_POST['mail']);
    $stmt->bindValue(2,$_POST['password']);

    $stmt->execute();
    $pdo = NULL;

    while($row = $stmt->fetch()) {

        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['mail'] = $row['mail'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['picture'] = $row['picture'];
        $_SESSION['comments'] = $row['comments'];
    }

    if(empty($_SESSION['id'])) {
        header("Location:login_error.php");
    }
    if(!empty($_POST['checkbox'])) {
        $_SESSION['checkbox'] = $_POST['checkbox'];

    }
}
if(!empty($_SESSION['id']) && !empty($_SESSION['checkbox'])) {
    setcookie('mail',$_SESSION['mail'],time()+60*60*24*7);
    setcookie('password',$_SESSION['password'],time()+60*60*24*7);
    setcookie('checkbox',$_SESSION['checkbox'],time()+60*60*24*7);
} else if(empty($_SESSION['checkbox'])) {
    setcookie('mail','',time()-1);
    setcookie('password','',time()-1);
    setcookie('checkbox','',time()-1);
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>4eachblog | Mypage</title>
        <link rel="stylesheet" href="register.css">
    </head>
    <body>
        <header>
            <div class="header">
                <a href=""><img src="4eachblog_logo.jpg"></a>
                <p class="login"><a href="log_out.php">ログアウト</a></p>
            </div>
        </header>
        <main>
            <div class="formOnlyMypage">
                <h1>会員情報</h1>
                <p class="confirm">
                    こんにちは！<?php echo $_SESSION['name'];?>さん
                </p>
                <div class="myPage">
                    <div class="myPage1">
                        <img src="<?php echo $_SESSION['picture'];?>">
                    </div> 
                    <div class="myPage2">
                        <label>氏名：</label>
                        <?php echo $_SESSION['name'];?><br><br>

                        <label>メールアドレス：</label>
                        <?php echo $_SESSION['mail'];?><br><br>

                        <label>パスワード：</label>
                        <?php echo $_SESSION['password'];?><br><br>
                    </div>
                </div>
                <?php echo $_SESSION['comments'];?><br><br>
                <div class="submitBox">
                    <form method="post" action="mypage_hensyu.php">
                        <input type="submit" value="編集する" class="submit">
                        <input type="hidden" value="<?php echo rand(1,10);?>" name="rand">
                    </form>
                </div>
            </div>
        </main>
        <footer>
            <p>©2018 InterNous.inc ALL rights reserved</p>
        </footer>
    </body>
</html>
                
