<?php
require_once '../../conexao.php';

$lista_tabelas = array("feriado", "acordo","funcionario","descarga", "folha"); // cada elemento do array representa o nome das tabelas no banco de dados, a qual sera excluido um item 
$links = array("7", "6","9","3","16"); // são os links das pagias, 7 é a de feriado, 6 a de acordo,  9 de funcionario e assim por diante

$status = ""; // status é se deu certo a exlcusão ou não 
$tam = count($lista_tabelas); // variavel para percorer o array no for 
$url = filter_input(INPUT_GET, 'ref'); // pegar as informações que vem na url, no caso o id e qual tabela será excluido,  está cliptografado.
$url = str_replace('wandim', '+',   $url); // + E % são considerados espaços na url 
$url = str_replace('carolzinha','%',$url);
//echo "Antes:".$url."    ";
$seguranca = new Cliptografar_Descriptografar("04102019PVACcomidaAcainaotemGosto_de_terra"); // chave para criptografia

$url = $seguranca->desencriptar($url);

//echo "URL:".$url."       ";

$id = preg_replace("/[^0-9]/", "", $url); // deixar apenas numeros para pegar o id para então fazer a exlcusão 
//echo "id : ".$id;

$pdo;
for($i = 0; $i<$tam; $i++) // iterar sobre o array lista tabela para saber qual tabela irá exlcuir o elemento
{
    if(strpos($url,$lista_tabelas[$i]) !== false) // Verifica de qual lista foi o click para exlcuir, se o retorno da função for diferente de falso ele achou
    {
        $edita_excluir = new ExcluirEdita; // objeto que exclui o elemento 
        $pdo = $edita_excluir->Delete_Banco($id, $lista_tabelas[$i]); // passsando o id do elemento a ser excluido e qual o nome da tabela que será excluido 
        
        $pdo? $status = "ITEM EXCLUIDO COM SUCESSO.": $status = "FALHA AO EXLUIR ITEM!"; // verificando se deu certo ou nao  
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/ponto/home.php?link=".$links[$i]."'><script type=\"text/javascript\">
               alert(\"".$status."\");
              </script>";   // exibir a mensagem se deu certo ou não e redirecinar para pagina correta
        $i = $tam+1; // parar o laco do for
    }
}

?>              

