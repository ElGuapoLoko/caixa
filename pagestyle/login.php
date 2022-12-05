<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema | Login</title>
    <link rel="icon" href="../admin.png" >

    <script src="../vendor/jquery/jquery.min.js"></script>

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body>

<style>

    body{
        background-color: #3359CA ;
        font-family: 'Roboto', sans-serif;
    }

    @keyframes fadein {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    /* Firefox < 16 */
    @-moz-keyframes fadein {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    /* Safari, Chrome and Opera > 12.1 */
    @-webkit-keyframes fadein {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    /* Internet Explorer */
    @-ms-keyframes fadein {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    /* Opera < 12.1 */
    @-o-keyframes fadein {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

</style>

<div class="d-flex justify-content-center" style="margin-top: 8%" id="tofade">

    <div class="col-sm-4">
        <div class="card text-center">
            <div class="card-body">

                <div class="mb-2"> </div>

                <div class="mb-5">
                    <h5>Alpha Centauri</h5>
                    <div id="response"> </div>
                </div>

                <div class="col-md-10 center" style="display: inline-block;">

                    <form id="form_login">

                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-astronaut"></i></span>
                                </div>
                                <input name="user" class="form-control form-control-alternative" placeholder="Usuário" type="text" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group input-group-alternative mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-fingerprint"></i></i></span>
                                </div>
                                <input name="password" class="form-control form-control-alternative" placeholder="Senha" type="password" autocomplete="off">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-primary">Login</button>

                    </form>

                    <div class="mb-5"></div>

                    <div class="mb-1">
                        <small class="text-muted">Alpha Centauri™</small>
                    </div>

                    <div class="mb-1">
                        <small class="text-muted">Todos os direitos Reservados</small>
                    </div>

                </div>


            </div>
        </div>

    </div>

    <script>

        $(document).ready(function () {

            var form = document.getElementById("form_login");

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
            });

            form.addEventListener('submit', function (event) {

                event.preventDefault();

                var valueUser = form.elements[0].value;
                var valuePassword = form.elements[1].value;

                if((valueUser != "undefined" && valueUser.length > 0) && valuePassword != "undefined" && valuePassword.length > 0){

                    var data = "user=" + valueUser + "&password=" + valuePassword;

                    $.ajax({
                        type: 'POST',
                        url: 'controler/login.php',
                        dataType: 'text',
                        data: data,
                        success: function (result) {

                            if(parseInt(result) == 1){

                                form.reset();

                                Toast.fire({
                                    icon: 'success',
                                    title: 'Usuário logado com sucesso'
                                })

                                $("#tofade").fadeOut(1000, function () {
                                    $(this).remove();
                                });

                                sleep(3000).then(() => {
                                    window.location = '../index.php';
                                });


                            } else {
                                form.reset();

                                Toast.fire({
                                    icon: 'error',
                                    title: 'Usuário e/ou senha inválido!'
                                })
                            }
                        },
                        error:function(xhr, ajaxOptions, thrownError) {
                            alert("Error");
                        }
                    })

                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Preencha todos os campos'
                    })

                    if(valueUser == "undefined" || valueUser.length <= 0){
                        if(!form.elements[0].classList.contains('is-invalid')){
                            form.elements[0].classList.add('is-invalid');
                        }
                    }

                    if(valuePassword == "undefined" || valuePassword.length <= 0){
                        if(!form.elements[1].classList.contains('is-invalid')){
                            form.elements[1].classList.add('is-invalid');
                        }
                    }

                }

            })

            form.elements[0].addEventListener('input', function () {

                if(form.elements[0].classList.contains("is-invalid") && form.elements[0].value.length > 0){
                    form.elements[0].classList.remove("is-invalid");
                }

            });

            form.elements[1].addEventListener('input', function () {

                if(form.elements[1].classList.contains("is-invalid") && form.elements[0].value.length > 0){
                    form.elements[1].classList.remove("is-invalid");
                }

            });

            function sleep (time) {
                return new Promise((resolve) => setTimeout(resolve, time));
            }

        })

    </script>

</body>
</html>