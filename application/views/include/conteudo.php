<?php




	if($_GET['action']=="configs")
	{
		
		if($_GET['and']=="salvar")
		{
			include_once("clsConfigs.php");
			$config = new Configs();
			
			
		
			if(($config->Salvar($_FILES['logo'],$_POST['txtNomeEmpresa'],$_POST['txtEnderecoEmpresa'],$_POST['txtFoneEmpresa'],$_POST['txtEmailEmpresa'],$_POST['txtSiteEmpresa']))==true)
			{
				?>
				<div class="alert alert-success">
				  <button type="button" class="close" data-dismiss="alert">×</button>
				  <h4>Sucesso!</h4>
				  Os dados foram atualizados. =)
				 			 
				</div>
				
							
				
				<?php
				
			}
			
		}
		
		
		include_once("clsConfigs.php");
		$config = new Configs();
		$arrayEmpresa = $config->BuscaDados();
		
		
		
		
	?>
	
		<form class="form-horizontal" method="post" action="index.php?action=configs&and=salvar" enctype="multipart/form-data">
		<fieldset>
		
		<!-- Form Name -->
		<legend>Configurações</legend>
		
		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label">Nome da Empresa</label>
		  <div class="controls">
		    <input id="txtNomeEmpresa" name="txtNomeEmpresa" type="text" placeholder="Minha Empresa LTDA" class="input-xlarge" value="<?php echo $arrayEmpresa['empresa'];?>">
		    
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label">Endereço</label>
		  <div class="controls">
		    <input id="txtEnderecoEmpresa" name="txtEnderecoEmpresa" type="text" placeholder="Endereço da Minha Empresa" class="input-xlarge" value="<?php echo $arrayEmpresa['endereco'];?>">
		    
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label">Telefone</label>
		  <div class="controls">
		    <input id="telefone" name="txtFoneEmpresa" type="text" placeholder="Telefone da Minha Empresa" class="input-xlarge" maxlength="12" onkeypress="mascara(this,'##-####.####')" value="<?php echo $arrayEmpresa['fone'];?>">
		    
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label">E-mail</label>
		  <div class="controls">
		    <input id="txtEmailEmpresa" name="txtEmailEmpresa" type="text" placeholder="E-mail da Minha Empresa" class="input-xlarge" value="<?php echo $arrayEmpresa['email'];?>">
		    
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label">Site</label>
		  <div class="controls">
		    <input id="txtSiteEmpresa" name="txtSiteEmpresa" type="text" placeholder="Site da Minha Empresa" class="input-xlarge" value="<?php echo $arrayEmpresa['site'];?>">
		    
		  </div>
		</div>
		
		<!-- foto input-->
		<div class="control-group">
		  <label class="control-label">Logo</label>
		  <div class="controls">
			  <input type="file" class="input" name="logo" id="logo" />		    
		  </div>
		</div>
		
		
		
		<!-- Button (Double) -->
		<div class="control-group">
		  <label class="control-label"></label>
		  <div class="controls">
		    <button id="btnGravarEmpresa" name="btnGravarEmpresa" class="btn btn-success">Gravar</button>
		    <button id="btnCancelar" name="btnCancelar" class="btn btn-danger">Cancelar</button>
		  </div>
		</div>
		
		</fieldset>
		</form>

	
	<?php
		
		
	}





		


//home
	if(empty($_GET['action']))
	{?>
	
		<h3>O que temos para hoje?</h3>
		
		<?php
		
		require_once("clsServicos.php");
		$servico = new Servico();
		if($servico->ServicosHoje(date("Y-m-d"))==NULL)
		{
						echo "<h4><br><center>Relaxe, você não tem nenhum compromisso para hoje :D</h4><br><center><img src=images/homer_relax.png width=350></center>";
		}
		
		else
		{		
			
		
			
			$arrayServicos = $servico->ServicosHoje(date("Y-m-d"));
			 $linhasDia = $servico->NumeroLinhasDia(date("Y-m-d"));
			
			
			
			for($i=1;$i<=$linhasDia;$i++)
			{
				require_once("clsClientes.php");
				$cliente = new Cliente();
				$NomeCliente = $cliente->BuscarCliente('',$arrayServicos['id_cliente'.$i]);
				$NomeCliente = $NomeCliente['razao_social'];
				
				
				$tituloServico = $arrayServicos["titulo".$i];
				
				
				require_once('clsSituacao.php');
				$situacao = new Situacao();
				$situacaoArray = $situacao->RetornaSituacao($arrayServicos['id_servico'.$i]);
				$situacaoServico = $situacaoArray['situacao'];
				
				
		
				
				$descricaoSituacao = $situacaoArray['descricao'];
				
				
				if($situacaoServico != 'Concluido')
				{
					//echo 'sim';
					if($arrayServicos['data_final'.$i] < date("Y-m-d")) // entra se esta vencido
					{
						//echo $situacaoArray['data'];
						//echo 'sim';
						$imagemURL = "pin_atraso.png";
						$cor = '#ffe0e0';
						$bold = '<b>';
					}
					else
					{
						$imagemURL = "pin.png";
						$cor = '';
						$bold = '';
					}

				
				
								
				$linkEdicao = "<a href='index.php?action=work&and=editar&servicoId=".$arrayServicos['id_servico'.$i]."'>";
				
				echo $linkEdicao;
				//aqui monta os post it

		     	?>
				<div class="postit" style="background-color:<?php echo $cor;?>; border-color:<?php echo $cor;?>">
					<i class="pin"><img src="images/<?php echo $imagemURL;?>"></i>
						Cliente:<i><b> <?php echo $NomeCliente;?></b></i><br>
						Título:<i> <?php echo $tituloServico;?> <br>
						Status:<i> <?php echo $situacaoServico;?> </i><br>
						Previsão:<i> <?php echo $bold. date("d/m/Y", strtotime($arrayServicos['data_final'.$i]));?> </b></i><br><br>
						Detalhes (Última Atualização): <?php echo date("d/m/Y", strtotime($situacaoArray['data']))."<br><b>". $descricaoSituacao;?></b></i></font>
				</div>	
				</a>
				<br>
				
				<?php
				
				}
				
				
			}
						
		?>
				
		
			
				
		
		
		
			<br><br>
		
		
		<?php
		}	
	}
	











//novo tarefa
	if($_GET['action']=='work')
	{
	
	
		if($_GET['and']=="confirmaExclusao")
		{?>
			<div class="alert alert-success" id="confirmaExclusao">
				<center>
				<?php
				require_once("clsServicos.php");
				$servico = new Servico();


				$servico->ExcluirServico($_GET['idServico']);
				
				
				
				?>				
			</div>
			<?php			
		}
			
			
			
	
	
	
	
	
	
		require_once("clsClientes.php");
		$cliente = new Cliente();
		if(($cliente->NumeroLinhas())==0)
		{
			echo "<script language='JavaScript'> location.href='index.php?action=client&and=cliente0'; </script>";
		}
		
	
	
		//gravar edicao/atualizacao de servico
		if($_GET['and']=='gravarEdicao')
		{
			
			//atualizar servico
			include_once("clsServicos.php");
			$servico = new Servico();
			
			include_once("clsMetodos.php");
			$metodo = new Metodos();
			
			 $valorFormatado = $metodo->FormataValorRealParaGravar($_POST['txtValorTotal']);
			
			
			
			if(($servico->AtualizarServico($_POST['txtIdServico'],$_POST['txtTituloServico'],$valorFormatado,date('Y-m-d', strtotime($_POST['data']))))==true)
			{?>
				<div class="alert alert-success">			
					<h5>O serviço foi Atualizado.</h5>			
				</div>
				<?php
			}
			else
			{
				echo "<br>não foi possivel atualizar o serviço";
			}
			
			
			
			//atualizar situacao
			include_once("clsSituacao.php");
			$situacao = new Situacao();
			
			
			if(($situacao->NovaSituacao($_POST['txtIdServico'],$_POST['selectSituacao'],date("Y-m-d"),$_POST['txtDescricaoServico']))=="true")
			{
				//echo '<br>situacao atualizado';
			}
			else
			{
				echo '<br>não atualizou situacao';
			}
			
			
			//inserir financeiro
			require_once("clsFinanceiro.php");				
			$financeiro = new Financeiro();
			
			require_once("clsMetodos.php");
			$metodo = new Metodos();
								
			$valorPago = $metodo->FormataValorRealParaGravar($_POST['txtValorSinal']);
			
			    
		    //se valor pago diferente de 0 é um novo financeiro
			if($valorPago != 0)
			{
			   if(($financeiro->NovoFinanceiro($_POST['txtIdServico'],date('Y-m-d'),$valorPago)=="true"))
			   {
					//echo '<br>Novo Financeiro Ok';										
			   }
			   else
			   {
					//echo '<br>Não incluiu Financeiro';
			   }
		    }

			
			
			
		}
	
	
	
	
		if($_GET['and']=="buscarResultado")
		{

			require_once("clsClientes.php");
			
			$cliente = new Cliente();
			$arrayCliente = $cliente->BuscarCliente('',$_POST['selectCliente']);			
			?>

			<legend>Serviços Encontrados / <?php echo " <font size=3><u>".$arrayCliente['razao_social'];?></u></legend>
		
				<?php
				require_once("clsServicos.php");
				$servico = new Servico();
				$NumLinhas = $servico->NumeroLinhas($_POST['selectCliente']);
				$arrayServico = $servico->RetornaServicos($_POST['selectCliente']);
				
				
				if($NumLinhas == 0)
				{
					echo "</font>Nenhum Serviço cadastrado para este cliente.<p><a href='index.php?action=work&and=buscar'><img src='images/back.png'></a>";
				}
				else
				{
					
				
				?>
				
					<table class="table table-striped" style="padding:0px;">
						<thead>
							<tr style="font-weight:bold; font-size:13px">
								<td>Titulo</td>
								<td>Previsão</td>
								<td>Situação</td>
								<td><center>Histórico</td>
								<td><center>Financeiro</td>
							</tr>
						</thead>
						<tbody>					
						<?php
						for($n=1;$n<=$NumLinhas;$n++){
						
								require_once('clsSituacao.php');
							 	$situacao = new Situacao();
							 	$situacaoArray = $situacao->RetornaSituacao($arrayServico['id_servico'.$n]);
							 	$situacaoServico = $situacaoArray['situacao'];
						?><tr style="font-family:verdana; font-size:12px">
							<td><a href=index.php?action=work&and=editar&servicoId=<?php echo $arrayServico['id_servico'.$n];?> title='Clique para editar este serviço'><?php echo $arrayServico["titulo".$n];?></a></td>
							<td><?php echo date('d/m/Y', strtotime($arrayServico["data_final".$n]));?></td>
							<td><?php echo $situacaoServico;?></td>
							<td><center><a href=index.php?action=work&and=historico&servicoId=<?php echo $arrayServico["id_servico".$n];?> title='Histórico deste serviço'><img class="esmaecer" src=images/list.png></center></a></td>
									<td><center><a href=index.php?action=work&and=historicoFinanceiro&servicoId=<?php echo $arrayServico["id_servico".$n];?> title='Histórico deste serviço'><img class="esmaecer" src=images/money.png width=16></a></center></td>					
					
						</tr><?php
							
											
						}
				
				?>
					</tbody>
						
				</table>
				</center>
				
<?php
			}//else
		}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//**********************************	
	
	
	
		if($_GET['and']=="historico")
		{
			
			include_once("clsServicos.php");
			include_once('clsClientes.php');
			$servico = new Servico();
			$servico = $servico->RetornaServico($_GET['servicoId']);	
			
			$cliente = new Cliente();
			$cliente = $cliente->BuscarCliente('',$servico['id_cliente']);
			
			
			$TituloServico = $servico['titulo'];	
			$Empresa = $cliente['razao_social'];
			
			
			
			include_once('clsSituacao.php');
			$situacao = new Situacao();
			$situacoes = $situacao->RetornaSituacoes($_GET['servicoId']);
			
			$NumLinhas = $situacao->NumeroLinhas($_GET['servicoId']);
			
			?>
			<div class="row">
				<div class="span3">
					<h3>Histórico do Serviço</h4>					
				</div>
				<div class="span4" style="float:right">
					<h5>Cliente: <i><?php echo $Empresa;?></i>
					<br>Título: <i><?php echo $TituloServico;?></h6></i>		
				</div>
			</div>
			<hr>
			
			
			<table class="table table-striped" style="padding:0px;" border="0">
						<thead>
							<tr style="font-weight:bold; font-size:13px">
								<td>Atualização do Status</td>
								<td>Data</td>
								<td>Descrição da Situação</td>
							</tr>
						</thead>
						<tbody>					
						<?php
						for($n=1;$n<=$NumLinhas;$n++){
					
						?><tr style="font-family:verdana; font-size:12px">
							<td><?php echo $situacoes['status'.$n];?></center></td>
							<td><?php echo date('d/m/Y', strtotime($situacoes['data'.$n]));?></td>
							<td><?php 
							
								if($situacoes['descricao'.$n] != " ")
								{
									echo $situacoes['descricao'.$n];
								}
								else
								{
									echo "Não informado!";
								}
							
					?>
							</td>
						</tr><?php
							
											
						}
				
				?>
					</tbody>
						
				</table>

			<?php
			
		
		}
	
	
	
	
	
	
	
	
	
	//**********************************	
	
	
	
		if($_GET['and']=="historicoFinanceiro")
		{
			
			include_once("clsServicos.php");
			include_once('clsClientes.php');
			$servico = new Servico();
			$servico = $servico->RetornaServico($_GET['servicoId']);	
			
				
			$cliente = new Cliente();
			$cliente = $cliente->BuscarCliente('',$servico['id_cliente']);
			
			
			$TituloServico = $servico['titulo'];	
			$Empresa = $cliente['razao_social'];
			
			include_once('clsMetodos.php');
			$metodo = new Metodos();
			
			$valor = $metodo->FormataValorRealParaGravar($servico['valor']);
			//$valor = 
			
			include_once('clsFinanceiro.php');
			$financeiro = new Financeiro();
			$financeiroHistorico = $financeiro->RetornaHistorico($_GET['servicoId']);
			
			$NumLinhas = $financeiro->LinhasFinanceiro($_GET['servicoId']);
			
			?>
			<div class="row">
				<div class="span3">
					<h3>Histórico Financeiro</h4>					
				</div>
				<div class="span4" style="float:right">
					<h5>Cliente: <i><?php echo $Empresa;?></i>
					<br>Título: <i><?php echo $TituloServico;?></i>	
					<br>Valor: <i>R$ <?php echo number_format($valor,2,',','.');?></h6></i>	
				</div>
			</div>
			<hr>
			
			
			<table class="table table-striped" style="padding:0px;" border="0">
						<thead>
							<tr style="font-weight:bold; font-size:13px">
								<td>Data</td>
								<td>Valor do Pagamento</td>
								<td>Saldo Devedor</td>
							</tr>
						</thead>
						<tbody>					
						<?php
						$saldoDevedor = $valor;
						for($n=1;$n<=$NumLinhas;$n++){
						
						?><tr style="font-family:verdana; font-size:12px">
							<td><?php echo date('d/m/Y', strtotime($financeiroHistorico['data'.$n]));?></td>
							<td>R$ <?php echo number_format($financeiroHistorico['valor'.$n],2,',','.');?></td>
							<td>R$ <?php echo number_format(($financeiroHistorico['valor'.$n] - $saldoDevedor),2,',','.');?></td>
					
						</tr><?php
							
							$saldoDevedor = $saldoDevedor - $financeiroHistorico['valor'.$n];										
						}
				
				?>
					</tbody>
						
				</table>

			<?php
			
		
		}
	
	
	
	
	
	
	
	
	
	//**********************************	
	
	
	
	
	
	
	
	
	
		
		if($_GET['and']=="buscar")
		{?>
		
		<form class="form-inline" method="post" action="index.php?action=work&and=buscarResultado">
			<fieldset>
			
			<!-- Form Name -->
			<legend>Buscar Serviço por Empresa</legend>
			
			<!-- Select Basic -->
			
			    <select id="selectCliente" name="selectCliente" class="input-xlarge" >
					<?php    	
					require_once("clsClientes.php");
						
					$cliente = new Cliente();
					
					$arrayTodosClientes = $cliente->BuscarTodosClientes();
					
					$numeroLinhas = $cliente->NumeroLinhas();
					
					for($n=1;$n<=$numeroLinhas;$n++){
						?>
						
						<option value="<?php echo $arrayTodosClientes["id".$n];?>"><?php echo $arrayTodosClientes["razao_social".$n];?></option>
					<?php	
						
					}
					
					
			    	
			    
			    ?>
			    
			    </select>

			    
					
			
			<!-- Button -->
			
			    <button type="submit" id="btnBuscar" name="btnBuscar" class="btn btn-primary" <?php echo $btnBuscar; ?>=""><i class="icon-search icon-white"></i> Buscar</button>
			 			
			</fieldset>
			</form>
		
		<hr>
		
			<legend>Últimos Serviços</legend>

			<?php
				require_once("clsServicos.php");
				require_once("clsClientes.php");
				
				$servico = new Servico();
				
				if(($servico->NumeroLinhasTotal()) == 0)
				{
					echo "Nenhum Serviço Cadastrado!";
					$btnBuscar = 'disabled=""';
				}
				else
				{?>
				
					<table class="table table-striped" style="padding:0px;">
						<thead>
							<tr style="font-weight:bold; font-size:13px">
								<td>Titulo</td>
								<td>Cliente</td>
								<td>Previsão</td>
								<td>Situação</td>
								<td><center>Histórico</td>
								<td><center>Financeiro</td>
							</tr>
						</thead>
						<tbody>					
						<?php
						$arrayUltimosServicos = $servico->RetornaUltimosServicos();		
		
							for($n=1;$n<=5;$n++){
								$cliente = new Cliente();
								$arrayCliente = $cliente->BuscarCliente('',$arrayUltimosServicos["id_cliente".$n] );
					
								 if(!empty($arrayUltimosServicos["titulo".$n]))
								 {
								 	require_once('clsSituacao.php');
								 	$situacao = new Situacao();
								 	$situacaoArray = $situacao->RetornaSituacao($arrayUltimosServicos['id_servico'.$n]);
								 	$situacaoServico = $situacaoArray['situacao'];
								 	
								?><tr style="font-family:verdana; font-size:12px">
									<td><a href=index.php?action=work&and=editar&servicoId=<?php echo $arrayUltimosServicos["id_servico".$n];?> title='Clique para editar este serviço'><?php echo $arrayUltimosServicos["titulo".$n];?></a></td>
									<td><?php echo $arrayCliente['razao_social'];?></td>
									<td><?php echo date('d/m/Y', strtotime($arrayUltimosServicos["data_final".$n]));?></td>
									<td><?php echo $situacaoServico;?></td>
									<td><center><a href=index.php?action=work&and=historico&servicoId=<?php echo $arrayUltimosServicos["id_servico".$n];?> title='Histórico deste serviço'><img class="esmaecer" src=images/list.png></center></a></td>
									<td><center><a href=index.php?action=work&and=historicoFinanceiro&servicoId=<?php echo $arrayUltimosServicos["id_servico".$n];?> title='Histórico deste serviço'><img class="esmaecer" src=images/money.png width=16></a></center></td>				
							
								</tr><?php
								}											
						}
								?>
					</tbody>
						
				</table>
				</center>
				
<?php
			}//else

			
		}
	
	
	
	
	
	
	
	
		//**********************************	

	
	
	

	
	
		if($_GET['and']=="novo")
		{
		
			
		
			//insere servico
			require_once("clsServicos.php");
			$servico = new Servico();
			
			
			include_once("clsMetodos.php");
			$metodo = new Metodos();
			
			$valorFormatado = $metodo->FormataValorRealParaGravar($_POST['txtValorTotal']);
			
			
			
			if(($servico->NovoServico($_POST['selectBuscarCliente'],$_POST['txtTituloServico'],$valorFormatado,date('Y-m-d', strtotime($_POST['data'])))==true))
			{
				//echo 'Servico Incluido';
				
				require_once("clsClientes.php");
				$cliente = new Cliente();
				
				$arrayCliente = $cliente->BuscarCliente('',$_POST['selectBuscarCliente']);
				
				
				?>
				<div class="alert alert-success">
				  <button type="button" class="close" data-dismiss="alert">×</button>
				  <h4>Sucesso!</h4>
				  O Serviço para o cliente <u><?php echo $arrayCliente["razao_social"];?></u>  foi incluído. =)
				</div>
				<?php 
				
				
				
						
				//insere financeiro (sinal, se tiver)
				
				$servico = new Servico();
				$ultimoIDServico = $servico->RetornaUltimoID();
				
				require_once("clsFinanceiro.php");
				
				$financeiro = new Financeiro();
								
				$valorSinal = $metodo->FormataValorRealParaGravar($_POST['txtValorSinal']);
			
			    
			    //se valor do sinal não é 0 entao tem sinal e ja grava no financeiro
			    if($valorSinal != 0)
			    {
				    if(($financeiro->NovoFinanceiro($ultimoIDServico,date('Y-m-d'),$valorSinal)=="true"))
				    {
				//		echo 'Financeiro Ok';										
					}
					else
					{
						echo 'Não incluiu Financeiro';
					}
			    }
				
				
				
				
				
				//insere situacao
						
				require_once("clsSituacao.php");
						
				$situacao = new Situacao();
						
				if(($situacao->NovaSituacao($ultimoIDServico,'Em Andamento',date("Y-m-d"),$_POST['txtDescricaoServico']))=="true")
				{
				//	echo 'situacao ok';
				}
				else
				{
					echo 'nao incluiu situacao';
				}
						
			
				
			}//if insercao servico
			else
			{
				echo 'erro ao inserir servico';
			}
									
			
		}//if gravar novo servico
		
		
		
		
		
		
		
	//**********************************	
		
		
		
		
		
		
		

	//se entra neste if, mostra o formulario para novo serviço
		
	if(($_GET['and']!="buscar") && ($_GET['and']!="buscarResultado") && ($_GET['and']!="historico") && ($_GET['and']!="historicoFinanceiro"))
	{	
		if($_GET['and']=='editar')
		{
			$action = "index.php?action=work&and=gravarEdicao";
		}
		else
		{
			$action = "index.php?action=work&and=novo";
		}
		
	?>
	
		<form class="form-horizontal" method="post" action=<?php echo $action; ?>>
		<fieldset>
		
		<?php
		if($_GET['and']=='editar')
		{
			echo "<legend>Atualização de Serviço</legend>";		
		}
		else
		{
			echo "<legend>Novo Serviço</legend>";
		}
		
		?>
		
		<input type="hidden" value="<?php echo $_GET['servicoId'];?>" name="txtIdServico" >
		
		<!-- Select Basic -->
		<div class="control-group">
		  <label class="control-label">Buscar Cliente</label>
		  <div class="controls">
		    <select id="selectBuscarCliente" name="selectBuscarCliente" class="input-xlarge">
		      <?php    	
					require_once("clsClientes.php");	
					$cliente = new Cliente();					
					$numeroLinhas = $cliente->NumeroLinhas();
					
					
						
					
					if($_GET['and'] == 'editar')
					{
						require_once('clsServicos.php');
						$servico = new Servico();
						$arrayServico = $servico->RetornaServico($_GET['servicoId']);
						$arrayTodosClientes = $cliente->BuscarCliente('',$arrayServico['id_cliente']);
						$numeroLinhas=1;
						
						require_once('clsSituacao.php');
						$situacao = new Situacao();
						$arraySituacao = $situacao->RetornaSituacao($_GET['servicoId']);
						$DtPrevisaoServico =" value=".date('d-m-Y', strtotime($arrayServico['data_final']));
						$descricaoServico = "<i>em ".date('d/m/Y', strtotime($arraySituacao['data'])).' - <img src=images/list.png> '.$arraySituacao['descricao']."</i><br><br><font face=verdana size=2>Informe o que foi feito nesta atualização:<br></font>";
						$helpDescricao = "<font face=verdana size=2>Última atualização deste serviço.</font><br>".$descricaoServico;
						
						
						include_once("clsFinanceiro.php");
						$financeiro = new Financeiro();				
						$linhasFinanceiro = $financeiro->LinhasFinanceiro($arrayServico['id_servico']);
						$arrayTotalPago = $financeiro->TotalPago($arrayServico['id_servico']);
						
						$totalPago = 0;
						for($i=0;$i<=$linhasFinanceiro;$i++)
						{
							$totalPago = $totalPago + $arrayTotalPago['valor'.$i];							
						}
						$saldoDevedor = $totalPago - $arrayServico['valor'];
					
						$saldoDevedor = '<p class="help-block"><font size=2 face=verdana >Saldo Devedor: -R$ '.number_format($saldoDevedor,2,',','.').'</font></p>';
					
						
						$totalPago = number_format($totalPago,2,',','.');
						
						$tituloServico = $arrayServico['titulo'];
						$pagamento = "Valor do Pagamento";
						$valorServico = " value= ".number_format($arrayServico['valor'],2,',','.');
						$situacaoServico = '';
						
						
					}
					else
					{
						$arrayTodosClientes = $cliente->BuscarTodosClientes();
						$valorServico = " value=R$ 0.00";
						$pagamento = "Adiantamento (Sinal)";
						$DtPrevisaoServico = "value=".date('d-m-Y');
					}
					
					
					
					for($n=1;$n<=$numeroLinhas;$n++){
					
						if($_GET['and'] != 'editar')
						{?>				
							<option value="<?php echo $arrayTodosClientes["id".$n];?>"><?php echo $arrayTodosClientes["razao_social".$n];?></option>
						<?php
						}
						else
						{?>				
							<option value="<?php echo $arrayTodosClientes["id"];?>"><?php echo $arrayTodosClientes["razao_social"];?></option>
						<?php
						}
					}			    	
			    
			    ?>
		    </select> 
		    
		    <?php
		    if($_GET['and']!='editar')
		    { ?>
		    
		    	<br><a href="index.php?action=client" title="Inserir Novo Cliente"><img src="images/add.png" width="40">Adicionar Cliente</a>
		    	<?php
		    }?>
		  
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label">Título do Serviço</label>
		  <div class="controls">
		    <input id="txtTituloServico" name="txtTituloServico" value="<?php echo $tituloServico;?>" type="text" placeholder="Informe um título para este serviço" class="input-xlarge" required="">    
		  </div>
		</div>
		
		<!-- Textarea -->
		<div class="control-group">
		  <label class="control-label">Descrição do Serviço</label>
		  <div class="controls">    
		  	<?php echo $helpDescricao; ?>		    
		    <textarea id="txtDescricaoServico" name="txtDescricaoServico" required=""></textarea>
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label">Valor do Serviço</label>
		  <div class="controls">
		    <input id="valor" name="txtValorTotal" <?php echo $valorServico;?> type="text" class="input-small">    
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label"><?php echo $pagamento; ?></label>
		  <div class="controls">
		    <input id="valor" name="txtValorSinal" type="text" class="input-small" value="R$ 0.00">   
		    <?php echo $saldoDevedor;?> 
		  </div>
		</div>
		
		<?php
		if($_GET['and'] == 'editar')//so mostra o select quando for para atualizar
		{?>
		
			<!-- Text input-->
			<div class="control-group">
			  <label class="control-label">Total Pago</label>
			  <div class="controls">
			    <input id="valor"  type="text" class="input-small" readonly="" value="<?php echo $totalPago; ?>">    
			  </div>
			</div>
		
		
			<!-- Select Basic -->
			<div class="control-group">
			  <label class="control-label">Situação</label>
			  <div class="controls">
			    <select name="selectSituacao" class="input-xlarge">   	
			    	<option value="Em Andamento"<?php if($arraySituacao['situacao'] == 'Em Andamento'){ echo ' selected="" '; };?>>Em Andamento</option>
			    	<option value="Pendente"<?php if($arraySituacao['situacao'] == 'Pendente'){ echo ' selected="" '; };?>>Pendente</option>
			    	<option value="Concluido"<?php if($arraySituacao['situacao'] == 'Concluido'){ echo ' selected="" '; };?>>Concluído</option>
			    </select> 
			  </div>
			</div>
			<?php
		}?>
		
		
		
		<div class="control-group">
			<label class="control-label">Previsão</label>
			<div class="controls">
				<div class="input-append date" id="dp3" data-date="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy">
					<input name="data" type="text" class="span2" <?php echo $DtPrevisaoServico; ?> readonly>
					<span class="add-on" id="iconeCalendario"><i class="icon-calendar"></i></span>
				</div>
			</div>
		</div>
		
		
		<!-- Multiple Checkboxes -->
		<!--
		<div class="control-group">
		  <label class="control-label"></label>
		  <div class="controls">
		    <label class="checkbox">
		      <input type="checkbox" name="cbAvisarCliente" value="Comunicar Cliente sobre a inserção do serviço." disabled="">
		      Comunicar Cliente sobre a situação do serviço.
		    </label>
		  </div>
		</div>
		-->
		
		<div class="control-group">
		  <label class="control-label"></label>
		  <div class="controls">
		    <button id="btnGravar" name="btnGravar" class="btn btn-success"><i class="icon-ok icon-white"></i> Gravar</button>		    
		    <input type="reset" class="btn btn-danger" value="Cancelar" onclick="location.href='index.php'"></input>
		     <?php if($_GET['and']=='editar'){?><a href = "javascript:confirmaExclusao('index.php?action=work&and=confirmaExclusao&idServico=<?php echo $arrayServico[id_servico];?>')"><button id="btnExcluir" name="btnExcluir" class="btn btn-danger" type="button"><i class="icon-trash"></i> Excluir Serviço</button></a><?php }?>
		  </div>		  
		</div>
		
		</fieldset>
		</form>
		
		
				
<?php
		
		}
		
	}


























//novo cliente
	if($_GET['action']=='client')
	{
	
		//nenhum cliente
		if($_GET['and']=="cliente0")
		{?>
			<div class="alert">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Advertência!</strong> Antes de prosseguir, cadastre seus clientes :)
			</div>
		<?php
     	}
	
	
	
		//buscar cliente
		if($_GET['and']=='buscar')
		{
			
			
			require_once("clsClientes.php");
			$cliente = new Cliente();
			if(($cliente->NumeroLinhas())==0)
			{
				echo "<script language='JavaScript'> location.href='index.php?action=client&and=cliente0'; </script>";
			}
			
			
			
		?>
		
	
		
			<form class="form-horizontal" method="post" action="index.php?action=client">
			<fieldset>
			
			<!-- Form Name -->
			<legend>Buscar Cliente</legend>
			
			<!-- Select Basic -->
			<div class="control-group">
			  <label class="control-label">Buscar Empresa</label>
			  <div class="controls">
			    <select id="selectCliente" name="selectCliente" class="input-xlarge">
					<?php    	
					require_once("clsClientes.php");
						
					$cliente = new Cliente();
					
					$arrayTodosClientes = $cliente->BuscarTodosClientes();
					
					$numeroLinhas = $cliente->NumeroLinhas();
					
					for($n=1;$n<=$numeroLinhas;$n++){
						?>
						
						<option value="<?php echo $arrayTodosClientes["id".$n];?>"><?php echo $arrayTodosClientes["razao_social".$n];?></option>
					<?php	
						
					}
					
					
			    	
			    
			    ?>
			    
			    </select>

			    
			  </div>
			</div>
			
			<!-- Search input-->
			<div class="control-group">
			  <label class="control-label">Buscar</label>
			  <div class="controls">
			    <input id="txtBuscaCliente" name="txtBuscaCliente" type="text" placeholder="" class="input-xlarge search-query">
			    <p class="help-block"><font size=2>Você pode navegar entre os clientes cadastrados ou então fazer a busca por razão social, nome fantasia ou nome do representante</p>
			  </div>
			</div>
			
			<!-- Button -->
			<div class="control-group">
			  <label class="control-label"></label>
			  <div class="controls">
			    <button id="btnBuscar" name="btnBuscar" class="btn btn-primary"><i class="icon-search"></i> Buscar</button>
			  </div>
			</div>
			
			</fieldset>
			</form>

		
		<?php
		}
		
		
		//gravar novo cliente ou editar
		if($_GET['and']=='gravar')
		{
			require_once("clsClientes.php");
			
			//recebendo os dados do cliente, do form
			$razaoSocial   = $_POST['txtRazaoSocial'];
			$nomeFantasia  = $_POST['txtNomeFantasia'];
			$endereco      = $_POST['txtEndereco'];
			$email         = $_POST['txtEmail'];
			$representante = $_POST['txtRepresentante'];
			$fone          = $_POST['txtFone'];
			$adicionais    = $_POST['txtAdicionais'];
			
			$cliente = new Cliente();

			if($_GET['editar']=='sim')//editar cliente
			{
				//echo "editar";
				if($cliente->AlterarCliente($_POST['txtID'],$razaoSocial,$nomeFantasia,$endereco,$email,$representante,$fone,$adicionais) == true)
				{?>
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  <h4>Sucesso!</h4>
					  O cliente <b><?php echo $_POST['txtRazaoSocial'];?></b> foi Alterado. =)
					</div>
					<?php
				}
				else
				{?>
					<div class="alert alert-warning">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  <h4>Problema!</h4>
					  Por algum motivo não foi possível alterar o cliente =/...<br>Revise os dados e tente novamente =)
					</div>
					<?php
				}
			}
			else//novo
			{			
				//	echo "novo";			
				if($cliente->NovoCliente($razaoSocial,$nomeFantasia,$endereco,$email,$representante,$fone,$adicionais) == true)
				{?>
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  <h4>Sucesso!</h4>
					  O cliente <b><?php echo $razaoSocial;?></b> foi cadastrado. =)
					</div>
					<?php
				}
				else
				{?>
					<div class="alert alert-warning">
					  <button type="button" class="close" data-dismiss="alert">×</button>
					  <h4>Problema!</h4>
					  Por algum motivo não foi possível cadastrar o novo cliente =/...<br>Revise os dados e tente novamente =)
					</div>
					<?php
				}
			}
		}
			
		
		
		
		
				
	
		
		$editar = "";
		
		
		//verifica se vem algo da busca, neste caso deve carregar os campos para alteracao =)
		if(!empty($_POST['selectCliente']) || (!empty($_POST['txtBuscaCliente'])))
		{
			require_once("clsClientes.php");
			$cliente = new Cliente();
			
			if(!empty($_POST['txtBuscaCliente']))
			{
				//fazer a pesquisa por txt que veio
				$buscar = $_POST['txtBuscaCliente'];
				$arrayBusca = $cliente->BuscarCliente($buscar,"");
			}
			else
			{
				$idBuscar = $_POST['selectCliente'];
				$arrayBusca = $cliente->BuscarCliente("",$idBuscar);
			}
			
			
			
			$id_cliente = $arrayBusca['id'];
			$razaoSocial = $arrayBusca['razao_social'];
			$nomeFantasia = $arrayBusca['nome_fantasia'];
			$endereco = $arrayBusca['endereco'];
			$email = $arrayBusca['email'];
			$fone = $arrayBusca['fone'];
			$representante = $arrayBusca['representante'];
			$adicionais = $arrayBusca['adicionais'];
			
			$editar = "&editar=sim";
			
		}
		
		
		
		
		
		if($_GET['and']=="confirmaExclusao")
		{?>
			<div class="alert alert-success" id="confirmaExclusao">
				<center>
				<?php
				require_once("clsClientes.php");
				$cliente = new Cliente();
				$arrayCliente = $cliente->BuscarCliente("",$_GET['id']);
				
				
				$cliente = new Cliente();
				if(($cliente->ExcluirCliente($arrayCliente['id']))==true)
				{?>
					<h5>O cliente <u><?php echo $arrayCliente['razao_social'];?></u> foi excluído com sucesso.</h5>
					<?php
				}
				else
				{?>
					<h5>Não foi possível excluir o cliente <u><?php echo $arrayCliente['razao_social'];?></u>. Informe isso ao suporte técnico.</h5>
					<?php
				}
				?>				
			</div>
			<?php			
		}
			
			
			?>
	
		
	
		<form class="form-horizontal" method="post" action="index.php?action=client&and=gravar<?php echo $editar;?>">
		
		<input type="hidden" value="<?php echo $id_cliente;?>" name="txtID" >
		
		<fieldset>
		
		<!-- Form Name -->
		<legend>Cadastro de Clientes</legend>
		
		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label">Razão Social</label>
		  <div class="controls">
		    <input value="<?php echo $razaoSocial;?>" id="txtRazaoSocial" name="txtRazaoSocial" type="text" placeholder="Informe a Razão Social da Empresa" class="input-xlarge" required="">
		    
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label">Nome Fantasia</label>
		  <div class="controls">
		    <input value="<?php echo $nomeFantasia;?>" id="txtNomeFantasia" name="txtNomeFantasia" type="text" placeholder="Informe o Nome Fantasia da Empresa" class="input-xlarge">
		    
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label">Endereço</label>
		  <div class="controls">
		    <input value="<?php echo $endereco;?>" id="txtEndereco" name="txtEndereco" type="text" placeholder="Informe o Endereço" class="input-xlarge">
		    
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label">E-mail</label>
		  <div class="controls">
		    <input value="<?php echo $email;?>" id="txtEmail" name="txtEmail" type="text" placeholder="Informe o E-mail" class="input-xlarge">
		    <p class="help-block"><font size="2">*necessário para o cliente receber atualização de serviços</font></p>
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label">Nome Representante</label>
		  <div class="controls">
		    <input value="<?php echo $representante;?>" id="txtRepresentante" name="txtRepresentante" type="text" placeholder="Informe o Nome do Representante desta Empresa" class="input-xlarge">
		    
		  </div>
		</div>
		
		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label">Telefone</label>
		  <div class="controls">
		    <input value="<?php echo $fone;?>" id="telefone" name="txtFone" type="text" placeholder="(DDD) 0000.0000" class="input-xlarge" maxlength="12" onkeypress="mascara(this, '##-####.####')">
		    
		  </div>
		</div>
		
		<!-- Textarea -->
		<div class="control-group">
		  <label class="control-label">Informações Adicionais</label>
		  <div class="controls">                     
		    <textarea id="txtAdicionais" name="txtAdicionais" rows="3"><?php echo $adicionais;?></textarea>
		  </div>
		</div>
		
		<!-- Button (Double) -->
		<div class="control-group">
		  <label class="control-label"></label>
		  <div class="controls">
		    <button type="reset" id="btnLimpar" name="btnLimpar" class="btn btn-danger"><i class="icon-remove"></i> Limpar</button>
		    <button id="btnGravar" name="btnGravar" class="btn btn-success"><i class="icon-ok"></i> Gravar</button>
		    <?php if(!empty($editar)){?><a href = "javascript:confirmaExclusao('index.php?action=client&and=confirmaExclusao&id=<?php echo $id_cliente;?>')"><button id="btnExcluir" name="btnExcluir" class="btn btn-danger" type="button"><i class="icon-trash"></i> Excluir</button></a><?php }?>
		    
		    
		    
		  </div>
		</div>
		
		</fieldset>
		</form>	
	
	
	
	<?php
	}//fim cliente









?>