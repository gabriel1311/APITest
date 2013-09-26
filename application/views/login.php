<div class="container">


<?php
	
	
	if(empty($naoEncontrado))
	{
		$naoEncontrado = '';
	}
	if(empty($buscarSenha))
	{
		$buscarSenha = '';
	}
	if(empty($emailEnviado))
	{
		$emailEnviado = '';
	}
	if(empty($erroLogin))
	{
		$erroLogin = '';
	}


	
	if($buscarSenha == 'sim')
	{?>
		
		<form class="form-horizontal" method="post" action="<?php echo site_url('login/enviaSenha') ?>">
			<fieldset>
			
			<!-- Form Name -->
			<legend>Recuperação de Senha</legend>
			
			<!-- Appended Input-->
			<div class="control-group">
			  <label class="control-label" for="appendedtext">E-mail</label>
			  <div class="controls">
			    <div class="input-append">
			      <input id="txtEmail" name="txtEmail" class="input-xlarge" type="text" required="">
			      <button class="btn" type="submit">Enviar Senha!</button>
			    </div>
			    <p class="help-block">informe o e-mail de cadastro.</p>
			  </div>
			</div>
			
			</fieldset>
		</form>
		
		<?php
		
		
		
		echo $naoEncontrado;
		
		
		?>

		
	<?php	
	}


	
	if($buscarSenha == '')
	{?>

		<form class="form-horizontal" method="post" action="<?php echo site_url('login/validarUsuario') ?>">
			<fieldset>
			
			<!-- Form Name -->
			<legend>Área Restrita</legend>
			
			
			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label" for="txtUser">Usuário</label>
			  <div class="controls">
			    <input id="txtUser" name="txtUser" type="text" placeholder="" class="input-medium" required="">
			    
			  </div>
			</div>
			
			<!-- Password input-->
			<div class="control-group">
			  <label class="control-label" for="txtSenha">Senha</label>
			  <div class="controls">
			    <input id="txtSenha" name="txtSenha" type="password" placeholder="" class="input-medium" required="">
			    <p class="help-block"><a href='<?php echo site_url('login/recuperarSenha'); ?>'>Esqueci a Senha</a></p>
			  </div>
			</div>
			
			<!-- Button -->
			<div class="control-group">
			  <label class="control-label" for="singlebutton"></label>
			  <div class="controls">
			    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Entrar</button>
			  </div>
			</div>
			
		</fieldset>
		</form>


<?php




	if($emailEnviado == "sim")
	{?>
		<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">×</button>
			A senha foi enviada para seu email. :)
		</div><?php
		
	}
	
	if($erroLogin == "sim")
	{?>
		<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">×</button>
			Login ou Senha Inválido.
		</div><?php
		
	}
	





}
?>


</div>