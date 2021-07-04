<?php
// 1. POSTデータ取得
$name   = $_POST["name"];
$lid  = $_POST["lid"];
$lpw = $_POST["lpw"];
$hlpw = password_hash($lpw,PASSWORD_DEFAULT);
//$kanri_flg = implode("、", $_POST['kanri_flg']);
//$life_flg = implode("、",$_POST['life_flg']);

//var_dump($kanri_flg);
//var_dump($life_flg);

// 2. DB接続します

require_once('funcs.php');
$pdo = db_conn();

// ３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare("INSERT INTO gs_user_table(name,lid,lpw,kanri_flg,life_flg)VALUES(:name,:lid,:lpw,0,0)");

// 4. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $hlpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
//$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
//$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect('index.php');
}

