<?php
    require_once("dbtools.inc.php");
    
    session_start();
    $login_user = $_SESSION["login_user"];
    $link = create_connection();
    
    
    if(!isset($_POST["album_id"])){
        $album_id = $_GET["album_id"];
        $sql = "SELECT * FROM album WHERE id = $album_id ";
        $result = execute_sql($link,"Portfolio_6",$sql);
        $row = mysqli_fetch_assoc($result);
        $album_name = $row["name"];
        //$album_id = $row["id"];
        $album_owner = $row["owner"];
        mysqli_free_result($result);
        mysqli_close($link);
        //echo "%".$album_owner."%".$login_user;
        if($album_owner != $login_user){
            echo "<script type='text/javascript'>
                alert('此相簿不是你的無法更改');</script>";
            
        }
        
    }
    else{
        $album_id = $_POST["album_id"];
        $album_name = $_POST["album_name"];
        $sql = "UPDATE album SET name = '$album_name' WHERE id = $album_id ";
        execute_sql($link,"Portfolio_6",$sql);
        mysqli_close($link);
        header("location:index.php");
    }


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title>電子相簿</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
        
        <style type="text/css">
            html{
                 height: 100%;
            }
            body{
                background-image: url(images/loginbg.jpg);
                background-repeat: no-repeat;
                background-size: cover;
                background-attachment: fixed;
                height: 100%;
            }
            .mid_div {
                float: none;
                display: block;
                margin-left: auto;
                margin-right: auto;
                text-align: left;
                max-width: 500px;
            }
            .max_table{
                background-color:azure;
                opacity: 0.5;
                height: 200px;
                width: 100%;
                text-align: center;
                display: flex;
                justify-content: center;
                align-items: center; 
            }
            .td_text{
                background-color: beige;
            }
        </style>
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  
        <form method="post" action="edit.php" name="myForm">
            <div class="max_table"><h1>相片修改區</h1></div><br><br>
            
            <div width="500px" class="panel panel-info mid_div">
                <div class="panel-heading">
                    <h3 class="panel-title">相簿修改</h3>
                </div>
                <div class="panel-body">
                    <input type="text" name="album_name" size="30" value="<?php echo $album_name ?>">
                    <input type="hidden" name="album_id"  value="<?php echo $album_id ?>" >
                    <input class='btn btn-success' type="submit"  value="更新"  ><br>
                    <a class='btn btn-primary' href="showAlbum.php?album_id=<?php echo $album_id ?>" >
                        回<?php echo $album_name ?>相簿</a>
                    
                </div>
            </div>
            
        </form>
    </body>
</html>
