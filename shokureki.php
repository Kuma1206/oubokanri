<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shokureki</title>
    <link rel="stylesheet" type="text/css" href="css/syokureki.css" />
</head>
<body>
    <h2>職務経歴書</h2>
    <div id="area1">
        <div id="gakureki" class="area2">
            <div class="t-area">
                <p>入社年月</p><input type="date" name="name">
                <p>退社年月</p><input type="date" name="name">
            </div>
            <div class="t-area">
                <p>企業名</p><input type="text" class="textarea" name="kaisyamei" placeholder="○○県立○○学校　○○科　入学">
            </div>
            <div class="t-area">
                <p>雇用形態</p><input type="text" name="name" placeholder="正社員">
            </div>
            <div class="" id="text-area">
                <div class="b-text">
                    <p>業務内容</p><textarea type="text" class="textarea" name="kaisyamei" placeholder="○○県立○○学校　○○科　卒業"></textarea>
                </div>
            </div>
            <div class="" id="text-area">
                <div class="b-text">
                    <p>実績</p><textarea type="text" class="textarea" name="kaisyamei" placeholder="○○県立○○学校　○○科　卒業"></textarea>
                </div>
            </div>
        </div>
        <div id="area3"></div>
        <div id="p-area">
            <div class="trash"></div>
            <h5>＋</h5>
        </div>
    </div>

    <div id="area1"> 
        <button>保存</button>
        <button id="modoru">Mainに戻る</button>
    </div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

$('h5').click(function() {
    let newGakureki = `
        <div id="gakureki" class="area2">
            <div class="t-area">
                <p>入社年月</p><input type="date" name="name">
                <p>退社年月</p><input type="date" name="name">
            </div>
            <div class="t-area">
                <p>企業名</p><input type="text" class="textarea" name="kaisyamei" placeholder="○○県立○○学校　○○科　入学">
            </div>
            <div class="t-area">
                <p>雇用形態</p><input type="text" name="name" placeholder="正社員">
            </div>
            <div class="" id="text-area">
                <div class="b-text">
                    <p>業務内容</p><textarea type="text" class="textarea" name="kaisyamei" placeholder="○○県立○○学校　○○科　卒業"></textarea>
                </div>
            </div>
            <div class="" id="text-area">
                <div class="b-text">
                    <p>実績</p><textarea type="text" class="textarea" name="kaisyamei" placeholder="○○県立○○学校　○○科　卒業"></textarea>
                </div>
            </div>
        </div>
    `;
    $('#area3').append(newGakureki);
});



$("#modoru").click(function() {
    window.location.href = "mypage.php";
});


</script>

</body>
</html>