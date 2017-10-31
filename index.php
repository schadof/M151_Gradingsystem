<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Greades</title>
    <meta name="description" content="The Great Gradingsystem">
    <meta name="author" content="Lars Ragutt">

    <link rel="stylesheet" href="assets/css/style.css">
    <?php
    include 'assets/php/default.php';
    ?>

</head>

<body>
<?php
if(!isset($_SESSION['login_user'])) {
    include 'assets/includes/loginform.php';
    if (isset($_POST['username']) && isset($_POST['password']) && !isset($_POST['fname'])) {
        include 'assets/php/login.php';
        login();
        if(isset($_SESSION['login_user'])){
            header("location: index.php");
        }
    }
    echo $_POST['occupation'];
    echo $_POST['class'];
    if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['occupation']) && isset($_POST['class'])){
        createUser();
    }
}
else{
    echo "<a href='assets/php/logout.php'>Logout</a>";
    echo "<br>";
    echo "<br>";
    include 'assets/php/grading.php';
}
?>
</body>
</html>