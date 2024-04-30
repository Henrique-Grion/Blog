<?php 
$PDO = require('./configuracao/backend.php');

$posts = [];
try {
    $parametros = [];
    $queryParametros = [];

    if(isset($_POST['q']))
    {
        $parametros[] = 'AND titulo LIKE :titulo';
        $queryParametros['titulo'] = "%{$_POST['q']}%";
    }

    $parametros = implode(' ', $parametros);
    $sql =
        "SELECT
            *
        FROM
            post
        WHERE
            1 = 1
            {$parametros}
        ORDER BY data ASC";

    $prepared = $PDO->prepare($sql);
    $prepared->execute($queryParametros);
    $posts = $prepared->fetchAll();
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
    <title>ElephantBlog</title>
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
    <br><br><br><br><br><br><br><br>
<?php
    if (isset($_SESSION['logado']) && $_SESSION['logado']) {
?>
        <a class="but" style="width:100px;text-align:center;
            text-align: center;
            margin-right: 0px;
            margin-left: 931px;
            margin-top: -144px;
            height: 50px;
        " href="<?php echo BASE_PATH ?>/controles/sair.php">Sair</a>
        <a class="but" style="width:280px;text-align:center;
            text-align: center;
            height: 50px;
            margin-left: auto;
            margin-top: -144px;
        " href="<?php echo BASE_PATH ?>/views/criarpost.php">Criar Post</a>
        <form class="search" action="<?php echo BASE_PATH ?>/index.php" method="post">
            <input type="search" name="q" id="q" placeholder="Search title">
            <button>search</button>
        </form>

        <div class="feed">
        <?php
            for ($i = 0; $i < count($posts); $i++) {
        ?>
                <h1><a style="color:black;" href="<?php echo BASE_PATH ?>/views/posts.php?id=<?php echo $posts[$i]['codpost']; ?>"><?php echo $posts[$i]['titulo'] ?></a></h1>
                <p>"<?php echo $posts[$i]['descricao'] ?>"</p>
                <br><br><br>
                ________________________________
                <br><br><br>
        <?php
            }
        ?>
        </div>

    <?php
    } else { ?>
        <p class="ad">
            Fique por dentro de tudo oque acontece no mundo das noticias. <br>Não perca tempo, entre e participe do maior blog de noticias do mundo!
        </p>

        <br><br><br>
        <div class="align">
            <a class="but" href="<?php echo BASE_PATH ?>/views/login.php">Entrar</a>
        </div>
    <?php
    } ?>
</body>

</html>