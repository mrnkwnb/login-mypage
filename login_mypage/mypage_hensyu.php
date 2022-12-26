<?php
mb_internal_encoding("utf8");
session_start();
if(empty($_POST['rand'])) {
    header("Location:login_error.php");
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>4eachblog | Mypage</title>
        <link rel="stylesheet" href="mypage_hensyu.css">
    </head>
    <body>
        <header>
            <div class="header">
                <a href=""><img src="4eachblog_logo.jpg"></a>
                <p class="login"><a href="login.php">ログイン</a></p>
            </div>
        </header>
        <main>
            <div class="form">
                <h1>会員情報</h1>
                <p class="confirm">
                    こんにちは！<?php echo $_SESSION['name'];?>さん
                </p>
                <form method="post" action="mypage_update.php">
                    <div class="myPage">
                        <div class="myPage1">
                            <img src="<?php echo $_SESSION['picture'];?>">
                        </div>
                        
                        <div class="myPage2">
                            <label>氏名：</label>
                            <input type="text" name="name" class="textBox" id="name"
                             value="<?php echo $_SESSION['name'];?>"><br><br>

                            <label>メールアドレス：</label>
                            <input type="email" name="mail" class="textBox" id="mail" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                             value="<?php echo $_SESSION['mail'];?>"><br><br>

                            <label>パスワード (半角英数6文字以上）：</label>
                            <input type="text" name="password" class="textBox" id="password" pattern="^[a-zA-Z0-9]{6,}$"
                             value="<?php echo $_SESSION['password'];?>"><br><br>
                        </div>

                    </div>
                    
                    <textarea name="comments" id="comments"><?php echo $_SESSION['comments'];?></textarea><br><br>
                    <div class="submitBox">
                        <input type="submit" value="この内容に変更する" class="submit">
                    </div>
                </form>
        </main>
        <footer>
            <p>©2018 InterNous.inc ALL rights reserved</p>
        </footer>
    </body>
</html>