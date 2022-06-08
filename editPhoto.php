<?php



 session_start();
            
require_once("dbtools.inc.php");
session_start();
$login_user = $_SESSION["login_user"];
$link = create_connection();

if(!isset($_POST["photo_name"])){

    $photo_id = $_GET["photo_id"];
    $sql = "SELECT a.name , a.filename , a.comment , a.album_id , b.name AS album_name , b.owner FROM photo AS a , album AS b WHERE a.id = $photo_id AND b.id = a.album_id;";
    $result = execute_sql($link,"Portfolio_6",$sql);
    $row = mysqli_fetch_object($result);    
    $album_id = $row->album_id;
    $album_name = $row->album_name;
    $photo_filename = $row->filename;
    $photo_comment = $row->comment;
    $album_owner = $row->owner;
    $photo_name = $row->name;
    
    mysqli_free_result($result);
    mysqli_close($link);
    //echo $login_user."=".$album_owner;
    if($album_owner != $login_user){
        echo "<script type='text/javascript'>
                alert('此相簿不是你的無法更改');</script>";
    }
}
else{
    $album_id = $_POST["album_id"];
    $photo_id = $_POST["photo_id"];
    $photo_name = $_POST["photo_name"];
    $photo_comment = $_POST["photo_comment"];
    //echo $photo_comment."11111111";
    
    $sql = "UPDATE photo SET name='$photo_name',comment = '$photo_comment' WHERE id = $photo_id ";
    execute_sql($link,"Portfolio_6",$sql);
    mysqli_close($link);
    echo "/////////////<br>";
    echo "album_id:".$album_id."<br>";
    echo "photo_id:".$photo_id."<br>";
    echo "photo_name:".$photo_name."<br>";
    echo "photo_comment:".$photo_comment."<br>";
    header("location:showAlbum.php?album_id=$album_id");
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
  
        <form method="post" action="editPhoto.php" name="myForm">
            <div class="max_table"><h1>相片修改區</h1></div><br><br>
            
            <div width="500px" class="panel panel-info mid_div">
                <div class="panel-heading">
                    <h3 class="panel-title">相片修改</h3>
                </div>
                <div class="panel-body">
                    
                    相片名稱<br><input type="text" name="photo_name" size="30" value="<?php echo $photo_name ?>"><br><br>
                    
                    相片內容<br><textarea name="photo_comment" row="5" cols="50" ><?php echo $photo_comment ?></textarea>
                    <input type="hidden" name="photo_id"  value="<?php echo $photo_id ?>" >
                    <input type="hidden" name="album_id"  value="<?php echo $album_id ?>" ><br>
                    
                    <input type="submit"  value="更新" class='btn btn-primary' >
                    <a class='btn btn-primary' href="showAlbum.php?album_id=<?php echo $album_id ?>" >
                        回<?php echo $album_name ?>相簿</a>
                    
                </div>
            </div>
        </form>
    </body>
</html>
