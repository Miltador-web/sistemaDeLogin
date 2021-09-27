<?php
include "login_system.php";
if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }
    $uname = validate($_POST['uname']);
    $password = validate($_POST['password']);
    if(empty($uname)) {
        header("Location: index.php?error=User Name is required");
        exit();
    }elseif(empty($password)){
        header("Location: index.php?error=Password is required");
        exit();
    }else{
        $sql = "SELECT * FROM users WHERE user ='$uname' AND passwor= '$password'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) ===1) {
            $row = mysqli_fetch_assoc($result);
            if($row['user'] === $uname && $row['passwor'] === $password) {
                header("Location: rotate.php");
                
            }else{
                header("Location: index.php?error=Invalid User or Password");
                exit();
            }
        
        }else{
            header("Location: index.php?error=Invalid User or Password");
            exit();
        }
    }
}else{
    header("Location: index.php");
    exit();
}