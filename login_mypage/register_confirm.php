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
                <?php echo $_POST['name'];?><br><br>
                <label>メールアドレス：</label>
                <?php echo $_POST['mail'];?><br><br>
                <label>パスワード：</label>
                <?php echo $_POST['password'];?><br><br>
                <label>プロフィール写真：</label>
                <?php
                    $temp_pic_name = $_FILES['picture']['tmp_name'];

                    $original_pic_name = $_FILES['picture']['name'];

                    move_uploaded_file($temp_pic_name,'./image/'.$original_pic_name);

                    $path_filename = './image/'.$original_pic_name;
                ?>  
                <div class="confirmImage">
                    <p><img src="<?php echo $path_filename ?>"></p>
                </div>
                <br>
    
                <label>コメント：</label>
                <?php echo $_POST['comments'];?><br><br>

                <div class="submitBox">
                    <form method="post" action="register.php" class="formSubmit">
                        <input type="submit" value="戻って修正する" class="submitReturn">
                    </form>
                    <form method="post" action="register_insert.php" enctype="multipart/form-data" class="formSubmit">
                        <input type="submit" value="登録する" class="submit">
                        <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
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