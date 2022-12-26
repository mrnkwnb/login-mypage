<?php
session_start();
if(isset($_SESSION['id'])) {
    header("Location:mypage.php");
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>4eachblog | ログイン</title>
        <link rel="stylesheet" href="register.css">
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
                <div class="error">
                    <p>メールアドレスまたはパスワードが間違っています。</p>
                </div>
                <form method="post" action="mypage.php">
                    <dl>
                        <dt><label for="mail">メールアドレス</label></dt>
                        <dd>
                            <input type="email" name="mail" class="textBox" id="mail"
                             pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                        </dd>
                        <dt><label for="password">パスワード</label></dt>
                        <dd>
                            <input type="password" name="password" class="textBox" id="password"
                             pattern="^[a-zA-Z0-9]{6,}$" required>
                        </dd>
                        <dt>
                            <label>
                                <input type="checkbox" name="checkbox">ログイン状態を保持する
                            </label>
                        </dt>
                    </dl>
                    <div class="submitBox">
                        <input type="submit" value="ログイン" class="submit">
                    </div>
                </form>
            </div>
        </main>
        <footer>
            <p>©2018 InterNous.inc ALL rights reserved</p>
        </footer>