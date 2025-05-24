<?php 

if (isset($_POST['send'])) {
    $user_name = $_POST['username'];
    $pass = $_POST['password'];
    if( $user_name == 'admin' && $pass == '2025') {
        header('Location: dashboard.php');
        exit();
    } else {
        $message_error [] = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
  @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap');

body {
    background-color: #f4f4f4;
    text-align: center;
}

.head_page {
    background-color: #394f66;
    color: white;
    padding: 20px;
    text-align: center;
    font-size: 22px;
    border-radius: 5px;
    margin-bottom: 20px;
    font-size: x-large;
    font-weight: 900;
}

.login {
    background-color: #ffffff;
    width: 350px;
    padding: 52px;
    margin: 65px auto;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

.login img {
    width: 360px;
}

.information {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.information label {
    font-weight: bold;
    color: #006400;
    display: flex;
}

.information input {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 94%;
}

#send_form {
    background-color: #006400;
    color: white;
    font-weight: bold;
    border: none;
    padding: 10px;
    cursor: pointer;
    transition: 0.3s;
    width: 100%;
    margin-top: 9px;
}

#send_form:hover {
    background-color: #004d00;
}

    </style>
    <title>Login</title>
</head>

<body>
    <?php include('mess_error.php') ?>
<div class="head_page"><p>الجمهورية الجزائرية الديمقراطية الشعبية<br>المديرية العامة للجمارك الجزائرية</p></div>
    <div class="login">
        <img src="image/cus.jpg" alt="">
        <form action="" method="post">
            <div class="information">
                <label for="">User name</label>
                <input type="text" name="username" required>
                <label for="">Password</label>
                <input type="password" name="password" required>
                <input type="submit" value="send" name="send" id="send_form">
            </div>
        </form>
    </div>
</body>
</html>