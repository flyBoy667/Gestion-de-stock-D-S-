<?php

$liaison = mysqli_connect('127.0.0.1', 'fly', 'root');
mysqli_select_db($liaison, 'stock_v3');

include('includes/header.php');

?>
    <style type="text/css">
        .titre_h1 {
            width: auto;
            display: block;
            height: auto;
            text-align: center;
            background-color: #EDEEEE;
            border: #666666 1px solid;
            padding-top: 20px;
            padding-bottom: 8px;
            padding-left: 10px;
            border: #3868e2 1px solid;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
        }

        .div_saut_ligne {
            width: 100%;
            height: 5px;
            display: inline-block;
        }

        .titre_h1 {
            width: auto;
            display: block;
            height: auto;
            text-align: center;
            background-color: #EDEEEE;
            border: #666666 1px solid;
            padding-top: 20px;
            padding-bottom: 8px;
            border: #3868e2 5px inset;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
        }

        .suite {
            width: 15%;
            height: 25px;
            float: left;
            font-size: 16px;
            font-weight: normal;
            text-align: left;
        }

        .bord {
            float: left;
            width: 5%;
            height: 25px;
        }

        .des {
            width: 30%;
            height: 25px;
            float: left;
            font-size: 16px;
            font-weight: normal;
            text-align: left;
            overflow: hidden;
        }

        .prix {
            width: 15%;
            height: 25px;
            float: left;
            font-size: 16px;
            font-weight: normal;
            text-align: right;
        }

        input,
        select {
            border-radius: 10px;
            text-align: center;
            padding-right: 10px;
        }
    </style>
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <div class="col-12">
        <!--        <div id="produit_dialog" title="Add Data">-->
        <!--            <form method="post" id="article_form" action="" enctype="multipart/form-data">-->
        <!--                <div class="row">-->
        <!--                    <div class="col-sm-6">-->
        <!--                        <div class="form-group">-->
        <!--                            <label>Categorie</label>-->
        <!--                            <select class="form-control" type="text" id="categorie" name="categorie">-->
        <!--                                <option>Selectionnez</option>-->
        <!--                                --><?php //if ($total_categorie > 0) {
        //                                    foreach ($result_categorie as $row_categorie) {
        //                                        ?>
        <!--                                        <option value="-->
        <?php //echo $row_categorie["id_categorie"]; ?><!--">-->
        <?php //echo $row_categorie["categorie"] ?><!--</option>-->
        <!--                                    --><?php //}
        //                                } ?>
        <!--                            </select>-->
        <!--                            <span id="error_categorie" class="text-danger"></span>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="col-sm-6">-->
        <!--                        <div class="form-group">-->
        <!--                            <label>Marque</label>-->
        <!--                            <select class="form-control" type="text" id="marque" name="marque">-->
        <!--                                <option>Selectionnez</option>-->
        <!--                                --><?php //if ($total_marque > 0) {
        //                                    foreach ($result_marque as $row_marque) {
        //                                        ?>
        <!--                                        <option value="--><?php //echo $row_marque["id_marque"]; ?><!--">-->
        <?php //echo $row_marque["marque"]; ?><!--</option>-->
        <!--                                    --><?php //}
        //                                } ?>
        <!--                            </select>-->
        <!--                            <span id="error_marque" class="text-danger"></span>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="row">-->
        <!--                    <div class="col-sm-6">-->
        <!--                        <div class="form-group">-->
        <!--                            <label>Code produit</label>-->
        <!--                            <input type="text" name="code" id="code" class="form-control"/>-->
        <!--                            <span id="error_code" class="text-danger"></span>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="col-sm-6">-->
        <!--                        <div class="form-group">-->
        <!--                            <label>Nom produit</label>-->
        <!--                            <input type="text" name="nom" id="nom" class="form-control"/>-->
        <!--                            <span id="error_nom" class="text-danger"></span>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="row">-->
        <!--                    <div class="col-sm-6">-->
        <!--                        <div class="form-group">-->
        <!--                            <label>Prix d'achat</label>-->
        <!--                            <input type="text" name="pa" id="pa" class="form-control"/>-->
        <!--                            <span id="error_pa" class="text-danger"></span>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="col-sm-6">-->
        <!--                        <div class="form-group">-->
        <!--                            <label>Prix de vente</label>-->
        <!--                            <input type="text" name="pv" id="pv" class="form-control"/>-->
        <!--                            <span id="error_pv" class="text-danger"></span>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="row">-->
        <!--                    <div class="col-sm-6">-->
        <!--                        <div class="form-group">-->
        <!--                            <label>Stock</label>-->
        <!--                            <input type="text" name="stock" id="stock" class="form-control"/>-->
        <!--                            <span id="error_stock" class="text-danger"></span>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="col-sm-6">-->
        <!--                        <div class="form-group">-->
        <!--                            <label>Statut</label>-->
        <!--                            <select class="form-control" type="text" id="statut" name="statut">-->
        <!--                                <option value="">Selectionnez</option>-->
        <!--                                <option value="1">Actif</option>-->
        <!--                                <option value="2">Inactif</option>-->
        <!--                                <span id="error_statut" class="text-danger"></span>-->
        <!--                            </select>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!---->
        <!--                <!--<div class="row">-->
        <!--                    <div class="col-sm-6">-->
        <!--                        <div class="form-group">-->
        <!--                            <label>Image</label>-->
        <!--                            <input type="file" name="photo" id="photo" class="form-control" accept="image/png, image/jpeg"/>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->-->
        <!--                <div class="form-group">-->
        <!--                    <input type="hidden" name="action" id="action" value="insert"/>-->
        <!--                    <input type="hidden" name="hidden_id" id="hidden_id"/>-->
        <!--                    <input type="submit" name="form_action" id="form_action" class="btn btn-info" value="Ajouter"/>-->
        <!--                </div>-->
        <!--            </form>-->
        <!--        </div>-->

        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Creer un nouveau client</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <script src="js/prototype.js" type="text/javascript"></script>
                <script language='javascript' type="text/javascript">
                    function recolter() {
                        document.getElementById("formulaire").request({
                            onComplete: function (transport) {
                                let idClient = document.getElementById("ref_client").value
                                if (idClient > 0) {
                                    document.getElementById("valider").disabled = false
                                } else {
                                    document.getElementById("valider").disabled = true
                                }
                                switch (document.getElementById('param').value) {
                                    case 'recup_client':
                                        var tab_info = transport.responseText.split('|');
                                        document.getElementById('civilite').value = tab_info[0];
                                        document.getElementById('nom_client').value = tab_info[1];
                                        document.getElementById('prenom_client').value = tab_info[2];
                                        break;

                                    case 'recup_article':
                                        var tab_info = transport.responseText.split('|');
                                        document.getElementById('designation').value = tab_info[0];
                                        document.getElementById('puht').value = tab_info[1];
                                        document.getElementById('qte').value = tab_info[2];
                                        break;

                                    case 'creer_client':
                                        var errors = [];
                                        var civilite = document.getElementById('civilite').value;
                                        var nom_client = document.getElementById('nom_client').value;
                                        var prenom_client = document.getElementById('prenom_client').value;
                                        var rep = transport.responseText;

                                        if (civilite === "") {
                                            errors.push("Veuillez sélectionner une civilité.");
                                        }

                                        if (nom_client === "") {
                                            errors.push("Veuillez saisir le nom du client.");
                                        }

                                        if (prenom_client === "") {
                                            errors.push("Veuillez saisir le prénom du client.");
                                        }

                                        if (errors.length > 0) {
                                            alert(errors.join("\n"));
                                            return; // Arrêter le traitement si des erreurs existent
                                        }

                                        if (rep === "nok")
                                            alert("Le client existe déjà");
                                        else {
                                            var liste = document.getElementById("ref_client");
                                            var option = document.createElement("option");
                                            option.value = rep;
                                            option.text = rep;
                                            liste.add(option);
                                            liste.selectedIndex = liste.length - 1;
                                        }
                                        break;

                                    case 'facturer':
                                        var reponse = transport.responseText;
                                        if (transport.responseText === "nok")
                                            alert("Une erreur est survenue");
                                        else {
                                            if (document.getElementById("paye").value === "" || (document.getElementById("paye").value < (document.getElementById("total_commande").value)) || (document.getElementById("paye").value > (document.getElementById("total_commande").value)))
                                                alert("La Somme a payé incorrect");
                                            else {
                                                alert("La facture a été validée");
                                                document.getElementById("editer").innerHTML = "<input type='button' value='Editer la facture' onclick='window.open(\"edition.php?info=" + reponse + "\")' />";
                                            }
                                        }

                                        break;

                                }
                            }
                        });
                    }
                </script>
                <form id="formulaire" name="formulaire" method="post" action="action/add_facture.php">
                    <div class="titre_h1" style="height:350px;">
                        <!-- Informations du client -->
                        <div style="width:10%;height:50px;float:left;"></div>
                        <div style="width:35%;height:50px;float:left;font-size:20px;font-weight:bold;text-align:left;color:#a13638;">
                            <u>Informations du client</u><br/>
                        </div>
                        <div style="width:10%;height:50px;float:left;"></div>
                        <div style="width:35%;height:50px;float:left;font-size:16px;font-weight:bold;text-align:left;">
                            <input type="button" id="creer_client" name="creer_client" value="Créer le client"
                                   onclick="document.getElementById('param').value='creer_client';recolter();"/>
                        </div>
                        <div style="width:10%;height:50px;float:left;"></div>

                        <div style="width:15%;height:55px;float:left;font-size:16px;font-weight:bold;text-align:left;">
                            Réf. Client :<br/>
                            <select id="ref_client" name="ref_client"
                                    onchange="document.getElementById('param').value='recup_client';recolter();">
                                <option value="0">Choisir client</option>
                                <?php
                                $requete = "SELECT IdClient FROM clients ORDER BY IdClient;";
                                $retours = mysqli_query($liaison, $requete);
                                while ($retour = mysqli_fetch_array($retours)) {
                                    echo "<option value='" . $retour["IdClient"] . "'>" . $retour["IdClient"] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div style="width:10%;height:55px;float:left;font-size:16px;font-weight:bold;text-align:left;">
                            Civilité : <br/>
                            <select id="civilite" name="civilite">
                                <option value="0">Selectionner civilite</option>
                                <option value="Mr">Mr</option>
                                <option value="Mme">Mme</option>
                            </select>
                        </div>

                        <div style="width:10%;height:55px;float:left;"></div>
                        <div style="width:6%;height:55px;float:left;"></div>
                        <div style="width:25%;height:55px;float:left;font-size:16px;font-weight:bold;text-align:left;">
                            Nom du client :<br/>
                            <input type="text" id="nom_client" name="nom_client"/>
                        </div>
                        <div style="width:25%;height:55px;float:left;font-size:16px;font-weight:bold;text-align:left;">
                            Prénom du client :<br/>
                            <input type="text" id="prenom_client" name="prenom_client"/>
                        </div>

                        <!-- Ajout des produits commandés -->
                        <div style="width:10%;height:50px;float:left;"></div>
                        <div style="width:80%;height:50px;float:left;font-size:20px;font-weight:bold;text-align:left;color:#a13638;">
                            <u>Ajout des produits commandés</u><br/>
                        </div>
                        <div style="width:10%;height:50px;float:left;"></div>

                        <div style="width:15%;height:55px;float:left;font-size:16px;font-weight:bold;text-align:left;">
                            Réf. Produit :<br/>
                            <select id="ref_produit" name="ref_produit"
                                    onchange="document.getElementById('param').value='recup_article';recolter();">
                                <option value="0">Réf. produit</option>
                                <?php
                                $requete = "SELECT id_produit FROM produit ORDER BY id_produit;";
                                $retours = mysqli_query($liaison, $requete);
                                while ($retour = mysqli_fetch_array($retours)) {
                                    echo "<option value='" . $retour["id_produit"] . "'>" . $retour["id_produit"] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div style="width:15%;height:55px;float:left;font-size:16px;font-weight:bold;text-align:left;">
                            Qté en stock :<br/>
                            <input type="text" id="qte" name="qte" disabled style="text-align:right;"/>
                        </div>
                        <div style="width:10%;height:55px;float:left;"></div>
                        <div style="width:25%;height:55px;float:left;font-size:16px;font-weight:bold;text-align:left;">
                            Désignation du produit :<br/>
                            <input type="text" id="designation" name="designation" disabled/>
                        </div>
                        <div style="width:25%;height:55px;float:left;font-size:16px;font-weight:bold;text-align:left;">
                            Prix unitaire HT :<br/>
                            <input type="text" id="puht" name="puht" disabled style="text-align:right;"/>
                        </div>
                        <div style="width:10%;height:55px;float:left;"></div>

                        <div class="div_saut_ligne" style="height:2%;"></div>

                        <div style="width:0;height:55px;float:left;"></div>
                        <div style="width:10%;height:55px;float:left;font-size:16px;font-weight:bold;text-align:left;">
                            Quantité:<br/>
                            <input type="text" id="qte_commande" name="qte_commande"/>
                        </div>
                        <div style="width:7%;height:55px;float:left;"></div>
                        <div style="width:20%;height:55px;float:left;font-size:16px;font-weight:bold;text-align:left;margin-top: -5px;">
                            Total commande :<br/>
                            <h4>
                                <input type="text" id="total_commande" name="total_commande" disabled
                                       style="color:#7f0c06;width:100%;font-family: Arial Black;"/>
                            </h4>
                        </div>
                        <div style="width:3%;height:55px;float:left;"></div>
                        <!--                        <div style="width:15%;height:55px;float:left;font-size:16px;font-weight:bold;text-align:left;margin-top: -5px;">-->
                        <!--                            Remise :<br/>-->
                        <!--                            <input type="text" id="remise" name="remise" value="0" onchange="montant_a_payer();"/>-->
                        <!--                        </div>-->
                        <div style="width:3%;height:55px;float:left;"></div>
                        <div style="width:15%;height:55px;float:left;font-size:16px;font-weight:bold;text-align:left;margin-top: -5px;">
                            Payé :<br/>
                            <input type="text" id="paye" name="paye"/>
                        </div>
                        <div style="width:3%;height:55px;float:left;"></div>
                        <div style="width:7%;height:55px;float:left;font-size:16px;font-weight:bold;text-align:left;padding-top: 10px;">
                            <input type="button" id="ajouter" name="ajouter" value="Ajouter" style="margin-top:10px;"
                                   onclick="plus_com();"/><br/>
                            <input type="text" id="param" name="param" style="visibility:hidden;"/>
                        </div>
                        <div style="width:15%;height:55px;float:left;font-size:16px;font-weight:bold;text-align:left;padding-top: 10px;">
                            <input type="button" id="valider" name="valider" value="Valider" disabled
                                   style="margin-top:10px;"
                                   onclick="document.getElementById('param').value='facturer';recolter();"/><br/>
                            <input type="text" id="chaine_com" name="chaine_com" style="visibility:hidden;"/>
                            <input type="text" id="total_com" name="total_com" style="visibility:hidden;"/>
                        </div>
                    </div>
                </form>

                <div class="div_saut_ligne" style="height:50px;">
                </div>

                <div style="float:left;width:10%;height:25px;"></div>
                <div style="float:left;width:80%;height:auto;text-align:center;">
                    <div class="titre_h1" style="float:left;height:auto;width:100%;">
                        <div style="float:left;width:5%;height:25px;"></div>
                        <div style="width:15%;height:25px;float:left;font-size:16px;font-weight:bold;text-align:left;">
                            Réference
                        </div>
                        <div style="width:15%;height:25px;float:left;font-size:16px;font-weight:bold;text-align:left;">
                            Quantité
                        </div>
                        <div style="width:30%;height:25px;float:left;font-size:16px;font-weight:bold;text-align:left;overflow:hidden;">
                            Désignation du produit
                        </div>
                        <div style="width:15%;height:25px;float:left;font-size:16px;font-weight:bold;text-align:right;">
                            PUHT
                        </div>
                        <div style="width:15%;height:25px;float:left;font-size:16px;font-weight:bold;text-align:right;">
                            PTHT
                        </div>
                        <div style="float:left;width:5%;height:25px;"></div>

                        <div style="float:left;width:100%;height:auto;" id="det_com">
                            <div class="bord"></div>
                            <div class="suite">

                            </div>
                            <div class="suite">

                            </div>
                            <div class="des">

                            </div>
                            <div class="prix">

                            </div>
                            <div class="prix" style="font-weight:bold;">

                            </div>
                            <div class="bord"></div>

                        </div>

                        <div style="float:left;width: 5%;height:25px;"></div>
                        <div style="float:left;width: 100%;height:auto;" id="editer"></div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <script language='javascript' type="text/javascript">
                var tot_com = 0;
                function plus_com() {
                    if (ref_client.value !== 0 && ref_produit.value !== 0 && qte_commande.value !== "0" && qte_commande.value !== "") {
                        if (parseInt(qte_commande.value) > parseInt(qte.value))
                            alert("La quantité en stock n'est pas suffisante pour honorer la commande");
                        else {
                            const ref_p = ref_produit.value;
                            const qte_p = qte_commande.value;
                            const des_p = designation.value;
                            const pht_p = puht.value;

                            tot_com = tot_com + qte_p * pht_p;
                            total_commande.value = tot_com.toFixed(2);
                            total_com.value = total_commande.value;
                            chaine_com.value += "|" + ref_p + ";" + qte_p + ";" + des_p + ";" + pht_p;
                            facture();
                        }
                    }
                }

                function montan_a_payer() {
                    //alert("test");
                    document.getElementById('paye').value = document.getElementById('total_commande').value;
                }


                function facture() {

                    const tab_com = chaine_com.value.split('|');
                    const nb_lignes = tab_com.length;
                    document.getElementById("det_com").innerHTML = "";
                    for (ligne = 0; ligne < nb_lignes; ligne++) {
                        if (tab_com[ligne] != "") {
                            const ligne_com = tab_com[ligne].split(';');
                            document.getElementById("det_com").innerHTML += "<div class='bord'></div>";
                            document.getElementById("det_com").innerHTML += "<div class='suite'>" + ligne_com[0] + "</div>";
                            document.getElementById("det_com").innerHTML += "<div class='suite'>" + ligne_com[1] + "</div>";
                            document.getElementById("det_com").innerHTML += "<div class='des'>" + ligne_com[2] + "</div>";
                            document.getElementById("det_com").innerHTML += "<div class='prix'>" + ligne_com[3] + "</div>";
                            document.getElementById("det_com").innerHTML += "<div class='prix'>" + (ligne_com[1] * ligne_com[3]).toFixed(2) + "</div>";
                            document.getElementById("det_com").innerHTML += "<div class='bord'><input type='button' value='X' title='Supprimer le produit' style='height:20px;font-size:12px;' onclick='suppr(\"" + tab_com[ligne] + "\");' /></div>";
                        }
                    }
                }

                function suppr(ligne_s) {
                    chaine_com.value = chaine_com.value.replace('|' + ligne_s, '');
                    const tab_detail = ligne_s.split(';');

                    total_commande.value = (total_commande.value - tab_detail[1] * tab_detail[3]).toFixed(2);
                    total_com.value = total_commande.value;
                    tot_com = total_com.value * 1;

                    facture();
                }
            </script>
            <!--            Boite modale (new user) scripts-->
            <script>
                document.getElementById('produit_dialog').dialog({
                    autoOpen: false,
                    width: 600
                });
            </script>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <!-- jQuery -->
    <!
    <script src="js/jquery.min.js">
    </script>
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- Page script -->
    <!--<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({

    })

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4',
    })
  })
</script>-->


<?php include('includes/footer.php'); ?>