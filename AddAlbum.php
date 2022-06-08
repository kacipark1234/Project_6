<?php
    session_start();
    if(isset($_POST["album_name"])){
        require_once("dbtools.inc.php");
        $album_name = $_POST["album_name"];
        $login_user = $_SESSION["login_user"];
        $link = create_connection();
        $sql="SELECT ifnull(max(id),0)+1 AS ID FROM album";
        $result = execute_sql($link,"Portfolio_6",$sql);
        $album_id = mysqli_fetch_object($result)->ID;
        //echo $album_id;
        $sql="INSERT INTO album(id,name,owner) VALUES($album_id,'$album_name','$login_user');";
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
        <title></title>
        
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
  
        <form method="post" action="AddAlbum.php" name="myForm">
            <div class="max_table"><h1>創建相簿區</h1></div><br><br>
            
            
            <table align="center" class="centerblock" >
                <td align="center">
                    <div class="input-group">
                        <input name="album_name" class="form-control" type="text"  maxlenght="30" size="30" placeholder="請輸入相簿名稱" ><br>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-success" value="新增" >
                    <a href="index.php"  class="btn btn-primary" value="回首頁" >回首頁</a>
                </td>
            </table>
            
        </form>
    </body>
    
</html>