<?php


include("pagestyle/header.php");

require_once 'controler/functions.php';

$PDO = db_connect();

$sql_despesas = "SELECT * FROM despesas ";
$stmt = $PDO->prepare($sql_despesas);


$stmt->execute();


?>

<form id="insertOutGoing">
    <center>

        <div class="col-lg-7 ">

            <div class="card shadow mb-lg-5">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Cadastro de Despesa</h6>
                </div>

                <div class="card-body" id="cardinfo">

                    <form id="form_cart">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Valor da Despesa R$</label>
                            <input name="valor" type="text" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descrição</label>
                            <textarea name="descricao" class="form-control" id="exampleFormControlTextarea1"
                                      rows="2"></textarea>
                        </div>

                        <button class="btn btn-success btn-icon-split" type="submit">
                        <span class="icon text-white-50">
                           <i class="fas fa-check"></i>
                        </span>

                            <span class="text" id="finishBuy">Cadastrar Despesa</span>
                        </button>
                    </form>


                </div>

            </div>

        </div>

    </center>
</form>



<div class="col-lg-12">

    <div class="card shadow mb-lg-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Despesas Registradas</h6>
        </div>

        <div class="card-body" id="cardinfo">

            <div class="row">
                <table class="table table-bordered dataTable" id="outgoing" role="grid"
                       aria-describedby="dataTable_info"
                       style="width: 100%;" width="100%" cellspacing="0">
                    <tr role='row' class='odd'>
                        <td width="70" class="text-center"> ID</td>
                        <td class="text-center"> Descrição</td>
                        <td width="240" class="text-center"> Valor</td>
                        <td width='240' class="text-center"> Data</td>
                        <td widht='50' class="text-center">Deletar</td>
                    </tr>


                    <?php

                    if($stmt->rowCount() == 0){
                        echo '' .
                            "<td width='140'> -</td>" .
                            "<td width='340'> - </td>" .
                            "<td width='240'>-</td>" .
                            "<td width='240'> -</td>" .
                            "<td widht='240' class='text-center'>-</td>" .
                            "</tr>";
                    } else {
                        while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '' .
                                "<td width='140'> #{$linha['id']}</td>" .
                                "<td width='340'> {$linha['descricao']} </td>" .
                                "<td width='240'>R$ {$linha['valor']}</td>" .
                                "<td width='240'> {$linha['data_despesa']}</td>" .
                                "<td widht='240' class='text-center'><button href='#' class='btn btn-danger btn-circle btn-sm actionButton' title='Remover Produto'><i class='fas fa-trash'></i></button></td>" .
                                "</tr>";
                        }
                    }

                    ?>

                </table>

            </div>
        </div>
    </div>
</div>


<script>

    $(document).ready(function () {

        var insertOutGoing = document.getElementById("insertOutGoing");

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        insertOutGoing.addEventListener('submit', function (event) {

            event.preventDefault();

            var price = insertOutGoing.elements[0].value.replace(',', '.');
            var description = insertOutGoing.elements[1].value;

            if(price.length <= 0 || description.length <= 0){

                Toast.fire({
                    icon: 'error',
                    title: 'Preencha todos os campos'
                });

            } else {

                if(isNaN(parseInt(price))){
                    Toast.fire({
                        icon: 'error',
                        title: 'Insira um número válido'
                    });
                    return;
                }

                var data = "valor=" + price + "&descricao=" + description;

                $.ajax({
                    type: 'POST',
                    url: '/controler/insertExpense.php',
                    dataType: 'text',
                    data: data,
                    success: function (result) {

                        if(result == 0){
                            Swal.fire(
                                'Erro ao cadastrar a despesa, favor entrar em contato com o suporte',
                                '',
                                'error'
                            )
                        } else {
                            var json = JSON.parse(result);

                            Swal.fire({
                                icon: 'success',
                                title: 'Despesa cadastrada com sucesso!',
                                showConfirmButton: false,
                                timer: 3000
                            })

                            var count = <?php echo $stmt->rowCount()?>;

                            if(count == 0){
                                var tableRef = document.getElementById('outgoing').getElementsByTagName('tbody')[0];
                                tableRef.deleteRow(1);
                            }

                            insertOutGoing.elements[0].value = "";
                            insertOutGoing.elements[1].value = "";

                            insertTable(json["id"], description, price, json["date"]);
                        }

                    },
                })

            }

        });


        $("#outgoing").on('click', '.actionButton', function (event) {

            event.preventDefault();

            var row = $(this).closest('tr');
            var code = row.find("td:eq(0)").text().replace("#", '');

            var position = this.parentNode.parentNode.rowIndex;

            var data = "id=" + code;

            $.ajax({
                type: 'POST',
                url: '/controler/removeExpense.php',
                dataType: 'text',
                data: data,
                success: function (result) {

                    if(result == 0){
                        Swal.fire(
                            'Erro ao remover a despesa, favor entrar em contato com o suporte',
                            '',
                            'error'
                        )
                    } else {
                        var json = JSON.parse(result);

                        Swal.fire({
                            icon: 'success',
                            title: 'Despesa removida com sucesso!',
                            showConfirmButton: false,
                            timer: 3000
                        })

                        var tableRef = document.getElementById('outgoing').getElementsByTagName('tbody')[0];
                        tableRef.deleteRow(position);

                        if(tableRef.rows.length <= 1){
                            var size = tableRef.rows.length;
                            var newRow = tableRef.insertRow(size);

                            newRow.innerHTML = clean();
                        }

                        //insertTable(json["id"], description, price, json["date"]);
                    }

                },
            })


        });

        function insertTable(id, description, price, date) {

            var tableRef = document.getElementById('outgoing').getElementsByTagName('tbody')[0];

            var size = tableRef.rows.length;
            var newRow = tableRef.insertRow(size);

            newRow.innerHTML = htmlRow(id, description, price, date);

        }

        function htmlRow(id, description, price, date) {
            return "<td width='140'> #" + id + "</td>" +
            "<td width='340'> " + description + " </td>" +
            "<td width='240'>R$ " + price + "</td>" +
            "<td width='240'> "+ date + "</td>" +
            "<td widht='240' class='text-center'><button href='#' class='btn btn-danger btn-circle btn-sm actionButton' title='Remover Produto'><i class='fas fa-trash'></i></button></td>" +
            "</tr>"
        }

        function clean() {
            return '<tr role="row" class="odd">' +
                '<td class="sorting_1">-</td>' +
                '<td>-</td>' +
                '<td>-</td>' +
                '<td>-</td>' +
                '<td class="text-center">-</td>' +
                '</tr>'
        }

    });

</script>

<?php include("pagestyle/footer.php") ?>
