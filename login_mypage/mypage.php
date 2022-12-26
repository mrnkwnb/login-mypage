<?php
mb_internal_encoding("utf8");
session_start();

//▼🌟既にログインされている状態（SESSEIONが存在している）なら、以下のコードは実行しなくて良い
if(empty($_SESSION['id'])) {
//（ログインの情報が残っていない場合に☟の処理を行う）
    
    //▼try文で書いているので、書かなくて良い
    $pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","");
    //▼ try catch文。DB接続出来なければ、エラーメッセージを表示するという例外処理を行う文。
    try {
        $pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","");
    } catch(PDOException $e) {
        die("
        <p>申し訳ございません、現在サーバーが混みあっており一時的にアクセスが出来ません。<br>
        しばらくしてから再度ログインをして下さい。</p>
        <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>
        ");
    }

    //▼ select文を使って、tableに入れたpost値を取得する
    //※DBとPOSTのデータを照合させる
    $stmt = $pdo->prepare("select * from login_mypage where mail=? && password=?");
    //mailカラムのとpasswordカラムの値が?(login.phpのpostデータと同じ)のものが取得される
    //?としたのは、login postから送られてきたデータが変数の為

    //▼ プレースホルダに値をバインドする
    //login.phpからpostされた値を入れる
    $stmt->bindValue(1,$_POST['mail']);
    $stmt->bindValue(2,$_POST['password']);
    //bindValue(パラメータID,$バインドする値)
    //↪パラメータID：プレースホルダの?の位置
    $stmt->execute();
    $pdo = NULL;//DB切断

    //▼ select文で取得した配列（カラム）の値を取得する = fetch
    while($row = $stmt->fetch()) { //while = ループ処理を行うという意味。

        //▼ループする内容
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['mail'] = $row['mail'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['picture'] = $row['picture'];
        $_SESSION['comments'] = $row['comments'];
    }

    if(empty($_SESSION['id'])) { //もしSESSION['id']が空だったら（照合したカラムにDBの情報が無かったら）
        header("Location:login_error.php");//リダイレクトでlogin_error.phpページへ飛ぶ
    }
    if(!empty($_POST['checkbox'])) { //もしPOST['checkbox']に☑が入っていたら
        $_SESSION['checkbox'] = $_POST['checkbox'];//POST値checkboxをsessionする

    }
}

//▼🌟既にログインされている状態かつ、SESSION[checkbox]に☑が入っていたら
if(!empty($_SESSION['id']) && !empty($_SESSION['checkbox'])) {
    setcookie('mail',$_SESSION['mail'],time()+60*60*24*7);//cookieを設定する（ログアウトやブラウザを閉じたりするまではcookieが残る状態）
    setcookie('password',$_SESSION['password'],time()+60*60*24*7);
    setcookie('checkbox',$_SESSION['checkbox'],time()+60*60*24*7);
} else if(empty($_SESSION['checkbox'])) {
    setcookie('mail','',time()-1);//cookieからデータを削除する（cookieを設定していなくても、これを記述しないと、データが残ってしまう）
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
                        <!--▼ mypage_hensyu.phpへのアクセスを、mypage.phpの編集ボタンでしかアクセス出来ない様にする
                        ※今の状態だと、アドレスバーに入力でアクセス出来てしまう為-->
                        <input type="hidden" value="<?php echo rand(1,10);?>" name="rand"><!--value値が送る内容-->
                        <!--続きはhensyuページへ-->
                    </form>
                </div>
            </div>
        </main>
        <footer>
            <p>©2018 InterNous.inc ALL rights reserved</p>
        </footer>
    </body>
</html>
                
