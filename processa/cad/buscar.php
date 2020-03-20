<?php

$nome = mysql_real_escape_string($_GET['term']); // pegando os valores que estão sendo digitados no input
$consulta = new ExcluirEdita;
$linhas = $consulta->busca_parecido($nome, "funcionario", "nome_func"); // dados estarão na variavel linhas

$resJson = "["; // formaro de exibição do autocomplete 

foreach ($linhas as $mostra) : // iterar sobre os valores  vindo do banco de dados e colocar como opção no html
      
    
endforeach;

