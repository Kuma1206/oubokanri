<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();

// セッションの有効性を確認する
if (!isset($_SESSION['user_id'])) {
    exit('セッションが有効ではありません。ログインしてください。');
}

// 必要なパラメータがセットされていることを確認する
if (
    !isset($_POST['namae']) || $_POST['namae'] === '' ||
    !isset($_POST['furigana']) || $_POST['furigana'] === '' ||
    !isset($_POST['gender']) || $_POST['gender'] === '' ||
    !isset($_POST['umare']) || $_POST['umare'] === '' ||
    !isset($_POST['nenrei']) || $_POST['nenrei'] === '' ||
    !isset($_POST['zipcode']) || $_POST['zipcode'] === '' ||
    !isset($_POST['zyusho']) || $_POST['zyusho'] === '' ||
    !isset($_POST['phone']) || $_POST['phone'] === '' ||
    !isset($_POST['email']) || $_POST['email'] === '' ||
    !isset($_POST['shikaku']) || $_POST['shikaku'] === '' ||
    !isset($_POST['fuyou']) || $_POST['fuyou'] === '' ||
    !isset($_POST['kazoku']) || $_POST['kazoku'] === '' ||
    !isset($_POST['haifu']) || $_POST['haifu'] === '' ||
    !isset($_POST['kibou']) || $_POST['kibou'] === ''
) {
    // フォームページにリダイレクト
    header('Location: privacy.php'); // form_page.php を実際のフォームページの名前に置き換えてください
    exit();
}

// POSTデータを取得する
$namae = $_POST['namae'];
$furigana = $_POST['furigana'];
$gender = $_POST['gender'];
$umare = $_POST['umare'];
$nenrei = $_POST['nenrei'];
$zipcode = $_POST['zipcode'];
$zyusho = $_POST['zyusho'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$shikaku = $_POST['shikaku'];
$fuyou = $_POST['fuyou'];
$kazoku = $_POST['kazoku'];
$haifu = $_POST['haifu'];
$kibou = $_POST['kibou'];

// ユーザーIDをセッションから取得する
$user_id = $_SESSION['user_id'];

// DB接続関数
function connectDB($dbn, $user, $pwd) {
    try {
        $pdo = new PDO($dbn, $user, $pwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo json_encode(["db error" => "{$e->getMessage()}"]);
        exit();
    }
}

// DBに接続する
$pdo = connectDB('mysql:dbname=tenshokukanri_01;charset=utf8mb4;port=3308;host=localhost', 'root', '');

// SQLを準備する
$sql = 'INSERT INTO privacy (id, user_id, namae, furigana, umare, nenrei, zipcode, zyusho, phone, email, shikaku, fuyou, kazoku, haifu, kibou, created_at, updated_at) VALUES (NULL, :user_id, :namae, :furigana, :umare, :nenrei, :zipcode, :zyusho, :phone, :email, :shikaku, :fuyou, :kazoku, :haifu, :kibou, now(), now())';
$stmt = $pdo->prepare($sql);

// バインド変数を設定する
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':namae', $namae, PDO::PARAM_STR);
$stmt->bindValue(':furigana', $furigana, PDO::PARAM_STR);   
$stmt->bindValue(':umare', $umare, PDO::PARAM_STR);  
$stmt->bindValue(':nenrei', $nenrei, PDO::PARAM_INT);  
$stmt->bindValue(':zipcode', $zipcode, PDO::PARAM_STR);  
$stmt->bindValue(':zyusho', $zyusho, PDO::PARAM_STR);  
$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);  
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':shikaku', $shikaku, PDO::PARAM_STR);  
$stmt->bindValue(':fuyou', $fuyou, PDO::PARAM_STR);  
$stmt->bindValue(':kazoku', $kazoku, PDO::PARAM_STR);  
$stmt->bindValue(':haifu', $haifu, PDO::PARAM_STR);  
$stmt->bindValue(':kibou', $kibou, PDO::PARAM_STR);  

try {
    // SQLを実行する
    $status = $stmt->execute();

    // 成功時の処理
    if ($status) {
        header('Location: privacy_read.php');
        exit();
    } else {
        exit('データの登録に失敗しました');
    }
} catch (PDOException $e) {
    // エラー時の処理
    echo "SQLエラー: " . $e->getMessage(); // エラーメッセージを表示
    exit();
}

?>
