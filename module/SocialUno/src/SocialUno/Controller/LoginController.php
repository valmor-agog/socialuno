<?php

namespace SocialUno\Controller;

use SocialUno\Controller\ActionController;
use Zend\View\Model\ViewModel;
use SocialUno\Form\Login;


class LoginController extends ActionController
{
    public function indexAction()
    {
        $form = new Login();
        return new ViewModel([
            'form' => $form
        ]);
    }
    
    public function validaCadastroAction()
    { 
       $return = array('result' => true);
            
       if(!$this->getService('SocialUno\Service\Validar')->validaSenha($_GET['senha'])){
           $return = array(
               'result' => false,
               'type' => 'caracterSenha'
           );
       }
       
       if(!$this->getService('SocialUno\Service\Validar')->validarEmail($_GET['login'])){
           $return = array(
               'result' => false,
               'type' => 'email'
           );
       }
       
       $this->response->setContent(json_encode($return));
       return $this->response;    
  
    }
    
    public function logarAction()
    {
        if($this->getRequest()->isPost()){
             
            $retorno = false;
            
             if($this->getService('SocialUno\Service\Usuario')->login($this->getRequest()->getPost())){
                 $retorno = true;
             }
             
            $this->response->setContent($retorno);
            return $this->response;
       }
    }
    
}
