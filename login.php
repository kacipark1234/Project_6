<?php
    if(isset($_POST["account"])){
        $login_account = $_POST["account"];
        $login_password = $_POST["password"];
        
        require_once("dbtools.inc.php");
        $link = create_connection();
        $sql = "SELECT * FROM users WHERE account = '$login_account' AND password = '$login_password'";
        $result = execute_sql($link,"Portfolio_6",$sql);
        if(mysqli_num_rows($result)==0){
            mysqli_free_result($result);
            mysqli_close($link);
            echo "<script type='text/javascript'>
                alert('帳號密碼錯誤，或資料不完全');</script>";
        }
        else{
            session_start();
            $row = mysqli_fetch_object($result);
            $_SESSION["login_user"] = $row->account;
            $_SESSION["login_name"] = $row->name;
            mysqli_free_result($result);
            mysqli_close($link);
            header("location:index.php");
        }
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title>登入系統</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
        
        <style type="text/css">
            html{
                 height: 100%;
            }
            body{
                background-image: url(images/loginbg.jpg);
                background-repeat: no-repeat;
                background-size: 100% 100%;
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
        </style>
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  
        <form method="post" action="login.php" name="myForm">
            
            
            <table align="center" class="centerblock" >
                <td align="center">
                    <div class="input-group">
                        <span class="input-group-addon " >
                            <i class="glyphicon glyphicon-user" ></i>
                        </span>
                        <input name="account" class="form-control" type="text"  maxlenght="30" size="30" placeholder="請輸入帳號" ><br>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon" >
                            <i class="glyphicon glyphicon-lock" ></i>
                        </span>
                        <input name="password" class="form-control" type="text"  maxlenght="30" size="30" placeholder="請輸入密碼" ><br>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-success" value="立即登入" >
                    <input type="reset"  class="btn btn-primary" value="重新輸入" >
                    <a href='addUser.php' class="btn btn-primary">註冊</a>
                </td>
            </table>
            
        </form>
    </body>
    
</html>


