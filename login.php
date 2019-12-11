<html>
    <head>
        <script src="js/dim2.js"></script>
<link rel="stylesheet" href="css/login.css">
    </head>
    <body>
    <div class="back"></div>
    <div class="form">
        <h1>Masuk</h1>
        <div class="dobel">
            <div class="dobel-child">
            <div class="input-list">
            <input type="text" id="username" placeholder="username" onkeyup="cekifexist()">
            <label for="username" id="usr">username</label>
            </div>
            <b id="next">Next</b>
            </div>
            
            <div class="dobel-child">dua</div>
        </div>
    </div>
    <script>
        let btnNext = gElement("#next");
        btnNext.onclick = function(){
            alert("hi");
        }
    </script>
    </body>
</html>