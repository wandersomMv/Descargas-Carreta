<?php
 
require_once '../../conexao.php';

$cad_folha = new Folha_ponto();
$cad_folha->inserir_Folha_Ponto();

if($cad_folha)
{
  echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/ponto/home.php?link=10'><script type=\"text/javascript\">
               alert(\"DEU CERTO!\");
              </script>";   // exibir a mensagem se deu certo ou não e redirecinar para pagina correta
}
else
{
  echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/ponto/home.php?link=10'><script type=\"text/javascript\">
  alert(\"ALGO DEU ERRADO NO CADASTRAMENTO DA FOLHA!\");
  </script>";   // exibir a mensagem se deu certo ou não e redirecinar para pagina correta
}


