<?php 

	require_once('recaptcha/recaptchalib.php');

	$privatekey = "6LeNiloUAAAAAFf4_idJpsvphBZyDXAqcqnKO_6-";
	$recaptcha_response = isset($_POST["g-recaptcha-response"])?$_POST["g-recaptcha-response"]:'';

	$resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $recaptcha_response);
	if (!$resp->success){
	    die ("O reCAPTCHA não foi informado corretamente. Volte e tente novamente.");
	    exit();
	}

	require_once('mail/class.phpmailer.php');

	$toEmail     =   "alisson.franciscocosta@gmail.com";
	$assunto     =   "Securit Service - acesso pelo site";
	
	$nome        =   $_POST['nome'];
	$telefone    =   $_POST['telefone'];
	$email       =   $_POST['email'];
	$mensagem    =   $_POST['mensagem'];

	$HTML_mensagem  = '
		<h2>Campanha:<br/><small>Traga seu n&uacute;mero de celular para Vivo e desbloqueie um desconto de at&eacute; R$720 em aparelho!</small></h2>
		<b>Nome:</b>'.$nome.'<br/>
		<b>E-mail: </b>'.$email.'<br/>
		<b>Telefone: </b>'.$telefone.'<br/>
		<b>mensagem:</b> '.$mensagem.' <br/>
	';
	
	
	try {

	    $mail = new PHPMailer();
	    $mail->CharSet     = "UTF-8";
	    $mail->ContentType = "text/html";
	    $mail->IsSMTP();
	    $mail->Host = "br456.hostgator.com.br";
	    $mail->Port = '465';
	    $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth    = true;
        $mail->Username    = "marketing@smarttelcom.com.br";
        $mail->Password    = ")O(I*U123";
	    $mail->From        = "marketing@smarttelcom.com.br";
	    $mail->FromName    = "Smart Vivo Empresa";
	    $cli_email = explode(",",$toEmail);
	    for($xx=0;$xx<count($cli_email);$xx++)
	    {
	        if($xx==0){
	            $mail->AddAddress(trim($cli_email[$xx]));
	        }else{
	            $mail->AddCC(trim($cli_email[$xx]));
	        }
	    }
	    $mail->AddReplyTo($email, $nome);
	    $mail->Subject = $assunto;
	    $mail->Body = $HTML_mensagem;
	    $mail->Send();

		// $header = "Content-Type: text/html; charset: utf-8\n";
		// $header .= "From: $email Reply-to: $email\n";
		// mail($para,$assunto,$corpo,$header);

		echo "sucesso";

	} catch (Exception $e) {
		die($e->getMessage());
	}


?>