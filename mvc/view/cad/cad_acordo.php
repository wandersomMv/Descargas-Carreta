
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
                  
                  
                  
                <div class="card-header card-header-danger">
                    <h4 class="card-title"> <?php  echo empty($url)? "Cadastro Acordado":"Editar Acordado"; // verifica se editar ou cadatrar?></h4>               
                </div>
                <div class="card-body">
                    <form action=<?php echo "processa/cad/proc_cad_acordo.php?ref=$url"; ?> method="POST" name="formuser" onsubmit="return check_form()">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Data Operação</label>
                          <?php
                          
                          //data completa
                                if(isset($mostra)){ // o formato do banco é vindo como data-time,  para adequar no html é necessario fazer uma converção 
                                    $date = new DateTime($mostra['temp_acordo']);
                                    $dataInput =  $date->format('Y-m-d\TH:i:s');
                                }
                                
                                echo isset($dataInput)?'<input type="datetime-local" class="form-control required" required name="temp_acordo"  value="'.$dataInput.'">':'<input type="datetime-local" class="form-control required"  required name="temp_acordo">';
                          ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Doca</label>
                          <input type="number" class="form-control" name="doca_acordo"  value=<?php echo isset($mostra)?$mostra['doca_acordo']:""; ?>>
                        </div>
                      </div>
                     
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                            <label class="text-danger">Nome da Empresa</label>
                            <input type="text" class="form-control required"  name="nome_emp_acordo" value=<?php echo isset($mostra)?$mostra['nome_emp_acordo']:""; ?>>
                        </div>
                      </div>
                      
                    </div>
                    <div class="row">
                      
                        <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Placa da Carreta</label>
                          <input type="text" class="form-control required" name="placa_cart_acordo"   value=<?php echo isset($mostra)?$mostra['placa_cart_acordo']:""; ?>>
                        </div>
                        </div>
                    
                        <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Placa do Cavalo</label>
                          <input type="text" class="form-control required"  name="placa_cav_acordo" value=<?php echo isset($mostra)?$mostra['placa_cav_acordo']:""; ?> >
                        </div>
                      </div>
                        
                        <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Valor da Carga</label>
                          <input type="number" class="form-control required"  name="valor_carga_acordo" value=<?php echo isset($mostra)?$mostra['valor_carga_acordo']:""; ?> >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Origem</label>
                          <input type="text" class="form-control required"  name="origem_acordo" value=<?php echo isset($mostra)?$mostra['origem_acordo']:""; ?> >
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Manifesto N°</label>
                          <input type="text" class="form-control required"   name="manifesto_acordo" value=<?php echo isset($mostra)?$mostra['manifesto_acordo']:""; ?> >
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Qtd. De Volume</label>
                          <input type="number" class="form-control required"  name="qtd_volume_acordo" value=<?php echo isset($mostra)?$mostra['qtd_volume_acordo']:""; ?>>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Equipe</label>
                          <div class="form-group">
                           
                              <textarea class="form-control required" rows="5"   type ="text" name="equipe_acordo"  > <?php echo isset($mostra)?$mostra['equipe_acordo']:""; ?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success pull-right" >Salvar</button>
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


      
    

      
     
      
      
      
