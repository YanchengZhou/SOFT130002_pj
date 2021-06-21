<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="Displaypage.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <style>
        .tableSearch{
            border-collapse : separate;
            border-spacing: 10px 40px;
            text-align: center;
        }

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
                alert('输入为空，展示所有艺术品！');
            } else {
                alert("搜索成功！");
            }

        }
    </script>

</head>

<body>

<?php
session_start();
$stat = "登陆";
if(isset($_SESSION['user']))
    $stat = "登出";
?>

<span style="height:50px">
            <span style=font-size:xx-large;font-family:DelaGothicOne;color:royalblue> <b>Art Store &nbsp &nbsp &nbsp</b> </span>
            <span style="font-size:large;padding-top:20px;font-family: monospace"> Where you find GENIUS and EXTROORDINARY </span>
            <span style="float:right;font-size:18px;font-family: 'Heiti SC';padding-top:24px"><a href="Mainpage.php">首页</a>
                &nbsp <a href="Search.php"> 搜索 </a> &nbsp <a href="Loginpage.php"> <?php echo $stat ?> </a> <a href="Signuppage.php"> &nbsp 注册</a> </span>
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

//index is current page number; num is total item number
$index = 0;
$num = 0;

if(isset($_GET['p']))
    $index = $_GET['p'];


if (isset($_SESSION['views'])) {
    $_SESSION['views'] = $_SESSION['views'] + 1;
} else {
    $_SESSION['views'] = 1;
}
//echo "浏览量：" . $_SESSION['views'];


?>

<?php

$name="v";
if(isset($_POST['test']))
    $name = $_POST['test'];

//default input is empty
$input = '';
if(isset($_GET['i']))
    $input = $_GET['i'];

//default page number
$page = 3;

$pics = array();
$title = array();
$artist = array();
$description = array();
$price = array();
$heat = array();


if (isset($_POST['submit']) or $index!=0){
    session_destroy();
    if(isset($_POST['content']))
        if($_POST['content'] != '')
            $input = $_POST['content'];

    if($name == 'p')
        $sql = "SELECT * FROM artworks order by price desc";
    elseif($name == 'v')
        $sql = "SELECT * FROM artworks order by view desc";
    else
        $sql = "SELECT * FROM artworks";

    $num = 0;

    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $t = $row['title'];
            $a = $row['artist'];
            $i = $row['description'];
            $p = $row['price'];
            $h = $row['view'];
            $pic = $row['imageFileName'];

            if(strpos($t, $input) or strpos($a, $input) or strpos($i, $input) or $input == '') {
                array_push($title, $t);
                array_push($artist, $a);
                array_push($price, $p);
                array_push($heat, $h);
                array_push($pics, $pic);
                $num++;

            }

        }
        if($input == '') {
            unset($_SESSION['views']);
        }



//        if($num <= 10) {
//            for($j = 0; $j < $num; $j++) {
//                echo "<h1 style='font-family: monospace; color:dimgrey'>
//                Title: ".$title[$j]."; Artist: ".$artist[$j]."; Price: ".$price[$j]."; Heat: ".$heat[$j]."; </h1>  <br>";
//            }
//        }
        if($num <= 10) {
            for($j = 0; $j < $num; $j++) {
                $picAd = "img/".$pics[$j];
                echo "
            <table class='tableSearch'>
        <tr>
            <td style='text-align: center'>
                <img  src=$picAd heigh='310' width=200>
            </td>
            <td>
                <div class='text'>
                    Title: $title[$j] <br> <br>
                    Artist: $artist[$j] <br> <br>
                    Heat: $heat[$j] &nbsp &nbsp &nbsp &nbsp
                    Price: $price[$j] <br>
                </div>
                <br> <br> <br>
                
               
            </td>
        </tr>
        </table>
        ";
            }
        }

        else {
            $start = $index * 10;
            for ($j = $start; $j < $start+10; $j++) {
                if($j < $num) {
                    $picAd = "img/".$pics[$j];
                    echo "
            <table class='tableSearch'>
        <tr>
            <td style='text-align: center'>
                <img  src=$picAd heigh='310' width=200>
            </td>
            <td>
                <div class='text'>
                    Title: $title[$j] <br> <br>
                    Artist: $artist[$j] <br> <br>
                    Heat: $heat[$j] &nbsp &nbsp &nbsp &nbsp
                    Price: $price[$j] <br>
                </div>
                <br> <br> <br>
                
               
            </td>
        </tr>
        </table>
        ";
                }
            }
        }


    } else {
        echo "0 结果";
    }




    $page = $num / 10;
}


$mysqli->close();
?>


<br> <br> <br> <br>




</body>

<footer>
    <br> <br> <br> <br>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">

            <?php
                $previous = 0;
                if($index!=0 and $index!=1)
                    $previous = $index - 1;
                else
                    $previous = $index;

                $after = 0;
                if($index!=0 and $index<$page)
                    $after = $index + 1;
                else
                    $after = $index;

                if($num > 10)
                    echo" <li class='page-item'>
                    <a class='page-link' href='Search.php?p=$previous&i=$input' tabindex=''-1'>Previous</a>
                        </li>";

                for($i = 1; $i <= $page; $i++) {
                    echo "<li class='page-item'><a class='page-link' href='Search.php?p=$i&i=$input'> $i </a></li>";
                }

                if($num > 10)
                    echo"<li class='page-item'>
                    <a class='page-link' href='Search.php?p=$after&i=$input'>Next</a>
                </li>";
            ?>

        </ul>
    </nav>
</footer>
</html>