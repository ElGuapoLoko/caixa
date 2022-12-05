<?php



include("pagestyle/header.php");
require_once 'controler/functions.php';


$PDO = db_connect();

$sql_produtos = "SELECT * FROM produtos ";
$stmt = $PDO->prepare($sql_produtos);

$linha = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt->execute();

$index = 0;
$codes = array();
$products = array();

while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $current = array();

    $code = $linha['codigo'];

    $codes[$index] = $code;

    $current["code"] = $linha['codigo'];
    $current["name"] = $linha['nome'];
    $current["price"] = $linha['valor'];

    $products[$code] = $current;

    $index++;

}

?>

<div class="col-sm">

    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-6 mb-7">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informações da compra</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="cartinfo" class="table table-bordered dataTable" id="dataTable"
                                           role="grid"
                                           aria-describedby="dataTable_info" style="width: 100%" width="100%"
                                           cellspacing="0">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" style="width: 177px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">Produto
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" style="width: 269px;"
                                                aria-label="Position: activate to sort column ascending">Código de
                                                Barras
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" style="width: 57px;"
                                                aria-label="Office: activate to sort column ascending">KG
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

                                        <div id="products"><!-- TODO -->

                                            <tr role="row" class="odd">
                                                <td class="sorting_1">-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td class="text-center">
                                                    -
                                                </td>
                                            </tr>

                                        </div>

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
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informações</h6>
                </div>
                <div class="card-body">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">

                        <form id="form_cart">

                            <div class="form-group">
                                <label>Nome do Produto</label>
                                <input type="text" class="form-control"
                                       aria-describedby="emailHelp" disabled autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Código do Produto</label>
                                <input type="text" class="form-control"
                                       aria-describedby="emailHelp" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Peso (KG)/Unidade</label>
                                <input type="text" class="form-control"
                                       autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>Valor por KG/Unidade</label>
                                <input type="text" class="form-control"
                                       disabled autocomplete="off">
                            </div>

                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </form>

                        <div class="col-xl-5 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total
                                                da Compra
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalCart">R$ 0,00
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="text-center">

                        <a href="#" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                            </span>

                            <span class="text" id="finishBuy">Finalizar Compra</span>
                        </a>

                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

<script>

    $(document).ready(function () {

        var cartValue = 0;

        var form = document.getElementById("form_cart");
        var finishBuy = document.getElementById("finishBuy");
        var inCart = new Map();

        var products = new Set();
        downloadProducts();

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

        form.addEventListener('submit', function (event) {

            event.preventDefault();

            var codeProduct = form.elements[1].value;
            var kg = form.elements[2].value.replace(',', '.');

            var price_per_kg = form.elements[3].value.replace("R$ ", '').replace(',', '.');

            if (codeProduct.length > 0) {
                if(isNaN(parseInt(codeProduct))) {

                    Toast.fire({
                        icon: 'error',
                        title: 'Insira um código válido'
                    });

                    return;

                } else if(isNaN(parseFloat(kg))){

                    Toast.fire({
                        icon: 'error',
                        title: 'Insira um KG/Unidade válido'
                    });

                    return;

                } else {

                    if(products.has(parseInt(codeProduct))){

                        Toast.fire({
                            icon: 'success',
                            title: 'Produto adicionado ao carrinho'
                        });


                        var tableRef = document.getElementById('cartinfo').getElementsByTagName('tbody')[0];

                        if (inCart.size <= 0) {

                            var table = document.getElementById('cartinfo');
                            for (var i = inCart.size; i < table.rows.length; i++) {
                                table.deleteRow(i + 1);
                            }

                        }

                        var name = form.elements[0].value;
                        var code = form.elements[1].value;
                        var price = parseFloat(form.elements[3].value);
                        var unity = parseFloat(form.elements[2].value);

                        cartValue += price;

                        var cart = document.getElementById("totalCart");

                        cart.innerText = 'R$ ' + cartValue.toFixed(2);

                        if (inCart.has(parseInt(code))) {
                            var product_cart = inCart.get(parseInt(code));
                            product_cart["price"] = (parseFloat(product_cart["price"]) + price).toFixed(2);
                            product_cart["unity"] = (parseFloat(product_cart["unity"]) + unity).toFixed(2);

                            var newRow = tableRef.rows[findInRow(code)];
                            newRow.innerHTML = productHtml(product_cart["name"], product_cart["code"], product_cart["unity"], product_cart["price"]);

                        } else {
                            var size = tableRef.rows.length;
                            var newRow = tableRef.insertRow(size);
                            var json = JSON.parse("{\"name\": \"" + name + "\", \"code\": " + code + ", \"unity\": \"" + unity + "\", \"price\": \"" + price + "\"}");
                            newRow.innerHTML = productHtml(name, code, unity, price);
                            inCart.set(parseInt(code), json);
                        }

                        form.elements[0].value = "";
                        form.elements[1].value = "";
                        form.elements[2].value = "";
                        form.elements[3].value = "";

                    } else {

                        Toast.fire({
                            icon: 'error',
                            title: 'Produto não encontrado'
                        });

                    }

                }

            } else {

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

                Toast.fire({
                    icon: 'error',
                    title: 'Insira o código do produto'
                })

            }


        })

        finishBuy.addEventListener("click", function () {

            if (inCart.size <= 0) {
                Swal.fire({
                    title: 'Não há itens no carrinho!',
                    icon: 'error',
                    timer: 3000,
                });
                return;
            }

            Swal.fire({
                title: 'Você deseja finalizar a compra?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1cc88a',
                cancelButtonColor: '#e74a3b',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Finalizar compra'
            }).then((result) => {

                if (result.value) {

                    Swal.fire({
                        title: 'Escolha o método de pagamento',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#1cc88a',
                        cancelButtonColor: '#4E73DF',
                        cancelButtonText: 'Cartão',
                        confirmButtonText: 'Dinheiro'
                    }).then((result) => {

                        if (result.value) {
                            //Dinheiro

                            Swal.fire({
                                title: 'Valor',
                                input: 'text',
                                inputAttributes: {
                                    autocapitalize: 'off'
                                },
                                showCancelButton: true,
                                confirmButtonText: 'Calcular',
                                cancelButtonText: 'Cancelar',
                                cancelButtonColor: '#e74a3b',
                                showLoaderOnConfirm: true,
                                preConfirm: (login) => {//response.statusText //   return isNaN(response.statusText);

                                    var client = parseFloat(login.replace(',', '.'));

                                    if (!isNaN(client)) {

                                        if (client >= cartValue) {
                                            Swal.fire(
                                                'Troco: R$ ' + (client - cartValue).toFixed(2).replace(".", ","),
                                                '',
                                                'warning'
                                            )

                                            clearCart('Dinheiro', (client - cartValue).toFixed(2));

                                        } else {
                                            Swal.showValidationMessage(
                                                `Valor inserido incorretamente`
                                            )
                                        }
                                    } else {
                                        Swal.showValidationMessage(
                                            `Insira um número válido`
                                        )
                                    }
                                }
                            });

                        } else {
                            Swal.fire(
                                'O total da compra é de: R$' + cartValue.toFixed(2).replace(".", ","),
                                '',
                                'warning'
                            )
                            clearCart('Cartão', cartValue.toFixed(2));
                        }

                    })

                }

            })

        });


        form.elements[1].addEventListener('input', function () {

            var value = form.elements[1].value;

            if (value.length >= 4) {
                if (products.has(parseInt(value))) {
                    validateProduct(value);
                } else {
                    form.elements[0].value = '';
                    form.elements[2].value = '';
                    form.elements[3].value = '';
                }
            } else if (value.length == 3) {
                form.elements[0].value = '';
                form.elements[2].value = '';
                form.elements[3].value = '';
            }

        });

        form.elements[2].addEventListener('input', function () {

            var value = parseFloat(form.elements[2].value.replace(",", "."));
            var price = priceProduct();

            if (!isNaN(value) && !isNaN(price)) {
                form.elements[3].value = parseFloat(value * price).toFixed(2);
            }

        });


        $("#cartinfo").on('click', '.actionButton', function () {
            var row = $(this).closest('tr');

            var code = row.find("td:eq(1)").text();

            var rows = document.getElementById('cartinfo').getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            var position = 0;

            for (i = 0; i < rows.length; i++) {
                rows[i].onclick = function () {
                    position = this.rowIndex + 1;
                }
            }

            removeFromCart(code, position);

        });


        function productHtml(name, code, weight, price) {


            return '<tr role="row" class="odd">' +
                '<td class="sorting_1">' + name + '</td>' +
                '<td>' + code + '</td>' +
                '<td>' + weight + '</td>' +
                '<td>R$ ' + price + '</td>' +
                '<td class="text-center">' +
                '<button href="#" class="btn btn-danger btn-circle btn-sm actionButton" title="Remover Produto">' +
                '<i class="fas fa-trash"></i>' +
                '</button>' +
                '</td>' +
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

        function downloadProducts() {
            var index = <?php echo json_encode($codes); ?>;

            for (var i = 0; i < index.length; i++) {
                if (parseInt(index[i])) {
                    products.add(parseInt(index[i]));
                }
            }

        }

        function validateProduct(code) {

            var index = <?php echo json_encode($products); ?>;

            var product = index[code];

            console.log(product);

            form.elements[0].value = product["name"];
            form.elements[2].value = parseInt("1");

            form.elements[3].value = product["price"].toString().replace(",", ".");

        }

        function priceProduct() {
            var index = <?php echo json_encode($products); ?>;

            var product = index[form.elements[1].value];
            return parseFloat(product["price"].replace(",", "."));
        }

        function removeFromCart(code, position) {

            var table = document.getElementById('cartinfo');

            code = parseInt(code);

            if (inCart.has(code)) {
                var json = inCart.get(code);
                var price = json["price"];
                table.deleteRow(position + 1);

                cartValue -= price;

                var cart = document.getElementById("totalCart");

                cart.innerText = 'R$ ' + cartValue.toFixed(2);

                inCart.delete(code);

                if (inCart.size == 0) {
                    var size = table.rows.length;
                    var newRow = table.insertRow(size);
                    newRow.innerHTML = clean();
                }

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

                Toast.fire({
                    icon: 'success',
                    title: 'Produto removido do carrinho'
                });

            }

        }


        function findInRow(primal) {

            var table_code = 0;

            $('table > tbody > tr').each(function (index, tr) {

                var $row = $(this).closest("tr"),
                    $tds = $row.find("td:nth-child(2)");

                $.each($tds, function () {
                    var code = $(this).text();

                    if (code == primal) {
                        table_code = index;
                        return index;
                    }
                });
            });

            return table_code;
        }

        function clearCart(gateway, total_change) {

            insertValue(gateway, total_change);

            cartValue = 0;
            var cart = document.getElementById("totalCart");
            cart.innerText = 'R$ 0,00';

            form.elements[0].value = "";
            form.elements[1].value = "";
            form.elements[2].value = "";
            form.elements[3].value = "";

            //Clear Table

            var table = document.getElementById('cartinfo');

            while (table.rows.length > 1) {
                table.deleteRow(1);
            }

            var newRow = table.insertRow(table.rows.length);
            newRow.innerHTML = clean();

            inCart = new Map();

        }

        function insertValue(gateway, total_change) {

            var json = '{';

            for (let value of inCart.values()) {
                json += '\"' + value['code'] + '\": ' + JSON.stringify(value) +',';
            }

            json = json.substring(0, json.length - 1);

            json += '}';

            var data = "json=" + json + "&total=" + cartValue.toFixed(2) + "&gateway=" + gateway + "&total_change=" + total_change;

            $.ajax({
                type: 'POST',
                url: '/controler/insertSale.php',
                dataType: 'text',
                data: data,
                success: function (result) {
                    console.log(result);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert("Error");
                }
            })

        }

    })

</script>

<?php include("pagestyle/footer.php") ?>
