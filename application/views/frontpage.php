<div class="container">


	<div class="alert alert-info">
		
		<?php
		
		
		
		
		if(empty($admin))
		{
			$admin = ''; //tratamento para evitar erros se nao tiver nada como parametro
		}
		
		if($admin == 'admin')
		{
			echo "<h2>Administração - API</h2>
				<h6><a href='".site_url()."'>Pag. principal</a></h6>";
		}
		else
		{?>
			<h2>Teste PHP para Empresa API</h2>
			<h6>Logado como: <?php echo $this->session->userdata('nome')." / ".$this->session->userdata('perfil');?></h6>
			
			<button class="btn btn-mini btn-info" type="button" onclick="location.href= '<?php echo site_url(); ?>' ">Home</button>
			<button class="btn btn-mini btn-info" type="button" onclick="location.href= '<?php echo site_url("frontpage/admin"); ?>' ">Admin</button>
			<button class="btn btn-mini btn-danger" type="button" onclick="location.href= '<?php echo site_url("login/logout"); ?>' ">Sair</button>
			<?php
		}
	?>
			
	</div>   
     
    
</div>   


<div class="container">
<div class="" style="background-color:#E8E8E8"><font face="tahoma" size="1">
Desenvolver um sistema de cadastro de Carros.
<br> FrameWork - 3) CodeIgniter;
<br>front-end.- 1) BootStrap;
<br>Base de dados - 3) MySql;

 <p>
    - Cadastro de Novos usuários (No mínimo dois perfis de acessos(funcionário, admin))
    - Recuperação de senha
    - Registrar acesso no LOG
 <br>
    - Carro pertence a Marca
        Deve conter os seguinte dados mínimos
            - Modelo
            - Ano             
            - Foto
            - Valor do carro
            - Número de parcelas máximo (3/6/12)
            - Valor total com juros (0,7%)
            - Data cadastro
            - Id usuário cadastro
 <br>
- Marca do carro
    - Marca
    - Data cadastro
    - Id usuário cadastro
<br>
- Regras de negócio
    - Somente usuários do perfil admin podem excluir dados
    - Somente usuários do perfil admin podem criar novos usuários
    - Somente usuários do perfil admin podem editar o valor do carro
</div>
</div>


 <div class="container">      
           
          <!!<div class="span9 alert" style="background-color:#f5f5f5; border:none">
          
          <div id="myCarousel" class="carousel slide span9 alert">
		  
		    		  
       
            <!-- Carousel items 
		    <div class="carousel-inner">
		        <div class="active item"><center>oii</div>
		        <div class="item">8989</div>
		        <div class="item">uu8u8</div>
		    </div>
		    
		    -->
		    
		    
		    
		    <?php
		    
		   
		    
		    
		    
		    
		    
		    
		    if(empty($carros))
		    {
		    	if(empty($carrosBuscaId))
		    	{
			    	$carros = $carrosBuscaTxt;
			    	?><!-- Carousel nav -->
			    	<a class="carousel-control left" href="#myCarousel" data-slide="prev"><center><font size=7><</font></a>
			    	<a class="carousel-control right" href="#myCarousel" data-slide="next"><center><font size=7>></font></a>
			    	<div class="carousel-inner">
			    	<?php
		    	}
		    	else
		    	{
			    	$carros = $carrosBuscaId;	
			    	?>
			    	<div class="carousel-inner">
			    	<?php    	
		    	}
		    }
		    else
		    {
			        ?><!-- Carousel nav -->
			    	<a class="carousel-control left" href="#myCarousel" data-slide="prev"><center><font size=7><</font></a>
			    	<a class="carousel-control right" href="#myCarousel" data-slide="next"><center><font size=7>></font></a>
			    	<div class="carousel-inner">
			    	<?php
		    }
		    
		    
		      for($i=1;$i<=(count($carros)/9);$i++)
		      {
		      
			      if($i==1)
			      {
				      $active = 'active ';
			      }
			      else
			      {
				      $active="";			      }
		      ?>

		    
		        <div class="<?php echo $active;?>item">
          
          <table border="0" width="100%">
          <tr>
          	<td width="50%">
          		<center>
          		<div class="span5">
          			<center><ul class="imgExpande"><li><img src="<?php echo site_url().'fotos/'.$carros['foto'.$i];?>" class="img-rounded" width="100%"></li></ul>
          		<font size=1 face=tahoma>Incluído em <?php echo date('d/m/Y', strtotime($carros['data_cadastro'.$i])); ?>
          		</div>	
				
          		
          	</td>
          	
          	<td>
          	
          	<?php //calculo das parcelas com o juros
          	$parcelasDe = (((($carros['valor'.$i]/100)*0.7)+$carros['valor'.$i])/$carros['max_parcelas'.$i]);?>

          			<h4><?php echo $carros['modelo'.$i].' - '.$carros['ano'.$i].' - '.$carros['id_marca'.$i];?>		
					<h5>Valor: <?php echo 'R$ '. number_format($carros['valor'.$i],2,',','.'); ?>	
          			</h4><h5>Parcelas de Até <?php echo $carros['max_parcelas'.$i]; ?>x de R$ <?php echo number_format($parcelasDe,2,',','.');?>
          			</h5>
					<div style="overflow: auto;height: 150px;">
					<table border="0" width="100%" class="table table-condensed" style="font-size:12px; font-family:verdana">
						<tr>
							<td width="50%"><center>Condição</td>
							<td>Total com Juros 0,7%</td>
						</tr>
						<?php
						for($n=1;$n<$carros['max_parcelas'.$i];$n++)
						{?>
						<tr>
							<td><center><?php echo $n+1;?>x</td>
							<td>R$ <?php echo number_format((($parcelasDe * $carros['max_parcelas'.$i])/($n+1)),2,',','.');  ?></td>
						</tr>
						<?php
						}?>					
					</div>
					</table>

	          		</div>
	          	</td>
	          </tr>
	          </table>
	          
	          </div>
	          
	          <?php
	          }
	          ?>
	          
	          
	          
	          </div>
	          
	          
	          </div>
	          
	          
	          
          <div class="span2">
         
	          <table border="0" width="100%">
	          <tr>
	          <td>
		          <center> 
	         	<form class="form-search" method="post" action="<?php echo site_url('frontpage/buscaCarroTxt');?>">
				 <button class="btn btn-link" type="submit"><i class="icon-search"></i></button>
				  <input  type="text" name="txtBusca" class="input-small search-query" placeholder="Modelo">
				  
				</form>
	         <hr>
	          </td>
	          </tr>
	          <tr>
	          	<td>
			          <h4><center>Mais Recentes</h5>
			          
			          <h6>
			          	<ul>
			          	<?php
			          	
			          	 for($i=1;$i<=(count($ultimos)/3);$i++)
			          	 {
			          		echo '<li><a href='.site_url("frontpage/buscaCarroId").'/'.$ultimos['id_carro'.$i].'><i class="icon-ok-sign"></i> '.$ultimos['modelo'.$i].' - '.$ultimos['ano'.$i].'</a></li>';
			          	 }
			          	 ?>
			          	</ul>
			          </h6>
			     </td>
			     </tr>
			     </table>
          </div>
          
          
          
          
          
        </div>  
                  
 </div>
      

    
    
    

    
    