<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>4eachblog | 会員登録</title>
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
                <h1>会員登録</h1>
                <form method="post" action="register_confirm.php" enctype="multipart/form-data"><!--enctype…は、ファイルをアップロードする為の記述-->
                    <dl>
                        <dt>
                            <div class="required">
                                <p>必須</p>
                            </div>
                            <label for="name">氏名</label>
                        </dt>
                        <dd><input type="text" name="name" class="textBox" id="name" required></dd>
                        <dt>
                            <div class="required">
                                <p>必須</p>
                            </div>   
                            <label for="mail">メールアドレス</label>
                        </dt>
                        <dd>
                            <input type="email" name="mail" class="textBox" id="mail"
                             pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                        </dd>
                        <dt>
                            <div class="required">
                                <p>必須</p>
                            </div>
                            <label for="password">パスワード (半角英数6文字以上）</label> 
                        </dt>
                        <dd>
                            <input type="password" name="password" class="textBox" id="password" pattern="^[a-zA-Z0-9]{6,}$" required>
                        </dd>
                        <dt>
                            <div class="required">
                                <p>必須</p>
                            </div>
                            <label for="confirm">パスワード確認</label>
                        </dt>
                        <dd>
                            <input type="password" name="confirm_password" class="textBox" id="confirm" oninput="ConfirmPassword(this)" required> 
                        </dd>
                        <dt>プロフィール写真</dt>
                        <input type="hidden" name="maxFile" value="5000000">
                        <dd><input type="file" name="picture" size="50"></dd>
                       
                        <dt><label for="comments">コメント</label></dt>
                        <dd><textarea name="comments" class="textArea" id="comments"></textarea></dd>
                    </dl>
                    <div class="submitBox">
                        <input type="submit" value="登録する" class="submit">
                    </div>
                </form>
            </div>
        </main>
        <footer>
            <p>©2018 InterNous.inc ALL rights reserved</p>
        </footer>

        <script>
            function ConfirmPassword(confirm) {
                var input1 = password.value;
                var input2 = confirm.value;
                if(input1 != input2) {
                    confirm.setCustomValidity("パスワードが一致しません。");
                } else {
                    confirm.setCustomValidity("");
                }
            }
        </script>
    </body>
</html>