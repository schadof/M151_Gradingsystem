<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Greades</title>
    <meta name="description" content="The Great Gradingsystem">
    <meta name="author" content="Lars Ragutt">

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
<?php
@session_start();

if(!isset($_SESSION['login_user'])) {
    include 'assets/includes/loginform.php';
    if (isset($_POST['username']) && isset($_POST['password']) && !isset($_POST['fname'])) {
        include 'assets/php/login.php';
        login();
        if(isset($_SESSION['login_user'])){
            header("location: index.php");
        }
    }
    if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['occupation']) && isset($_POST['class'])){
        include 'assets/php/login.php';
        createUser();
    }
}
else{
    echo "<a href='assets/php/logout.php'>Logout</a>";
    echo "<br>";
    echo "<br>";
    include 'assets/includes/grading.php';
}
if ($_SESSION['occupation'] == "Administrator"){
    echo "<a href='/assets/includes/students.php'>Students</a></br>";
    echo "<a href='/assets/includes/registerform.php'>Register</a>";
}
?>
</body>
</html>