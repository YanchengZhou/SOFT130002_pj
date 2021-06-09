<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="Displaypage.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <?php
    require_once "connect.php";
    ?>

    <?php
    $exist = 0;
    $id = $_GET['id'];

    $sql3 = "SELECT * FROM carts WHERE artworkID='$id'";

    $result3 = $mysqli->query($sql3);
//
//    $sql = "select * from carts";
//    $result4 = $mysqli->query($sql);
//    $num = $result4->num_rows;
//    echo $num;


    if ($result3->num_rows > 0) {
        $exist = 1;
        while($row = $result3->fetch_assoc()) {

        }
    } else {
        $exist = 0;
    }



    //$row = $result->fetch_assoc();

    ?>

    <script type="text/javascript">

        function add()
        {
            let a = <?php echo $exist; ?>;
            // $.ajax({
            //     type: "POST",
            //     url: "Displaypage.php",
            //     data:{
            //         "a": "11"
            //     },
            //     success: function(msg){
            //         alert( "Data Saved: " + msg );
            //     }
            // });

             if(a == 0) {
                 alert("添加成功！");
                // userID每次不同才能insert，auto increment进入数据库取消再加上后可以从1开始重新刷新

             }
             else
                alert("已收藏该艺术品");
        }

    </script>

</head>
<body>
<?php
    $pic = $_GET['pic'];
    $name = $_GET['name'];
    $artist = $_GET['artist'];
    $height = $_GET['height'];
    $width = $_GET['width'];
    $genre = $_GET['genre'];
    $price = $_GET['price'];
    $view = $_GET['view'];
    $year = $_GET['year'];

    mysqli_query($mysqli, "UPDATE artworks SET view = view + 1 WHERE imageFileName='$pic'");

    if (isset($_POST['submit']) and $exist == 0){
        mysqli_query($mysqli, "INSERT INTO carts (userID, artworkID)
                      VALUES (1, $id)");
    }


//push: 0-filename, 1-title, 2-artist, 3-description, 4-genre
//5-width, 6-height, 7-price, 8-view
?>

    <div>
        <span class="title"> Art Store </span> &nbsp &nbsp
        <span class="ch"><a href="Loginpage.php">登陆</a> or
            <a href="Signuppage.php">注册</a> </span>
        <span style="float:right;padding-top:15px; padding-right:15px" class="ch" > 未登陆 </span>
    </div>
    <br>
    <br>
    <hr>
    <p class="subtitle"> <?php echo $name; ?> </p>
    <p style="font-family:monospace; color:gray;font-size: x-large"> <a href="Search.php"> Artist: <?php echo $artist; ?>  </a> </p>
    <hr>
    <br>
    <table>
        <tr>
            <td> <img src="<?php echo "img/" . $pic; ?>" height=480 width = 630 class="image"> </td>
            <td>
                <div class="text">
                    Dimensions: <?php echo $width; ?>cm * <?php echo $height; ?>cm  <br> <br>
                    Year of work: <?php echo $year; ?> <br> <br>
                    Genre: <?php echo $genre; ?> <br> <br>

                </div>
                <br> <br>
                <div class="subtitle" style="font-size:x-large"> Heat: <?php echo $view; ?> <br> </div>
                <hr>
                <div class="subtitle" style="font-size:x-large"> Price: <?php echo $price; ?>m USD </div> <br> <br>
                <form method = post>
                <input type="submit" name = "submit" class="button1" onclick= "add()" value="Add to Cart">
                </form> <br> <br>
                <button class="button2" onclick = "add()"> Add to Waitlist </button>

            </td>
        </tr>
    </table>




</body>
</html>
