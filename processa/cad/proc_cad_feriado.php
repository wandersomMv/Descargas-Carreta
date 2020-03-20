<?php
require_once '../../conexao.php';
// pega os dados do formuário

$url = filter_input(INPUT_GET,'ref'); // pegar as informações que vem na url, no caso o id e qual tabela será excluido,  está cliptografado.

if(empty($url))
 {
      // SE A URL ESTIVER VAZIA ENTÃO É UMA INSERÇÃO 
      $feriado = new Feriado;
      $pdo =$feriado->insert_Feriado();
     
 }
 else // se a url estiver com alguma coisa 
 {
     $array_campos = array("temp_feriado","doca_feriado","nome_feriado","placa_carreta_feriado","placa_cavalo_feriado","valor_carga_feriado","origem_feriado",
            "manifesto_feriado","qtd_volume_feriado","equipe_feriado"); // Nomes que estão no formulario e que são os mesmos atributos da tabela feriado no banco de dados
     $editar = new ExcluirEdita;
     $pdo = $editar->Update($url, $array_campos);
   
     
 }
   $status = $pdo?  "ITEM ALTERADO COM SUCESSO.": "FALHA AO ALTERAR ITEM!"; // verificando se deu certo ou nao  
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/ponto/home.php?link=7'><script type=\"text/javascript\">
               alert(\"".$status."\");
              </script>";   // exibir a mensagem se deu certo ou não e redirecinar para pagina correta

