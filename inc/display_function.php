<?php 
include("sql_function.php");
?>
<?php 
function display_all_propriete() {
    $to_display = get_all_propriete();
    ?>
    
    <div class="container my-4">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php foreach ($to_display as $iter) { ?>
                <div class="col">
                    <a href="./fiche.php?id_propriete=<?= $iter["id_propriete"] ?>" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm">
                            <img src="../asset/base.jpg" class="card-img-top" alt="Propriété">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($iter["adresse"]) ?></h5>
                                <p class="card-text mb-1"><?= htmlspecialchars($iter["ville"]) ?></p>
                                <p class="card-text text-muted"><?= htmlspecialchars($iter["statut_vente"]) ?></p>
                                <h6 class="card-subtitle text-success"><?= number_format($iter["prix"], 2, ',', ' ') ?> €</h6>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
    
    <?php
}
?>

<?php function display_all_propriete_agent($id){?>
    <?php $to_display=get_info_agent_all($id);?>
     <div class="propriete-grid">
        <?php foreach ($to_display as $iter){ ?>
                <a href="./fiche.php?id_propriete=<?=$iter["id_propriete"]?>">
                
                
            <div class="propriete-card">
                <img class="propriete-img" src="../asset/base.jpg" alt="Propriété">
                <div class="propriete-info">
                 
                    <h1><?= htmlspecialchars($iter["adresse"]) ?></h1>
                    <p><?= htmlspecialchars($iter["ville"]) ?></p>
                     <h2><?= htmlspecialchars($iter["statut_vente"]) ?></h2>
                    <h3><?= number_format($iter["prix"], 2, ',', ' ') ?> €</h3>
                </div>
            </div>

            </a>
        <?php } ?>
    </div>
<?php } ?>
<?php function display_propriete($id){?>
   <?php $iter=get_info_propriete($id);?>
   <div class="container mt-4">
      
        <div class="row">
            <div class="col-md-8">
                <h2>Luxury Villa House
                    <?php if(get_statut_vente($id)!="Vendue"){?>
                         <span class="badge bg-danger">À vendre</span></h2>
                    <?php }?>    
               
                <p><i class="bi bi-geo-alt-fill"></i><?=$iter["adresse"]?></p>
            </div>
            <div class="col-md-4 text-end">
                <div class="price-tag"><?=$iter["prix"]?></div>
                <small>$1,200 / sq ft</small>
            </div>
        </div>

       
        <div class="section-title">Gallery</div>
        <div class="row">
            <div class="col-md-12">
                <img src="../asset/base.jpg" alt="<?= $iter["type_maison"]?>" class="gallery-img">
            </div>
        </div>

        
        <div class="row mt-4 gap2">
            <div class="col-md-6">
                <div class="section-title">Schedule a Tour</div>
                <form>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date">
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Time</label>
                        <input type="time" class="form-control" id="time">
                    </div>
                    <div class="mb-3">
                        <label for="adults" class="form-label">Adults</label>
                        <input type="number" class="form-control" id="adults" min="0">
                    </div>
                    <div class="mb-3">
                        <label for="children" class="form-label">Children</label>
                        <input type="number" class="form-control" id="children" min="0">
                    </div>
                    <button type="submit" class="btn btn-danger">Submit Request</button>
                </form>
            </div>

           
            <div class="col-md-6">
                <div class="section-title">Agent Information</div>
                <div class="d-flex align-items-center mb-2 agent-info">
                    <img src="../asset/agent.jpg" alt="Agent Lisa Clark" width="50px" height="50px">
                    <div class="ms-3">
                        <strong><?=$iter["nom_agent"]?> <?=$iter["prenom_agent"]?></strong><br>
                        Agent of Property
                    </div>
                </div>
                <p><i class="bi bi-geo-alt-fill"></i> <?=$iter["region"]?></p>
                <p><i class="bi bi-telephone-fill"></i> (234) 0200 17813</p>
                <p><i class="bi bi-envelope-fill"></i> <?=$iter["nom_agent"]?>@gmail.com</p>
                <form action="./agent.php" method="post">
                    <input type="hidden" value="<?=$iter["id_agent"]?>" name="id_agent">
                    <input type="submit" value="info sur l'agent" class="info_agent">
                </form>
            </div>
        </div>
    </div>


<?php }?>
