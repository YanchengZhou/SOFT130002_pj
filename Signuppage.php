<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="LoginSignup.css">
    <style>
    </style>
    <script>
        function checkSignForm() {
            let letter = /[a-zA-Z]+/.test(document.getElementById('ipt2').value);
            let number = /\d+/.test(document.getElementById('ipt2').value);
            if (document.getElementById('ipt1').value.length == 0 || document.getElementById('ipt2').value.length == 0 ||
                document.getElementById('ipt3').value.length == 0) {
                alert('输入为空！出错了！');
            } else if (document.getElementById('ipt2').value != document.getElementById('ipt3').value) {
                alert('密码与确认密码不一致，出错了！');
            } else if (!letter || !number) {
                alert('密码需要同时包含数字和字母，出错了!');
            } else {
                alert('注册成功！');
            }
        }
    </script>
</head>
<body>
    <p style="text-align:right" class="ch"> <a href="Mainpage.php"> 返回主页 </a> </p>
    <h1 style="text-align:center" class="title"> Sign up for Art Store </h1>
    <p style="font-family: sans-serif;font-size:18px"> Please enter your username and password and confirm your password </p>
    <br>
    <form style="text-align:center;font-size:large">
        <input type="text" id="ipt1" style="width:300px;height:40px;font-size:large" placeholder="Username"> <br> <br>
        <input type="password" id="ipt2" style="width:300px;height:40px;font-size:large" placeholder="Password"> <br> <br>
        <input type="password" id="ipt3" style="width:300px;height:40px;font-size:large" placeholder="Confirm password"> <br> <br>
    </form>

    <br>

    <div align="center">
        <input type="button" onclick="checkSignForm()" style="height:50px;width:200px" class="button" value = "Sign up">
    </div>


    <p style="font-family: TrainOne-Regular"> <a href="Loginpage.php"> Go to Login page </a> </p>

</body>

</html>