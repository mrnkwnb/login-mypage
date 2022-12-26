<!--ログイン状態のままログインページに移動すると、マイページに飛ぶように記述する-->
<?php
session_start();
if(isset($_SESSION['id'])) {
    header("Location:mypage.php");
}
//「$_SESSION['id']が存在していたら、mypage.phpに飛ぶ」という記述
//（※一度ログインをしたら、sessionに値が与えられる為、TRUEとなり、header文が有効となる）
?>

<!--ログインページの記述-->
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
            <form method="post" action="mypage.php">
                <dl>
                    <dt><label for="mail">メールアドレス</label></dt>
                    <dd>
                        <input type="email" name="mail" class="textBox" id="mail" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                         value=
                            "<?php
                                if(isset($_COOKIE['mail'])) {
                                    echo $_COOKIE['mail'];
                                }
                            ?>" 
                        >
                    </dd>
                    <dt><label for="password">パスワード</label></dt>
                    <dd>
                        <input type="password" name="password" class="textBox" id="password" pattern="^[a-zA-Z0-9]{6,}$"
                         value=
                         "<?php
                                if(isset($_COOKIE['password'])) {
                                    echo $_COOKIE['password'];
                                }
                            ?>" 
                        >
                    </dd>
                    <dt>
                        <label>
                            <input type="checkbox" name="checkbox"
                                <?php
                                 if(isset($_COOKIE['checkbox'])) {
                                    echo "checked='checked'";
                                 }//もし$_COOKIE['name値']が存在していたら、☑状態にしてねという意味
                                ?>
                            >
                            ログイン状態を保持する
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