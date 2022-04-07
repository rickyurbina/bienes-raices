<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'extensions/phpmailer/src/PHPMailer.php';
require 'extensions/phpmailer/src/SMTP.php';
require_once "models/crud.php";

class Mailer{

	public function 	envia(){

		if (isset($_REQUEST['enviaMail'])){
			$email = $_POST['mailLost'];


			$result = Datos::mdlBuscaEmpleadoMail($email,"usuarios");



			if (!empty($result)){

				$pass = $result["password"];
			    $nombre = $result['nombre'];
			    $subject = 'Recuperacion de Password';
			}

			 if(!empty($pass)){

				//*********************************************************************************************************************************************
				$mail = new PHPMailer();

				$mail->SetFrom( 'noreply@bienesraicescc.com' , 'BRCC IT Support' );
				$mail->AddReplyTo( 'bienesraicescc.com' , 'BRCC IT Support' );
				//foreach( $toemails as $toemail ) {
					//$mail->AddAddress( $authorEmail , $author );
				    $mail->AddAddress( $email, $nombre );
				//}

				$mail->Subject = $subject;

				$referrer = $_SERVER['HTTP_REFERER'] ? '<br><br><br>This Form was submitted from: ' . $_SERVER['HTTP_REFERER'] : '';


				$body = '
				<div style="margin-left:150px; padding:50px;width:600px;">
				<img src="http://bienesraicescc.com/controlPanel/views/img/logos/black-logo.png" align="left" style="width:350px;height:110px;" alt=""/>
				<table width="600" border="0" cellspacing="10" cellpadding="10">
				  <tbody style="font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif; color:#070C7F; text-align:left">
				    <tr style="background-color:#166518">
				      <td style="color:#FFFFFF; text-align:center"><h1>Recuperaci&oacute;n de Password</h1></td>
				    </tr>
				    <tr>
				      <td><h2>Hola '.$nombre.'</h2></td>
				    </tr>
				    <tr>
				      <td><h3>Tu password es :<strong> '.$pass.'</strong></h3></td>
				    </tr>
				    <tr>
				      <td style="font-size:12px; text-align:center"><p>Este es un mensaje automatico<br> Por favor no responda a este remitente.</p></td>
				    </tr>
				  </tbody>
				</table>

				</div>';


				$mail->MsgHTML( $body );
				$sendEmail = $mail->Send();

				if( $sendEmail == false ){

					return "error al enviar";
				}
			return "ok";
			} //if($pass

		else {
			return "no existe";
		}
	} // REQUEST

	} //funcion envia

} //Mailer


?>