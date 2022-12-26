<?php
session_start();
session_destroy();
//sessionを無効にすることで、ログアウトする事ができる。
//※sessionに値が残っていると、前回ログインした時のデータが残ってしまう。
header("Location:login.php");
?>