<?php
    session_start();
    /*echo "<br>_POST['album_id']: ".$_POST["album_id"];
    echo "<br>_POST['album_name']: ".$_POST["album_name"];
    echo "<br>_GET['album_id']: ".$_GET["album_id"];
    echo "<br>_GET['album_name']: ".$_GET["album_name"];
    echo "<br>_SESSION['login_user']: ".$_SESSION["login_user"];
    echo "<br>_SESSION['login_name']: ".$_SESSION["login_name"];*/
    require_once("dbtools.inc.php");
    $login_user = $_SESSION["login_user"];
    $album_id = $_GET["album_id"];
    $link = create_connection();
    $sql = "SELECT * FROM album ORDER BY name";
    execute_sql($link,"Portfolio_6",$sql);
    /*
    $sql = "DELETE FROM photo WHERE album_id = $album_id";
    execute_sql($link,"Portfolio_6",$sql);
    
    $sql = "DELETE FROM album WHERE id = $album_id AND owner = '$login_user'";
    execute_sql($link,"Portfolio_6",$sql);
    mysqli_free_result($result);
    mysqli_close($link);*/
    $sql = "SELECT filename FROM photo WHERE album_id = $album_id AND EXISTS(SELECT * FROM album WHERE id = $album_id AND owner = '$login_user' )";
    $result = execute_sql($link,"Portfolio_6",$sql);
    while($row = mysqli_fetch_assoc($result)){
        $file_name = $row["filename"];
        $photo_path = realpath("Photo//$file_name");
        if(file_exists($photo_path)){
            unlink($photo_path);
        }
        
    }
    
    $sql = "DELETE FROM photo WHERE album_id = $album_id";
    execute_sql($link,"Portfolio_6",$sql);
    $sql = "DELETE FROM album WHERE id = $album_id AND owner = '$login_user' ";
    execute_sql($link,"Portfolio_6",$sql);
    mysqli_free_result($result);
    mysqli_close($link);
    header("location:index.php");
    
    
?>