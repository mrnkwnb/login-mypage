<!--mypage_hensyu.php から送られたデータを、DBに格納するページ-->
<?php
mb_internal_encoding("utf8");
session_start();

$pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","");
/*　↑この文はNG ※もしDB接続に失敗したら、エラーメッセージがそのまま画面に表示されてしまう為。
    ↓のtry文で記述しておけば接続の処理をしてくれる*/

//▼例外処理文
try {
        $pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","");  //問題が起きそうな処理
    } catch(PDOException $e) {                                              //catch(監視する内容)/(PDOException)=接続失敗の事故
                                                                            //監視する内容 が tryで発生すれば、処理がcatch内に移る
        die("                                                               
        <p>申し訳ございません、現在サーバーが混みあっており一時的にアクセスが出来ません。<br>
        しばらくしてから再度ログインをして下さい。</p>
        <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>
        ");
    }
                                                                      
//テーブルの値を、mypage_hensyu.phpから送られたPOSTデータに更新する
$stmt = $pdo->prepare(
    "UPDATE login_mypage SET name = ?,mail = ?,password = ?,comments = ? WHERE id=?"
);
$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['comments']);
$stmt->bindValue(5,$_SESSION['id']);//（idカラムがSESSION['id']（mypage.phpで設定した）のものを更新する為）
$stmt->execute();

$stmt = $pdo->prepare(
    "SELECT * FROM login_mypage where id = ?"
);
$stmt->bindValue(1,$_SESSION['id']);
$stmt->execute();
$pdo = NULL;

while($row = $stmt->fetch()) {  //fetch = 配列を取得する
    $_SESSION['id'] = $row['id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['mail'] = $row['mail'];
    $_SESSION['password'] = $row['password'];
    //$_SESSION['picture2'] = $row['picture']; //今回は、pictureは編集していない
    $_SESSION['comments'] = $row['comments'];
}
header("Location:mypage.php");
?>