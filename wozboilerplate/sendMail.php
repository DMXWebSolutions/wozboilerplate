<?php

/* Run: 
    composer require phpmailer/phpmailer
    to do download of paste vendor
*/
    
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$btnSend = filter_input(INPUT_POST, 'btnSend', FILTER_SANITIZE_STRING);

if ($btnSend) {

    $nome      =  $_POST['name'];
    $email     =  $_POST['email'];
    $mensagem  =  $_POST['message'];

    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);   

    try {

        $mail->SMTPDebug = 0;                            
        $mail->isSMTP();                                      
        $mail->Host = '';  
        $mail->SMTPAuth = true;                               
        $mail->Username = '';                 
        $mail->Password = '';                                                      
        $mail->Port = 587;                                    
        $mail->CharSet = 'UTF-8';

        $mail->setFrom("comapany.com", "EXAMPLE COMPANY");
        $mail->addAddress('support@comapany.com', 'EXAMPLE COMPANY');    
        $mail->addReplyTo('support@comapany.com', 'EXAMPLE COMPANY');

        $mail->isHTML(true);                                  
        $mail->Subject = 'Example Company - Nova mensagem!';
        $mail->Body    = '<p>Nome: ' . $nome . '</p>'. 
                         '<p>Email: ' . $email . '</p>'.
                         '<p>Mensagem: ' . $mensagem . '</p>';
        $mail->send();
        
        $_SESSION['status'] = "<div class='alert alert-success'><b>Sucesso!</b> Email enviado com êxito. </div>";

        header('location:index.php');

    } catch (Exception $e) {
        
        $_SESSION['status'] = "<div class='alert alert-danger'><b>Ops!</b> Ocorreu algum problema. Email não enviado. </div>";

        header('location:index.php');
    }
}

?>