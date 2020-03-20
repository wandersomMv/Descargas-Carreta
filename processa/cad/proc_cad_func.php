<?php
 
require_once '../../conexao.php';
 
// pega os dados do formuário
$url = filter_input(INPUT_GET, 'ref'); // pegar as informações que vem na url, no caso o id e qual tabela será excluido,  está cliptografado.

if(empty($url))
 {
      // SE A URL ESTIVER VAZIA ENTÃO É UMA INSERÇÃO 
      $func = new Funcionario();
      $pdo = $func->insert_Funcionario();
     
 }
 else // se a url estiver com alguma coisa 
 {
     $array_campos = array("nome_func","cpf_func","rg_func","n_conta_func","n_pis_func","idade_func","end_func","tel_func");// array com os atributos da tabela funcionario, cada elemento desse array é são nomes da coluna da tabela funcionario
     $editar = new ExcluirEdita;
     $pdo = $editar->Update($url, $array_campos);
     
     
 }
 $status = $pdo?  "ITEM ALTERADO COM SUCESSO.": "FALHA AO ALTERAR ITEM!"; // verificando se deu certo ou nao  
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/ponto/home.php?link=9'><script type=\"text/javascript\">
               alert(\"".$status."\");
              </script>";   // exibir a mensagem se deu certo ou não e redirecinar para pagina correta




