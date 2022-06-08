<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title>相簿內容</title>
        
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
            .C{
                width:100%;
                text-align: center;
                display: flex;
                justify-content: center;
                align-items: center;
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
                float: none;
                display: block;
                margin-left: auto;
                margin-right: auto;
                text-align: left;
                height: auto;
                max-width: 600px;
                
            }
        </style>
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        
        
        <?php
            session_start();
            
            require_once("dbtools.inc.php");
            $link = create_connection();
            $album_id = $_GET["album_id"];
            $photo_id = $_GET["photo_id"];
            $sql = "SELECT * FROM album WHERE id = $album_id";
            $result = execute_sql($link,"Portfolio_6",$sql);
            $row = mysqli_fetch_object($result);
            
            $album_name = $row->name;
            $album_owner = $row->owner;
            echo "<div class='max_table' algin='center'><h1 align='center' >相簿名稱: $album_name<br>作者:$album_owner</h1></div><hr>";
            
            $sql = "SELECT * FROM photo WHERE id = $photo_id";
            $result = execute_sql($link,"Portfolio_6",$sql);
            $row = mysqli_fetch_object($result);
            $photo_filename = $row->filename;
            $photo_comment = $row->comment;
            $photo_name = $row->name;
            echo "<div class='C'><h1>$photo_name</h1></div>";
            echo "<p align='center' ><img width='600px' src='Photo\\$photo_filename'></p>";
            echo "<div class='td_text' ><h3 ><br>$photo_comment</h3></div>";
            
            $sql = "SELECT id ,album_id, filename FROM photo WHERE album_id = (SELECT id FROM album WHERE id = $album_id)";
            $result = execute_sql($link,"Portfolio_6",$sql);
            echo "<hr><p align='center'>";
            
            while($row = mysqli_fetch_assoc($result)){
                //echo $row["id"];
                if($row["id"] == $photo_id){
                    
                    echo "<img  width='100px' src='Photo\\".$row["filename"]."' style='border-style:solid;border-color:Red;border-width:10px' >";
                    
                }
                else{
                    echo "<a href='photoDetail.php?album_id=$album_id&photo_id=".$row["id"]."' >";
                    
                    echo "<img width='100px' src='Photo\\".$row["filename"]."' style='border-style:solid;border-color:Black;border-width:2px' ></a>";

                    
                }
                
            }
            //echo "111111111";
            mysqli_free_result($result);
            mysqli_close($link);
            
            
        ?>
        <hr>
        <p align="center" >
            <a class='btn btn-primary' href="index.php">回首頁</a>
            <a class='btn btn-primary' href="showAlbum.php?album_id=<?php echo $album_id ?>" >
                        回<?php echo $album_name ?>相簿</a>
        </p>
        <br><br><br>
        
    </body>
    
</html>