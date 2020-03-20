<?php
session_start();
include_once 'conexao.php'; 
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
  <link rel="icon" type="image/png" href="img/teste.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    WAC System
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/icones.css" />
  <link rel="stylesheet" href="css/icones_pers.css">
  <link rel="stylesheet" href="css/all.css" >
  <!-- CSS Files -->
  <link href="css/material-dashboard.css?v=2.1.0" rel="stylesheet" />

</head>

  <body role="document"   >
       
         <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
        <div class="container-fluid">
     
        
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-default btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
              
              
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" >
                    <i class="material-icons">dashboard</i>
                    <p class="d-lg-none d-md-block">
                      Stats
                    </p>
                  </a>
                </li>
              </ul>
           
          </div>
        </div>
      </nav>
      
	<?php
		include_once("menu.php");
		//include_once("menu_adm_horizontal.php");
		//$link = $_GET["link"];
                 if (isset($_GET['link'])) {
                  $link = $_GET['link'];
                     }
		
                $pag['1'] = "index.php";
                $pag['2'] = "mvc/view/cad/cad_frota.php";
                $pag['3'] = "mvc/view/list/list_descarga.php";
                $pag['4'] = "mvc/view/cad/cad_acordo.php";
                $pag['5'] = "mvc/view/cad/cad_feriado.php";
                $pag['6'] = "mvc/view/list/list_acordo.php";
                $pag['7'] = "mvc/view/list/list_feriado.php";
                $pag['8'] = "mvc/view/cad/cad_usuario.php";
                $pag['9'] = "mvc/view/list/list_funcionario.php";
                $pag['10'] = "mvc/view/cad/cad_folha.php";
                $pag['11'] = "processa/excluir/excluir.php";
               
                
		if(!empty($link)){
			if(array_key_exists($link, $pag)){
				include $pag[$link];
			}else{
				include "index.php";
			}
		}else{
			include "index.php";
		}
		
	?>
      
<footer class="footer">
<div class="container-fluid">
 
  <div class="copyright float-right" id="date">
    websites <i class="material-icons">favorite</i> 
    <a href="#" target="_blank">WAC System</a> 
  </div>
</div>
</footer>
  
      
   
      
      
  </body>
    
 <script src="js/core/jquery.min.js"></script>
  <script src="js/core/popper.min.js"></script>
  <script src="js/core/bootstrap-material-design.min.js"></script>
  <script src="https://unpkg.com/default-passive-events"></script>
  <script src="js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
 
  <!-- Chartist JS -->
  <script src="js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="js/material-dashboard.js"></script>
  <script src="js/validacao_formulario.js"></script>
 
  
  
 
  
  
</html>









<script>

   var opcoes_menu = document.getElementsByClassName('nav-item');
   var url = window.location.href;
   url = url.split('?link=');
   if(url.length>1)
   {
     
       switch(url[1])
       {
           case '1':
               opcoes_menu[1].className += " active";
           break;
           
           case '8':
               opcoes_menu[2].className += " active";
           break;
           
           case '2':
               opcoes_menu[3].className += " active";
           break;
           
           case '4':
               opcoes_menu[4].className += " active";
           break;
           case '5':
               opcoes_menu[5].className += " active";
           break;
           case '10':
               opcoes_menu[6].className += " active";
           break;
       default:
           opcoes_menu[1].className += " active";
            
       }
       
   }
   else
   {
       opcoes_menu[1].className += " active"; 
   }
  
  </script>






























