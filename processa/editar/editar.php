<?php
require_once '../../conexao.php';

$lista_tabelas = array("feriado", "acordo","funcionario","descarga", "folha"); // cada elemento do array representa o nome das tabelas no banco de dados, a qual sera excluido um item 
$lista_editar = array("feriado"=>"5", "acordo"=>"4","funcionario"=>"8","descarga"=>"2", "folha"=>"10"); // cada elemento do array representa o nome das tabelas no banco de dados, a qual sera excluido um item 
$status = ""; // status é se deu certo a exlcusão ou não 
$tam = count($lista_tabelas); // variavel para percorer o array no for 
$url = filter_input(INPUT_GET, 'ref'); // pegar as informações que vem na url, no caso o id e qual tabela será excluido,  está cliptografado.

echo"URL:".$url;
if(!isset($_SESSION))
{
    session_start();
    $_SESSION['url'] = $url;
            
}else
{
     $_SESSION['url'] = $url;
}

$url = str_replace('wandim', '+',   $url); // + E % são considerados espaços na url 
$url = str_replace('carolzinha','%',$url);

$seguranca = new Cliptografar_Descriptografar("04102019PVACcomidaAcainaotemGosto_de_terra"); // chave para criptografia
$url = $seguranca->desencriptar($url);
$id = preg_replace("/[^0-9]/", "", $url); // deixar apenas numeros para pegar o id para então fazer a exlcusão 



for($i = 0; $i<$tam; $i++) // iterar sobre o array lista tabela para saber qual tabela irá exlcuir o elemento
{
    if(strpos($url,$lista_tabelas[$i]) !== false) // Verifica de qual lista foi o click para exlcuir, se o retorno da função for diferente de falso ele achou
    {
         // verificando se deu certo ou nao  
        $pagina = "location: http://localhost/ponto/home.php?link=".$lista_editar[$lista_tabelas[$i]].""; // pagina de editar que e a mesma de cadastrar 
        header($pagina); 
        die('Não ignore meu cabeçalho...');
        $i = $tam+1; // parar o laco do for
    }
}


?>              

