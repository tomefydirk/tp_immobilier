<?php 

include("../inc/display_function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../asset/style.css">
</head>
<body>
    <header class="main-header">
    <div class="logo">ImmoAgency</div>
    <nav class="nav-links">
        <a href="./index.php">Accueil</a>
        <a href="#">Propriétés</a>
        <a href="#">Agents</a>
        <a href="#">Contact</a>
    </nav>
</header>



    <?php display_all_propriete();?>
</body>
</html>