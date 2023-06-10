<?php
session_start();
$empty= false;
$login = true;

if(isset($_SESSION['loggedIn'])){
    header(("location: ./index.php"));
}
if($_SERVER["REQUEST_METHOD"]== "POST"){
    include("partials/db.php");
    $username= $_POST['username'];
    $password= $_POST['password'];
    $userCheck = "SELECT * from users WHERE $username='$username'";
    $resultofUserCheck = mysqli_query($conn, $userCheck);
    $numofUser = mysqli_num_rows($resultofUserCheck);
    if($username ==""||$password= ""){
        $empty= true;
    } else if($numofUser==1){
        while($row = mysqli_fetch_array($resultofUserCheck)){
        if(password_verify($password, $row['password'])){
            $login=true;
            $_SESSION['loggedIn']=true;
            $_SESSION['id']=$row["id"];
            $_SESSION['username']=$row["username"];
            $_SESSION['useremail']=$row["useremail"];

            
        }else{
            $login = false;
        }
    }

}else{
    $login = false;
}
}
?>

if(isset($_POST['submit'])){
   
    $sql = "SELECT * FROM users WHERE username='$username' and password='$passwordHash'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if($count==1){
        header("Location: login_success.php");
    }else{
        echo '<script>
        window.location.href = "loginForm.php";
        alert("Login failed!")
        </script>';
    }
}   
?>