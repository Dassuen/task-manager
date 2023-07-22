<!DOCTYPE html>
<html>
<head>
    <title>Login - Seu título aqui</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=swap" rel="stylesheet">
    <link href="<?php echo base_url('html/assets/adminlte/dist/css/adminlte.min.css'); ?>" rel="stylesheet">
</head>
<body class="hold-transition login-page dark-mode">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Unifica</b>Tech</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Faça login para começar sua sessão</p>
                <form id="login-form">
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
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">Manter Conectado</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="button" id="btn-login" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
                <!-- Exibir mensagem de erro de validação, se houver -->
                <div id="error-message" class="alert alert-danger mt-3" style="display: none;"></div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('html/assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('html/assets/adminlte/dist/js/adminlte.min.js'); ?>"></script>
    <script>
        $(document).ready(function () {
            // Quando o botão de login é clicado
            $('#btn-login').click(function () {
                // Obtém os valores do formulário
                var email = $('input[name="email"]').val();
                var password = $('input[name="password"]').val();

                // Envia os dados ao servidor através do AJAX
                $.ajax({
                    url: '<?php echo site_url("auth/login"); ?>',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        email: email,
                        password: password
                    },
                    success: function (response) {
                        if (response.success) {
                            // Redireciona para a página de dashboard ou outra página após o login
                            window.location.href = response.redirect;
                        } else {
                            // Exibe a mensagem de erro
                            $('#error-message').html(response.message).show();
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>