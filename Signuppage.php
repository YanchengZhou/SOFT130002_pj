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
                alert('注册成功，正在检查是否重复注册！');
            }
        }
    </script>
</head>
<body>
    <p style="text-align:right" class="ch"> <a href="Mainpage.php"> 返回主页 </a> </p>
    <h1 style="text-align:center" class="title"> Sign up for Art Store </h1>
    <p style="font-family: sans-serif;font-size:18px"> Please enter your username and password and confirm your password </p>
    <br>
    <form style="text-align:center;font-size:large" method="post">
        <input type="text" id="ipt1" name="user" style="width:300px;height:40px;font-size:large" placeholder="Username"> <br> <br>
        <input type="password" id="ipt2" name="pass"  style="width:300px;height:40px;font-size:large" placeholder="Password"> <br> <br>
        <input type="password" id="ipt3" name="pass2" style="width:300px;height:40px;font-size:large" placeholder="Confirm password"> <br> <br>
        <input type="submit" onclick="checkSignForm()" style="height:50px;width:200px" class="button" value = "Sign up">
    </form>

    <br>

    <p style="font-family: TrainOne-Regular"> <a href="Loginpage.php"> Go to Login page </a> </p>

</body>

<?php
    require_once "connect.php";
?>

<?php

    if(isset($_POST['user'])) {
        $user = $_POST['user'];
        $password = $_POST['pass'];

        $sql = "SELECT * FROM user2";
        $result = $mysqli->query($sql);

        $repeat = 0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $name = $row['name'];
                $pass = $row['password'];
                if($user == $name) {
                    echo "<script type='text/javascript'>alert('该用户已经存在，出错了！');</script>";
                    $repeat = 1;
                }
            }
            if($repeat == 0) {
                mysqli_query($mysqli, "INSERT INTO user2 (name,password) VALUES ('$user','$password')");
                session_start();
                $_SESSION['user'] = $user;
                $_SESSION['password'] = $pass;
                $_SESSION['status'] = "log out";
                $status = "log out";

                echo " <br> <br> <p class='subtitle' style='font-size:xx-large'> 已登陆 <br> <br>
                    Personal Information:
                </p>";

                echo "<p class='text'>
        User: $user <br> <br>
        Password: $password <br> <br> </p>";

                echo "<script type='text/javascript'> document.getElementById('log').value = 'log out' </script>";
            }

        } else {
            echo "0 结果";
        }


        $mysqli->close();



    }

//if (document.getElementById('ipt1').value.length == 0 || document.getElementById('ipt2').value.length == 0 ||
//    document.getElementById('ipt3').value.length == 0) {
//    alert('输入为空！出错了！');
//}


?>

</html>