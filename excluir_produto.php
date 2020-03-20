<?php
session_start();
include_once 'conexao.php';

$id = filter_input(INPUT_GET, 'ref');


$deletar = $pdo->prepare("DELETE FROM carrinho_temporario WHERE temporario_id = :id");
$deletar -> bindValue(':id',$id);
$deletar -> execute();

if ($deletar):
        echo '<script>alert("Este produto foi excluído com sucesso!")</script>';
        echo '<script>window.location="home.php?link=36"</script>';  
    else:
        echo '<script>alert("Produto não foi excluído !")</script>';
        echo '<script>window.location="home.php?link=36"</script>';  
endif;
    
