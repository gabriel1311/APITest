<?php

?>

<style type="text/css">
<!--
.pgoff {font-family: Verdana, Arial, Helvetica; font-size: 11px; color: #FF0000; text-decoration: none}
a.pg {font-family: Verdana, Arial, Helvetica; font-size: 11px; color: #003366; text-decoration: none}
a:hover.pg {font-family: Verdana, Arial, Helvetica; font-size: 11px; color: #0066cc; text-decoration:underline}
-->
</style>
<?php
	$quant_pg = ceil($quantreg/$numreg);
	$quant_pg++;
	$pg = $_GET['pg'];
	
	
	?>
	
	<div class="pagination pagination-centered">
  <ul>
 

	<?php
	// Verifica se esta na primeira página, se nao estiver ele libera o link para anterior
	if ($pg > 0) { 
		echo "<li><a href=".$PHP_SELF."?action=listProd&pg=".($pg-1)." class=pg><b><<</b></a></li>";
	} else { 
		echo "<li><a href='#' class=pg><font color=#CCCCCC class=pg><<</font></a></li>";
	}
	
	// Faz aparecer os numeros das página entre o ANTERIOR e PROXIMO
	for($i_pg=1;$i_pg<$quant_pg;$i_pg++) { 
		// Verifica se a página que o navegante esta e retira o link do número para identificar visualmente
		if ($pg == ($i_pg-1)) { 
			echo "<li><span class=pgoff>[$i_pg]</span></li>";
		} else {
			$i_pg2 = $i_pg-1;
			echo "<li><a href=".$PHP_SELF."?action=".$_GET['action']."&pg=$i_pg2 class=pg><b>$i_pg</b></a></li>";
		}
	}
	
	// Verifica se esta na ultima página, se nao estiver ele libera o link para próxima
	if (($pg+2) < $quant_pg) { 
		echo "<li><a href=".$PHP_SELF."?action=".$_GET['action']."&pg=".($pg+1)." class=pg><b>>></b></a></li>";
	} else { 
		echo "<li><a href='#' class=pg><font color=#CCCCCC class=pg>>></font></a></li>";
	}
?>
</ul>
</div>


<?php
?>