<?php  

require_once("ApiMailchimp.php");

        define('MAILCHIMP_KEY', '03439f18a452ccc27a75b291034ed596-us4');
        define('MAILCHIMP_LIST_ID', 'e301c817dc');
        define('MAILCHIMP_DOUBLE_OPTIN', 'false'); //Enviar e-mail de confirmação? true=sim false=não
        define('MAILCHIMP_UPDATE_EXISTING', 'true'); //Substitui contato existente? true=sim false=não



    function cadastra_email_mailchimp($email){
   
      $MailChimp1 = new MailChimp(MAILCHIMP_KEY);
      $result1 = $MailChimp1->call('lists/subscribe', array(
          'id' => MAILCHIMP_LIST_ID,
          'email' => array('email' => $email),
          'double_optin' => MAILCHIMP_DOUBLE_OPTIN, //CONFIRMAÇÃO DE EMAIL
          'update_existing' => MAILCHIMP_UPDATE_EXISTING, //ATUALIZAR LEAD EXISTENTE

      ));




        if ($result1) {
            response(true, 'subscribed');
        }else{
           response(false, 'ERRO');
        }
    }

    cadastra_email_mailchimp('amorimmarco071@gmail.com');

    function remove_email_mailchimp($email){
         
        $MailChimp1 = new MailChimp(MAILCHIMP_KEY);
        $result1 = $MailChimp1->call('lists/unsubscribe', array(
            'id' => MAILCHIMP_LIST_ID,
            'email' => array('email' => $email),
            'double_optin' => MAILCHIMP_DOUBLE_OPTIN, //CONFIRMAÇÃO DE EMAIL
            'update_existing' => MAILCHIMP_UPDATE_EXISTING, //ATUALIZAR LEAD EXISTENTE
   
                ));


        if ($result1) {
            response(true, 'unsubscribe');
        }else{
           response(false, 'ERRO');
        }
         
    }

  
      function response($responseStatus, $responseMsg) {
       $out = json_encode(array('status' => $responseStatus, 'msg' => $responseMsg)); 
       echo $out;
      }

