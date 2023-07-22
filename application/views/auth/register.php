<!DOCTYPE html>
<html>
<head>
    <title>Register - Seu título aqui</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=swap" rel="stylesheet">
    <link href="<?php echo base_url('html/assets/adminlte/dist/css/adminlte.min.css'); ?>" rel="stylesheet">
</head>
<body class="hold-transition register-page dark-mode">
<div class="register-box">
        <div class="register-logo">
            <a href="#"><b>Unifica</b>Tech</a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new user</p>
                <form id="register-form">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="button" id="btn-register" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                </form>
                <!-- Exibir mensagem de sucesso ou erro de validação -->
                <div id="register-message" class="mt-3"></div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('html/assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('html/assets/adminlte/dist/js/adminlte.min.js'); ?>"></script>

    <script>
        $(document).ready(function () {
            // Quando o botão de registro é clicado
            $('#btn-register').click(function () {
                // Obtém os valores do formulário
                var email = $('input[name="email"]').val();
                var password = $('input[name="password"]').val();
                var confirm_password = $('input[name="confirm_password"]').val();

                // Envia os dados ao servidor através do AJAX
                $.ajax({
                    url: '<?php echo site_url("auth/ajax_register"); ?>',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        email: email,
                        password: password,
                        confirm_password: confirm_password
                    },
                    success: function (response) {
                        if (response.success) {
                            // Exibe mensagem de sucesso
                            $('#register-message').html('<div class="alert alert-success">User registered successfully. Redirecting to login page...</div>');
                            // Redireciona para a página de login após 2 segundos
                            setTimeout(function () {
                                window.location.href = '<?php echo site_url("auth"); ?>';
                            }, 2000);
                        } else {
                            // Exibe mensagem de erro de validação
                            $('#register-message').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>