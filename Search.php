<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="Displaypage.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <style>
    ul.pagination {
    display: flex;
    padding: 0;
    justify-content: center;
    margin:auto;
    }

    ul.pagination li {display: inline;}

    ul.pagination li a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    }
    </style>

    <script type="text/javascript">
        function checkLogForm(){
            let input = document.getElementById('ipt1').value;
            if (input.length == 0) {
                alert('输入为空！');
            } else {
                alert("搜索成功！");
            }

        }
    </script>

</head>

<body>

<span style="height:50px">
            <span style=font-size:xx-large;font-family:DelaGothicOne;color:royalblue> <b>Art Store &nbsp &nbsp &nbsp</b> </span>
            <span style="font-size:large;padding-top:20px;font-family: monospace"> Where you find GENIUS and EXTROORDINARY </span>
            <span style="float:right;font-size:18px;font-family: 'Heiti SC';padding-top:24px"><a href="Mainpage.php">首页</a>
                &nbsp <a href="Search.php"> 搜索 </a> &nbsp <a href="Loginpage.php">登陆</a> <a href="Signuppage.php"> &nbsp 注册</a> </span>
        </span>

<hr>
<br> <br> <br>

    <form style="text-align:center" method="post">
        <input type="text" name = "content" placeholder="Search" id="ipt1" style="width:200px;height:30px;font-size:large"> &nbsp &nbsp &nbsp &nbsp
        <input type = "submit" name = "submit"  onclick="checkLogForm()" value = "Submit" class = button1 style="height:30px;width:80px"> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
        <input type="radio" name="test" id="price" value="p" /> Sort by price &nbsp &nbsp &nbsp &nbsp
        <input type="radio" name="test" id="view" value="v"/> Sort by view &nbsp &nbsp &nbsp &nbsp
        <input type="radio" name="test" checked="true" id="none" value="n" /> No sort
    </form>


<br> <br> <br> <br>

<h1 style="font-family: DelaGothicOne;text-align: center"> Search Result: </h1>

<br> <br> <br>


<?php
require_once "connect.php";
?>

<?php

$name = $_POST['test'];

if (isset($_POST['submit'])){
    $input = $_POST['content'];

    if($name == 'p')
        $sql = "SELECT * FROM artworks order by price desc";
    elseif($name == 'v')
        $sql = "SELECT * FROM artworks order by view desc";
    else
        $sql = "SELECT * FROM artworks";

    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $title = $row['title'];
            $artist = $row['artist'];
            $intro = $row['description'];
            $price = $row['price'];
            $heat = $row['view'];

            if(strpos($title, $input) or strpos($artist, $input) or strpos($intro, $input)) {
                echo "<h1 style='font-family: monospace; color:dimgrey'>
                Title: ".$title."; Artist: ".$artist."; Price: ".$price."; Heat: ".$heat."; </h1>  <br>";
            }
        }
    } else {
        echo "0 结果";
    }
}

$mysqli->close();
?>


<br> <br> <br> <br>




</body>

<footer>
    <br> <br> <br> <br>

    <ul class="pagination" style="font-size: 24px">
        <li><a href="#">«</a></li>
        <li><a href="#">1</a></li>
        <li><a class="active" href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">6</a></li>
        <li><a href="#">7</a></li>
        <li><a href="#">»</a></li>
    </ul>
</footer>
</html>