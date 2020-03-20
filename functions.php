<?php


 
function db_connect()
{
    $pdo = new PDO ('mysql:host='.DB_HOST .';dbname='.DB_NAME.';charset=utf8',DB_USER, DB_PASS);
    return $pdo;
}



class Botoes
{
    
    public static function botao_edita_excluir($id,$tabela)
    {
        
        $url = $id.$tabela; // juntar o id da linha em questão com a tabela que ela esta recionada no banco de dados
        $seguranca = new Cliptografar_Descriptografar("04102019PVACcomidaAcainaotemGosto_de_terra"); // chave para criptografia
        $url = $seguranca->encriptar($url); // criptografar o dado 
        
        $url = str_replace('+', 'wandim', $url); // se aparecer + ou % trocar por que na url isso e interpretado com espaço 
        $url = str_replace('%', 'carolzinha', $url);
        
        
        

//        $_REQUEST['ref'] = $url;
       
        
        
        
        echo"
                            <td class=td-actions text-right>
                              <button type=button rel=tooltip title=Editar class=btn btn-white btn-link btn-sm>
                               <a class = 'text-white' href ='processa/editar/editar.php?ref=$url'> <i class=material-icons>edit</i>
                              </button>
                              <button type=button rel=tooltip title=Remove class=btn btn-white btn-link btn-sm>
                                <a class = 'text-white' href ='processa/excluir/excluir.php?ref=$url' data-confirm ='Tem certeza de que deseja excluir o item selecionado?'><i class='material-icons'>close</i></a>
                                 
                              </button>
                             
                            </td>
            ";
    }
    
}





class Cliptografar_Descriptografar // classe para cliptografar a url, cliptografia usando OPENSSL
{
    
    
    private $chave;

            
    function __construct($chave) { // chave para cliptografar
            $this->chave = $chave;  
        }
    public function encriptar($texto)
            {
                $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
                $iv = openssl_random_pseudo_bytes($ivlen);
                $ciphertext_raw = openssl_encrypt($texto, $cipher, $this->chave, $options=OPENSSL_RAW_DATA, $iv);
                $hmac = hash_hmac('sha256', $ciphertext_raw, $this->chave, $as_binary=true);
                return $ciphertext = base64_encode($iv.$hmac.$ciphertext_raw);
            }

    public function desencriptar($textoCodificado)
            {
                $c = base64_decode($textoCodificado);
                $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
                $iv = substr($c, 0, $ivlen);
                $hmac = substr($c, $ivlen, $sha2len=32);
                $ciphertext_raw = substr($c, $ivlen+$sha2len);
                $texto_original = openssl_decrypt($ciphertext_raw, $cipher, $this->chave, $options=OPENSSL_RAW_DATA, $iv);
                $calcmac = hash_hmac('sha256', $ciphertext_raw, $this->chave, $as_binary=true);
                settype ($hmac,"string");
                settype ($calcmac,"string");
                if (hash_equals($hmac, $calcmac)) {//PHP 5.6+ timing attack safe comparison
                    return $texto_original;
                }
            }
}



class ExcluirEdita // classe para excluir/editar, ela é usada quando usuario clilca em exclui/editar em alguma listagem no front
{
    
    
    public function  busca_parecido($nome, $tabela, $campo) // buscar elementos do banco de dados, no maximo 20
    {
                $pdo = db_connect(); // conectar-se ao banco para buscar o cpf
                $consulta = $pdo->prepare("SELECT * FROM $tabela WHERE $campo LIKE '%$nome%' LIMIT 10"); // buscar cpf dos funcionarios no banco 
                $consulta -> execute(); // os dados são retornados na variavel consulta
                
                if($consulta -> rowCount > 0)
                {
                    return $consulta;
                }
                return false;
    }


    public  function Delete_Banco($id,$tabela){  // é passado o id da tabela no banco para excluir e qual tabela irá excluir
            $querry = "DELETE FROM ".$tabela." WHERE id ='".$id."'";
            $pdo = db_connect();
            return $pdo -> exec($querry); 
        }
        
        
        
    public function Update($url, $array_campos)
    {
                $lista_tabelas = array("feriado", "acordo","funcionario","descarga", "folha"); // cada elemento do array representa o nome das tabelas no banco de dados, a qual sera excluido um item 
                $tam = count($lista_tabelas); // variavel para percorer o array no for 
                $url = str_replace('wandim', '+',   $url); // + E % são considerados espaços na url 
                $url = str_replace('carolzinha','%',$url);
                $seguranca = new Cliptografar_Descriptografar("04102019PVACcomidaAcainaotemGosto_de_terra"); // chave para criptografia
                    
                $url = $seguranca->desencriptar($url); // url original 
                $tabela = "";
                $id = preg_replace("/[^0-9]/", "", $url); // deixar apenas numeros para pegar o id para pegar os dados no banco de dados
                
                $i = 0;
                // PEGAR DE QUAL TABELA PERTENCE AQUELE EDITAR
                // USANDO FOR DO CACHORRO !!!
                for($i = 0; $i<$tam; $i++){
                    if(strpos($url,$lista_tabelas[$i]) !== false) // Verifica de qual lista foi alteração, se o retorno da função for diferente de falso ele achou
                        {
                            $tabela = $lista_tabelas[$i];
                            $i = $tam+1; // parar o laco do for
                        }
                } // iterar sobre o array lista tabela para saber qual tabela irá eidtar o elemento o elemento
                $tam_campos = count($array_campos); // pegar o tamanho dos campos da que contem a tabela
                //UPDATE `folha` SET `funcionario_ponto`='teste',`cpf_ponto`= 1 ,`qtd_dias_trabalho`= 1 ,`cargo_ponto`='irineu',`mes_ponto`= 4 ,`ano_ponto`= 2000,`qtd_hora_comercial`=10,`qtd_hora_extra`=10,`turno_ponto`="MAT" WHERE `id` = 2
                $querry = "UPDATE ".$tabela. " SET";
                for($i = 0; $i<$tam_campos;$i++)// percorrer os campos e seta-los com os respectivos valores
                {
                    $dado = $url = filter_input(INPUT_POST,$array_campos[$i] ); // pegar as informações que vem na url, no caso o id e qual tabela será excluido,  está cliptografado.
                    $querry.=' '.$array_campos[$i].' = "'.$dado.'"';
                    if($i+1<$tam_campos){$querry.=',';}
                    
                }
                $querry .= " WHERE id = ".$id;
                
//                ECHO "QUERRY : ". $querry;
               $pdo = db_connect();
               return $pdo -> exec($querry); 
                
               
        
    }

    public static function pegar_dados_banco_id_tabela($url)
    {
                $lista_tabelas = array("feriado", "acordo","funcionario","descarga", "folha"); // cada elemento do array representa o nome das tabelas no banco de dados, a qual sera excluido um item 
                $tam = count($lista_tabelas); // variavel para percorer o array no for 
                $url = str_replace('wandim', '+',   $url); // + E % são considerados espaços na url 
                $url = str_replace('carolzinha','%',$url);
                $seguranca = new Cliptografar_Descriptografar("04102019PVACcomidaAcainaotemGosto_de_terra"); // chave para criptografia
                    
                $url = $seguranca->desencriptar($url); // url original 
                $tabela = "";
                $id = preg_replace("/[^0-9]/", "", $url); // deixar apenas numeros para pegar o id para pegar os dados no banco de dados
                
                $i = 0;
                // PEGAR DE QUAL TABELA PERTENCE AQUELE EDITAR
                // USANDO FOR DO CACHORRO !!!
                for($i = 0; $i<$tam; $i++){
                    if(strpos($url,$lista_tabelas[$i]) !== false) // Verifica de qual lista foi o click para exlcuir, se o retorno da função for diferente de falso ele achou
                        {
                            $tabela = $lista_tabelas[$i];
                            $i = $tam+1; // parar o laco do for
                        }
                } // iterar sobre o array lista tabela para saber qual tabela irá eidtar o elemento o elemento
        
               
        
                $pdo = db_connect(); // conectar-se ao banco para buscar o cpf
                $consulta = $pdo->prepare("SELECT * FROM $tabela WHERE id = $id"); // buscar cpf dos funcionarios no banco 
                $consulta -> execute(); // os dados são retornados na variavel consulta
                //$linhas = $consulta -> rowCount
               
                foreach ($consulta as $mostra) : // iterar sobre os valores  vindo do banco de dados e colocar como opção no html
                    return $mostra;
                endforeach; 
    }
    
}

class Acordo // tudo referente ao arcordo está nessa classe
{
    public function Lista_acordo () { // listar o acordo no front
        
                        $pdo = db_connect(); // conectar-se ao banco de dados 
                        $consulta = $pdo->prepare("SELECT * FROM acordo ORDER BY nome_emp_acordo"); // querry para pegar os dados do banco de dados
                        $consulta -> execute();
		                $nomes = array ("valor_carga_acordo","temp_acordo","nome_emp_acordo",
                            "placa_cart_acordo","placa_cav_acordo","origem_acordo","manifesto_acordo",
                            "equipe_acordo","qtd_volume_acordo","doca_acordo"); // lista de atributos que está no banco, cada elemento desse array representa uma coluna no banco 
                        
                        $linhas = $consulta -> rowCount(); 
                        foreach ($consulta as $mostra) :  // iterar por todas as linhas retornadas no banco
                            echo"<tr>";
                            $tam = count($nomes); 
                             for ($i=0; $i < $tam; $i++){ // setar os valores das linhas retornadas do banco 
                                       if ($nomes[$i]== "temp_acordo"){echo "<td>".date('d/m/Y H:i:s', strtotime($mostra[$nomes[$i]]))."</td>";} // temp_acordo é do formato data-time, o tratamento é diferente    
                                       else {echo"<td>".$mostra[$nomes[$i]]."</td>";}   
                             }

                             Botoes::botao_edita_excluir($mostra['id'],"acordo"); // botão que edita ou exclui a linha que retornou do banco de dados
                             
                             echo"</tr>";                      
                        endforeach;
                        
                        
                        $soma = $pdo->query("SELECT SUM(valor_carga_acordo) AS total FROM acordo")->fetchColumn(); // fazer o cálculo 
                        echo "<tr><td>".number_format($soma, 2, ",",".")."<td></tr>";
                        
	}
        
        public function Inserir_acordo (){ // FUNCÇÃO QUE INSERE OS DADOS REFERENTES AO ACORDO NO BANCO DE DADOS
         
            
        try{
            
                $pdo = db_connect(); // fazer conecção com banco de dados 
                $pdo = $pdo->prepare('INSERT INTO acordo VALUES(DEFAULT, :temp_acordo, :doca_acordo, :nome_emp_acordo, :placa_cart_acordo, :placa_cav_acordo,
                    :valor_carga_acordo, :origem_acordo, :manifesto_acordo, :qtd_volume_acordo, :equipe_acordo)'); //QUERY PARA INSERIR NO BANCO DE DADOS
                
                # campos com os filtros
                $subistuir = array 
                            ("valor_carga_acordo"=>FILTER_VALIDATE_FLOAT,"temp_acordo"=>FILTER_SANITIZE_SPECIAL_CHARS,"nome_emp_acordo"=>FILTER_SANITIZE_SPECIAL_CHARS,
                            "placa_cart_acordo"=>FILTER_SANITIZE_SPECIAL_CHARS,"placa_cav_acordo"=>FILTER_SANITIZE_SPECIAL_CHARS,"origem_acordo"=>FILTER_SANITIZE_SPECIAL_CHARS,
                            "manifesto_acordo"=>FILTER_SANITIZE_SPECIAL_CHARS,"equipe_acordo"=>FILTER_SANITIZE_SPECIAL_CHARS,"qtd_volume_acordo"=>FILTER_VALIDATE_INT,"doca_acordo"=>FILTER_SANITIZE_SPECIAL_CHARS);// LISTA DE ATRIBUTOS QUE SERA INSERIDA NO BANCO DE DADOS, CADA ELEMENTO É UMA COLUNA REFERENTE A TABELA ACORDO
             

                foreach($subistuir as  $chave=>$valor)
                { 
                    $pag = filter_input(INPUT_POST , $chave,$valor); # Pegar os campos do formulario  e filtra-los
                    
                    if((empty($pag) || !$pag)){ // se o usuario não colocou nehum dado no campo corretamente

                        return false;    // retornar false por conta dos campos estarem errados
                        exit();
                    }
                    $pdo->bindValue(":".$chave,$pag);// // subistituindo os referntes valores passados pelo usuário na querry, request é uma variavel global e armazena os valores passados do usuário 
                }

                return  $pdo->execute(); // executa a querry para inserir os dados 


            }catch(PDOException $e)
            {
                return false; 
            } 
            catch (Exception $e) {
                return false; 
            }
            
        }
        
}

class Desc{// TUDO REFERENTE A DESCARGA ESTÁ RELACIONADO COM ESSA CLASSE
    
    public function  Insert_desc() // função para inserir os dados passados pelo usuario
    {

        try{
            $nomes_variaveis = array("temp_op","doca","op_inicio","op_fim","placa_carreta",
            "placa_cavalo","valor_carga","origem","manifesto","qtd_volume","equipe");// array com os atributos da tabela descarga, cada elemento desse array é são nomes da coluna da tabela descarga
            // insere no banco
            $pdo = db_connect(); // conectar-se ao banco de dados
            $pdo = $pdo->prepare('INSERT INTO descarga VALUES(DEFAULT, :temp_op, :doca, :op_inicio, :op_fim, :placa_carreta, :placa_cavalo,
            :valor_carga, :origem, :manifesto, :qtd_volume, :equipe)'); //  querry para inserir dados na tabela descarga

            $tam_dados = count($nomes_variaveis);
            for($i =0; $i<$tam_dados;$i++)// recebendo dados do formulario// subistituindo os referntes valores passados pelo usuário na querry, request é uma variavel global e armazena os valores passados do usuário 
            { 
                $pag = filter_input(INPUT_POST,$nomes_variaveis[$i],FILTER_SANITIZE_SPECIAL_CHARS);
                if((empty($pag) || !$pag)){ // se o usuario não colocou nehum dado no campo corretamente

                    return false;    // retornar false por conta dos campos estarem errados
                    exit();
                }
                $pdo->bindValue( ":".$nomes_variaveis[$i],$pag);# substituir os valores na querry
            
            } 

            return $pdo->execute(); //executar a querry ja com os dados 
        
        }catch(PDOException $e) # vinda do banco de dados
        {
            return false; 
        } 
        catch (Exception $e) { // desconhecida
            return false; 
        }
        
    }
    public function Listar_desc(){ // FUNCÇÃO PARA LISTAR OS DADOS DO BANCO EM UMA TABELA NO FRONT
        
                    
                try{
                        $nomes_variaveis = array("valor_carga","temp_op","op_inicio","op_fim","placa_carreta",
                        "placa_cavalo","origem","manifesto","equipe","qtd_volume","doca"); // // array com os atributos da tabela descarga, cada elemento desse array é são nomes da coluna da tabela descarga
                        $pdo = db_connect(); // CONECTAR-SE AO BANCO DE DADOS
                        $consulta = $pdo->prepare("SELECT * FROM descarga"); // PEGAR TODOS OS DADOS DA TABELA DESCARGA 
                        $consulta -> execute(); // EXECUTAR A QUERRY, OS VALORES RETORNADOS DO BANCO ESTARÃO ARMAZENADOS NA VARIAVEL CONSULTA 
                        
                        $tam_tab = count($nomes_variaveis);
                        
                       
                        foreach ($consulta as $mostra) :  // for para interar sobres os dados retornados do banco, que está na variável consulta
                        echo"<tr>";
                            for($i=0;$i<$tam_tab;$i++)
                            {
                                if ($mostra[$nomes_variaveis[$i]] =='op_inicio'||$mostra[$nomes_variaveis[$i]] =='op_fim' ) // OP_FIM/OP_INICIO SÃO DO FORMATO DATATIME E A FORMA DE TRATAMENTO PARA EXIBIR É DIFERENTE
                                {
                                    echo "<td>".date('H:i', strtotime($mostra[$nomes_variaveis[$i]]))."</td>";
                                }elseif ($mostra[$nomes_variaveis[$i]] =='temp_op') {
                                    echo "<td>".date('d/m/Y', strtotime($mostra['temp_op']))."</td>"; // COLOCAR NO FORMATO DIA MES E ANO 
                                }else{
                                    
                                     echo"<td>".$mostra[$nomes_variaveis[$i]]."</td>"; 
                                }  
                            }
                            
                            Botoes::botao_edita_excluir($mostra['id'],"descarga"); // botão que edia/exclui um elemento referente a essa tabela
                             echo"</tr>";
                        endforeach;

                         $soma = $pdo->query("SELECT SUM(valor_carga) AS total FROM descarga")->fetchColumn();  
                         echo "<tr><td>".number_format($soma, 2, ",",".")."</td></tr>";// fazer o calculo referente aquela tabela


                }   catch(PDOException $e)
                {
                    return false;
                }
    }
}

Class Funcionario // TUDO REFERENTE A FUNCIONARIO ESTÁ CONTIDO DENTRO DESSA CLASSE
{
    
    public function listar_funcionario() //funcão para listar os dados referente ao funcionario em uma tabela no front
    {
                        $campos_funcionario = array('nome_func','cpf_func','rg_func','n_conta_func','n_pis_func','idade_func','end_func','tel_func');// // array com os atributos da tabela funcionario, cada elemento desse array é são nomes da coluna da tabela funcionario
                        $tam = count($campos_funcionario);
                        $pdo = db_connect(); // conectar-se ao banco de dados
                        $consulta = $pdo->prepare("SELECT * FROM funcionario"); // buscar todos os dados referente ao funcionario no banco de dados
                        $consulta -> execute(); // executar a querry de busca
                        $linhas = $consulta -> rowCount();
                        foreach ($consulta as $mostra):  // os dados retornado do banco de dados é armazenado na variavel consulta 
                                echo"<tr>";
                                for($i = 0; $i<$tam;$i++) // mostra representa uma linha do banco de dados 
                                {
                                      echo"<td>".$mostra[$campos_funcionario[$i]]."</td>";// colocar o valor na tabela 

                                }
                                 Botoes::botao_edita_excluir($mostra['id'],"funcionario"); // botão que edia/exclui um elemento referente a essa tabela
                             echo"</tr>";
                        endforeach;
    }
    public function insert_Funcionario() { // funcção para pagar os dados passados pelo usuario atravez do formulario e inserir no banco de dados 
        
       try
       { 
        
            $nomes_campos = array("nome_func","cpf_func","rg_func","n_conta_func","n_pis_func","idade_func","end_func","tel_func");// array com os atributos da tabela funcionario, cada elemento desse array é são nomes da coluna da tabela funcionario
            $tam_campos = count($nomes_campos);
            
            for($i=0; $i<$tam_campos;$i++){ # Veridicar se os campos foram devidademente preenchidos
                $pag = filter_input(INPUT_POST , $nomes_campos[$i]); # Pegar os campos do formulario
                if(empty($pag)){ // se o usuario não colocou nehum dado no campo 
                    return false;
                    exit();
                }
            }
            $conect = db_connect(); // conectar-se ao banco de dados 
            $pdo = $conect->prepare('INSERT INTO funcionario VALUES(DEFAULT, :nome_func, :cpf_func, :rg_func, :n_conta_func, :n_pis_func,
                        :idade_func, :end_func, :tel_func)'); //QUERY PARA INSERÇÃO DOS DADOS NO BANCO DE DADOS, :nome_func é onde sera subistuido o valor para inserir no banco

            
            #Preparar os dados para inserir no banco, subistituir os valores do campo na querry 
            for($i =0; $i<$tam_campos;$i++){ // passar por todos os atributos da querry para colocar os dados que foram passado pelo usuario atraves do formulario
                $dado = filter_input(INPUT_POST , $nomes_campos[$i],FILTER_SANITIZE_SPECIAL_CHARS); # Pegar os campos do formulario
                $pdo->bindValue( ":".$nomes_campos[$i],$dado); //colocar os dados na querry para insiri no banco, por exemplo: :idade_func será subistituido pelo valor que o usuario passou atraves do formulário
            }
            return $pdo->execute(); # Executar a querry

        }catch(PDOException $e) # vinda do banco de dados
        {
            return false; 
        } 
        catch (Exception $e) { // desconhecida
            return false; 
        }  
    }
    
    
    
}




class Feriado// MANIPULAÇÃO DA LISTAGEM, CADASTRO, ECLUSÃO DO FERIADO
{
    public function insert_Feriado(){
        
        $nomes_campo = array("temp_feriado","doca_feriado","nome_feriado","placa_carreta_feriado","placa_cavalo_feriado","valor_carga_feriado","origem_feriado",
            "manifesto_feriado","qtd_volume_feriado","equipe_feriado"); // Nomes que estão no formulario e que são os mesmos atributos da tabela feriado no banco de dados
        $tam_campos = count($nomes_campo);
        
        for($i=0; $i<$tam_campos;$i++){ # Veridicar se os campos foram devidademente preenchidos
            $pag = filter_input(INPUT_POST , $nomes_campo[$i]); # Pegar os campos do formulario
            if(empty($pag)){ // se o usuario não colocou nada, não preencheu o campo devidamente 
                
                echo "Volte e Preencha Todos os campos!!";
                exit();
            }
        }
        $pdo = db_connect(); // conectar-se ao banco de dados 
        $pdo =$pdo->prepare('INSERT INTO feriado VALUES(DEFAULT, :temp_feriado, :doca_feriado, :nome_feriado, :placa_carreta_feriado, :placa_cavalo_feriado,
        :valor_carga_feriado, :origem_feriado, :manifesto_feriado, :qtd_volume_feriado, :equipe_feriado)'); //Preparando os dados, //QUERY PARA INSERÇÃO DOS DADOS NO BANCO DE DADOS, :placa_cavalo_feriado é onde sera subistuido o valor para inserir no banco

        
        #Preparar os dados para inserir no banco, subistituir os valores do campo na querry 
        for($i =0; $i<$tam_campos;$i++){
            $pdo->bindValue( ":".$nomes_campo[$i],$_POST[$nomes_campo[$i]]); // recebendo dados do formulario e susbistituindo na querry os dados 
        }
        return $pdo->execute(); # Executar a querry para inserir no banco de dados com os devidos dados passados pelo usuario  
    }
    

    public function listar_Feriado() { // FUNÇÃO PARA LISTAR OS DADOS REFERENTES AO FERIADO
            $pdo = db_connect(); // conectar-se ao banco de dados
            $consulta = $pdo->prepare("SELECT * FROM feriado"); // pegar todos os dados da tabela feriado para então a listagem em uma tabela no html 
            $consulta -> execute(); // execulta a querry passada e armazena o resultado na variável consulta 
            $linhas = $consulta -> rowCount();

            $nomes_campo = array('doca_feriado','temp_feriado','nome_feriado','placa_carreta_feriado','placa_cavalo_feriado','origem_feriado','manifesto_feriado',
                'equipe_feriado','qtd_volume_feriado','valor_carga_feriado'); // array que representa as colunas da tabela feriado, cada elemento e um nome de uma coluna da tabeça feriado



             # o banco retornou dados referente essa tabela
               foreach ($consulta as $mostra):  // iterar sobre os valores retornados do banco e exibi-los na tela 
                    echo"<tr>";
                    $tam_campos = count($nomes_campo); // pegando o tamanho do array com os nomes das colunas da tabela 
                    for($i=0; $i<$tam_campos; $i++){
                        if($nomes_campo[$i] == "temp_feriado"){ // tem_p feriado e data time, é necessario uma conversão para exibi-lo 
                            echo "<td>".date('d/m/Y H:i:s', strtotime($mostra['temp_feriado']))."</td>";
                          }
                         else{
                             echo  "<td>".$mostra[$nomes_campo[$i]]."</td>";}
                    }
                    Botoes::botao_edita_excluir($mostra['id'],"feriado"); // botão para excluir/editar e necessario passar qual id deve excluir/editar e qual tabela ele pertence 
                    echo"</tr>";

                endforeach;
            $soma = $pdo->query("SELECT SUM(valor_carga_feriado) AS total FROM feriado")->fetchColumn();
            echo"<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>". number_format($soma, 2, ",",".")."</td>"; // fazer o calculo da tabela intera.          
    }
}


class Folha_ponto{ // CLASSE PARA TRABNALHAR COM TUDO RELACIONADO A FOLHA
    
    
    
    
    
    
    public static function listar_opcoes_funcionario() { // FUNÇÃO PARA PEGAR OS NOMES DO FUNCIONARIO QUE ESTÃO NO BANCO DE DADOS E DEIXAR PARA O USUARIO O CAMPO PRE-PRENCHIDO 
        
        
                $pdo = db_connect(); // conectar-se ao banco para pegar os nomes do funcionario 
                $consulta = $pdo->prepare("SELECT nome_func FROM funcionario"); //  buscar os nomes dos funcionarios no banco de dados
                $consulta -> execute(); // todos os dados retornardos do banco será armazenados na variavel consulta 
                $linhas = $consulta -> rowCount();
                foreach ($consulta as $mostra): // iterar sobre os nomes dos funcionarios retornados do banco e colocalos como opções na interface para o usuario 

                    echo "<option value=".$mostra['nome_func'].">".$mostra['nome_func']."</option>"; // setando as opções com os nomes dos funcionarios 

                endforeach;
                                      
        
    }
    
    public static function listar_opcoes_cpf() // função para colocar o cpf como opções na hora de preencher o formulario, esses cpfs são trazidos do banco de dados, é para facilitar o usuario a não precisar digitar o cpf de uma pessoa que esta no banco de dados 
    {
        
                $pdo = db_connect(); // conectar-se ao banco para buscar o cpf
                $consulta = $pdo->prepare("SELECT cpf_func FROM funcionario"); // buscar cpf dos funcionarios no banco 
                $consulta -> execute(); // os dados são retornados na variavel consulta
                $linhas = $consulta -> rowCount();
                foreach ($consulta as $mostra) : // iterar sobre os valores  vindo do banco de dados e colocar como opção no html 
                          
                    echo "<option value=".$mostra['cpf_func'].">".$mostra['cpf_func']."</option>"; // setando o cpf como opção no html
                          
                endforeach;
    }
    public function inserir_Folha_Ponto(){ // FUNCÇÃO PARA INSERIR NA TABELA FOLHA
        
        
        $nomes_campos = array('funcionario_ponto', 'cpf_ponto', 'qtd_dias_trabalho', 'cargo_ponto', 'mes_ponto',
        'ano_ponto', 'qtd_hora_comercial', 'qtd_hora_extra', 'turno_ponto'); // ARRAY REPRESENTA CADA COLULA DA TABELA FOLHA NO BANCO DE DADOS, TAMBÉM SÃO OS MESMOS NAME DOS CAMPOS NO HTML
        
        $tam = count($nomes_campos);
        for($i=0; $i<$tam;$i++){ # Veridicar se os campos foram devidademente preenchidos, passar por todos os campos do formulario, que os nomes estão no array para verificar se foi devidamente preenchidos
            $pag = filter_input(INPUT_POST , $nomes_campos[$i]); # Pegar os campos do formulario
            
            if(empty($pag)){ // SE O USUÁRIO NAO DIGITOU NADA  ENTÃO NAO E POSSÍVEL CONTINUAR
                echo "Volte e Preencha Todos os campos!! Folha";
                exit();
            }
        }
        
        $pdo = db_connect();     // conectar-se ao banco de dados para fazer a inserção 
        $pdo = $pdo->prepare('INSERT INTO folha VALUES(DEFAULT, :funcionario_ponto, :cpf_ponto, :qtd_dias_trabalho, :cargo_ponto, :mes_ponto,
        :ano_ponto, :qtd_hora_comercial, :qtd_hora_extra, :turno_ponto)'); //Preparando os dados, no luga de por exemplo :funcionario_ponto será subistituido um valor para a inserção no banco de dados
        
        
        for($i=0; $i < $tam; $i++) {$pdo->bindValue( ":".$nomes_campos[$i],$_POST[$nomes_campos[$i]]);} // subistituindo nos campos onde possui ':' os dados que o usuario passou e que está na variavel _Request
        
        return  $pdo->execute(); // executar a query para fazer a inserção no banco de dados
        
    }
    
    
    
}

?>

