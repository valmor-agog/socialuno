<?php

namespace SocialUno\Service;

use SocialUno\Service\Service;

class Usuario extends Service
{
    
    public function login($values)
    {
        $select = $this->getObjectManager()->createQueryBuilder()
                ->select('usuario.email','usuario.senha')
                ->from('SocialUno\Model\Usuario', 'usuario')
                ->where('usuario.email = ?1 and usuario.senha = ?2')
                ->setParameters(array(1 => $values['login'], 2 => md5($values['senha'])));  
        
        $result = $select->getQuery()->getArrayResult();
        
        return $this->validarLogin($result);
        
    }
    
    private function validarLogin($result)
    {
        if(!empty($result)){
            
            return true;
            
        }
        
        return false;
    }


//    public function getUsuario($email)
//    {
//       $select = $this->getObjectManager()->createQueryBuilder()
//                        ->select()
//                        ->from()
//                        ->where()
//                        ->setParameter()
//                         ->orderBy();
//        return $select->getQuery()->getArrayResult();
//    }
    
}
