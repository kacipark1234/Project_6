<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title>相簿內畫面</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
        
        <style type="text/css">
            html{
                 height: 100%;
            }
            body{
                background-image: url(images/indexbg.jpg);
                background-repeat: no-repeat;
                background-size: cover;
                background-attachment: fixed;
                height: 100%;
            }
            .centerblock {
                float: none;
                display: block;
                margin-left: auto;
                margin-right: auto;
                margin-top: 20%;
                text-align: center;
                max-width: 340px;
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
            img{
                margin: 20px;
                margin-bottom: 5px;
            }
            .td_text{
                background-color: beige;
            }
        </style>
        <script>
            function Delete(album_id,photo_id){
                if(confirm("確定刪除照片?")){
                    location.href="deletePhoto.php?album_id=" + album_id + "&photo_id=" + photo_id;
                }
            }
        </script>
    </head>
    <body>
        <?php
            session_start();
            $album_id = $_GET["album_id"];
            $login_user = $_SESSION["login_user"];    
          
            require_once("dbtools.inc.php");
            $link = create_connection();
            $sql = "SELECT * FROM album WHERE id = $album_id";
            $result = execute_sql($link,"Portfolio_6",$sql);
            $row = mysqli_fetch_object($result);
            $album_name = $row->name;
            $album_owner = $row->owner;
            echo "<div class='max_table' algin='center'><h1 align='center' >相簿名稱:$album_name<br>擁有者:$album_owner </h1></div><hr>";
            $sql = "SELECT * FROM photo WHERE album_id = $album_id";
            $result = execute_sql($link,"Portfolio_6",$sql);
            $total_photo = mysqli_num_rows($result); 
            echo "<table border='0' align='center'>";
            $photo_page = 5;
            $i=1;
            while($row = mysqli_fetch_assoc($result)){
                $photo_id = $row["id"];
                $photo_name = $row["name"];
                $photo_filename = $row["filename"];
                if($i % $photo_page == 1){
                    echo "<tr align='center' class='td_text'>";
                }
                echo "<td width='160px' >";
                echo "<a href='photoDetail.php?album_id=$album_id&photo_id=$photo_id'>";
                echo "<img src='Photo\\$photo_filename' width='200px' ><br>";
                echo "$photo_name</a>";
                
                if($album_owner == $login_user){
                    echo "<br><a class='btn btn-primary' href='editPhoto.php?album_id=$album_id&photo_id=$photo_id'>編輯</a>";
                    echo "<a href='#' class='btn btn-danger' onclick='Delete($album_id,$photo_id)' >刪除</a><br>";
                    
                }
                echo "<br></td>";
                if($i % $photo_page == 0 || $i == $total_photo){
                    echo "</tr><td></td>";
                }
                $i++;
            }
            echo "</table>";
            mysqli_free_result($result);
            mysqli_close($link);
            
            echo "<br>><p align='center'>";
            if($album_owner == $login_user){
                echo "<a href='uploadPhoto.php?album_id=$album_id' class='btn btn-primary' >上傳相片</a>";
            }
        ?>
        <a href="index.php" class='btn btn-primary'>回首頁</a>
        <br><br><br>
    </body>
    
</html>

