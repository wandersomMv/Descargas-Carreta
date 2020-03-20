function check_form(){
    // Função para verificar se os campos do formularios estão em branco
    var inputs = document.getElementsByClassName('required');
    var len = inputs.length;
   
    for(var i=0; i < len; i++)
    {
       if (!inputs[i].value)
       { 
           swal("Oops!", "Você deve preencher todos os campos para cadastrar!", "error");
           return false;
       }
    }
   
    return true; 
}

