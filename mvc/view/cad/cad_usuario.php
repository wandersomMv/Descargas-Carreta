<?php
    
        if(isset($_SESSION)) // VERIFICAR SE EXISTE SESSÃO, NELA ESTA A URL QUE É USADA PARA FAZER UPDATE 
        {
//             session_start(); 
             $url = isset($_SESSION['url'])?$_SESSION['url']:null;
             unset( $_SESSION['url'] );  // irá remover apenas os dados de 'url'
             // SE TEM URL ENTÃO É PARA EDITAR, PEGAR OS DADOS DO BANCO PARA SETAR OS VALORES
          
             
             if(!empty($url)) 
             {
                 $mostra = ExcluirEdita::pegar_dados_banco_id_tabela($url); // pegar os dados do banco e colocar no mostra 
             }
                
        }
        
?>
<div class="main-panel">
      <!-- Navbar -->
   
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title"><?php  echo empty($url)? "Cadastro De Funcionários":"Editar Funcionário"; // verifica se editar ou cadatrar?></h4>               
                </div>
                <div class="card-body">
                    <form action=<?php echo "processa/cad/proc_cad_func.php?ref=$url";?> method="POST" onsubmit="return check_form()">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Nome do Funcinário</label>
                          <input type="text" class="form-control required" name="nome_func" value=<?php echo isset($mostra)?$mostra['nome_func']:""; ?> >
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">CPF do Funcionário</label>
                          <input type="number"  class="form-control required" name="cpf_func" value=<?php echo isset($mostra)?$mostra['cpf_func']:""; ?>>
                        </div>
                      </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label class="bmd-label-floating">RG do Funcionário</label>
                            <input type="number" class="form-control required" name="rg_func" value=<?php echo isset($mostra)?$mostra['rg_func']:""; ?>>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="bmd-label-floating">Número da Conta do Funcionário</label>
                            <input type="number" class="form-control required" name="n_conta_func" value=<?php echo isset($mostra)?$mostra['n_conta_func']:""; ?>>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">N° PIS</label>
                          <input type="number" class="form-control required"name="n_pis_func" value=<?php echo isset($mostra)?$mostra['n_pis_func']:""; ?>>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                      
                        <div class="col-md-4">
                        <div class="form-group">
                          <label >Data de Nascimento do Funcionário</label>
                          <input type="date" class="form-control required" name="idade_func" value=<?php echo isset($mostra)?$mostra['idade_func']:""; ?> >
                        </div>
                        </div>
                    
                        <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Endereço do Funcionário</label>
                          <input type="text" class="form-control required" name="end_func" value=<?php echo isset($mostra)?$mostra['end_func']:""; ?>>
                        </div>
                      </div>
                        
                        <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Telefone do Funcionário</label>
                          <input type="text" class="form-control required"name="tel_func" value=<?php echo isset($mostra)?$mostra['tel_func']:""; ?> >
                        </div>
                        </div>
                    </div>    
                    
              
                    <button type="submit" class="btn btn-success pull-right">Salvar</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>      
