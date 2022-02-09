<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mail
 *
 * @author ernesto.ruales
 */
require 'php-mailer/PHPMailerAutoload.php';

class Mail
{

    private $mail;
    private $email = "ereyes@macrogramec.com";
    private $pass = "12345";
    private $host = "mail.macrogramec.com";

    function __construct()
    {
        $this->conectar();
    }

    public function conectar()
    {
        $this->mail = new PHPMailer();
        $this->mail->IsSMTP();
        $this->mail->SMTPAuth = true;

        //Temporal
        $this->mail->SMTPSecure = "ssl";  // tls    //ssl
        $this->mail->Host = $this->host; // SMTP a utilizar. Por ej. smtp.elserver.com
        $this->mail->Username = $this->email; // Correo completo a utilizar
        $this->mail->Password = $this->pass; // Contrasena	/
        $this->mail->Port = 465; // Puerto a utilizar 465   587
        // $this->mail->Port = 25; // Puerto a utilizar 465   587
    }

    public function enviarCorreo($from, $destinatario, $texto, $asunto, $archivo)
    {
        $this->mail->ClearAllRecipients();
        $this->mail->From = $from;
        $this->mail->FromName = $from; // El titulo dentro del correo
        $this->mail->IsHTML(true); // El correo se envia como HTML
        $this->mail->Subject = $asunto;  // Asunto
        $correos = explode(";", $destinatario);
        foreach ($correos as &$correo) {
            $this->mail->AddAddress(trim($correo));
        }
        $this->mail->Body = $texto;
        $this->mail->CharSet = 'UTF-8';
        $this->mail->addAttachment($archivo);
        if (!$this->mail->Send()) {
            return array(false, $this->mail->ErrorInfo);
        }
        //return array(true,"bien");
        return true;
    }
    public function crearUsuario($archivo, $correoRemitente, $correo_destinatario, $diseno)
    {
        $body = $diseno;
        $asunto = "Cuenta SIRC";

        return $this->enviarCorreo($correoRemitente, $correo_destinatario,  $body, $asunto, $archivo);
    }
 
}
