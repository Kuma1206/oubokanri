<?php
session_start(); 

// ログインしているユーザーのIDをセッションから取得
$user_id = $_SESSION['user_id'];

// DB接続
$dbn = 'mysql:dbname=tenshokukanri_01;charset=utf8mb4;port=3308;host=localhost';
$user = 'root';
$pwd = '';

try {
    $pdo = new PDO($dbn, $user, $pwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL作成&実行（ログインしているユーザーのデータを取得）
    $sql = 'SELECT * FROM privacy WHERE user_id = :user_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT); // パラメータの型を指定してバインド
    $stmt->execute();
    
    // 結果を取得する前に、fetchできる行があるか確認する
    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        // データが見つからない場合は、初期値として空白を設定
        $result = [
            'namae' => '',
            'furigana' => '',
            'gender' => '',
            'umare' => '',
            'nenrei' => '',
            'zipcode' => '',
            'zyusho' => '',
            'phone' => '',
            'email' => '',
            'shikaku' => '',
            'fuyou' => '',
            'kazoku' => '',
            'haifu' => '',
            'kibou' => '',
        ];
    }
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>privacy</title>
    <link rel="stylesheet" type="text/css" href="css/privacy.css" />
</head>
<body>
    <h2>個人情報の修正</h2>
    <form action="privacy_create.php" method="POST">
        <div id="area1">
            <div class="t-area">
                <p>名前</p><input type="text" name="namae" value="<?= htmlspecialchars($result['namae'], ENT_QUOTES, 'UTF-8') ?>" placeholder="山田　太郎">
            </div>
            <div class="t-area">
                <p>フリガナ</p><input type="text" name="furigana" value="<?= htmlspecialchars($result['furigana'], ENT_QUOTES, 'UTF-8') ?>" placeholder="ヤマダ　タロウ">
            </div>
            <div class="t-area">
                <p>性別</p>
                <select id="sei" name="gender">
                    <option value="male" <?= $result['gender'] == 'male' ? 'selected' : '' ?>>男性</option>
                    <option value="female" <?= $result['gender'] == 'female' ? 'selected' : '' ?>>女性</option>
                    <option value="other" <?= $result['gender'] == 'other' ? 'selected' : '' ?>>その他</option>
                </select>
            </div>
            <div class="t-area">
                <p>生年月日</p><input type="data" id="umare" name="umare" value="<?= htmlspecialchars($result['umare'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="t-area">
                <p>年齢</p><input type="number" id="nenrei" name="nenrei" min="0" value="<?= htmlspecialchars($result['nenrei'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="t-area">
                <p>郵便番号</p><input type="text" name="zipcode" value="<?= htmlspecialchars($result['zipcode'], ENT_QUOTES, 'UTF-8') ?>" placeholder="123-4567"><p id="kensaku">🔎</p>
            </div>
            <div class="t-area">
                <p>現住所</p><input type="text" id="zyusho" name="zyusho" value="<?= htmlspecialchars($result['zyusho'], ENT_QUOTES, 'UTF-8') ?>" placeholder="福岡県福岡市中央区0-0-0 パーク福岡 101号室">
            </div>
            <div class="t-area">
                <p>電話番号</p><input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($result['phone'], ENT_QUOTES, 'UTF-8') ?>" placeholder="000-1234-5678">
            </div>
            <div class="t-area">
                <p>E-mail</p><input type="email" id="email" name="email" value="<?= htmlspecialchars($result['email'], ENT_QUOTES, 'UTF-8') ?>" placeholder="〇〇〇〇〇〇@gmail.com">
            </div>
            <div class="t-area">
                <p>資格</p><input type="text" id="shikaku" name="shikaku" value="<?= htmlspecialchars($result['shikaku'], ENT_QUOTES, 'UTF-8') ?>" placeholder="○○免許取得">
            </div>
            <div class="t-area">
                <p>扶養家族（配偶者を除く）</p><input type="text" id="fuyou" name="fuyou" value="<?= htmlspecialchars($result['fuyou'], ENT_QUOTES, 'UTF-8') ?>" placeholder="〇人">
            </div>
            <div class="t-area">
                <p>配偶者</p>
                <select id="kazoku" name="kazoku">
                    <option value="有" <?= $result['kazoku'] == '有' ? 'selected' : '' ?>>有</option>
                    <option value="無" <?= $result['kazoku'] == '無' ? 'selected' : '' ?>>無</option>
                </select>
            </div>
            <div class="t-area">
                <p>配偶者の扶養義務</p>
                <select id="haifu" name="haifu">
                    <option value="有" <?= $result['haifu'] == '有' ? 'selected' : '' ?>>有</option>
                    <option value="無" <?= $result['haifu'] == '無' ? 'selected' : '' ?>>無</option>
                </select>
            </div>
            <div class="t-area">
                <p>本人希望記入欄</p><input type="text" id="kibou" name="kibou" value="<?= htmlspecialchars($result['kibou'], ENT_QUOTES, 'UTF-8') ?>" placeholder="ヤマダ　タロウ">
            </div>
            <button>保存</button>
        </div>
    </form>   
    <button id="modoru">Mainに戻る</button>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $("#modoru").click(function() {
            window.location.href = "mypage.php";
        });
    </script>
</body> 
</html>
