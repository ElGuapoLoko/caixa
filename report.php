<?php

include("pagestyle/header.php") ?>

<div class="col-lg-12">

    <div class="card shadow mb-lg-5">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Realizar Consulta</h6>
        </div>

        <form method="POST" action="report2.php">
            <div class="card-body" id="cardinfo">

                <div class="row">

                    <div class="col-md-3">
                        <div class="dataTables_length" id="dataTable_length">

                            <label for="exampleInputEmail1">Dia</label>
                            <select name="dia" class="custom-select custom-select form-control form-control">
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="dataTables_length" id="dataTable_length">

                            <label for="exampleInputEmail1">Mês</label>
                            <select name="mes" class="custom-select custom-select form-control form-control">
                                <option value=""></option>
                                <option value="1">Janeiro</option>
                                <option value="2">Fevereiro</option>
                                <option value="3">Março</option>
                                <option value="4">Abril</option>
                                <option value="5">Maio</option>
                                <option value="6">Junho</option>
                                <option value="7">Julho</option>
                                <option value="8">Agosto</option>
                                <option value="9">Setembro</option>
                                <option value="10">Outubro</option>
                                <option value="11">Novembro</option>
                                <option value="12">Dezembro</option>
                            </select>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="dataTables_length" id="dataTable_length">

                            <label for="exampleInputEmail1">Ano</label>
                            <select name="ano" class="custom-select custom-select form-control form-control">
                                <option value=""></option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>

                        </div>
                    </div>

                    <div class="col-md-3">

                        <div class="card-body">
                            <button class="btn btn-success btn-icon-split" type="submit">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>

                                <span class="text" id="finishBuy">Realizar Consulta</span>
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </form>

    </div>

</div>

<script>

    // $(document).ready(function () {
    //
    //     var form = document.getElementById('consult');
    //
    //     form.addEventListener('submit', function (event) {
    //
    //         event.preventDefault();
    //
    //         var element = form.elements;
    //         var day = element[0].value;
    //         var month = element[1].value;
    //         var year = element[2].value;
    //
    //         if (day != '' || month != '' || year != '') {
    //
    //             var data = "dia=" + day + "&mes=" + month + "&ano=" + year;
    //
    //             // $.ajax({
    //             //     type: 'POST',
    //             //     url: '/report2.php',
    //             //     dataType: 'text',
    //             //     data: data,
    //             //     success: function (result) {
    //             //         //window.location = '/report2.php';
    //             //     },
    //             //     error: function () {
    //             //         alert("Error");
    //             //     }
    //             // })
    //
    //         } else {
    //             alert("Informe os valores");
    //         }
    //
    //     });
    //
    //
    // });

</script>

<?php include("pagestyle/footer.php") ?>
