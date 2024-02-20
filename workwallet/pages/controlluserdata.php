<?php
    $fieldError = "";
    $usernameError = "";
    $emailError = "";
    $passwordError = "";
    $confirmError = "";
    $sucess = "";

    if (isset($_POST["register"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmpassword = $_POST["confirmpassword"];

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        require_once "connection.php";
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);

        if (empty($username) || empty($email) || empty($password) || empty($confirmpassword)) {
            $fieldError = "All field are required.";
        } elseif ($rowCount > 0) {
            $emailError = "Email already exits!";
        } else {
            if (strlen($password) < 8) {
                $passwordError = "Password must be at least 8 characters long.";
            }
            if ($password !== $confirmpassword) {
                $confirmError = "Password does not match.";
            }
            if (strlen($password) < 8 || $password !== $confirmpassword) {
            } else {
                //we will insert the data into database
                $sql = "INSERT INTO users (username, email, password) VALUES(?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    $sucess = "You are registered successfully";
                    header("refresh:1,url=login.php");
                } else {
                    die("Something went wrong");
                }
            }
        }
    }

    //--Login Form validation
     if (isset($_POST["login"])) {
         $email = $_POST["email"];
         $password = $_POST["password"];
         require_once "connection.php";
         $sql = "SELECT * FROM users WHERE email = '$email'";
         $result = mysqli_query($conn, $sql);
         $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
 
         if ($user) {
             if (password_verify($password, $user["password"])) {
                 session_start();
                 $_SESSION["users"] = $user;
                
 
                 if(isset($_POST['remember_me'])){           // add cookie for remember me
                     setcookie('email_username',$_POST['email'],time()+ (30*24*60*60));
                     setcookie('password',$_POST['password'],time()+ (30*24*60*60));
                 }
                 else{                   //clear cookie
                     setcookie('email_username','',time() - (30*24*60*60));
                     setcookie('password','',time() - (30*24*60*60));
                 }
                 header("Location: main.php"); //redirect
                 die();
             } else {
                 $passwordError = "Password does not match.";
             }
         } elseif (empty($email)) {
             $fieldError = "All field are required.";
         } else {
             $emailError = "Email does not match.";
         }
     }
     
?> 