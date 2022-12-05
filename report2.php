<?php

include("pagestyle/header.php");

require_once 'controler/functions.php';

$totaldespesa = 0;
$totalvendas  = 0;
$PDO          = db_connect();
$dia          = $_POST['dia'];
$mes          = $_POST['mes'];
$ano          = $_POST['ano'];

if ($dia === "" && isset($mes) && isset($ano)) {
    
    $sql_despesas = "SELECT valor FROM despesas WHERE data2 = :data2 AND data3 = :data3 ; ";
    
    $stmt = $PDO->prepare($sql_despesas);
    $stmt->bindParam(':data2', $mes);
    $stmt->bindParam(':data3', $ano);
    $stmt->execute();
    
    while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        $totaldespesa += (double) $linha['valor'];
        
    }
    
    $sql_despesas = "SELECT total FROM sales WHERE month = :data2 AND year = :data3 ; ";
    
    $stmt = $PDO->prepare($sql_despesas);
    $stmt->bindParam(':data2', $mes);
    $stmt->bindParam(':data3', $ano);
    $stmt->execute();
    
    while ($linha2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        $totalvendas += (double) $linha2['total'];
    }
    
}

if ($dia === "" && $mes === "" && isset($ano)) {
    
    $sql_despesas = "SELECT valor FROM despesas WHERE data3 = $ano ; ";
    
    $stmt = $PDO->prepare($sql_despesas);
    $stmt->bindParam(':data3', $ano);
    $stmt->execute();
    
    while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        $totaldespesa += (double) $linha['valor'];
        
        
    }
    
    $sql_despesas = "SELECT total FROM sales WHERE year = :data3 ; ";
    
    $stmt = $PDO->prepare($sql_despesas);
    $stmt->bindParam(':data3', $ano);
    $stmt->execute();
    
    while ($linha2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        $totalvendas += (double) $linha2['total'];
        
        
        
    }
    
}
if ($ano === "") {
    
    echo "<script type=\"text/javascript\">alert(\"Digite um ano valido \"); document.location.href = 'report.php';</script>";
    
    
} elseif (isset($dia) && isset($mes) && isset($ano)) {
    
    
    $sql_despesas = "SELECT * FROM despesas WHERE data1 = :data1 AND data2 = :data2 AND data3= :data3 ; ";
    $stmt         = $PDO->prepare($sql_despesas);
    $stmt->bindParam(':data1', $dia);
    $stmt->bindParam(':data2', $mes);
    $stmt->bindParam(':data3', $ano);
    $stmt->execute();
    
    while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        $totaldespesa += (double) $linha['valor'];
        
        
        
    }
    
    $selers = array();
    
    $sql_despesas = "SELECT * FROM sales WHERE day = :data1 AND month = :data2 AND year = :data3 ; ";
    $stmt         = $PDO->prepare($sql_despesas);
    $stmt->bindParam(':data1', $dia);
    $stmt->bindParam(':data2', $mes);
    $stmt->bindParam(':data3', $ano);
    $stmt->execute();
    
    while ($linha2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        $totalvendas += (double) $linha2['total'];
        
    }
    
    
    
    
}



?>
    <div class="card shadow mb-lg-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Relatorio </h6>
        </div>
        <div class="card-body" id="cardinfo">
            <div class="row">
                <table class="table table-bordered dataTable" id="dataTable" role="grid" aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
                    <tr role='row' class='odd'>
                        <td width="180" class="text-center"> Data </td>
                        <td width="180" class="text-center"> Total Vendas</td>
                        <td width="180" class="text-center"> Total Despesas</td>
                        <td width="180" class="text-center"> Lucro</td>
                    </tr>
                    <tr role='row' class='odd'>
                        <td width="180" class="text-center"><?php echo $dia.'/'.$mes.'/'.$ano ?></td>
                        <td width="180" class="text-center">R$ <?php echo $totalvendas; ?></td>
                        <td width="180" class="text-center">R$ <?php echo $totaldespesa; ?></td>
                        <td width="180" class="text-center">R$ <?php echo $totalvendas - $totaldespesa; ?></td>
                    </tr>
                </table>
            </div>
        </div>

		
    </div>
<?php include("pagestyle/footer.php") ?>