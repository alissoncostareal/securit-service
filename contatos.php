<section id="fale-conosco" class="mt-1">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="title-h1 mt-auto text-center">Fale conosco<br/>
					<span class="lead">Agende sua visita ou peça seu orçamento sem compromisso</span></h1>
					<div id="preloader" class="alert text-center" 
					style="display: none;">
					<img src="assets/imgs/preloader.gif" align="absmiddle"> <br> <small><i>Aguarde, enviando sua mensagem...</i></small> <br><br>
					</div>
				<div id="contato_form_sucesso" class="alert alert-success" style="display: none;"> Sua mensagem foi enviada com sucesso! </div>
				<form class="form-all" id="demo-form" action="dados.php" method="post">
					<div class="row">
						<div class="col-sm-12">
							<label for="nome">Nome*</label>
							<input type="text" class="form-control input-cnt" id="nome" name="nome" required="true">
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
							<label>Mensagem*</label>
							<textarea class="form-control input-cnt" name="areatext" id="areatext" rows="5"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12" align="center">
							<input type="hidden" name="token" value="<?php echo $token; ?>">
							<button type="submit" class="btn btn-primary envio-mail lato-light" onclick="EnviaDados();">Enviar</button>
					</div>
				</div>
				<!-- criar função -->
			</form>
		</div>
	</div>
</div>
</section>