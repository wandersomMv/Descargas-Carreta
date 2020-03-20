

<!DOCTYPE html>
    <?php
      if (!isset($_GET['link'])) {
          
           echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/ponto/home.php?link=1'>";
        }
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">
    <div class="main-panel">
      <!-- Navbar -->
      
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
            
          
          <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">watch_later</i>
                  </div>
                   <p class ="card-category" align="justify">Descargas que foram realizadas em horário comercial.</p>  
                  <h4 class="card-title">
                    Lista de Descarga
                  </h4>
                </div>
                <div class="card-footer">
                  <div class="stats">
                       <button type="button"  class="btn btn-success btn-round btn-sm ">
                        <a href="home.php?link=3" class="text-white text-center">Listar descargas horário comercial</a>
                       </button>
                   
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">attach_money</i>
                  </div>
                    <p class="card-title"></p>
                    <p class ="card-category" align="justify">Descargas que foram realizadas fora do horário comercial.</p>
                  <h4 class="card-title">Lista de Acordados</h4>
                </div>
                <div class="card-footer">
                  <div class="stats">
                       <button type="button"  class="btn btn-danger btn-round btn-sm ">
                        <a href="home.php?link=6" class="text-white text-center">Listar descargas Acordadas</a>
                       </button>
                     
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">monetization_on</i>
                  </div>
                   <p class ="card-category" align="justify">Descargas que foram realizadas em  feriados.</p>
                   <br>
                   <h4 class="card-title">Lista de feriados</h4>
                </div>
                <div class="card-footer">
                  <div class="stats">
                      <button type="button"  class="btn btn-warning btn-round btn-sm ">
                        <a href="home.php?link=7" class="text-white text-center">Listar Descargas Feriados</a>
                    </button>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons ">account_circle</i>
                  </div>
                    <p class ="card-category " align="justify" >Todas Informações dos Funcionários, nome, conta etc.</p>
                  <h4 class="card-title">Funcionário</h4>
                </div>
                <div class="card-footer">
                  <div class="stats">
                     
                    <button type="button"  class="btn btn-info btn-round btn-sm ">
                        <a href="home.php?link=9" class="text-white text-center">Listar Funcionários</a>
                    </button>
            
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
            
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-danger">
                  <h4 class="card-title">Lista Acordado</h4>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                   
                      <thead class=" text-primary">
                        <tr>
                            <th class="text-white card-header card-header-danger">Data</th>
                            <th class="text-white card-header card-header-danger">Empresa</th>
                            <th class="text-white card-header card-header-danger">Valor Carga</th>
                            

                         </tr>
                      </thead>
                  
                    <tbody>
                      <tr>
                         <?php 
                        
                        $pdo = db_connect();
                        $consulta = $pdo->prepare("SELECT * FROM acordo ORDER BY temp_acordo");
                        $consulta -> execute();
                        $linhas = $consulta -> rowCount();
                        foreach ($consulta as $mostra) : 
                        echo"<tr>";
                        echo "<td>".date('d/m/Y H:i:s', strtotime($mostra['temp_acordo']))."</td>";
                        echo"<td>".$mostra['nome_emp_acordo']."</td>";
                        echo"<td>".$mostra['valor_carga_acordo']."</td>"; 
                         
               
                      endforeach;
                      echo"</tr>"; ?>
                <td></td>
                <td></td>
                <td><?php 
                $soma = $pdo->query("SELECT SUM(valor_carga_acordo) AS total FROM acordo")->fetchColumn();
                echo number_format($soma, 2, ",",".");
                ?></td>
                      </tr>
                                         
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Lista Feriados</h4>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                      <table class="table">
                    <thead class="text-warning">
                        
                        
                        
                        <tr>
                            <th class="text-white card-header card-header-warning">Data</th>
                            <th class="text-white card-header card-header-warning">Empresa</th>
                            <th class="text-white card-header card-header-warning">Valor Carga</th>
                            

                         </tr>
                      
                    </thead>
                        <tbody>
                        <?php 
                        
                            $pdo = db_connect();
                            $consulta = $pdo->prepare("SELECT * FROM feriado ORDER BY temp_feriado");
                            $consulta -> execute();
                            $linhas = $consulta -> rowCount();
                            foreach ($consulta as $mostra) : 
                            echo"<tr>";
                            echo "<td>".date('d/m/Y H:i:s', strtotime($mostra['temp_feriado']))."</td>";
                            echo"<td>".$mostra['nome_feriado']."</td>"; 
                            echo"<td>".$mostra['valor_carga_feriado']."</td>"; 

                            endforeach;
                            echo "</tr>";
                        ?>
                        <td></td><td></td>                 
                    
                  <td>
                      <?php
                        $soma = $pdo->query("SELECT SUM(valor_carga_feriado) AS total FROM feriado")->fetchColumn();
                        echo number_format($soma, 2, ",",".");
                      ?>
                        </tbody>
                      </table>
                    </div>
                   
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      
 
 


  <!--   Core JS Files   -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
















































































 


  <!--   Core JS Files   -->

  
