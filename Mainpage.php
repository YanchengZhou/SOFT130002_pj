<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Mainpage.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">


</head>
<body>

<?php
require_once "connect.php";

?>

<?php
$sql1 = "SELECT * FROM artworks order by view desc limit 3";
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

$result = $mysqli->query($sql1);
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

    }
} else {
    echo "0 结果";
}

//push another three times: index from 4 to 6

$sql2 = "SELECT * FROM artworks order by timeReleased desc limit 3";
$result2 = $mysqli->query($sql2);
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
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

    }
} else {
    echo "0 结果";
}


$mysqli->close();

?>




        <span style="height:50px">
            <span style=font-size:xx-large;font-family:DelaGothicOne;color:royalblue> <b>Art Store &nbsp &nbsp &nbsp</b> </span>
            <span style="font-size:large;padding-top:20px;font-family: monospace"> Where you find GENIUS and EXTROORDINARY </span>
            <span style="float:right;font-size:18px;font-family: 'Heiti SC';padding-top:24px">
                &nbsp <a href="Mainpage.php">首页</a>  &nbsp  <a href="Search.php"> 搜索 </a>
             &nbsp <a href="Loginpage.php">登陆</a> <a href="Signuppage.php"> &nbsp 注册</a> </span>
        </span>

<!--        <hr>-->
<!--    <br> <br> <br>-->
<!--        <div class="div1">-->
<!--            <a href="Displaypage.php" class="img1">-->
<!--            <img src=$pics[1] class="img1">-->
<!--            </a>-->
<!--        </div>-->
<!---->
    <br> <br> <br>

    <h2 style="text-align: center; font-family: DelaGothicOne; color:indianred"> Top  viewed  artworks </h2> <br> <br>

    <div class="container" style="margin-top:30px;width:50%">

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>



            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
<!--                    if multiple variable: link?varname1=var1&varname2=var2  -->
                    <a href="<?php echo "Displaypage.php?name=".$name[0]."&artist=".$artist[0]."&year=".$year[0]."&id=".$id[0]
                    ."&genre=".$genre[0]."&height=".$height[0]."&width=".$width[0]."&price=".$price[0]."&view=".$view[0]."&pic=".$pics[0]; ?>">
                        <img src="<?php echo "img/" . $pics[0];?>" width="100%">
                    </a>
                    <div class="carousel-caption">
                        <h3> <?php echo $name[0]; ?> </h3>
                        <p> <?php echo $artist[0]; ?> </p>
                    </div>
                </div>
                <div class="item">
                    <a href="<?php echo "Displaypage.php?name=".$name[1]."&artist=".$artist[1]."&year=".$year[1]."&id=".$id[1]
                        ."&genre=".$genre[1]."&height=".$height[1]."&width=".$width[1]."&price=".$price[1]."&view=".$view[1]."&pic=".$pics[1]; ?>">
                        <img src="<?php echo "img/" . $pics[1]; ?>" width="100%">
                    </a>
                    <div class="carousel-caption">
                        <h3> <?php echo $name[1]; ?> </h3>
                        <p> <?php echo $artist[1] ?> </p>
                    </div>
                </div>
                <div class="item">
                    <a href="<?php echo "Displaypage.php?name=".$name[2]."&artist=".$artist[2]."&year=".$year[2]."&id=".$id[2]
                        ."&genre=".$genre[2]."&height=".$height[2]."&width=".$width[2]."&price=".$price[2]."&view=".$view[2]."&pic=".$pics[2]; ?>">
                        <img src="<?php echo "img/" . $pics[2]; ?>" width="100%">
                    </a>
                    <div class="carousel-caption">
                        <h3> <?php echo $name[2]; ?> </h3>
                        <p> <?php echo $artist[2]; ?> </p>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(function() {
            $('.carousel').carousel({
                interval: 3000
            });
        });
    </script>

    <br> <br> <br> <br> <br> <br>

<h2 style="text-align: center; font-family: DelaGothicOne; color:indianred"> Latest artworks </h2>

<br> <br> <br>


<table id="table">
        <tr>
            <td><img src="<?php echo "img/".$pics[3]; ?>" height="250" width = 250></td>
            <td><img src="<?php echo "img/".$pics[4]; ?>" height="250" width = 250></td>
            <td><img src="<?php echo "img/".$pics[5]; ?>" height="250" width = 250></td>
        </tr>
        <tr>
            <td> <br> <br> <br> <p1 style="padding-top:90px"> <?php echo $name[3]; ?> <br> <br> <?php echo $artist[3]; ?> <br> <br> </p1>
                <p2> <?php echo $description[3]; ?> </p2>
                <p1> <br> <br> <a href="<?php echo "Displaypage.php?name=".$name[3]."&artist=".$artist[3]."&year=".$year[3]."&id=".$id[3]
                        ."&genre=".$genre[3]."&height=".$height[3]."&width=".$width[3]."&price=".$price[3]."&view=".$view[3]."&pic=".$pics[3]; ?>">
                        <b>LEARN MORE</b> </a> </p1> </td>
            <td> <p1 style="padding-bottom:90px"> <?php echo $name[4]; ?> <br> <br> <?php echo $artist[5] ?> <br> <br> </p1>
                <p2> <?php echo $description[5]; ?> </p2>
                <p1> <br> <br> <a href="<?php echo "Displaypage.php?name=".$name[4]."&artist=".$artist[4]."&year=".$year[4]."&id=".$id[4]
                        ."&genre=".$genre[4]."&height=".$height[4]."&width=".$width[4]."&price=".$price[4]."&view=".$view[4]."&pic=".$pics[4]; ?>">
                        <b>LEARN MORE</b> </a> </p1> </td>
            <td> <p1 style="padding-bottom:60px"> <?php echo $name[5]; ?> <br> <br> <?php echo $artist[5]; ?> <br> <br> </p1>
                <p2> <?php echo $description[5]; ?> </p2>
                <p1> <br> <br> <a href="<?php echo "Displaypage.php?name=".$name[5]."&artist=".$artist[5]."&year=".$year[5]."&id=".$id[5]
                        ."&genre=".$genre[5]."&height=".$height[5]."&width=".$width[5]."&price=".$price[5]."&view=".$view[5]."&pic=".$pics[5]; ?>">
                        <b>LEARN MORE</b> </a> </p1></td>
        </tr>
    </table>

        <br>
        <div style="text-align: center">
            <p1 style="font-weight:normal">@ArtStore.Produced and maintained by Yancheng Zhou at 2021.6 All Rights Reserved</p1>
        </div>

    <article>

    </article>

    <footer>

    </footer>

</body>
</html>