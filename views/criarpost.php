<?php
$PDO = require('./../configuracao/backend.php');

$subtemas = [];
try {
    $sql =
        "SELECT
            tema.codtema AS tema_id,
            tema.nome AS nome_tema,
            subtema.codsubtema AS subtema_id,
            subtema.nome AS nome_subtema,
            subtema.codtema AS tema_subtema
        FROM subtema
        JOIN tema ON tema.codtema=subtema.codtema";

    $resultado = $PDO->query($sql);
    $subtemas = $resultado->fetchAll();
} catch (PDOException $e) {
    $_SESSION['erro'] = $e->getMessage();
}
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
    <title>Criar Post</title>
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
    <form id="cria" action="<?php echo BASE_PATH ?>/controles/criarpost.php" method="post">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo" required><br>

        <label for="descricao">Descrição</label>
        <input type="text" name="descricao" id="descricao" required><br>

        <label for="data">Data</label>
        <input type="date" name="data" id="data"><br>


        <label for="subtema">Tema</label>
        <select name="subtema" id="subtema">
            <?php
            for ($j = 0; $j < count($subtemas); $j++) {
            ?>
                <option value="<?php echo $subtemas[$j]['subtema_id'] ?>"><?php echo $subtemas[$j]['nome_tema'] ?> - <?php echo $subtemas[$j]['nome_subtema'] ?></option>
            <?php

            }
            ?>
        </select><br>

        <label>Conteudo</label><br>
        <textarea style="resize:none;" maxlength="1000" name="conteudo" id="conteudo" cols="50" rows="20"></textarea><br>
        <button style="height:30px;font-size:20px;font-family:Lilita One,sans;">Postar</button>
    </form>

</body>

</html>