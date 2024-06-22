<?php
$liaison = mysqli_connect('127.0.0.1', 'fly', 'root', 'stock_v3');

if (!$liaison) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['info'])) {
    $info = explode("-", $_GET['info']);
    $idClient = intval($info[0]);
    $idCommande = intval($info[1]);

    // Récupération des informations du client
    $requeteClient = $liaison->prepare("SELECT * FROM clients WHERE IdClient = ?");
    $requeteClient->bind_param('i', $idClient);
    $requeteClient->execute();
    $retourClient = $requeteClient->get_result();
    $client = $retourClient->fetch_assoc();
    $requeteClient->close();

    // Vérification de la récupération des données du client
    if (!$client) {
        die("Client not found.");
    }

    // Récupération des informations de la commande
    $requeteCommande = $liaison->prepare("SELECT * FROM commandes WHERE Com_num = ?");
    $requeteCommande->bind_param('i', $idCommande);
    $requeteCommande->execute();
    $retourCommande = $requeteCommande->get_result();
    $commande = $retourCommande->fetch_assoc();
    $requeteCommande->close();

    // Vérification de la récupération des données de la commande
    if (!$commande) {
        die("Order not found.");
    }

    // Récupération des détails de la commande
    $requeteDetails = $liaison->prepare("SELECT * FROM detail WHERE Detail_com = ?");
    $requeteDetails->bind_param('s', $commande['facture_number']);
    $requeteDetails->execute();
    $retourDetails = $requeteDetails->get_result();
    $requeteDetails->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .facture {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
        }

        .facture-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #f2f2f2;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .facture-header img {
            max-width: 150px;
        }

        .facture-header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .facture-section {
            margin-bottom: 20px;
        }

        .facture-section h2 {
            margin: 0 0 10px 0;
            font-size: 18px;
            color: #333;
        }

        .facture-table {
            width: 100%;
            border-collapse: collapse;
        }

        .facture-table th, .facture-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .facture-table th {
            background-color: #f2f2f2;
            font-weight: normal;
        }

        .facture-summary {
            text-align: right;
            margin-top: 20px;
            border-top: 2px solid #f2f2f2;
            padding-top: 20px;
        }

        .facture-summary p {
            margin: 5px 0;
            font-size: 16px;
            color: #333;
        }
    </style>
</head>
<body>
<div class="facture">
    <div class="facture-header">
        <img src="images/logo.png" alt="Logo de l'entreprise">
        <div>
            <h1>Facture</h1>
            <p>Numéro de facture : <?php echo htmlspecialchars($commande['facture_number']); ?></p>
            <p>Date : <?php echo htmlspecialchars($commande['Com_date']); ?></p>
        </div>
    </div>
    <div class="facture-section">
        <h2>Client</h2>
        <p><?php echo htmlspecialchars($client['Client_civilite'] . ' ' . $client['Prenom'] . ' ' . $client['Nom']); ?></p>
    </div>
    <div class="facture-section">
        <h2>Détails de la commande</h2>
        <table class="facture-table">
            <tr>
                <th>Référence</th>
                <th>Désignation</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
            <?php while ($detail = $retourDetails->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($detail['Detail_ref']); ?></td>
                    <td>
                        <?php
                        $requeteProduit = $liaison->prepare("SELECT nom_produit FROM produit WHERE id_produit = ?");
                        $requeteProduit->bind_param('s', $detail['Detail_ref']);
                        $requeteProduit->execute();
                        $retourProduit = $requeteProduit->get_result();
                        $produit = $retourProduit->fetch_assoc();
                        echo htmlspecialchars($produit['nom_produit']);
                        $requeteProduit->close();
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($detail['Detail_qte']); ?></td>
                    <td>
                        <?php
                        $requeteProduitPrix = $liaison->prepare("SELECT prix_vente FROM produit WHERE id_produit = ?");
                        $requeteProduitPrix->bind_param('s', $detail['Detail_ref']);
                        $requeteProduitPrix->execute();
                        $retourProduitPrix = $requeteProduitPrix->get_result();
                        $produitPrix = $retourProduitPrix->fetch_assoc();
                        echo htmlspecialchars(number_format($produitPrix['prix_vente'], 2));
                        $requeteProduitPrix->close();
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars(number_format($detail['Detail_qte'] * $produitPrix['prix_vente'], 2)); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <div class="facture-summary">
        <p>Total HT : <?php echo htmlspecialchars(number_format($commande['Com_montant'], 2)); ?> €</p>
        <p>Remise : <?php echo htmlspecialchars(number_format($commande['Com_remise'], 2)); ?> €</p>
        <p>Montant payé : <?php echo htmlspecialchars(number_format($commande['montant_paye'], 2)); ?> €</p>
    </div>
</div>
</body>
</html>
<?php mysqli_close($liaison); ?>
