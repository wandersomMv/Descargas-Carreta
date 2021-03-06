
<div class="main-panel">
      <!-- Navbar -->
   
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-danger">
                  <h4 class="card-title">Lista Acordado</h4>               
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                      <table class="table">
                      <thead class=" text-primary">
                        <tr>
			    <th class="text-white card-header card-header-danger">Valor Carga</th>
                            <th class="text-white card-header card-header-danger">Data</th>
                            <th class="text-white card-header card-header-danger">Empresa</th>
                            <th class="text-white card-header card-header-danger">Placa Carreta</th>
                            <th class="text-white card-header card-header-danger">Placa Cavalo</th>
                            <th class="text-white card-header card-header-danger">Origem</th>
                            <th class="text-white card-header card-header-danger">Manifesto</th>
                            <th class="text-white card-header card-header-danger">Equipe</th>
                            <th class="text-white card-header card-header-danger">QTD Volume</th>
                            <th class="text-white card-header card-header-danger">Doca</th>
                            
		         </tr>
                      </thead>
               		<tbody>
                    <?php 
                        $acordo = new Acordo ;
                        $acordo->Lista_acordo(); 
                        ?>
                           
                     </tbody>
                    </table>
                        
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
          
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <script>
          
                $(document).ready(function(){
                $('a[data-confirm]').click(function(ev){
                      var href = $(this).attr('href');
                      if(!$('#confirm-delete').length){
                              $('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-danger text-white">EXCLUIR ITEM<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja excluir o item selecionado?</div><div class="modal-footer"><button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataComfirmOK">Apagar</a></div></div></div></div>');
                      }
                      $('#dataComfirmOK').attr('href', href);
                $('#confirm-delete').modal({show: true});
                      return false;

                });
                });

          
          </script>