
<div class="main-panel">
      <!-- Navbar -->
   
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title">Lista Funcionários</h4>               
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                      <table class="table">
                      <thead class=" text-primary">
                        <tr>
			    <th class="text-white card-header card-header-info">Funcionário</th>
                            <th class="text-white card-header card-header-info">CPF</th>
                            <th class="text-white card-header card-header-info">RG</th>
                            <th class="text-white card-header card-header-info">Conta</th>
                            <th class="text-white card-header card-header-info">PIS</th>
                            <th class="text-white card-header card-header-info">Idade</th>
                            <th class="text-white card-header card-header-info">Endereço</th>
                            <th class="text-white card-header card-header-info">Telefone</th>
                            
		         </tr>
                      </thead>
               		<tbody>
                    <?php 
                        $funcionario = new Funcionario;
                        $funcionario->listar_funcionario();
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
                      $('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-info text-white">EXCLUIR ITEM<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja excluir o item selecionado?</div><div class="modal-footer"><button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataComfirmOK">Apagar</a></div></div></div></div>');
              }
              $('#dataComfirmOK').attr('href', href);
        $('#confirm-delete').modal({show: true});
              return false;

        });
        });


  </script>