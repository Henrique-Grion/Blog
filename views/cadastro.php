<?php
$PDO = require('./../configuracao/backend.php');
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo BASE_PATH ?>/assets/estiliza.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Lilita+One&display=swap" rel="stylesheet">
    <title>Cadastro</title>
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
    <br><br><br><br><br><br>
    <form id="cadastro" action="<?php echo BASE_PATH ?>/controles/cadastro.php" method="post">
        <label for="nome">Nome</label>
        <input style="margin-left: 130px;" type="text" name="nome" id="nome" required><br>
        <label for="datnas">Data de Nascimento</label>
        <input type="date" name="datnas" id="datnas" required><br>
        <label for="profissao">Profissão</label>
        <input style="margin-left: 86px;" type="text" name="profissao" id="profissao"><br>
        <label for="apel">Apelido</label>
        <input style="margin-left: 111px;" type="text" name="apel" id="apel"><br>
        <label for="email">E-mail</label>
        <input style="margin-left: 120px;" type="email" name="email" id="email"><br>
        <label for="senha">Senha</label>
        <input style="margin-left: 129px;" type="password" name="senha" id="senha"><br><br>
        <button style="margin-left: 296px; height:40px;font-size:20px;font-family:Lilita One,sans;">Cadastrar</button>
    </form>

</body>

</html>