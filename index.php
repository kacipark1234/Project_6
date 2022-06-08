<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title>相簿主頁</title>
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
            function Delete(album_id){
                if(confirm("確定刪除?")){
                    location.href="deleteAlbum.php?album_id=" + album_id;
                }
            }
        </script>
    </head>
    <body>
        
        <?php
            
            session_start();
            if(isset($_SESSION["login_user"])){
                $login_user = $_SESSION["login_user"];
                $login_name = $_SESSION["login_name"];
            }
            require_once("dbtools.inc.php");
            $link = create_connection();
            $sql = "SELECT * FROM album ORDER BY id";
            $result = execute_sql($link,"Portfolio_6",$sql);
            $total_album = mysqli_num_rows($result);
            
            echo "<div class='max_table' algin='center'><h1 align='center' >$total_album 個相簿</h1></div><hr>";
            echo "<table align='center' >";
          
            
            $album_per_row = 5;    
            $i = 1; 
            while($row = mysqli_fetch_assoc($result)){
                
                $album_id = $row["id"];
                $album_name = $row["name"];
                $album_owner = $row["owner"];
                
                $sql = "SELECT filename FROM photo WHERE album_id = $album_id";
                $photo_result = execute_sql($link,"Portfolio_6",$sql);
                $total_photo = mysqli_num_rows($photo_result);
                if($total_photo>0){
                    $cover_photo = mysqli_fetch_object($photo_result)->filename;
                }
                else{
                    $cover_photo = "None.png";     
                }   
                //echo $cover_photo;
                mysqli_free_result($photo_result);    
                if($i % $album_per_row == 1){
                    echo "<tr align='center' valign='top' >";
                }
                echo "<td width='160px' class='td_text' >擁有者:$album_owner<br>";
                echo "<a href='showAlbum.php?album_id=$album_id' >";
                echo "<img src='Photo\\$cover_photo' width='200px' ><br>";
                echo "$album_name</a><br>$total_photo Pectures";
                //echo $login_user." = ".$album_owner;
                if(isset($login_user) && $album_owner == $login_user){
                    echo "<br><a href='edit.php?album_id=$album_id' class='btn btn-primary'>編輯</a>";
                    echo "<a href='#' onclick='Delete($album_id)' class='btn btn-danger'>刪除</a><br>";
                    
                }
                else{
                    echo "<p>無法編輯</p>";
                }
                echo "<br></td><td><div  style='width:30px' ></div></td>";
                
                if($i % $album_per_row == 0 || $i == $total_album){
                    echo "</tr><td><hr style='opacity:0;'></td>";
                }
                $i++;
                
                
                
                
            } 
                 
            echo "</table><hr>";
            
            mysqli_free_result($result);
            mysqli_close($link);
            
            echo "</hr><p align='center'>";
            if(!isset($login_name)){
                echo "<a href='login.php' class='btn btn-success'>登入</a>";
            }
            else{
                echo "<a href='AddAlbum.php' class='btn btn-primary' >新增相簿</a>";
                echo "<a href='logout.php' class='btn btn-danger' >登出</a>";
                
            }
            
        ?>
        <br><br><br>
    </body>
    
</html>