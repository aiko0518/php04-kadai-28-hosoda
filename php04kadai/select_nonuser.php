<?php
require_once('funcs.php');

//2．SQL文を用意(データ取得：SELECT)
$pdo = db_conn();
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//4．データ表示
$view="";
//$resultArr = [];
if($status==false) {
  sql_error($status);
}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  //PHP処理
  //”配列$result”に全てのデータを代入できます。
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= "<p>";
    $view .= '<a href="detail.php?id=' . $result['id'] . '">';
    $view .= h($result['indate'].'：'.$result['name'].'：'.$result['url'].'：'.$result['naiyou']);
    $view .= '</a>';
    $view .= '<a href="delete.php?id=' . $result['id'] . '">';//追記
    //$view .= '  [削除]';//追記
    $view .= '</a>';//追記
    $view .= "</p>";
    //array_push($resultArr, $result);
  }
    //$json = json_encode($resultArr);
    //var_dump($json);
  } 

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
      <p><?= $user_name ?></p>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>

<script>
const data = JSON.parse('<?=$json?>');
console.log(data);

</script>