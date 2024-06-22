<?php
$date = date("m"); // Mois actuel par défaut
include('includes/db_connexion.php');

// Vérification et traitement du filtre par mois
if (isset($_GET['month'])) {
    $selected_month = $_GET['month'];
} else {
    $selected_month = $date; // Mois actuel par défaut
}

$query = "SELECT SUM(Detail_qte) AS qvente FROM detail WHERE type = 1 AND MONTH(date_commande) = :month";
$statement = $connect->prepare($query);
$statement->execute(array(':month' => $selected_month));
$result = $statement->fetch(PDO::FETCH_OBJ);
$qvendue = $result->qvente;

$query2 = "SELECT SUM(montant_paye) AS mt FROM transaction WHERE type = 1 AND MONTH(transaction_date) = :month";
$statement2 = $connect->prepare($query2);
$statement2->execute(array(':month' => $selected_month));
$result2 = $statement2->fetch(PDO::FETCH_OBJ);
$sum = $result2->mt;

$query_achat = "SELECT SUM(Detail_qte) AS qachat FROM detail WHERE type = 2 AND MONTH(date_commande) = :month";
$statement_achat = $connect->prepare($query_achat);
$statement_achat->execute(array(':month' => $selected_month));
$result_achat = $statement_achat->fetch(PDO::FETCH_OBJ);
$qacheter = $result_achat->qachat;

$query_achat2 = "SELECT SUM(montant_paye) AS mt_achat FROM transaction WHERE type = 2 AND MONTH(transaction_date) = :month";
$statement_achat2 = $connect->prepare($query_achat2);
$statement_achat2->execute(array(':month' => $selected_month));
$result_achat2 = $statement_achat2->fetch(PDO::FETCH_OBJ);
$sum_achat = $result_achat2->mt_achat;

// Récupération des mois disponibles pour le filtre
$query_months = "SELECT DISTINCT MONTH(date_commande) AS mois FROM detail";
$statement_months = $connect->prepare($query_months);
$statement_months->execute();
$months = $statement_months->fetchAll(PDO::FETCH_COLUMN);

include('includes/header.php');
?>

<div class="row">
    <div class="col-md-12">
        <form action="" method="get" class="form-inline mb-3">
            <label for="month" class="mr-2">Sélectionner un mois :</label>
            <select name="month" id="month" class="form-control mr-2" onchange="this.form.submit()">
                <?php foreach ($months as $month) : ?>
                    <option value="<?php echo $month; ?>" <?php if ($month == $selected_month) echo 'selected'; ?>>
                        <?php echo date("F", mktime(0, 0, 0, $month, 1)); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <noscript><input type="submit" value="Appliquer" class="btn btn-primary"></noscript>
        </form>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total ventes (<?php echo date("F", mktime(0, 0, 0, $selected_month, 1)); ?>)</span>
                <span class="info-box-number">
                    <?php echo ($qvendue) ? $qvendue : 0; ?>
                    <small>Produit(s)</small>
                    <small><?php echo "(" . number_format($sum, 2, ',', ' ') . " CFA)"; ?></small>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-ship"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total achats (<?php echo date("F", mktime(0, 0, 0, $selected_month, 1)); ?>)</span>
                <span class="info-box-number">
                    <?php echo ($qacheter) ? $qacheter : 0; ?>
                    <small>Produit(s)</small>
                    <small><?php echo "(" . number_format($sum_achat, 2, ',', ' ') . " CFA)"; ?></small>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-dollar-sign"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total dépenses (<?php echo date("F", mktime(0, 0, 0, $selected_month, 1)); ?>)</span>
                <span class="info-box-number">0</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-money-bill-alt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total transactions (<?php echo date("F", mktime(0, 0, 0, $selected_month, 1)); ?>)</span>
                <span class="info-box-number">
                    <?php $total_transaction = $sum + $sum_achat; echo number_format($total_transaction, 2, ',', ' ')." CFA"; ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-md-6">
        <!-- BAR CHART -->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Ventes VS Achats (Quantités)</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <canvas id="barChart" style="height:230px; min-height:230px"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <div class="col-md-6">
        <!-- PIE CHART -->
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Valeur du stock (Montants)</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <canvas id="pieChart" style="height:230px; min-height:230px"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<?php include('includes/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Données pour le graphique à barres (Ventes vs Achats)
    var barData = {
        labels: ['Ventes', 'Achats'],
        datasets: [{
            label: 'Quantités',
            backgroundColor: ['#28a745', '#dc3545'],
            data: [<?php echo $qvendue ? $qvendue : 0; ?>, <?php echo $qacheter ? $qacheter : 0; ?>]
        }]
    };

    // Options pour le graphique à barres
    var barOptions = {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Quantités de ventes et d\'achats'
            }
        }
    };

    // Création du graphique à barres
    var barChartCanvas = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barData,
        options: barOptions
    });

    // Données pour le graphique circulaire (Valeur du stock)
    var pieData = {
        labels: ['Ventes', 'Achats'],
        datasets: [{
            label: 'Montants',
            backgroundColor: ['#17a2b8', '#ffc107'],
            data: [<?php echo $sum ? $sum : 0; ?>, <?php echo $sum_achat ? $sum_achat : 0; ?>]
        }]
    };

    // Options pour le graphique circulaire
    var pieOptions = {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Montants de ventes et d\'achats'
            }
        }
    };

    // Création du graphique circulaire
    var pieChartCanvas = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
    });
</script>
