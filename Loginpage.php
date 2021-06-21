<!DOCTYPE html>
<html lang="en">

<?php

$status = "log in";
if(!isset($_SESSION['user']))
    session_start();

//    session_start();
//
//    if (isset($_SESSION['views'])) {
//        $_SESSION['views'] = $_SESSION['views'] + 1;
//    } else {
//        $_SESSION['views'] = 1;
//    }
//    echo "浏览量：" . $_SESSION['views'];
//?>

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
                alert('输入格式正确，已提交！');
            }
        }
    </script>
</head>
<body>
    <p style="text-align:right" class="ch"> <a href="Mainpage.php"> 返回主页 </a> </p>
    <h1 class="title"> Art Store </h1>
    <p style="font-family: sans-serif"> Please enter your username and password </p>
    <br>

    <form style="text-align:center" method="post">
        <input type="text" name="user" id="ipt1" placeholder="Username" style="width:300px;height:40px;font-size:large"> <br> <br>
        <input type="password" name="pass" id="ipt2" placeholder="Password" style="width:300px;height:40px;font-size:large"> <br> <br> <br>
        <input type = "submit" id="log" onclick="checkLogForm()" value = "log in" style="height:50px;width:200px" class="button">
    </form>

    <br>

    <p style="font-size: xx-large;font-family: fantasy;font-weight: bold"> <a href="Signuppage.php"> Create New Account </a> </p>

</body>

<?php

if(isset($_SESSION['user'])) {
    echo "<script type='text/javascript'> document.getElementById('log').value = 'log out' </script>";
}
else {
    echo "<script type='text/javascript'> document.getElementById('log').value = 'log in' </script>";
}

require_once "connect.php";

if(isset($_POST['user'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    if (isset($_SESSION['user'])) {
        session_destroy();
        echo "<script type='text/javascript'> document.getElementById('log').value = 'log in' </script>";
        echo "<script type='text/javascript'>alert('成功退出账号！');</script>";


    } else {
        $sql = "SELECT * FROM user2";
        $result = $mysqli->query($sql);

        $repeat = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $name = $row['name'];
                $password = $row['password'];
                if ($user == $name and $pass == $password) {
                    $repeat = 1;
                }
            }
            if ($repeat == 0) {
                echo "<script type='text/javascript'>alert('该用户不存在，请先注册！');</script>";
            } else {

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
        }

    }

}

$mysqli->close();
?>

</html>