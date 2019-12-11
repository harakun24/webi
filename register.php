<html>
    <head>
        <script src="js/dim2.js"></script>
        <link rel="stylesheet" href="css/singup.css?v=2">
    </head>
    <body>
        <div class="back"></div>
        <div class="form">
            <h1>Sign up</h1>
            <div class="input-list">
            <input type="text" id="username" placeholder="username" onkeyup="cekifexist()">
            <label for="username" id="usr">username</label>
            </div>

            <div class="input-list">
            <input type="email" id="email" placeholder="email" onkeyup="emailcek()">
            <label for="email" id="mail">email</label>
            </div>

            <div class="input-list">
            <input type="password" id="password" placeholder="password" onkeyup="pass()">
            <label for="password" id="pass">password</label>
            <div class="show" id="psw"></div>
            </div>

            <div class="input-list">
            <input type="password" id="re-type" placeholder="re-type" onkeyup="retype()">
            <label for="re-type" id="rtype">re-type</label>
            <div class="show" id="rtp"></div>
            </div>

            <div class="input-list last">
                <button id="cek">Bergabung</button>
                <a href="#">sudah punya akun?

                    <div class="cover">Masuk</div>
                </a>
            </div>
            
        </div>
        <script>
            let lock=[false,false,false,false];
            let status = 1;
            let status1 = 1;
            let ipt = gElement("#psw");
            let ipt2 = gElement("#rtp");

            ipt.onclick = function(){
                if(status){
                    this.style.cssText="background-image:url(images/show.png?v=2)";

                    this.parentNode.children[0].type="text";
                    status=0;
                }
                else{
                    this.style.cssText="background-image:url(images/hide.png)";
                    this.parentNode.children[0].type="password";
                    status=1;

                }
            }

            ipt2.onclick = function(){
                if(status1){
                    this.style.cssText="background-image:url(images/show.png?v=2)";

                    this.parentNode.children[0].type="text";
                    status1=0;
                }
                else{
                    this.style.cssText="background-image:url(images/hide.png)";
                    this.parentNode.children[0].type="password";
                    status1=1;

                }
            }
           
           let submit = gElement("#cek");
            submit.onclick = function(){
                if(lock[0]&&lock[1]&&lock[2]&&lock[3]){
                    let obj = {
                        username : gElement("#username").value,
                        email : gElement("#email").value,
                        password : gElement("#password").value
                    };
                    fetch("insert.php",{
                        method:"POST",
                        body:JSON.stringify({data:obj})
                    }).then(res=>res.text()).then(res=>{
                        console.log(res);
                    })
                }
                else{
                    alert("mohon lengkapi semua isian");
                }
                // console.log(lock);                
            }
            function validate(label,input,text,color){
                        let text2=gElement(label);
                        let input2=gElement(input);
                        text2.innerHTML=text;
                        text2.style.color=color;
                        input2.style.cssText="box-shadow: 0px 0px 2px "+color;
            }
            function cekifexist(){
                let uname = gElement("#username");
                fetch("cek.php?uname="+uname.value)
                .then(response=>response.text())
                .then(response=>{
                    
                    if(response!="ok"){
                        lock[0]=false;
                        validate("#usr","#username","sudah terpakai","red");
                    }
                    else{
                        validate("#usr","#username","username","rgba(66, 107, 241, 0.699)");
                        lock[0]=true;

                    }
                })
            }
            function emailcek(){
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                let input = gElement("#email");
                if(re.test(String(input.value).toLowerCase())){
                    fetch('cek.php?cek='+input.value)
                    .then(res=>res.text())
                    .then(res=>{
                        if(res=="ok"){
                            validate("#mail","#email","email","rgba(66, 107, 241, 0.699)");
                            lock[1]=true;
                        }
                        else{
                            validate("#mail","#email","email sudah dipakai","red");
                        }
                    })
                    
                }
                else{
                    lock[1]=false;
                    validate("#mail","#email","email tidak sesuai","red");
                }
            }
            function pass(){
                let p=gElement("#password");
                if(p.value.length<8){
                    lock[2]=false;
                    validate("#pass","#password","password minimal 8 karakter","red");
                }else{
                    lock[2]=true;
                    validate("#pass","#password","password","rgba(66, 107, 241, 0.699)");
                }
                retype();
            }
            function retype(){
                let p=gElement("#password");
                let p2 = gElement("#re-type");
                if(p.value==p2.value){
                    lock[3]=true;
                    validate("#rtype","#re-type","re-type","rgba(66, 107, 241, 0.699)");
                }
                else{
                    lock[3]=false;
                    validate("#rtype","#re-type","Password tidak cocok","red");
                }
            }
        </script>
    </body>
</html>