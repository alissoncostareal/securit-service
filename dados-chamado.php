<?php 

    // require_once('recaptcha/recaptchalib.php');

    // $privatekey = "6Lf4Fl4UAAAAAJWHepU8PRUjjSyDKYBARhYna4Wf";
    // $recaptcha_response = isset($_POST["g-recaptcha-response"])?$_POST["g-recaptcha-response"]:'';

    // $resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $recaptcha_response);
    // if (!$resp->success){
    //     die ("O reCAPTCHA não foi informado corretamente. Volte e tente novamente.");
    //     exit();
    // }



session_start();

if (isset($_POST) && empty($_POST)) {
    exit(); 
} else{

    require_once 'securit/security.csrf.php';

    $security = new \security\CSRF;
    
    if(isset($_POST['token'])) {
        
        if($security->get($_POST['token'])) {


            /*SAVE BANCK*/
            try{
                $security->delete($_POST['token']);
                
                $conexao = new PDO("mysql:host=localhost;dbname=u223239252_secur;charset=utf8","u223239252_user","zSmfEZbgGQc9");
            } catch(PDOException  $e ){
                die("Error: ".$e->getMessage());
            }

            try {
                $nome        =   $_POST['nome'];
                $empresa     =   $_POST['empresa'];
                $telefone    =   $_POST['telefone'];
                $email       =   $_POST['email'];
                $mensagem    =   $_POST['areatext'];
                
                $stmt = $conexao->prepare("INSERT INTO acao_chamado (nome, empresa, telefone, email, mensagem) VALUES (:nome, :empresa, :telefone, :email, :mensagem)");
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':empresa', $empresa);
                $stmt->bindParam(':telefone', $telefone);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':mensagem', $mensagem);
                $stmt->execute();
            } catch (Exception $e) {
                die("Error: ".$e->getMessage());    
            }

            /*envio da resposta ao cliente*/


            $para        =   $email;    
            $assunto     =   "Atendimento - Securit Service";

            $corpo  = "Prezado,<br/>";
            $corpo .= "Sua solicitação de Atendimento foi recebida e em breve você terá uma resposta.<br/>";
            $corpo .= "Atenciosamente,<br/>";
            $corpo .= "<b>Atendimento Securit Service</b>";

            $header = "Content-Type: text/html; charset: utf-8\n";
            $header .= "From: Securit Service Reply-to: atendimento@securitservice.com.br\n";

            if(mail($para,$assunto,$corpo,$header)){
             echo "Mensagem enviada com sucesso.";
            }else{
             echo "A mensagem não pode ser enviada";
            }

            /*envio da resposta ao cliente*/

            $email = $para;

            require_once('mail/class.phpmailer.php');

            $toEmail     =   "suportetecnico@securitservice.com.br,candido@securitservice.com.br";
            $assunto     =   "Atendimento - Securit Service";

            $HTML_mensagem  = '
            <center><h2>Abertura de chamado<br/></h2></center>
            <h3>Dados do cliente:<br/></h3>
            <b>Nome:</b>'.$nome.'<br/>
            <b>Empresa:</b>'.$empresa.'<br/>
            <b>Telefone: </b>'.$telefone.'<br/>
            <b>E-mail: </b>'.$email.'<br/>
            <b>Mensagem:</b> '.$mensagem.' <br/>
            ';


            try {

                $mail = new PHPMailer();
                $mail->CharSet     = "UTF-8";
                $mail->ContentType = "text/html";
                $mail->IsSMTP();
                $mail->Host = "smtp.weblink.com.br";
                $mail->Port = '465';
                $mail->SMTPSecure = 'ssl';
                $mail->SMTPAuth    = true;
                $mail->Username    = "atendimento@securitservice.com.br";
                $mail->Password    = "KpX7g8iSn21f";
                $mail->From        = "atendimento@securitservice.com.br";
                $mail->FromName    = "Securit Service";
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

                die("sucesso");

            } catch (Exception $e) {
                die($e->getMessage());
            }


            
        } else {

            exit();

        }
    }
}
?>