
<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn()
//*関数を作成し、内容をreturnさせる
//*DBname等、今回の課題に合わせる
function db_conn(){
    try {
          $db_name = "mil1st_hosoda";
          $db_id = "mil1st";
          $db_pw = "yattemil12345";
          $db_host = "mysql57.mil1st.sakura.ne.jp";
          

        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo;    
    } catch (PDOException $e) {
      exit('DBConnectError:'.$e->getMessage());
    }    
}
          //Localhost接続用
          //$db_name = "gs_bm";    //データベース名
          //$db_id   = "root";      //アカウント名
          //$db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
          //$db_host = "localhost"; //DBホスト

//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("ErrorMassage:".$error[2]);
}

//リダイレクト関数：redirect($file_name)
function redirect($file_name){
    header("Location:" . $file_name);
    exit();
}
//ログインチェック
function loginCheck(){
    if( $_SESSION["chk_ssid"] != session_id() ){
      exit('LOGIN ERROR');
    }else{
      session_regenerate_id(true);
      $_SESSION['chk_ssid'] = session_id();
    }
  }

//ログインチェック select.php用
function loginCheckS(){
  if( $_SESSION["chk_ssid"] != session_id() ){
    header("Location:" . 'select_nonuser.php');

  }else{
    session_regenerate_id(true);
    $_SESSION['chk_ssid'] = session_id();
  }
}

//ログインチェック detail.php用
function loginCheckD(){
  if( $_SESSION["chk_ssid"] != session_id() ){
    header("Location:" . 'detail_nonuser.php');

  }else{
    session_regenerate_id(true);
    $_SESSION['chk_ssid'] = session_id();
  }
}


?>



