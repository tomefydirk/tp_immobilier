<?php 
include("../inc/display_function.php");
$id=$_GET["id_propriete"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Villa House</title>
   <link rel="stylesheet" href="../asset/style.css">
    <style>
        .price-tag {
            color: green;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .gallery-img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .section-title {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .agent-info img {
            border-radius: 50%;
            width: 60px;
            height: 60px;
            object-fit: cover;
        }
    </style>
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

  <?=display_propriete($id);?>
</body>
</html>