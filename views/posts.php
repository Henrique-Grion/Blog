<?php
$PDO = require('./../configuracao/backend.php');

$post = [];
$comentarios = [];
$id = $_GET['id'];
try {
    $sql =
        "SELECT
            u.nome,
            c.texto,
            c.data,
            c.coduser,
            c.codcomentario
        FROM
            comentario c
            JOIN usuario u ON u.coduser = c.coduser 
        WHERE
            c.codpost = :id";
    $prepared = $PDO->prepare($sql);
    $prepared->execute(['id' => $id]);
    $comentarios = $prepared->fetchAll();

    $sql =
        "SELECT
            c.codpost,
            c.titulo,
            c.descricao,
            c.conteudo,
            c.data,
            c.dataalter,
            c.codtema AS tema_post,
            c.codsubtema AS subtema_post,
            c.coduser,
            u.nome AS usuario
        FROM
            post c
            JOIN usuario u ON u.coduser = c.coduser
        WHERE
            codpost = :id";
    $prepared = $PDO->prepare($sql);
    $prepared->execute(['id' => $id]);
    $post = $prepared->fetch();
} catch (PDOException $e) {
    $_SESSION['erro'] = $e->getMessage();
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
    <title>Users Posts</title>
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
        <a class="but" style="width:100px; margin-left:auto;height:50px;"href="<?php echo BASE_PATH?>/index.php">Feed</a>
        <a class="but" style="
            width:100px;
            margin-top: -62px;
            height: 50px;
            margin-left: 1112px;
        " href="<?php echo BASE_PATH ?>/controles/sair.php">Sair</a>
    <div class="post">
        <h1 style="border-bottom:2px solid black; font-family:Lilita One,sans;"><?php echo $post['titulo'] ?></h1>

        <p>"<?php echo $post['descricao'] ?>"</p>

        <div class="content"><?php echo $post['conteudo'] ?></div>

        <p style="text-align:left;">By <?php echo $post['usuario'] ?> | <?php echo $post['data'] . " last edit: " . $post['dataalter'] ?></p>
        
        <?php if($post['coduser']==$_SESSION['id']){ ?>
        <form action="<?php echo BASE_PATH ?>/controles/excluir.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <button style="color: red;">Excluir</button>
        </form>
        <a href="<?php echo BASE_PATH ?>/views/editar.php?id=<?php echo $id; ?>"><button>Editar</button></a><br>
        <?php
        }
        ?>
    </div>

<!----------------------------- Publica comentario----------------------------------------------------------------->
    <form style="margin:auto;" action="<?php echo BASE_PATH ?>/controles/criarcomentario.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <br>
        <textarea name="comentario" type="text" placeholder="short comment" style="resize:none;width:300px;height:60px;"></textarea>
        <button>publish</button>
    </form>

<!---------------------------SESSÃO DE COMENTÁRIOS----------------------------------------------------------- -->
    <div class="comentario">
        <?php
        for ($i = 0; $i < count($comentarios); $i++) {
        ?>
            <p><?php echo $comentarios[$i]['nome'] ?> - <?php echo $comentarios[$i]['data'] ?>:<br>

                <form action="<?php echo BASE_PATH ?>/controles/manipula_comentario.php"method="post">
                    <textarea name="comment" id="comment" style="resize:none;width:200px;height:75px;"<?php if($comentarios[$i]['coduser']!=$_SESSION['id']){?>readonly disabled<?php } ?>><?php echo $comentarios[$i]['texto'] ?></textarea>
                    <?php
                    if($comentarios[$i]['coduser']==$_SESSION['id']){
                    ?>
                    <input type="hidden" name="comentario" id="comentario" value="<?php echo $comentarios[$i]['codcomentario'] ?>">
                    <input type="hidden" name="post" id="post" value="<?php echo $id ?>">
                    <input type="submit" name="acao" id="acao" value ="editar">
                    <input style="color:red;"type="submit" name="acao" id="acao"value ="excluir">
                    <?php
                    }
                    ?>
                </form>
            </p>
        <?php
        }
        ?>
    </div>

</body>

</html>