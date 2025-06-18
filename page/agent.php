<?php include("../inc/display_function.php");
if (!isset($_POST["id_agent"])) {
    header("Location:./index.php");
}
if ($_POST["id_agent"] == null) {
    header("Location:./index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <h2>Nombre de Propriétés à l'actif de <span class="agent_name"><?= get_name_agent($_POST["id_agent"]) ?> </span>
            :
            <?= get_count_propriete_agent($_POST["id_agent"]) ?>
        </h2>
        <h2>contact : (234) 0200 17813</h2>
        <?php display_all_propriete_agent($_POST["id_agent"]); ?>
    </main>

</body>

</html>