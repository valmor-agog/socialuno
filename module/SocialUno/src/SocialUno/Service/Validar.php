<?php

namespace SocialUno\Service;

use SocialUno\Service\Service;

class Validar extends Service
{
    public function validarEmail($email) 
    {
        
        if(preg_match("/^([[:alnum:]_.-]){3,}@([[:lower:][:digit:]_.-]{3,})(.[[:lower:]]{2,3})(.[[:lower:]]{2})?$/", $email)){ 
            return true; 
        } 
        
        return false;
    }
    
    public function validaSenha($senha)
    {
        if(strlen($senha) > 5){
            return true;
        }
        
        return false;
    }
}
