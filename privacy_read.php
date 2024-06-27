<?php
session_start(); 
// ログインしているユーザーのIDをセッションから取得
$user_id = $_SESSION['user_id'];

// DB接続
$dbn ='mysql:dbname=tenshokukanri_01;charset=utf8mb4;port=3308;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

// SQL作成&実行
$sql = 'SELECT * FROM privacy WHERE user_id = :user_id;';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// SQL実行の処理
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {
  $output .= "<tr>";
  $output .= "<div class=\"t-area\">
                <p>名前: {$record['namae']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>フリガナ: {$record['furigana']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>性別: {$record['gender']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>生年月日: {$record['umare']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>年齢: {$record['nenrei']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>郵便番号: {$record['zipcode']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>現住所: {$record['zyusho']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>電話番号: {$record['phone']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>E-mail: {$record['email']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>資格: {$record['shikaku']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>扶養家族（配偶者を除く）: {$record['fuyou']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>配偶者: {$record['kazoku']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>配偶者の扶養義務: {$record['haifu']}</p>
              </div>";
  $output .= "<div class=\"t-area\">
                <p>本人希望記入欄: {$record['kibou']}</p>
              </div>";
  $output .= "</tr>";
}

$data_exists = !empty($result); // データがあるかどうかのフラグ
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（一覧画面）</title>
  <link rel="stylesheet" type="text/css" href="css/privacy_read.css" />
</head>
<body>
  <h2>個人情報の修正</h2>
  <div>
    <?= $output ?>
  </div>
  <div id="area1">
    <div class="t-area">
      <p>名前：</p>
    </div>
    <div class="t-area">
      <p>フリガナ：</p>
    </div>
    <div class="t-area">
      <p>性別：</p>
    </div>
    <div class="t-area">
      <p>生年月日：</p>
    </div>
    <div class="t-area">
      <p>年齢：</p>
    </div>
    <div class="t-area">
      <p>郵便番号：</p>
    </div>
    <div class="t-area">
      <p>現住所：</p>
    </div>
    <div class="t-area">
      <p>電話番号：</p>
    </div>
    <div class="t-area">
      <p>E-mail：</p>
    </div>
    <div class="t-area">
      <p>資格：</p>
    </div>
    <div class="t-area">
      <p>扶養家族（配偶者を除く）：</p>
    </div>
    <div class="t-area">
      <p>配偶者：</p>
    </div>
    <div class="t-area">
      <p>配偶者の扶養義務：</p>
    </div>
    <div class="t-area">
      <p>本人希望記入欄：</p>
    </div>
  </div>
  <button id="syuusei">修正</button>
  <button id="modoru">Mainに戻る</button>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    
  var dataExists = <?= json_encode($data_exists) ?>;
  if (dataExists) {
    $('#area1').hide();
  } else {
    $('#area1').show();
  }

  $("#modoru").click(function() {
    window.location.href = "mypage.php";
  });

  $("#syuusei").click(function() {
    window.location.href = "privacy_create.php";
  });

</script>
</body>
</html>
