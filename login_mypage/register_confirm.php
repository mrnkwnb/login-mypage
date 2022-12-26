<!--会員登録、確認画面-->
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>4eachblog | 会員登録 確認</title>
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
                <h1>会員登録　確認</h1>
                <p class="confirm">こちらの内容で登録しても宜しいでしょうか？</p>
                <br>
                <label>氏名：</label>
                <?php echo $_POST['name'];?><br><br> <!-- $_POST = http,postで渡された値を取得する変数のこと -->
                <label>メールアドレス：</label>
                <?php echo $_POST['mail'];?><br><br>
                <label>パスワード：</label>
                <?php echo $_POST['password'];?><br><br>

                <label>プロフィール写真：</label>

                <!--↓↓↓画像ファイルの取得を記述↓↓↓-->
                <?php
                    $temp_pic_name = $_FILES['picture']['tmp_name'];//$_FILES = http,postでアップロードされた値を取得する変数のこと
                    //A.アップロードされたファイルの、仮保存されたディレクトリ（場所）を取得し、$temp_pic_name変数へ代入

                    $original_pic_name = $_FILES['picture']['name'];
                    //B.アップロードされたファイルの、ファイル名を取得し、$original_pic_name変数へ代入

                    move_uploaded_file($temp_pic_name,'./image/'.$original_pic_name);
                    //Aから、imageフォルダ(Bを)へ移動

                    $path_filename = './image/'.$original_pic_name;
                    //imageフォルダとBに変数を付けておく➡これがファイルのURLになる
                ?>  
                <!--↑↑↑画像ファイルの取得を記述↑↑↑-->

                <div class="confirmImage">
                    <p><img src="<?php echo $path_filename ?>"></p>
                    <!--ファイルの名前が、echoされる。画像の取得（一時保存場所からの移動）が行われないと出来ない。-->
                </div>
                <br>
                

                <label>コメント：</label>
                <?php echo $_POST['comments'];?><br><br>

                <div class="submitBox">
                    <form method="post" action="register.php" class="formSubmit">
                        <input type="submit" value="戻って修正する" class="submitReturn">
                    </form>
                    <form method="post" action="register_insert.php" enctype="multipart/form-data" class="formSubmit"> <!--enctype…は、ファイルをアップロードする為の記述-->
                        <input type="submit" value="登録する" class="submit">
                        <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>"> <!--register_insert.phpに送る為の記述-->
                        <input type="hidden" name="mail" value="<?php echo $_POST['mail']; ?>">
                        <input type="hidden" name="password" value="<?php echo $_POST['password']; ?>">
                        <input type="hidden" name="path_filename" value="<?php echo $path_filename; ?>">
                        <input type="hidden" name="comments" value="<?php echo $_POST['comments']; ?>">
                    </form>
                </div>
            </div>
        </main>
        <footer>
            <p>©2018 InterNous.inc ALL rights reserved</p>
        </footer>
    </body>
</html>                