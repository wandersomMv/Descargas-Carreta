<?php
 require_once '../../conexao.php';
 
 
 $array_campos =array ("valor_carga_acordo","temp_acordo","nome_emp_acordo",
                            "placa_cart_acordo","placa_cav_acordo","origem_acordo","manifesto_acordo",
                            "equipe_acordo","qtd_volume_acordo","doca_acordo"); // lista de atributos que está no banco, cada elemento desse array representa uma coluna no banco 
 $url = filter_input(INPUT_GET, 'ref'); // pegar as informações que vem na url, no caso o id e qual tabela será excluido,  está cliptografado.

 if(empty($url))
 {
      // SE A URL ESTIVER VAZIA ENTÃO É UMA INSERÇÃO 
      $acordo = new Acordo ; 
      $pdo = $acordo->Inserir_acordo(); // INSERIR
     
 }
 else // se a url estiver com alguma coisa 
 {
     $editar = new ExcluirEdita;
     $pdo = $editar->Update($url, $array_campos);
    
     
 }
 $status = $pdo?  "ITEM ALTERADO COM SUCESSO.": "FALHA AO ALTERAR ITEM!"; // verificando se deu certo ou nao  
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/ponto/home.php?link=6'><script type=\"text/javascript\">
               alert(\"".$status."\");
              </script>";   // exibir a mensagem se deu certo ou não e redirecinar para pagina correta
 