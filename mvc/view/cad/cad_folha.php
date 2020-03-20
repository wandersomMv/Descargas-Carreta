
<div class="main-panel">
      <!-- Navbar -->
   
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Folha Ponto</h4>               
                </div>
                <div class="card-body">
                    <form action=<?php echo "processa/cad/proc_cad_folha.php"?> method="POST">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Funcionário</label>
                            <input type="text"  id = "busca" class="form-control j_autocomplete" name="funcionario_ponto">
<!--                           <select  type = "text" name="funcionario_ponto" class="form-control text-secondary" >-->
                            
                            <?php 
//                                Folha_ponto::listar_opcoes_funcionario(); // METODO ESTÁTICO PARA LISTAR TODOS FUNCIONARIOS CADASTRADOS
                            ?>
                                                            
<!--                        </select>-->
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">CPF</label>
                          <select name="cpf_ponto" class="form-control text-secondary" >
                            
                            <?php 
                                            
                                Folha_ponto::listar_opcoes_cpf();   // METODO ESTÁTICO PARA LISTAR TODOS CPF dos FUNCIONARIOS CADASTRADOS
                             ?>
                                                            
                        </select>
                        </div>
                      </div>
                        
                         <div class="col-md-4">
                        <div class="form-group">
                            <label class="bmd-label-floating">Qtd Dias Trabalhados</label>
                            <input type="number" class="form-control" name="qtd_dias_trabalho">
                        </div>
                      </div>
                     
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                            <label class="bmd-label-floating">Cargo</label>
                            <input type="text" class="form-control" name="cargo_ponto">
                        </div>
                      </div>
                        
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Mês</label>
                          <select name="mes_ponto" class="form-control text-secondary" >
                              
                              <?php
                                   $messes = array("Janeiro", "Feveiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
                                   $tam = count($messes);
                                   for($i =0; $i<$tam;$i++){echo "<option value=".$messes[$i].">".$messes[$i]."</option>";}
                              ?>
                            
                          </select>
                        </div>
                        </div>
                        
                         <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Ano</label>
                          <input type="number" class="form-control" name="ano_ponto">
                        </div>
                        </div>
                        
                    </div>
                    <div class="row">
                      
                         <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating"> Qtd Horas Trabalhadas no Horário Comercial</label>
                          <input type="number" class="form-control" name="qtd_hora_comercial">
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Qtd de Hora Extra</label>
                          <input type="number" class="form-control" name="qtd_hora_extra">
                        </div>
                        </div>
                    
                        <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Turno</label>
                          <select name="turno_ponto" class="form-control text-secondary" >
                            <option value="Matutino - Vespertino">Matutino - Vespertino</option>
                            <option value="Vespertino - Noturno" >Vespertino - Noturno</option>
                            <option value="Matutino - Noturno">Matutino - Noturno</option>
                            
                          </select>
                          
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
      
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        //funcionario_ponto == seach 
        
        
        
        $('.j_autocomplete').autocomplete(
            source: 'processa/cad/buscar.php'       
        );
       
    
    
    </script>

      
      