<?php 
$date = date("m");//echo $date;exit;
include ('includes/db_connexion.php');
$query ="SELECT SUM(Detail_qte) AS qvente FROM detail WHERE type = 1 AND  MONTH(date_commande) = $date ";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_OBJ);
//$total_row = $statement->rowCount();

$query2 ="SELECT SUM(montant_paye) AS mt FROM transaction WHERE type = 1 AND MONTH(transaction_date) = $date ";
$statement2 = $connect->prepare($query2);
$statement2->execute();
$result2 = $statement2->fetchAll(PDO::FETCH_OBJ);

$query_achat ="SELECT SUM(Detail_qte) AS qachat FROM detail WHERE type = 2 AND MONTH(date_commande) = $date ";
$statement_achat = $connect->prepare($query_achat);
$statement_achat->execute();
$result_achat = $statement_achat->fetchAll(PDO::FETCH_OBJ);
//$total_row_achat = $statement_achat->rowCount();

$query_achat2 ="SELECT SUM(montant_paye) AS mt_achat FROM transaction WHERE type = 2 AND MONTH(transaction_date) = $date ";
$statement_achat2 = $connect->prepare($query_achat2);
$statement_achat2->execute();
$result_achat2 = $statement_achat2->fetchAll(PDO::FETCH_OBJ);

foreach ($result_achat as $row_qachat) {
  $qacheter = $row_qachat->qachat;
}
foreach ($result as $row_qvendue) {
  $qvendue = $row_qvendue->qvente;
}
//echo $qacheter;exit;
//$row = $stmt->fetchAll(PDO::FETCH_OBJ);
//echo $sum = $result2->mt;exit;
foreach ($result2 as $row) 
  {
    $sum = $row->mt;
  }

foreach ($result_achat2 as $row_achat2) 
  {
    $sum_achat = $row_achat2->mt_achat;
  }

include ('includes/header.php')
?>
	<div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total ventes (Du mois)</span>
                <span class="info-box-number">
                  <?php if ($qvendue) echo $qvendue; else echo 0;?>
                  <small>Product</small>
                  <small><?php echo "(".number_format($sum, 2, ',', ' ')." CFA)";?></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-ship"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total achat (Du mois)</span>
                <span class="info-box-number">
                  <?php if ($qacheter)echo $qacheter;else echo 0?>
                  <small>Product</small>
                  <small><?php echo "(".number_format($sum_achat, 2, ',', ' ')." CFA)";?></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-dollar-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total depenses (Du mois)</span>
                <span class="info-box-number">0</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-money-bill-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total transactions (Du mois)</span>
                <span class="info-box-number"><?php $total_transaction = $sum + $sum_achat; echo number_format($total_transaction, 2, ',', ' ')." CFA"; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->    
          
          <div class="col-md-6">
              <!-- BAR CHART -->
              <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">Vente VS Achat</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="barChart" style="height:230px; min-height:230px"></canvas>
                    </div>
                  </div>
                  <!-- /.card-body -->
              </div>
              <!-- /.card -->  
          </div>
          <div class="col-md-6">
            <!-- PIE CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Valeur du stock</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
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

<?php include ('includes/footer.php') ?>

