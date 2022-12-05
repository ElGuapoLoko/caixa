<?php

include("pagestyle/header.php");

require_once 'controler/functions.php';

$PDO = db_connect();
 
$sql_produtos = "SELECT * FROM produtos ";
$stmt = $PDO->prepare($sql_produtos);
 

$stmt->execute();

$types = array();
$aux= ''; 

 ?>

<div class="col-lg-12 ">

    <!-- Project Card Example -->
    <div class="card shadow mb-lg-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Controle de Estoque</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="stock" role="grid" aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 177px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Produto</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 269px;" aria-label="Position: activate to sort column ascending">Código do Produto</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 57px;" aria-label="Office: activate to sort column ascending">KG/Unidade</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 269px;" aria-label="Age: activate to sort column ascending">Valor</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 118px;" aria-label="Start date: activate to sort column ascending">Editar</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php

                                if ($stmt->rowCount() == 0) {
                                    echo '' .
                                        "<td width='140'> -</td>" .
                                        "<td width='340'> - </td>" .
                                        "<td width='240'>-</td>" .
                                        "<td width='240'> -</td>" .
                                        "<td widht='240' class='text-center'>-</td>" .
                                        "</tr>";
                                } else {

                                    while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
													
													if($linha['medida'] === "Peso")
												{
													$aux = "Kilos" ; 
													
												}else
												{
													$aux = "Unidades" ;
													
												}

                                        $types[$linha['codigo']] = $linha['medida'];

                                        echo '' .
                                            "<td width='140'> {$linha['nome']}</td>" .
                                            "<td width='340'> {$linha['codigo']} </td>" .
                                            "<td width='240'>{$linha['quantidade']} | $aux </td>" .
                                            "<td width='240'>R$ {$linha['valor']}</td>" .
                                            "<td widht='240' class='text-center'><button href='#' class='btn btn-info btn-circle btn-sm actionButton' title='Remover Produto'><i class='fas fa-pencil-alt'></i></button></td>" .
                                            "</tr>";

                                    }

                                }

                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        $("#stock").on('click', '.actionButton', function (event) {

            event.preventDefault();

            var row = $(this).closest('tr');
            var code = row.find("td:eq(1)").text();

            Swal.fire({
                title: 'Alterar KG/Unidade',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Salvar',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {//response.statusText //   return isNaN(response.statusText);

                    if(!isNaN(login.replace(',', ".")) && login.length > 0){

                        var data = "id=" + parseInt(code) + "&amount=" + login;

                        $.ajax({
                            type: 'POST',
                            url: 'controler/updateStock.php',
                            dataType: 'text',
                            data: data,
                            success: function (result) {

                                var json = <?php echo json_encode($types)?>;

                                row.find("td:eq(2)").text(login + " | " + json[parseInt(code)]);

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Alteração realizada com sucesso!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                            },
                        });

                    } else {
                        Swal.showValidationMessage(
                            `Insira um número válido`
                        )
                    }
                }
            });

        });

        // var button =  document.getElementById('teste');
        //
        // button.addEventListener('click', function () {
        //

        // });

    })

</script>

<?php include("pagestyle/footer.php") ?>
