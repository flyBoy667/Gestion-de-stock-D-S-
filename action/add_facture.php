<?php
$liaison = mysqli_connect('127.0.0.1', 'fly', 'root');
mysqli_select_db($liaison, 'stock_v3');

if (isset($_POST["param"])) {
    switch ($_POST["param"]) {
        case "recup_client":
            $requete = "SELECT * FROM clients WHERE IdClient = " . $_POST["ref_client"] . ";";
            $retours = mysqli_query($liaison, $requete);
            $retour = mysqli_fetch_array($retours);
            $chaine = $retour["Client_civilite"] . "|" . $retour["Nom"] . "|" . $retour["Prenom"];
            print($chaine);
            break;

        case "recup_article":
            $requete = "SELECT * FROM produit WHERE id_produit = '" . $_POST["ref_produit"] . "';";
            $retours = mysqli_query($liaison, $requete);
            $retour = mysqli_fetch_array($retours);
            $chaine = $retour["nom_produit"] . "|" . $retour["prix_vente"] . "|" . $retour["stock_encours"] . "|" . $retour["id_produit"];
            print($chaine);
            break;

        case "creer_client":
            $requete = "SELECT COUNT(IdClient) AS nb FROM clients WHERE Nom='" . $_POST["nom_client"] . "' AND Prenom='" . $_POST["prenom_client"] . "';";
            $retours = mysqli_query($liaison, $requete);
            $retour = mysqli_fetch_array($retours);
            if ($retour["nb"] > 0)
                print("nok");
            else {
                $requete = "INSERT INTO clients(Client_civilite, Nom, Prenom) VALUES ('" . $_POST["civilite"] . "', '" . $_POST["nom_client"] . "', '" . $_POST["prenom_client"] . "');";
                $retours = mysqli_query($liaison, $requete);
                if ($retours == 1)
                    print(mysqli_insert_id($liaison));
            }
            break;
        case "facturer":

            if ($_POST["paye"] != 0) {

                $requete = "SELECT Com_num FROM commandes ORDER BY Com_num DESC LIMIT 1;";
                $retours = mysqli_query($liaison, $requete);
                $retour = mysqli_fetch_array($retours);
                $derniere_com = $retour['Com_num'] + 1;
                $com_client = $_POST["ref_client"];
                $com_date = date('d/m/Y');
                $transaction_date = date('Y-m-d');
                $com_montant = $_POST["total_com"];
                $montant_paye = $_POST["paye"];
                $remise = $_POST["total_remise"];
                $facture_number = $com_date . "/S-00" . $derniere_com;
                $type = 1;

                $texte_com = $_POST["chaine_com"];
                $tab_com = explode('|', $texte_com);

                if ($remise < 0) {
                    $restant = $remise * (-1);

                    $facture_number = mysqli_real_escape_string($liaison, $facture_number);
                    $com_montant = mysqli_real_escape_string($liaison, $com_montant);
                    $restant = mysqli_real_escape_string($liaison, $restant);
                    $com_date = mysqli_real_escape_string($liaison, $com_date);
                    $com_client = mysqli_real_escape_string($liaison, $com_client);
                    $montant_paye = mysqli_real_escape_string($liaison, $montant_paye);

                    $query = "INSERT INTO paiements_incomplets (num_facture, montant_toatl, restant, paye, paiment_date, id_client) VALUES ('$facture_number', $com_montant, $restant, '$montant_paye', '$com_date', $com_client)";
                    $retours = mysqli_query($liaison, $query);

                    if (!$retours) {
                        echo "Erreur lors de l'exécution de la requête : " . mysqli_error($liaison);
                    }
                }


                $requete = "INSERT INTO commandes(Com_client, Com_date, Com_montant, facture_number, Com_remise, montant_paye) VALUES (" . $com_client . ", '" . $com_date . "', " . $com_montant . ", '" . $facture_number . "'," . $remise . "," . $montant_paye . ");";
                $retours = mysqli_query($liaison, $requete);

                $transaction = "INSERT INTO transaction(num_facture, client_fournisseur, montant, remise, montant_paye, type, transaction_date) VALUES ('" . $facture_number . "'," . $com_client . ", " . $com_montant . ", " . $remise . ", " . $montant_paye . "," . $type . ", '" . $transaction_date . "');";
                $transa = mysqli_query($liaison, $transaction);
                if ($retours == 1) {
                    $detail_com = mysqli_insert_id($liaison);
                    for ($ligne = 0; $ligne < sizeof($tab_com); $ligne++) {
                        if ($tab_com[$ligne] != "") {
                            $ligne_com = explode(';', $tab_com[$ligne]);
                            $requete = "INSERT INTO detail(Detail_com, Detail_ref, Detail_qte, type,date_commande) VALUES ('" . $facture_number . "', '" . $ligne_com[0] . "', " . $ligne_com[1] . ",1, '" . $transaction_date . "');";
                            $retours = mysqli_query($liaison, $requete);
                            $requete = "UPDATE produit SET stock_encours=stock_encours-" . $ligne_com[1] . " WHERE id_produit='" . $ligne_com[0] . "';";
                            $retours = mysqli_query($liaison, $requete);
                            //Requête des sortie de stock
                            /*$req= "INSERT INTO sortie (ref_produit, quantite) VALUES('".$ligne_com[0]."',".$ligne_com[1].")";
                            $reponse =  mysqli_query($liaison, $req);*/

                        }
                    }
                    print($com_client . "-" . $detail_com);
                } else
                    print("nok");

                break;
            }
    }
}

mysqli_close($liaison);
