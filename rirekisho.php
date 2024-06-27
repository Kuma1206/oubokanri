<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rirekisyo</title>
    <link rel="stylesheet" type="text/css" href="css/rirekisho.css" />
</head>
<body>
    <h2>履歴書</h2>
    <div id="area1">
        <p>学歴</p>
        <div id="gakureki" class="area2">
            <div class="t-area">
                <p>入学年月</p><input type="date" name="name">
            </div>
            <div class="t-area">
                <p>学校名</p><input type="text" class="textarea" name="kaisyamei" placeholder="○○県立○○学校　○○科　入学">
            </div>
            <div class="t-area">
                <p>卒業年月</p><input type="date" name="name">
            </div>
            <div class="t-area">
                <p>学校名</p><input type="text" class="textarea" name="kaisyamei" placeholder="○○県立○○学校　○○科　卒業">
            </div>
        </div>
        <div id="area3"></div>
        <div id="p-area">
            <div class="trash"></div>
            <h5>＋</h5>
        </div>
    </div>

    <div id="area1"> 
        <p>職歴</p>
        <div id="shokumu-keireki" class="area2">
            <div class="t-area">
                <p>入社年月</p><input type="date" name="name">
            </div>
            <div class="t-area">
                <p>会社名</p><input type="text" class="textarea" name="kaisyamei" placeholder="○○株式会社　入社">
            </div>
            <div class="t-area">
                <p>退社年月</p><input type="date" name="name">
            </div>
            <div class="t-area">
                <p>退職理由</p><input type="text" class="textarea" name="kaisyamei" placeholder="一身上の都合により退社">
            </div>
        </div>
        <div id="area4"></div>
        <div id="p-area">
            <div class="trash"></div>
            <h6>＋</h6>
        </div>


        <button>保存</button>
        <button id="modoru">Mainに戻る</button>

    </div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

$('h5').click(function() {
    let newGakureki = `
        <div id="shokumu-keireki" class="area2">
            <div class="t-area">
                <p>入社年月</p><input type="date" name="name">
            </div>
            <div class="t-area">
                <p>会社名</p><input type="text" class="textarea" name="kaisyamei" placeholder="○○株式会社　入社">
            </div>
            <div class="t-area">
                <p>退社年月</p><input type="date" name="name">
            </div>
            <div class="t-area">
                <p>退職理由</p><input type="text" class="textarea" name="kaisyamei" placeholder="一身上の都合により退社">
            </div>
        </div>
    `;
    $('#area3').append(newGakureki);
});


$('h6').click(function() {
    let newGakureki = `
        <div id="gakureki" class="area2">
            <div class="t-area">
                <p>入学年月</p><input type="date" name="name">
            </div>
            <div class="t-area">
                <p>学校名</p><input type="text" class="textarea" name="kaisyamei" placeholder="○○県立○○学校　○○科　入学">
            </div>
            <div class="t-area">
                <p>卒業年月</p><input type="date" name="name">
            </div>
            <div class="t-area">
                <p>学校名</p><input type="text" class="textarea" name="kaisyamei" placeholder="○○県立○○学校　○○科　卒業">
            </div>
        </div>
    `;
    $('#area4').append(newGakureki);
});


$("#modoru").click(function() {
    window.location.href = "mypage.php";
});


</script>

</body>
</html>