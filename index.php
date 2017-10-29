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
include 'assets/includes/loginform.php';
if (isset($_POST['username']) && isset($_POST['password'])) {
    include 'assets/php/login.php';
    login();
}
?>
</body>
</html>