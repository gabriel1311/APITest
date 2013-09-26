 
<div class="container">


	<div class="alert alert-info">
		<?php
		
		if(empty($admin))
		{
			$admin = ''; //tratamento para evitar erros se nao tiver nada como parametro
		}
		
		if($admin == 'admin')
		{
			echo "<h2>Administra��o - API</h2>
			    <h6>Logado como: ".$this->session->userdata('nome')." / ".$this->session->userdata('perfil')."</h6>";
				?>
				<button class="btn btn-mini btn-info" type="button" onclick="location.href= '<?php echo site_url(); ?>' ">Home</button>
				<button class="btn btn-mini btn-danger" type="button" onclick="location.href= '<?php echo site_url("login/logout"); ?>' ">Sair</button>
				<?php
				
		}
		else
		{?>
			<h2>Teste PHP para Empresa API</h2>
			<h6>Logado como: <?php echo $this->session->userdata('nome')." / ".$this->session->userdata('perfil');?></h6>
			<h6><a href="<?php echo site_url('frontpage/admin'); //echo site_url('frontpage/admin'); ?>">Admin</a></h6>
			<?php
		}
	?>
			
	</div>   
     
    
</div>  
 
 
 <div class="container">
 
 <div class="span3" style="border-style:solid; padding:5px; margin-bottom:10px" id="cssmenu">
            
              
              <?php
              if($this->session->userdata('perfil') == "admin")
              {
	              $controlePerfil = "";
              }
              else
              {
	              $controlePerfil = 'hidden=""';
              }
              
              ?>
              
              
              
				<ul>
				   <li class='active'><a href='<?php echo site_url();?>'><span>HOME</span></a></li>
				   <li class='has-sub'><a href='#'><span>CARROS</span></a>
				      <ul>
				         <li class='active'><a href='<?php echo site_url('carros/newCar'); ?>'><span>CADASTRO</span></a>
				         </li>
				         <li class='active'><a href='<?php echo site_url('carros/searchCar'); ?>'><span>BUSCA</span></a>
				         </li>
				      </ul>
				   </li>
				   <li class='has-sub'><a href='#'><span>MARCAS</span></a>
				      <ul>
				         <li class='active'><a href='<?php echo site_url('marcas/newMarca'); ?>'><span>CADASTRO</span></a>
				         </li>
				         <li class='active'><a href='<?php echo site_url('marcas/searchMarca'); ?>'><span>BUSCA</span></a>
				         </li>
				      </ul>
				   </li>
				   <li class='has-sub' <?php echo $controlePerfil;?> ><a href='#'><span>USU�RIOS</span></a>
				      <ul>
				         <li class='active'><a href="<?php echo site_url('usuarios/newUser'); ?>"><span>CADASTRO</span></a>
				         </li>
				         <li class='active'><a href='<?php echo site_url('usuarios/searchUser'); ?>'><span>BUSCA</span></a>
				         </li>
				      </ul>
				   </li>
				   <li class='active'><a href='<?php echo site_url('login/logout');?>'><span>SAIR</span></a></li>

				</ul>
              
              
              
</div>
       
           
                  
          
          <div id="main" class="span9">
             <div class="hero-unit" style="background-color:#F5F5F5; padding-top:5px; padding-bottom:5px; padding-left:30px">
              

<?php 

if(empty($info)) $info = '';
if($info == 'sim'){
	
?>
Desenvolver um sistema de cadastro de Carros.
<br> FrameWork - 3) CodeIgniter;
<br>front-end.- 1) BootStrap;
<br>Base de dados - 3) MySql;

 <br>
    - Cadastro de Novos usu�rios (No m�nimo dois perfis de acessos(funcion�rio, admin))
    - Recupera��o de senha
    - Registrar acesso no LOG
 <br>
    - Carro pertence a Marca
        Deve conter os seguinte dados m�nimos
            - Modelo
            - Ano             
            - Foto
            - Valor do carro
            - N�mero de parcelas m�ximo (3/6/12)
            - Valor total com juros (0,7%)
            - Data cadastro
            - Id usu�rio cadastro
 <br>
- Marca do carro
    - Marca
    - Data cadastro
    - Id usu�rio cadastro
<br>
- Regras de neg�cio
    - Somente usu�rios do perfil admin podem excluir dados
    - Somente usu�rios do perfil admin podem criar novos usu�rios
    - Somente usu�rios do perfil admin podem editar o valor do carro
<?php
}
 ?>      
       
       
       
       
              <?php 
         //novo usuario
              if($action == 'novo_usuario')
              {
              		
	              if(empty($inserir))
	              {
		              $inserir = "";
	              }
	              if($inserir == "ok")
	              {
		              ?><div class="alert alert-success">O Usu�rio foi inclu�do com sucesso.</div><?php
	              }
	              if($inserir == "erro")
	              {
		               ?><div class="alert alert-danger">Erro ao inserir o novo Usu�rio. Contate o suporte.</div><?php
	              }
	              
	              if(empty($usuario_carregado))
	              {
		              $usuario_carregado = "";
		              $valueId = '';
		              $valueNome = '';
		              $valueEmail = '';
		              $valueLogin = '';
		              $valuePerfil = '';
		              $url = site_url('usuarios/inserir');
		              $senha = "<div class='control-group'>
					  				<label class='control-label'>Senha</label>
					  				<div class='controls'>
					  					<input id='txtSenha'  name='txtSenha' type='password' class='input-small' required=''>	    
					  				</div>
					  			</div>";
	              }
	              else //carrega dados do usuario para editar
	              {
		              $valueNome = " value ='".$usuario_carregado['nome']."'";
		              $valueId = " value ='".$usuario_carregado['id_user']."'";
		              $valueEmail = " value ='".$usuario_carregado['email']."'";
		              $valueLogin = " value ='".$usuario_carregado['login']."'";
		              $valuePerfil = " value ='".$usuario_carregado['perfil']."'";
		              $url = site_url('usuarios/editar').'/'.$usuario_carregado['id_user'];
		              $senha = "";
		              
		              if($usuario_carregado['perfil']=='admin')
		              {
			              $checkedAdmin = 'checked=""';
			              $checkedFunc = '';
		              }
		              else
		              {
		              	  $checkedAdmin = '';
			              $checkedFunc = 'checked=""';
			          }
		              
	              }
	              
	              
	              
              ?>
              
	              
	              <form class="form-horizontal" method="post" action="<?php echo $url; ?>" enctype="multipart/form-data">
					<fieldset>
					
					<!-- Form Name -->
					<legend>Novo Usu�rio</legend>
					
					
					<input type="hidden" <?php echo $valueId;?> name="txtId">
					
					<!-- Text input-->
					<div class="control-group">
					  <label class="control-label">Nome</label>
					  <div class="controls">
					    <input id="txtNomeUser" name="txtNomeUser" <?php echo($valueNome); ?> type="text" class="input-xlarge"  required="">	    
					  </div>
					</div>
					<!-- Text input-->
					<div class="control-group">
					  <label class="control-label">E-mail</label>
					  <div class="controls">
					    <input id="txtEmail" name="txtEmail" <?php echo($valueEmail); ?> type="text" class="input-xlarge" required="">	    
					  </div>
					</div>
					<!-- Text input-->
					<div class="control-group">
					  <label class="control-label">Login</label>
					  <div class="controls">
					    <input id="txtLogin" name="txtLogin" <?php echo($valueLogin); ?> type="text" class="input-medium" required="">	    
					  </div>
					</div>
					<!-- Text input-->
					<?php echo $senha;?>
					
					<!-- Multiple Radios -->
					<div class="control-group">
					  <label class="control-label" for="radios">Perfil</label>
					  <div class="controls">
					    <label class="radio" for="radios-0">
					      <input type="radio" name="rdPerfil" id="radios-0" value="funcionario" <?php echo $checkedFunc;?>>
					      Funcion�rio
					    </label>
					    <label class="radio" for="radios-1">
					      <input type="radio" name="rdPerfil" id="radios-1" value="admin" <?php echo $checkedAdmin;?>>
					      Administrador
					    </label>
					  </div>
					</div>
				
					
					<!-- Button (Double) -->
					<div class="control-group">
					  <label class="control-label"></label>
					  <div class="controls">
					    <button id="btnGravarEmpresa" name="btnGravarEmpresa" class="btn btn-success">Gravar</button>
					  </div>
					</div>
					
					</fieldset>
					</form>


	              
	              
	             <?php 
              }//fim novo usuario
              
              
              
              
              
              
              //todos usu�rios
              if($action == 'busca_usuario')
              {
              	if(empty($excluirUsuario))
              	{
	              	$excluirUsuario = "";
              	}
              	else
              	{
	              	if ($excluirUsuario == 'sucesso')
	              	{
		            	?><div class="alert alert-success">O Usu�rio foi exclu�do com sucesso.</div><?php
	              	}
	              	else
	              	{
		              	?><div class="alert alert-warning"><?php echo $excluirUsuario;?></div><?php
	              	}

              	}
              	              

              	if(empty($usuario_atualizado))
              	{
	              	$usuario_atualizado = "";
              	}
              	
              	if($usuario_atualizado == 'sucesso')
              	{
	              	?><div class="alert alert-success">Usu�rio atualizado com sucesso!</div><?php
              	}
              	if($usuario_atualizado == 'erro')
              	{
	              	?><div class="alert alert-danger">Problemas ao atualizar o Usu�rio, comunique ao suporte t�cnico!</div><?php
              	}




              	
              	?>
              	<div class="row">
					<div class="span3">
						<h3>Usu�rios Cadastrados</h4>					
					</div>
				</div>
				
				<hr>
				
				<table class="table table-striped" style="padding:0px;" border="0">
							<thead>
							<tr style="font-weight:bold; font-size:13px">
								<td>Nome do Usu�rio</td>
								<td>E-mail</td>
								<td>Login</td>
								<td>Perfil</td>
								<td><center>Alterar</td>
								<td><center>Excluir</td>
							</tr>
						</thead>
						<tbody>					
						<?php
						
						if(empty($usuarios))
						{
							$usuarios = "";
						}
						
						for($i=1;$i<=(count($usuarios)/5);$i++)
						{?>

						
						<?php
						
					
						?><tr style="font-family:verdana; font-size:12px">
							<td><?php echo $usuarios['nome'.$i]; ?></td>
							<td><?php echo $usuarios['email'.$i]; ?></td>
							<td><?php echo $usuarios['login'.$i]; ?></td>
							<td><?php echo $usuarios['perfil'.$i]; ?></td>
							<td><center>
							<a href="<?php echo site_url('usuarios/buscarUsuario').'/'.$usuarios['id_user'.$i];?>"><i class="icon-wrench"></i></a>			
							</td>
							<td><center>
							<?php 
								$caminhoExcluir = site_url('usuarios/excluir')."/".$usuarios['id_user'.$i];	
							?>
								<a href="javascript:confirmaExclusao('<?php echo $caminhoExcluir;?>')">							
								<center><i class="icon-remove"></i></a>
							</td>
														
						</tr><?php
							
											
						}
				
				?>
					</tbody>
						
				</table>
              	<?php

              }

              
              
              
              
              
              
              
              
              
              
              
              
              
              //nova marca
              if($action == 'nova_marca')
              {
              		if(empty($nova_marca))
              		{
	              		$nova_marca = '';
              		}
              		
              		if($nova_marca == 'sucesso')
              		{
	              		?><div class="alert alert-success">Marca nova inclu�da com sucesso!</div><?php
              		}
              		if($nova_marca == 'erro')
              		{
	              		?><div class="alert alert-error">Erro ao incluir a nova marca, informe o suporte t�cnico!</div><?php
              		}
              		if($nova_marca == 'duplicado')
              		{
	              		?><div class="alert alert-warning">Esta marca j� est� cadastrada!</div><?php
              		}
              		
              		
              		if( ! empty($marca_carregada))
              		{
              			$value = " value='".$marca_carregada['nome_marca']."'";
              			$url   = site_url('marcas/editar').'/'.$marca_carregada['id_marca'];
              		}
              		else
              		{
	              		$value = "";
	              		$url = site_url('marcas/inserir');
              		}
              		
              		if(empty($marca_atualizada))
              		{
	              		$marca_atualizada = "";
              		}
              		if ($marca_atualizada == 'sucesso')
              		{
	              		?><div class="alert alert-success">Marca atualizada com sucesso!</div><?php
              		}
              		if ($marca_atualizada == 'erro')
              		{
	              		?><div class="alert alert-error">Erro ao atualizar o nome da marca, informe o suporte t�cnico!</div><?php
              		}
              		
              		
              ?>
	              
	              <form class="form-horizontal" method="post" action="<?php echo $url; ?>" enctype="multipart/form-data">
					<fieldset>
					
					<!-- Form Name -->
					<legend>Nova Marca</legend>
					
					<!-- Text input-->
					<div class="control-group">
					  <label class="control-label">Nome</label>
					  <div class="controls">
					    <input id="txtNomeMarca" name="txtNomeMarca" <?php echo $value;?> type="text" class="input-xlarge" required="">	    
					  </div>
					</div>
										
					
					<!-- Button (Double) -->
					<div class="control-group">
					  <label class="control-label"></label>
					  <div class="controls">
					    <button id="btnGravarEmpresa" name="btnGravarEmpresa" class="btn btn-success">Gravar</button>
					  </div>
					</div>
					
					</fieldset>
					</form>

              <?php
              }//fim nova marca
              
              
              
              
              
              
              
              
              //todas  marcas
              if($action == 'buscar_marca')
              {
              
              
              if(empty($excluirMarca))
              	{
	              	$excluirMarca = "";
              	}
              	if($excluirMarca == 'sim')
              	{
	              	?><div class="alert alert-success">Marca exclu�da com sucesso!</div><?php
              	}
              	if($excluirMarca == 'nao')
              	{
	              	?><div class="alert alert-error">Erro ao excluir a marca, informe o suporte t�cnico!</div><?php
              	}
              	if($excluirMarca == 'em_uso')
              	{
	              	?><div class="alert alert-warning">Erro ao excluir a marca, existem carros cadastrados com esta Marca!</div><?php
              	}

              	
              	?>
              	<div class="row">
					<div class="span3">
						<h3>Marcas Cadastradas</h4>					
					</div>
				</div>
				
				<hr>
				
				<table class="table table-striped" style="padding:0px;" border="0">
							<thead>
							<tr style="font-weight:bold; font-size:13px">
								<td>Nome da Marca</td>
								<td>Data de Cadastro</td>
								<td>Usu�rio</td>
								<td><center>Alterar</td>
								<td><center>Excluir</td>
							</tr>
						</thead>
						<tbody>					
						<?php
						
						if(empty($marcas))
						{
							$marcas = "";
						}
						
						for($i=1;$i<=(count($marcas)/4);$i++)
						{?>

						
						<?php
						
					
						?><tr style="font-family:verdana; font-size:12px">
							<td><?php echo $marcas['nome_marca'.$i]; ?></td>
							<td><?php echo date('d/m/Y', strtotime($marcas['data_cadastro'.$i])); ?></td>
							<td><?php echo $marcas['id_usuario'.$i]; ?></td>
							
							<td><center>
							<a href="<?php echo site_url('marcas/buscarMarca').'/'.$marcas['id_marca'.$i];?>"><i class="icon-wrench"></i></a>			
							</td>
							<td><center>
							<?php if($this->session->userdata('perfil') == "admin")
									{
										$caminhoExcluir = site_url('marcas/excluir')."/".$marcas['id_marca'.$i];	
									?>
										<a href="javascript:confirmaExclusao('<?php echo $caminhoExcluir;?>')"><?php 
									} 
									else
									{
										?><a data-toggle="modal" href="#addIdea" title="Seu perfil n�o est� liberado para exclus�es."</a><?php
									}
									
									?>
							<center><i class="icon-remove"></i></a>
							</td>
														
						</tr><?php
							
											
						}
				
				?>
					</tbody>
						
				</table>
              	<?php

              }
              
              
              
              
              
              
              
              
              
              
              
              //novo carro
              if($action == 'novo_carro')
              {
              		if(empty($error))
              		{
	              		$error = '';
              		}
              		else
              		{
	              		?><div class="alert alert-error"><?php echo($error);?></div><?php
              		}
              
              
              		if(empty($novo_carro))
              		{
	              		$novo_carro = '';
              		}
              		
              		if($novo_carro == 'sucesso')
              		{
	              		?><div class="alert alert-success">Carro novo inclu�do com sucesso!</div><?php
              		}
              		if($novo_carro == 'erro')
              		{
	              		?><div class="alert alert-error">Erro ao incluir o novo carro, informe o suporte t�cnico!</div><?php
              		}
              		if($novo_carro == 'duplicado')
              		{
	              		?><div class="alert alert-warning">Este carro j� est� cadastrado!</div><?php
              		}
              ?>
	              
	              <form class="form-horizontal" method="post" action="<?php echo site_url('carros/inserir'); ?>" enctype="multipart/form-data">
					<fieldset>
					
					<!-- Form Name -->
					<legend>Novo Carro</legend>
					
					<!-- Text input-->
					<div class="control-group">
					  <label class="control-label" for="txtModelo">Modelo</label>
					  <div class="controls">
					    <input id="txtModelo" name="txtModelo" type="text" placeholder="" class="input-xlarge" required="">
					    
					  </div>
					</div>
					
					<!-- Select Basic -->
					<div class="control-group">
					  <label class="control-label" for="sbMarca">Marca</label>
					  <div class="controls">
			   
					    <select id="sbMarca" name="sbMarca" class="input-medium">
					    	<?php 
					    	
					    	for($i=1; $i<=(count($marcas)/4); $i++)
					    	{
						    	?>	<option value="<?php echo $marcas['id_marca'.$i];?>"><?php echo $marcas['nome_marca'.$i]; ?></option>  <?php
					    	}
					    	 	
					  		?>
					    	
					    </select>
					  </div>
					</div>
					<!-- Text input-->
					<div class="control-group">
					  <label class="control-label" for="txtAno">Ano</label>
					  <div class="controls">
					    <input id="txtAno" name="txtAno" type="text" placeholder="" class="input-small" required="">
					    
					  </div>
					</div>
					
					<!-- Text input-->
					<div class="control-group">
					  <label class="control-label" for="txtValor">Valor</label>
					  <div class="controls">
					    <input id="valor" name="txtValor" type="text" placeholder="" class="input-medium" required="">
					    
					  </div>
					</div>
					
					<!-- Select Basic -->
					<div class="control-group">
					  <label class="control-label" for="sbParcelas">M�x. Parcelas</label>
					  <div class="controls">
					    <select id="sbParcelas" name="sbParcelas" class="input-mini">
					      <option>3</option>
					      <option>6</option>
					      <option>12</option>
					    </select>
					  </div>
					</div>
					
					<!-- File Button --> 
					<div class="control-group">
					  <label class="control-label" for="filebutton">Foto</label>
					  <div class="controls">
					    <input id="userfile" name="userfile" class="input-file" type="file">
					  </div>
					</div>
					
					
					<!-- Button (Double) -->
					<div class="control-group">
					  <label class="control-label"></label>
					  <div class="controls">
					    <button id="btnGravarEmpresa" name="btnGravarEmpresa" class="btn btn-success">Gravar</button>
					  </div>
					</div>
					
					</fieldset>
					</form>

              <?php
              }//fim novo carro

              
              
              
              
              
              
              
              
              
               //todos carros
              if($action == 'buscar_carro')
              {
              
              	if(empty($excluir))
              	{
	              	$excluir = "";
              	}
              	if($excluir == 'sim')
              	{
	              	?><div class="alert alert-success">Carro exclu�do com sucesso!</div><?php
              	}
              	if($excluir == 'nao')
              	{
	              	?><div class="alert alert-error">Erro ao excluir o carro, informe o suporte t�cnico!</div><?php
              	}
              	
              
              	//print_r($carros);
              	?>
              	<div class="row">
					<div class="span3">
						<h3>Carros Cadastrados</h4>					
					</div>
				</div>
				
				<hr>
				
				
					
				
				<table class="table table-striped" style="padding:0px;" border="0">
							<thead>
							<tr style="font-weight:bold; font-size:13px">
								<td>Modelo</td>
								<td>Marca</td>
								<td>Ano</td>
								<td>Valor</td>
								<td>Usu�rio</td>
								<td><center>Alterar</td>
								<td><center>Excluir</td>
							</tr>
						</thead>
						<tbody>					
						<?php
						
						if(empty($carros))
						{
							$carros = "";
						}
						
						for($i=1;$i<=(count($carros)/9);$i++)
						{?>
						
						
						
						<!-- Model Window
					    ================================================== --> 
					<!-- Placed at the end of the document so the pages load faster -->
					<div class="modal hide fade in" id="dadosCar<?php echo $i;?>" width=500>
					  <div class="modal-header">
					    <button class="close" data-dismiss="modal">�</button>
					    <h3>Dados do Ve�culo</h3>
					  </div>
					  <div class="modal-body" style="">
					    <div class="span5" style=" margin-left:10">
					    	<h5>Modelo: <?php echo $carros['modelo'.$i]; ?>
					    	<br>Marca: <?php echo $carros['id_marca'.$i]; ?>
					    	<br>Ano: <?php echo $carros['ano'.$i]; ?>
					    	<br>Valor: <?php echo 'R$ '. number_format($carros['valor'.$i],2,',','.'); ?>
					    	<br>M�ximo de Parcelas: <?php echo $carros['max_parcelas'.$i]; ?>x
					    	<br>Data de Inclus�o: <?php echo date('d/m/Y', strtotime($carros['data_cadastro'.$i])); ?>
					    	
					    </div>
			
					    <div class="span5" style="">
					    	<a href="<?php echo site_url().'fotos/'.$carros['foto'.$i];?>" target='_blank'><img src="../fotos/<?php echo $carros['foto'.$i];?>" class="img-polaroid"></a><br>
					    </div>
					  </div>
					  
					  <div class="modal-footer"></div>
					</div>
						
						<?php
						
					
						?><tr style="font-family:verdana; font-size:12px">
							<td><a data-toggle="modal" href="#dadosCar<?php echo $i;?>"><?php echo $carros['modelo'.$i]; ?></a></td>
							<td><?php echo $carros['id_marca'.$i]; ?></td>
							<td><?php echo $carros['ano'.$i]; ?></td>
							<td><?php echo 'R$ '. number_format($carros['valor'.$i],2,',','.'); ?></td>
							<td><?php echo $carros['id_usuario'.$i]; ?></td>
							<td><center><i class="icon-wrench"></i></td>
							<td><center>
							<?php if($this->session->userdata('perfil') == "admin")
									{
										$caminhoExcluir = site_url('carros/excluir')."/".$carros['id_carro'.$i];	
									?>
										<a href="javascript:confirmaExclusao('<?php echo $caminhoExcluir;?>')"><?php 
									} 
									else
									{
										?><a data-toggle="modal" href="#addIdea" title="Seu perfil n�o est� liberado para exclus�es."</a><?php
									}
									
									?>
							<center><i class="icon-remove"></i></a>
							</td>
														
						</tr><?php
							
											
						}
				
				?>
					</tbody>
						
				</table>
              	<?php
              	
              }
             
              
               ?>
              
             
            </div>
          </div>
 </div>