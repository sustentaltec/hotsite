<?php

define('EMAIL_TO', 'contato@sustentaltec.com.br');
define('EMAIL_SUBJECT', 'Contato pelo hotsite');
define('CAPTCHA_ENABLED', '0'); // 0 - Disabled, 1 - Enabled

if ($_POST) {
	$name = $_POST['name'];
	$email = $_POST['email']; 
	$message = $_POST['message'];

	if (empty($name) || empty($email) || empty($message)) { $msg = 'Preencha o formulário'; }
	else if (!$email == '' && (!strstr($email,'@') || !strstr($email,'.'))) { $msg = 'Seu e-mail não é válido'; }
	else {
		$headers = "From: ".$name." <".$email.">\r\n";
		$headers .= "Reply-To: ".$name." <".$email.">\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

		$body = '
		<html><body>
		<table border="0" cellspacing="0" cellpadding="0" width="100%">
		<tr><td style="border-bottom: solid 1px #CCC; font-size:18px; font-weight:bold; padding:10px;" colspan="2">'.$email_subject.'</td></tr>
		<tr><td valign="top" style="padding:10px; border-bottom: solid 1px #CCC;" valign="top"><b>Name:</b></td><td style="padding:10px; border-bottom: solid 1px #CCC;">'.$name.' ('.$email.')</td></tr>
		<tr><td valign="top" style="padding:10px; border-bottom: solid 1px #CCC;" valign="top"><b>Message:</b></td><td style="padding:10px; border-bottom: solid 1px #CCC;">'.$message.'</td></tr>
		</table>
		</body></html>
		';

		mail(EMAIL_TO, EMAIL_SUBJECT, $body, $headers);
	}
}

header('Location: index.php');
exit;

?>