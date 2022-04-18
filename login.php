<?php
session_start();

require_once 'functions.php';

// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if( $key === hash('sha256', $row['username']) ) {
        $_SESSION['login'] = true;
    }
}


if( isset($_COOKIE['login']) ) {
    if( $_COOKIE['login'] == 'true'){
        $_SESSION['login'] = true;
    }
}


if( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}



if( isset($_POST["login"]) ) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' ");
    // cek username
    if( mysqli_num_rows($result) === 1 ){

        // cek password
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password, $row["password"]) ) {
            header('Location:index.php');
              // set session
            $_SESSION["login"] = true;
            $_SESSION["username"] = $username;

            // cek remember me
            if( isset($_POST["remember"]) ) {
                // buat cookie
                setcookie('id', $row['id'], time()+20000);
                setcookie('key', hash('sha256', $row['username']), time()+20000);
            }
        }
    

    }

    $error = true;


}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- <link rel="icon" type="image/x-icon" href="assets/img/favicon-32x32.png"> -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon-32x32.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="assets/scss/theme.css" rel="stylesheet">
</head>
<body class="general login">
       <!-- Header Section -->
    
    <div class="container-fluid d-flex justify-content-center p-0" id="container-fluid">
        <div class="card text-center bg-transparent border-0">
            <form action="" method="post" id="form-login" class="bg-white">
                
                <img src="assets/img/logo.png" alt="Brian D">

                <?php if( isset($error) ) :?>
                    <div class="alert alert-warning text-danger">Username atau password salah</div>
                <?php endif; ?>

                        <div class="username">
                            <label for="username" class="visually-hidden">
                                Username
                            </label>
                            <span class="iconify" data-icon="carbon:user-avatar-filled" style="color: #877dd4;" data-width="25" data-height="25"></span> 
                            <input type="text" name="username" id="username" class="rounded-0" placeholder="Username" autofocus autocomplete="off" required>

                       </div>

                        <div class="password mt-4 mb-2">
                            <label for="password" class="visually-hidden">Password :</label>
                            <span class="iconify" data-icon="fa6-solid:lock" style="color: #877dd4;" data-width="20" data-height="20"></span>
                            <input type="password" name="password" id="password" class="rounded-0" placeholder="Password">
                        </div>

                        <div class="checkbox">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember" class="">Remember me</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="login" class="btn">Login</button>
                        </div>

                    <!-- <p class="mt-5 ">Untuk informasi lebih lanjut, hubungi kami </p>
                    <a href="https://id-id.facebook.com/RQAlBashiroh" target="_blank" class="col btn btn-outline-primary mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                        </svg> Facebook
                    </a>
                    <a href="https://www.youtube.com/channel/UClaMyRJAtIuxCyY2xhiMnaQ" target="_blank" class="col mt-2 btn btn-outline-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                        <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                        </svg> Youtube
                    </a>
                    <a href="https://www.google.com" target="_blank" class="col btn btn-outline-success mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                        </svg> Whatsapp
                    </a> -->

                    <p class="pb-2">&copy; 2022 by Brian Dratolla<p>

            </form>
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>