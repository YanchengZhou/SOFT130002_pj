<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="LoginSignup.css">
    <style>

    </style>
    <script>
        function checkLogForm(){
            if(document.getElementById('ipt1').value.length==0 || document.getElementById('ipt2').value.length==0) {
                alert('输入为空！出错了！');
            }
            else {
                alert('登陆成功！');
            }
        }
    </script>
</head>
<body>
    <p style="text-align:right" class="ch"> <a href="Mainpage.php"> 返回主页 </a> </p>
    <h1 class="title"> Art Store </h1>
    <p style="font-family: sans-serif"> Please enter your username and password </p>
    <br>

    <form style="text-align:center">
        <input type="text" id="ipt1" placeholder="Username" style="width:300px;height:40px;font-size:large"> <br> <br>
        <input type="password" id="ipt2" placeholder="Password" style="width:300px;height:40px;font-size:large"> <br> <br> <br>
    </form>

    <div align="center">
        <input type = "button" onclick="checkLogForm()" value = "log in" style="height:50px;width:200px" class="button">
    </div>

    <br>

    <p style="font-size: xx-large;font-family: fantasy;font-weight: bold"> <a href="Signuppage.php"> Create New Account </a> </p>

</body>

</html>