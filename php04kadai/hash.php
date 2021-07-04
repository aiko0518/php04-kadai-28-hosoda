<?php

//パスワードのハッシュ化
$pw = password_hash('test1', PASSWORD_DEFAULT);
echo $pw;


?>