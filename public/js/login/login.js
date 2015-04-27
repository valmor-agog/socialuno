$('.div-form-cadastro > div > input ').blur(function(){
    $(this).removeAttr('style');
   if($.trim($(this).val()) == ''){
        
       $(this).focus();
       $(this).css('border', '1px solid #ff0000');
   }
   
   if($(this).attr('id') == 'novo_usuario_senha_confirmar'){
       console.log($.trim($(this).val()), $.trim($('#novo_usuario_senha').val()));
       if($.trim($(this).val()) !== $.trim($('#novo_usuario_senha').val())){
           
           alert('senhas nao correspondem');
           $('#cadastrar').removeAttr('onclick');
           
       }else{
            $('#cadastrar').attr('onclick', 'cadastrar(this)');
       }
       
   }
});

function cadastrar(obj)
{
     dataUrl = $(obj).attr('data-url');
     login = $('#email').val();
     senha = $('#novo_usuario_senha').val();
    
    
    if($.trim(login) == ''){
        alert('cara preenche um email');
        return;
    }
    
    $.ajax({ 
       type: 'POST',
       dataType : "json",
       url: dataUrl+'?login='+login+'&senha='+senha, 
       success: function(data) { 
           if(data.result == false){

               if(data.type == 'email'){
                   respostaError('#email', 'Email cadastrado não é valido');
                   return;
               }

               if(data.type == 'characterSenha'){
                   respostaError('#novo_usuario_senha', 'A senha não pode ser inferior a 3 caracteres');                    
                   return;
               }
           }
           
           
      } 
   });   
}

function  respostaError(div, msgError)
{
    $('.form-box > '+div).append('<div id="resp"> '+msgError+'</div>');
    setTimeout(function(){
        $('#resp').remove();
    },5000);
}


function logar(obj)
{
    var dataUrl = $(obj).attr('data-url');
    var login = $('#login').val();
    var  senha = $('#senha').val();
    
    if($.trim($('#login').val()) == '' || $.trim($('#senha').val()) == ''){
        alert('preencher campos');
        return;
    }
   
   $.post(
       dataUrl,
       {
           login: login,
           senha: senha,
       },
       function(data, status) {
           
            
        
       },
       'json' // tipo dos dados q ira retornar, nesse caso ira esperar "json"
    );
}

