<?php
 
require_once '../../conexao.php';

$url = filter_input(INPUT_GET, 'ref'); // pegar as informações que vem na url, no caso o id e qual tabela será excluido,  está cliptografado.

if(empty($url))
 {
      // SE A URL ESTIVER VAZIA ENTÃO É UMA INSERÇÃO 
      $insert = new Desc;
      $pdo = $insert->Insert_desc();
     
 }
 else // se a url estiver com alguma coisa 
 {
     $array_campos = array("temp_op","doca","op_inicio","op_fim","placa_carreta",
            "placa_cavalo","valor_carga","origem","manifesto","qtd_volume","equipe");// array com os atributos da tabela descarga, cada elemento desse array é são nomes da coluna da tabela descarga
     $editar = new ExcluirEdita;
     $pdo = $editar->Update($url, $array_campos);
   
     
 }
   $status = $pdo?  "ITEM ALTERADO COM SUCESSO.": "FALHA AO ALTERAR ITEM!"; // verificando se deu certo ou nao  
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/ponto/home.php?link=3'><script type=\"text/javascript\">
               alert(\"".$status."\");
              </script>";   // exibir a mensagem se deu certo ou não e redirecinar para pagina correta

