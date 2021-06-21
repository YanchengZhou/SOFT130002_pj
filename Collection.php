<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="Displaypage.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-3.5.1.min.js"></script>

    <script>
        function deleteLine(obj) {
            let bool = 0;
            if (confirm( '确定要删除吗?' ))
            {
                bool = 1;
            }
            else {
                bool = 0;
            }

            if(bool == 1) {
                let tr = obj.parentNode.parentNode.parentNode.parentNode;
                let tab = tr.parentNode;
                tab.removeChild(tr);
                alert("删除成功！");
            }

            // $.ajax({
            //     type: 'POST',
            //     url: 'Collection.php',
            //     data:{
            //         'id': id
            //     },
            //     success: function(msg){
            //         alert( 'Data Saved: ' + msg );
            //     }
            // });
    }

    </script>
</head>
<body>

    <?php
        require_once "connect.php";

        session_start();
        $u = "未登录";
        $p = "无密码";

    if(isset($_SESSION['user'])) {
        $u = $_SESSION['user'];
        $p = $_SESSION['password'];
    }

    $sql2 = "SELECT * FROM carts";

    $collection = array();

    $result = $mysqli->query($sql2);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($collection, $row['artworkID']);
        }

    }

    $id = array();
    $pics = array();
    $name = array();
    $artist = array();
    //$description = array();
    $genre = array();
    $width = array();
    $height = array();
    $price = array();
    $view = array();
    $year = array();
    $description = array();
    $date = array();

    $num = 0;

    for ($i = 0; $i < count($collection); ++$i) {
        $sql3 = "SELECT * FROM artworks WHERE artworkID = $collection[$i]";
        $result = $mysqli->query($sql3);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($id, $row['artworkID']);
                array_push($pics, $row["imageFileName"]);
                array_push($name, $row['title']);
                array_push($artist, $row['artist']);
                array_push($description, $row['description']);
                array_push($year, $row['yearOfWork']);
                array_push($genre, $row['genre']);
                array_push($width, $row['width']);
                array_push($height, $row['height']);
                array_push($price, $row['price']);
                array_push($view, $row['view']);
                array_push($date, $row['timeReleased']);
                $num = $num + 1;

            }

        }
    }


    ?>

    <?php
    $status = "登陆";
    if(isset($_SESSION['user']))
        $status = "登出";
    ?>

    <span style="height:50px">
            <span style=font-size:xx-large;font-family:DelaGothicOne;color:royalblue> <b>Art Store &nbsp &nbsp &nbsp</b> </span>
            <span style="font-size:large;padding-top:20px;font-family: monospace"> Where you find GENIUS and EXTROORDINARY </span>
            <span style="float:right;font-size:18px;font-family: 'Heiti SC';padding-top:24px">
                &nbsp <a href="Mainpage.php">首页</a>  &nbsp  <a href="Search.php"> 搜索 </a>
             &nbsp <a href="Loginpage.php"> <?php echo $status ?> </a> <a href="Signuppage.php"> &nbsp 注册</a> </span>
    </span>

    <hr>
    <br>

    <p class="subtitle" style="font-size:xx-large">
        Personal Information:
    </p>

    <p class="text">
        User: <?php echo $u ?> <br> <br>
        Password: <?php echo $p ?> <br> <br>
    </p>


     <br> <br> <hr> <br> <br>

    <p class="subtitle" style="font-size:xx-large">
        Collection List:
    </p>

    <br>

    <?php
    for($i = 0; $i < $num; $i++) {
        //拼接字符串html标签里会出错，在外面拼好
        $pic = 'img/'.$pics[$i];
        $delete = 'Delete.php?name='.$id[$i];
        $link = "Displaypage.php?name=".$name[$i]."&artist=".$artist[$i]."&year=".$year[$i]."&id=".$id[$i]
            ."&genre=".$genre[$i]."&height=".$height[$i]."&width=".$width[$i]."&price=".$price[$i]."&view=".$view[$i]."&pic=".$pics[$i];

        //echo双引号内的标签，双引号要变成用单引号
        //虽然在html标签里，但外面套了php，php变量直接调用即可

        if(isset($_SESSION['user'])) {
            echo "<table class='table1' id='myTable'>
        <tr>
            <td>
                <img  src=$pic heigh='630' width=400>
            </td>
            <td style='text-align: left'>
                <div class='text' class>
                    
                    Title: $name[$i]  <br> <br>
                    Artist: $artist[$i] <br> <br>
                    Release time: $date[$i] <br> <br>
                </div>
                <br> <br> <br>
                
                <a href= '$link'>
                    <input type='button' class='button2' value='查看详情' id='b11'>
                </a>
                <br> <br>
                <form method='post'>
                <a href='$delete'>
                    <input type='button' id='$pic' name='delete' class='button1' value='删除' onclick='deleteLine(this)'>
                </a>
                </form>
            </td>
        </tr>
        </table>
        ";
        }
        else {
            echo "<p> 未登陆，无法查看收藏！ </p>";
        }
    }


//            $sql = "DELETE FROM carts
//        WHERE artworkID=$idDelete";


    ?>

<!--    <table class="table1" id="myTable">-->
<!--        <tr>-->
<!--            <td>-->
<!--                <img  src="44.jpg" heigh="630" width=400>-->
<!--            </td>-->
<!--            <td style="text-align: left">-->
<!--                <div class="text" class>-->
<!--                    Dimensions: 48cm * 63cm  <br> <br>-->
<!--                    Medium: Oil on Canvas <br> <br>-->
<!--                    School: Impression <br> <br>-->
<!--                    Location: the Musée Marmottan Monet in Paris <br> <br>-->
<!--                </div>-->
<!--                <br> <br>-->
<!--                <div class="subtitle" style="font-size:x-large"> Heat: 99999999 <br> </div>-->
<!--                <hr>-->
<!--                <div class="subtitle" style="font-size:x-large"> Price: 100000000000 USD </div> <br> <br>-->
<!---->
<!--                <br>-->
<!--                <a href="Displaypage.php">-->
<!--                    <input type="button" class="button2" value="查看详情" id="b11">-->
<!--                </a>-->
<!--                <br> <br>-->
<!--                <input type="button" class="button1" value="删除" onclick="deleteLine(this)" id="b12">-->
<!--            </td>-->
<!--        </tr>-->
<!---->
<!--        <tr>-->
<!--            <td>-->
<!--                <img  src="60.jpg" heigh="630" width=400>-->
<!--            </td>-->
<!--            <td style="text-align: left">-->
<!--                <div class="text" class>-->
<!--                    Dimensions: 92.1 cm * 73 cm  <br> <br>-->
<!--                    Medium: Oil on Canvas <br> <br>-->
<!--                    School: Post-Impressionism <br> <br>-->
<!--                    Location: National Gallery, Londont <br> <br>-->
<!--                </div>-->
<!--                <br> <br>-->
<!--                <div class="subtitle" style="font-size:x-large"> Heat: 99999999000000 <br> </div>-->
<!--                <hr>-->
<!--                <div class="subtitle" style="font-size:x-large"> Price: 100000000000123 USD </div> <br> <br>-->
<!---->
<!--                <br>-->
<!--                <a href="Displaypage.php">-->
<!--                    <input type="button" class="button2" value="查看详情">-->
<!--                </a>-->
<!--                <br> <br>-->
<!--                <input type="button" class="button1" value="删除" onclick="deleteLine(this)">-->
<!---->
<!--            </td>-->
<!--        </tr>-->
<!---->
<!--        <tr>-->
<!--            <td>-->
<!--                <img  src="66.jpg" heigh="630" width=400>-->
<!--            </td>-->
<!--            <td style="text-align: left">-->
<!--                <div class="text" class>-->
<!--                    Dimensions: 207.6 cm * 308 cm  <br> <br>-->
<!--                    Medium: Oil on Canvas <br> <br>-->
<!--                    School: Post-Impressionism <br> <br>-->
<!--                    Location: Art Instituate of Chicago <br> <br>-->
<!--                </div>-->
<!--                <br> <br>-->
<!--                <div class="subtitle" style="font-size:x-large"> Heat: 0 <br> </div>-->
<!--                <hr>-->
<!--                <div class="subtitle" style="font-size:x-large"> Price: 5 USD </div> <br> <br>-->
<!---->
<!--                <br>-->
<!--                <a href="Displaypage.php">-->
<!--                    <input type="button" class="button2" value="查看详情">-->
<!--                </a>-->
<!--                <br> <br>-->
<!--                <input type="button" class="button1" value="删除" onclick="deleteLine(this)">-->
<!---->
<!--            </td>-->
<!--        </tr>-->
<!--    </table>-->


</body>
</html>