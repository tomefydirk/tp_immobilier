---view:
CREATE or replace VIEW v_listings_detaillees AS
SELECT 
    l.id_listing,
    l.id_agent,
    a.nom AS nom_agent,
    a.prenom AS prenom_agent,
    l.id_propriete,
    p.adresse,
    p.ville,
    l.date_debut,
    l.date_fin
FROM listings l
JOIN agents a ON l.id_agent = a.id_agent
JOIN proprietes p ON l.id_propriete = p.id_propriete;

CREATE or replace VIEW v_transactions_detaillees AS
SELECT 
    t.id_transaction,
    t.id_client,
    c.nom AS nom_client,
    c.prenom AS prenom_client,
    c.date_naissance,
    t.id_propriete,
    p.adresse,
    p.ville,
    t.date_transaction,
    t.prix_final
FROM transactions t
JOIN clients c ON t.id_client = c.id_client
JOIN proprietes p ON t.id_propriete = p.id_propriete;

CREATE or replace VIEW v_nb_proprietes_par_agent AS
SELECT 
    a.id_agent,
    a.nom,
    a.prenom,
    COUNT(l.id_propriete) AS nb_proprietes
FROM agents a
JOIN listings l ON a.id_agent = l.id_agent
GROUP BY a.id_agent;


CREATE or replace VIEW v_proprietes_non_vendues AS
SELECT p.*
FROM proprietes p
WHERE p.id_propriete NOT IN (
    SELECT t.id_propriete FROM transactions t
);

CREATE or replace VIEW v_clients_achats_agents AS
SELECT 
    c.nom AS nom_client,
    c.prenom AS prenom_client,
    p.adresse,
    p.ville,
    a.nom AS nom_agent,
    a.prenom AS prenom_agent
FROM transactions t
JOIN clients c ON t.id_client = c.id_client
JOIN proprietes p ON t.id_propriete = p.id_propriete
JOIN listings l ON p.id_propriete = l.id_propriete
JOIN agents a ON l.id_agent = a.id_agent;

CREATE or replace VIEW v_statut_vente_proprietes AS
SELECT 
    p.id_propriete,
    p.adresse,
    p.ville,
     p.prix,
    'Vendue' AS statut_vente
   
FROM proprietes p
JOIN transactions t ON p.id_propriete = t.id_propriete

UNION

SELECT
    p.id_propriete,
    p.adresse,
    p.ville,
    p.prix,
    'Non vendue' AS statut_vente
FROM proprietes p
WHERE p.id_propriete NOT IN (
    SELECT id_propriete FROM transactions
);

Create or replace view v_list_propriete_agent_complet as 
SELECT 
    a.id_agent,
    a.nom AS nom_agent,
    a.prenom AS prenom_agent,
    p.id_propriete,
    p.adresse,
    p.ville,
    p.prix,
    p.type_maison,
    sv.statut_vente
FROM 
    agents a
JOIN 
    listings l ON a.id_agent = l.id_agent
JOIN 
    proprietes p ON l.id_propriete = p.id_propriete
JOIN v_statut_vente_proprietes sv
    on l.id_propriete=sv.id_propriete

ORDER BY 
    a.id_agent, p.id_propriete
;

--1)Lister,les clients nés après le 1er janvier 1990.
SELECT id_client, nom, prenom, 
       TIMESTAMPDIFF(YEAR, date_naissance, NOW()) AS age
FROM clients
WHERE TIMESTAMPDIFF(YEAR, date_naissance, NOW()) >= 10;

--2)Trouvez toutes les propriétés situées à Paris qui coûtent plus de 800,000
select * from proprietes where prix >=800000;

--3)Listez les noms des agents et les propriétés qu'ils ont listées.
SELECT nom_agent, prenom_agent, adresse, ville
FROM v_listings_detaillees;

--4)Créer une table type_maison, remplir la table avec les données existantes(insert from select).
CREATE TABLE type_maison (
    id_type_maison INT AUTO_INCREMENT PRIMARY KEY,
    nom_type VARCHAR(50) 
);
        --ajout de colonne :
            ALTER TABLE proprietes ADD COLUMN id_type_maison INT;
        
        --remplir type_maison:
      INSERT INTO type_maison (nom_type)
            SELECT DISTINCT type_maison
            FROM proprietes
            WHERE type_maison IS NOT NULL --tsy null
        AND type_maison NOT IN (
            --pas dans type maison
      SELECT nom_type FROM type_maison
    );

        --Mettre à jour les donnee:

    UPDATE proprietes p
        JOIN type_maison t ON p.type_maison = t.nom_type
    SET p.id_type_maison = t.id_type_maison;

        


--5)Trouvez le nombre de propriétés listées par chaque agent.
select * from v_nb_proprietes_par_agent;

--6)Trouvez les propriétés qui n'ont été vendues dans aucune transaction.
select  * from v_proprietes_non_vendues;

--7)Listez les noms des clients, les propriétés qu'ils ont achetées, et les noms des agents qui ont listé ces propriétés.
select * from v_clients_achats_agents;

--8)Trouvez toutes les propriétés et indiquez si elles ont été vendues ou non.
select * from v_statut_vente_proprietes;

--9)Supprimez les transactions des clients nés avant 1980.
DELETE t
FROM transactions t
JOIN clients c ON t.id_client = c.id_client
WHERE c.date_naissance < '1980-01-01';

---10)Affichez les agents ayant listé plus de 3 propriétés
SELECT *
FROM v_nb_proprietes_par_agent
WHERE nb_proprietes > 3;