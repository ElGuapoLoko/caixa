<?php 
include("pagestyle/header.php") ;
require_once 'controler/functions.php';

$totaldespesa = 0;
$totalvendas  = 0;
$PDO          = db_connect();

$mes      = date("n");

    
    $sql_despesas = "SELECT * FROM despesas WHERE  data2 = :data2  ; ";
    $stmt         = $PDO->prepare($sql_despesas);

    $stmt->bindParam(':data2', $mes);

    $stmt->execute();
    
    while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        $totaldespesa += (double) $linha['valor'];
        
        
        
    }
    
    $selers = array();
    
    $sql_despesas = "SELECT * FROM sales WHERE  month = :data2  ; ";
    $stmt         = $PDO->prepare($sql_despesas);
 
    $stmt->bindParam(':data2', $mes);
 
    $stmt->execute();
    
    while ($linha2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        $totalvendas += (double) $linha2['total_change'];
        
    }
    
    


?>

<div class="col-lg-12">

    <div class="row" style="margin-left:-370px;">

        <div class="col-xl-3 col-md-6 mb-4"></div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total de Vendas  ( Mensal )</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$<?php echo $totalvendas; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-suitcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		
		        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total de Despesas  ( Mensal )</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$<?php echo $totaldespesa; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">LUCRO  ( Mensal )</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$<?php echo $totalvendas-$totaldespesa; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		

    </div>

</div>


<?php include("pagestyle/footer.php") ?>
