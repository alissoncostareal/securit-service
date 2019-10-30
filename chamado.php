<?php 
error_reporting(E_ERROR | E_PARSE);
session_start();

require_once 'securit/security.csrf.php';

$security = new \security\CSRF;
$token = $security->set(3, 3600);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="assets/css/default.css">
    <link rel="stylesheet" href="assets/css/media.css">
    <title>Securit service</title>
    <link rel="icon" type="image/png" href="assets/imgs/icons/favicon.png"/>
    <link rel="icon" type="image/png" href="assets/imgs/icons/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="assets/imgs/icons/favicon-16x16.png" sizes="16x16" />
</head>

<body>
    <header class="menu" id="">
        <div class="wrapper wrapper_1200">
            <h1 class="navbar-brand logo-menu">
                <a href="http://securitservice.com.br/"><img src="assets/imgs/logo-securit-azul.png" class="img-responsive logo-securit-down logo-securit"></a>
            </h1>
            <nav class="lato-black">
                <ul class="menu-ul">
                    <li><a href="http://securitservice.com.br/" title="inicio"><p>home</p></a></li>
                    <li><a href="http://securitservice.com.br/#empresa" title="empresa"><p>securit service</p></a></li>
                    <li><a href="http://securitservice.com.br/#servicos" title="serviços"><p>serviços</p></a></li>
                    <li><a href="http://securitservice.com.br/#parceiros" title="Parceiros"><p>Parceiros</p></a></li>
                    <li><a href="http://securitservice.com.br/#fale-conosco" title="Contato"><p>Contatos</p></a></li>
                </ul>
            </nav>
            <div class="nav-button lato-black">
                <a target="_blank" href="chamado.php" class="button-helpdesk button-helpdesk-down" title="Acessar Help Desk">solicitação</br>técnica<a>
            </div>
            <div class="toggle">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </div>
    </header>
<section id="fale-conosco" class="chamado">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="title-h1 mt-auto text-center">Chamados<br/>
					<span class="lead">Há algum problema técnico? Faça um chamado e aguarde!</span></h1>
					<div id="preloader" class="alert text-center" 
					style="display: none;">
					<img src="assets/imgs/preloader.gif" align="absmiddle"> <br> <small><i>Aguarde, enviando seu chamado...</i></small> <br><br>
					</div>
				<div id="contato_form_sucesso" class="alert alert-success" style="display: none;"> seu chamado foi enviado com sucesso! </div>
				<form class="form-chamado" id="chamado-form" action="dados-chamado.php" method="post">
					<div class="row">
						<div class="col-sm-6">
							<label for="nome">Nome*</label>
							<input type="text" class="form-control input-cnt" id="nome" name="nome" required="true">
						</div>
						<div class="col-sm-6">
							<label for="empresa">Empresa*</label>
							<input type="text" class="form-control input-cnt" id="empresa" name="empresa" required="true">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label for="telefone">Telefone*</label>
							<input type="text" class="form-control input-cnt" name="telefone" id="telefone" required="true">
						</div>
						<div class="col-sm-6">
							<label for="email">Email*</label>
							<input type="email" class="form-control input-cnt" name="email" id="email" aria-describedby="emailHelp" required="true">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<label>Fale sobre o problema detalhadamente*</label>
							<textarea class="form-control input-cnt" name="areatext" id="areatext" rows="5"></textarea>
						</div>
					</div>	
					<div class="row">
						<div class="col-sm-12" align="center">
							<input type="hidden" name="token" value="<?php echo $token; ?>">
							<button type="submit" class="btn btn-primary envio-mail lato-light" onclick="EnviaChamado();">Enviar</button>
					</div>
				</div>
				<!-- criar função -->
			</form>
		</div>
	</div>
</div>
</section>
<?php require_once('modais/modal-1.php'); ?>

<?php require_once('modais/modal-2.php'); ?>

<?php require_once('modais/modal-3.php'); ?>

<?php require_once('modais/modal-serv.php'); ?>
<?php include 'assets/includes/footer.php'; ?>