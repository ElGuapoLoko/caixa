<?php


include("pagestyle/header.php");

require_once 'controler/functions.php';

$PDO = db_connect();

$sql_produtos = "SELECT * FROM produtos ";
$stmt = $PDO->prepare($sql_produtos);

$stmt->execute();

$index = 0;
$codes = array();

$products = array();

?>

<div class="col-sm">

    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-6 mb-7">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Produtos Cadastrados</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="products" class="table table-bordered dataTable" id="dataTable"
                                           role="grid"
                                           aria-describedby="dataTable_info" style="width: 100%;" width="100%"
                                           cellspacing="0">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" style="width: 177px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">Produto
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" style="width: 269px;"
                                                aria-label="Position: activate to sort column ascending">Código do
                                                produto
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" style="width: 57px;"
                                                aria-label="Office: activate to sort column ascending">KG/Unidade
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" style="width: 269px;"
                                                aria-label="Age: activate to sort column ascending">Valor
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" style="width: 118px;"
                                                aria-label="Start date: activate to sort column ascending">Ação
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
										$aux = '' ; 
								
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

                                                $code = $linha['codigo'];

                                                $codes[$index] = $code;

                                                array_push($products, $linha['codigo']);
                                                array_push($products, $linha['nome']);

                                                echo '' .
                                                    "<td width='140'> {$linha['nome']}</td>" .
                                                    "<td width='340'> {$linha['codigo']} </td>" .
                                                    "<td width='240'>{$linha['quantidade']} | $aux  </td>" .
                                                    "<td width='240'>R$ {$linha['valor']}</td>" .
                                                    "<td widht='240' class='text-center'><button href='#' class='btn btn-danger btn-circle btn-sm actionButton' title='Remover Produto'><i class='fas fa-trash'></i></button></td>" .
                                                    "</tr>";
                                            }
                                        }

                                        ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <!-- Illustrations -->

            <div class="card  mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Cadastrar novo produto</h6>
                </div>
                <div class="card-body">

                    <div class="text-center">

                        <center>

                            <div class="col-sm-6">

                                <form id="register_product">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nome do Produto</label>
                                        <input name="nome" type="text" class="form-control"
                                               aria-describedby="emailHelp" autocomplete="off">
                                    </div>

                                    <div class="form-group">

                                        <label for="exampleInputEmail1">Código do produto</label>
                                        <div class="input-group">
                                            <input id="productCode" type="text" class="form-control" aria-label="Search"
                                                   aria-describedby="basic-addon2" autocomplete="off">
                                            <div class="input-group-append">
                                                <button id="generateRandomID" class="btn btn-primary" type="button"
                                                        title="Gerar Código do produto">
                                                    <i class="fas fa-redo-alt"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Preço R$ / Unidade , Kg</label>
                                        <input name="valor" type="text" class="form-control"
                                               aria-describedby="emailHelp" autocomplete="off">
                                    </div>

                                    <div class="dataTables_length" id="dataTable_length">

                                        <label for="exampleInputEmail1">Unidade de Medida</label>
                                        <select name="medida" aria-controls="dataTable"
                                                class="custom-select custom-select form-control form-control">
                                            <option value="Unidade">Unidade</option>
                                            <option value="Peso">Peso (KG)</option>
                                        </select>

                                        <div class="form-group" style="margin-top:15px;">
                                            <label for="exampleInputEmail1">Quantidade </label>
                                            <input name="quantidade" type="text" class="form-control"
                                                   aria-describedby="emailHelp" autocomplete="off">
                                        </div>

                                    </div>

                                    <div class="card-body ">
                                        <button class="btn btn-success btn-icon-split" type="submit">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>

                                            <span class="text" id="finishBuy">Cadastrar Produto</span>
                                        </button>
                                    </div>

                                </form>

                            </div>

                        </center>

                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

<script>

    $(document).ready(function () {

        var form = document.getElementById("register_product");
        var random = document.getElementById("generateRandomID");
        var productCode = document.getElementById("productCode");

        var products = <?php echo json_encode($products); ?>;
        var filter = new Set();

        for(var i = 0; i < products.length; i++){
            filter.add(products[i]);
        }

        form.reset();

        form.addEventListener('submit', function (event) {

            event.preventDefault();

            var nameProduct = form.elements[0].value;
            var code = form.elements[1].value;
            var price = form.elements[3].value;
            var measure = form.elements[4].value;
            var amount = form.elements[5].value;

            if (nameProduct.length > 0 && code.length > 0 && price.length > 0) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                if(isNaN(parseInt(code)) || isNaN(parseFloat(price)) || isNaN(parseFloat(amount))){

                    Toast.fire({
                        icon: 'error',
                        title: 'Informe um número válido'
                    });

                    if(isNaN(parseInt(code))){
                        form.elements[1].classList.add('is-invalid');
                    }

                    if(isNaN(parseFloat(price))){
                        form.elements[3].classList.add('is-invalid');
                    }

                    if(isNaN(parseFloat(amount))){
                        form.elements[5].classList.add('is-invalid');
                    }

                    return;
                }

                if(filter.has(nameProduct)){
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro ao cadastrar o produto!',
                        text: 'Já existe um produto com este nome cadastrado.',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    return;
                }

                if(filter.has(code)){
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro ao cadastrar o produto!',
                        text: 'Já existe um produto com este código.',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    return;
                }

                var data = "nome=" + nameProduct + "&codigo=" + code + "&valor=" + price + "&medida=" + measure + "&quantidade=" + amount;

                $.ajax({
                    type: 'POST',
                    url: 'controler/insertProduct.php',
                    dataType: 'text',
                    data: data,
                    success: function (result) {

                        if (result == 0) {
                            Swal.fire(
                                'Erro ao inserir o produto, favor entrar em contato com o suporte',
                                '',
                                'error'
                            )
                        } else {

                            Swal.fire({
                                icon: 'success',
                                title: 'Produto cadastrado com sucesso!',
                                showConfirmButton: false,
                                timer: 3000
                            });

                            var tableRef = document.getElementById('products').getElementsByTagName('tbody')[0];

                            if (filter.size <= 0) {
                                tableRef.rows[0].innerHTML = product(nameProduct, code, measure, parseFloat(price.replace(',', '.')), amount);

                            } else {
                                var newRow = tableRef.insertRow(tableRef.rows.length);
                                newRow.innerHTML = product(nameProduct, code, measure, parseFloat(price.replace(',', '.')), amount);
                            }

                            filter.add(code);
                            filter.add(nameProduct);

                        }

                    },
                });

                form.reset();

            } else {

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'error',
                    title: 'Preencha todos os campos'
                });

                if (nameProduct.length <= 0) {
                    form.elements[0].classList.add('is-invalid');
                }

                if (code.length <= 0) {
                    form.elements[1].classList.add("is-invalid");
                }

                if (price.length <= 0) {
                    form.elements[3].classList.add("is-invalid");
                }

                if (amount.length <= 0) {
                    form.elements[5].classList.add("is-invalid");
                }

            }

        });

        random.addEventListener("click", function () {

            var randomID = (Math.random() * (9999 - 1000) + 1000).toFixed();

            productCode.value = randomID;

            if(form.elements[1].classList.contains('is-invalid')){
                form.elements[1].classList.remove('is-invalid');
            }

        });

        //Nome
        form.elements[0].addEventListener('input', function () {

            var element = form.elements[0];
            var nameProduct = element.value;

            if (nameProduct.length >= 5 && element.classList.contains('is-invalid')) {
                element.classList.remove('is-invalid');
            }

        });

        //Code
        form.elements[1].addEventListener('input', function () {

            var element = form.elements[1];
            var nameProduct = element.value;

            if (nameProduct.length >= 4 && element.classList.contains('is-invalid') && !isNaN(nameProduct)) {
                element.classList.remove('is-invalid');
            }

        });


        //Price
        form.elements[3].addEventListener('input', function () {

            var element = form.elements[3];
            var nameProduct = element.value;

            if (nameProduct.length >= 4 && element.classList.contains('is-invalid')) {
                element.classList.remove('is-invalid');
            }

        });

        //Price
        form.elements[5].addEventListener('input', function () {

            var element = form.elements[5];
            var nameProduct = element.value;

            if (!isNaN(parseInt(nameProduct)) && nameProduct.length >= 1 && element.classList.contains('is-invalid')) {
                element.classList.remove('is-invalid');
            }

        });

        $("#products").on('click', '.actionButton', function (event) {

            //event.preventDefault();

            var row = $(this).closest('tr');
            var code = row.find("td:eq(1)").text();
            var name_product = row.find("td:eq(0)").text();

            var position = this.parentNode.parentNode.rowIndex - 1;

            var data = "id=" + parseInt(code);

            $.ajax({
                type: 'POST',
                url: 'controler/removeProduct.php',
                dataType: 'text',
                data: data,
                success: function (result) {

                    if (result == 0) {
                        Swal.fire(
                            'Erro ao remover o produto, favor entrar em contato com o suporte',
                            '',
                            'error'
                        )
                    } else {

                        Swal.fire({
                            icon: 'success',
                            title: 'Produto removido com sucesso!',
                            showConfirmButton: false,
                            timer: 3000
                        });

                        filter.delete(code);
                        filter.delete(name_product);

                        var tableRef = document.getElementById('products').getElementsByTagName('tbody')[0];
                        tableRef.deleteRow(position);

                        if (filter.size <= 0) {
                            var size = tableRef.rows.length;
                            var newRow = tableRef.insertRow(size);

                            newRow.innerHTML = clean();
                        }

                    }

                },
            })


        });

        //products


        function product(product, code, measurement, price, unity) {
            return '<tr role="row" class="odd">' +
                '<td class="sorting_1">' + product + '</td>' +
                '<td>' + code + '</td>' +
                '<td>' + unity + " | " + measurement + '</td>' +
                '<td>R$ ' + price + '</td>' +
                "<td widht='240' class='text-center'><button href='#' class='btn btn-danger btn-circle btn-sm actionButton' title='Remover Produto'><i class='fas fa-trash'></i></button></td>" +
                '</tr>'
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
