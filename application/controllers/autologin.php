<?php

class Autolog extends CI_Controller
{
   $privateKey = "801*)!d7vw9w5clp12l;0smva90a@@<ksvoa";
   $timeout = new DateTime('Tomorow');
   $url = echo site_url('intra/main');

   public function createToken($privateKey, $url, $login, $timeout)
   {
      return (hash('sha256', $privateKey . $url . $login . $timeout));
   }

   public function createUrl($privateKey, $url, $login, $timeout)
   {
      $this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
      $this->form_validation->set_rules('submit', 'Submit', 'trim|required|xss_clean');
      if ($this->form_validation->run())
      {
         $hash = createToken($privateKey, $url, $login, $timeout->getTimestamp());
         $autoLoginUrl = http_build_query(array(
            'name' => $login,
            'timeout' => $timeout,
            'token' => $hash
            ));
         return ($url.'?'.$autoLoginUrl);
      }
   }

   public function checkUrl($privateKey)
   {  
      if((int)$_GET['timeout'] > time() )
      {
          return false;
      }

      //check the user credentials (he exists, he have right on this page)

      $hash = createToken($privateKey, $_SERVER['PHP_SELF'], $_GET['name'], $_GET['timeout']);

      return ($_GET['token'] == $hash);
   }

   public function autologin()
   {
   $this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
   if ($this->form_validation->run())
   {

   }
   }
}

?>
