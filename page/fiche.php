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
   <link href="./../asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   
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
    <main>
          <?=display_propriete($id);?>
    </main>

</body>
</html>