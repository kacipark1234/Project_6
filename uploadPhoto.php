
<?php
    session_start();
            
    $filename = $_FILES['myfile']['name'];
    $tmpname = $_FILES['myfile']['tmp_name'];
    $filetype = $_FILES['myfile']['type'];
    $filesize = $_FILES['myfile']['size'];  
    require_once("dbtools.inc.php");
    $link = create_connection();
    if(!isset($_POST["album_id"])){
        $album_id = $_GET["album_id"];
        $sql = "SELECT * FROM album WHERE id = $album_id";
        $result = execute_sql($link,"Portfolio_6",$sql);
        $row = mysqli_fetch_object($result);    
        $album_name = $row->name;
        $album_owner = $row->owner;
    }
    else{
        $album_id = $_POST["album_id"];
        $album_owner = $_POST["album_owner"];
        $login_user = $_SESSION["login_user"];
        
        if(isset($login_user) && $album_owner == $login_user && $filename != ""){
            $tmpname = $_FILES['myfile']['tmp_name'];
            $filename = $_FILES['myfile']['name'];
            $src_ext = strtolower(strrchr($_FILES['myfile']['name'],"."));
            $desc_file_name = uniqid().".jpg";
            
            $image_upload_path = "Photo\\".$filename;
            //$S = "C:\Users\mix30678\Desktop\\2_004.png";
            //echo "<br>".$tmpname."  =  ".$image_upload_path;
            $is_uploaded=move_uploaded_file($tmpname,$image_upload_path);
            if($is_uploaded){
                echo '上傳成功';
            }
            else{
                echo '上傳失敗';
            }
            $photoName = $_POST["photoName"];
            $photoComment = $_POST["photoComment"];
            //echo "<br>".$photoName." = ".$photoComment;
            $sql = "INSERT INTO photo(name,comment,filename,album_id) VALUES('$photoName','$photoComment','$filename','$album_id')";
            execute_sql($link,"Portfolio_6",$sql);
            
        }
        mysqli_close($link);
        header("location:showAlbum.php?album_id=$album_id");

        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
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
                max-width: 800px;
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
        <form enctype="multipart/form-data" method="post" action="uploadPhoto.php">
            <div class="max_table"><h1>檔案上傳區</h1></div><br><br>
            
            <div width="800px" class="panel panel-info mid_div">
                <div class="panel-heading">
                    <h3 class="panel-title">檔案上傳</h3>
                </div>
                <div class="panel-body">
                    <input type="file" name="myfile" size="50"><br>
                    請輸入相片名稱 :<input type="text" name="photoName" size="50"><br><br>
                    請輸入相片內容 :<input type="text" name="photoComment" size="50"><br><br>
                    <input type="hidden" name="album_id" value="<?php echo $album_id ?>" >
                    <input type="hidden" name="album_owner" value="<?php echo $album_owner ?>">
            
                    <input type="submit" value="確定上傳" class='btn btn-primary'>
                </div>
            </div>     
            
            
                 
        </form>
    </body>
    
</html>