<?php
$PDO = require('./../configuracao/backend.php');

if (isset($_SESSION['logado']) && $_SESSION['logado']) {
    header('Location: ' . BASE_PATH . '/index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo BASE_PATH ?>/assets/estiliza.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Lilita+One&display=swap" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <div class="head">
        <img style="margin-left:50px;" src="https://cdn-icons-png.flaticon.com/512/3069/3069224.png" width="100" height="100">
        <text class="title">Elephant Blog</text>
    </div>
    <div style="color: red; font-weight: bold">
    <?php
        if (isset($_SESSION['erro']) && strlen($_SESSION['erro'])) {
    ?>
            Erro! <?php echo $_SESSION['erro'] ?>
    <?php
            unset($_SESSION['erro']);
        }
    ?>
    </div>
    <div class="login">
        <form action="<?php echo BASE_PATH ?>/controles/login.php" method="post">
            <label for="email">E-mail</label>
            <input style="margin:3px;" type="email" name="email" required>
            <br>
            <label for="senha">Senha</label>
            <input style="margin:3px; margin-left:13px;" type="password" name="senha" required>
            <br><br>
            <button style="margin-left:181px;font-family:Lilita One,sans;width: 100px;height:50px;font-size:20px;">Entrar</button>
        </form>
    </div>
    <p style="text-align: center;font-family:Concert One,sans;font-size:20px;">
        Caso não possua uma conta clique <a href="<?php echo BASE_PATH ?>/views/cadastro.php">aqui</a> para se cadastrar
    </p>
</body>

</html>