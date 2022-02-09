<?php
require_once "../../conexion.php";
class Correo
{

    function crearUsuario($correo)
    {
        // DISENO
        $diseno = "";

        $Segoe_UI = 'Segoe_UI';
        $Montserrat = '.$Montserrat.';
        
        $diseno .= '
        <html>
            <body
            style="margin: 0; padding: 0; width: 100%; word-break: break-word; -webkit-font-smoothing: antialiased; --bg-opacity: 1; background-color: #eceff1; background-color: rgba(236, 239, 241, var(--bg-opacity));">
            <div style="display: none;">Iglesia casa de fe</div>
            <div role="article"  lang="en">
                <table style="font-family: Montserrat, -apple-system, '.$Segoe_UI.', sans-serif; width: 100%;" width="100%"
                    cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td align="center"
                            style="--bg-opacity: 1; background-color: #eceff1; background-color: rgba(236, 239, 241, var(--bg-opacity)); font-family: Montserrat, -apple-system, '.$Segoe_UI.', sans-serif;"
                            bgcolor="rgba(236, 239, 241, var(--bg-opacity))">
                            <table class="sm-w-full" style="font-family: '.$Montserrat.',Arial,sans-serif; width: 600px;"
                                width="600" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                    <td class="sm-py-32 sm-px-24" style="font-family: Montserrat, -apple-system, '.$Segoe_UI.', sans-serif; padding: 48px; text-align: center;">
    
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" class="sm-px-24" style="font-family: '.$Montserrat.',Arial,sans-serif;">
                                        <table style="font-family: '.$Montserrat.',Arial,sans-serif; width: 100%;" width="100%"
                                            cellpadding="0" cellspacing="0" role="presentation">
                                            <tr>
                                                <td class="sm-px-24"
                                                    style="--bg-opacity: 1; background-color: #ffffff; background-color: rgba(255, 255, 255, var(--bg-opacity)); border-radius: 4px; font-family: Montserrat, -apple-system, '.$Segoe_UI.', sans-serif; font-size: 14px; line-height: 24px; padding: 48px; text-align: left; --text-opacity: 1; color: #626262; color: rgba(98, 98, 98, var(--text-opacity));"
                                                    bgcolor="rgba(255, 255, 255, var(--bg-opacity))" align="left">
                                                    <p align="center" class="sm-leading-32"
                                                        style="font-weight: 600; font-size: 20px; margin: 0 0 24px; --text-opacity: 1; color: #263238; color: rgba(60, 116, 147, var(--text-opacity));">
                                                        Su cuenta fue creada el SIRC
                                                    </p>
    
                                                    
    
                                                    <table style="font-family: '.$Montserrat.',Arial,sans-serif; width: 100%;"
                                                        width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                                        <tr>
                                                            <td
                                                                style="font-family: '.$Montserrat.',Arial,sans-serif; padding-top: 32px; padding-bottom: 32px;">
                                                                <div
                                                                    style="--bg-opacity: 1; background-color: #eceff1; background-color: rgba(236, 239, 241, var(--bg-opacity)); height: 1px; line-height: 1px;">
                                                                    &zwnj;</div>
                                                            </td>
                                                        </tr>
                                                    </table>
    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: '.$Montserrat.',Arial,sans-serif; height: 20px;"
                                                    height="20"></td>
                                            </tr>
    
                                            <tr>
                                                <td style="font-family: '.$Montserrat.',Arial,sans-serif; height: 16px;"
                                                    height="16"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            </body>
        </html>
        ';
    
        // FIN
        
        require 'class/c_correo.php';
        $mail = new Mail();
        $data = Conexion::buscarRegistro("SELECT * FROM configuracion_correo where estado = 'A' ");
        $envia =  $data['correo'];
        // $validar = $mail->enviarSugerencia("",envia, recibe, $diseno);
        $validar = $mail->crearUsuario("",$envia, $correo, $diseno);
        if ($validar){
            $return["status"] = "correcto";
            $return["mensaje"] = "Correo enviado";
        }else{
            $return["status"] = "error";
            $return["mensaje"] = "Error al enviar el correo, intentalo de nuevo";
        }

        return $return;
    }

}
