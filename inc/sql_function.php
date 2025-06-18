<?php 
require("connection.php");

function get_all_propriete(){
      $rqst="select * from v_statut_vente_proprietes";
    
      $resultat= mysqli_query(dbconnect(), $rqst);
         $com = array();
    while ($r = mysqli_fetch_assoc($resultat)) {
        $com[] = $r;
    }
    return $com;
}
function get_info_propriete($id) {
  

    $rqst = "SELECT * FROM v_info_propriete WHERE id_propriete = $id LIMIT 1";
    $result = mysqli_query(dbconnect(), $rqst);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return null;
}
function get_statut_vente($id){
    $rqst="select * from v_statut_vente_proprietes where id_propriete=$id";

    $resultat=mysqli_query(dbconnect(),$rqst);

    return mysqli_fetch_assoc($resultat)["statut_vente"];
}
function get_info_agent_all($id){
    $rqst="select * from v_list_propriete_agent_complet where id_agent=$id";
    $resultat=mysqli_query(dbconnect(),$rqst);

          $com = array();
    while ($r = mysqli_fetch_assoc($resultat)) {
        $com[] = $r;
    }
    return $com;

}
function get_count_propriete_agent($id){
    $rqst="select * from v_nb_proprietes_par_agent where id_agent=$id";


    $resultat=mysqli_query(dbconnect(),$rqst);
    return mysqli_fetch_assoc($resultat)["nb_proprietes"];

}
function get_name_agent($id){
    $rqst="select nom,prenom from agents where id_agent=$id";
     $resultat=mysqli_query(dbconnect(),$rqst);

     $personne=mysqli_fetch_assoc($resultat);
      return $personne["nom"]." ".$personne["prenom"];
}
?>