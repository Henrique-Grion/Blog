<?php
$PDO = require('./../configuracao/backend.php');
try {
    if (isset($_POST['acao']) && $_POST['acao'] == 'editar') {
        $sql =
            "UPDATE 
            comentario
        SET
            texto = :texto,
            data = NOW()
        WHERE
            codcomentario = :codcomentario";

        $prepared = $PDO->prepare($sql);

        if (!$prepared->execute([
            'texto' => $_POST['comment'],
            'codcomentario' => $_POST['comentario']
        ])) {
            $_SESSION['erro'] = 'Erro ao editar post!';
        }
    } 
    
    else if(isset($_POST['acao']) && $_POST['acao']=='excluir'){
        $sql=
            "DELETE FROM comentario WHERE codcomentario = :id";
            $prepared = $PDO->prepare($sql);

        if (!$prepared->execute([
            'id'=> $_POST['comentario']
        ])) {
            $_SESSION['erro'] = 'Erro ao editar post!';
        }
    }else {
        header('Location: ' . BASE_PATH . '/views/posts.php?id='. $_POST['post']);
        exit();
    }

} catch (Exception $e) {
    $_SESSION['erro'] = $e->getMessage();
}

header('Location: ' . BASE_PATH . '/views/posts.php?id='. $_POST['post']);
