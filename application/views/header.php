<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html" charset="ISO-8859-1">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="">
   <meta name="keywords" content="">
   <meta name="author" content="">
   
   

   <title>Test API</title>

   <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">
   <link href="<?php echo base_url('assets/css/bootstrap.css') ?>" rel="stylesheet">
   <link href="<?php echo base_url('assets/css/bootstrap-responsive.css') ?>" rel="stylesheet">
   <link href="<?php echo base_url('assets/css/menu-vertical.css') ?>" rel="stylesheet">
   
   <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
   
      <script src="<?php echo base_url('assets/js/jquery-1.8.3.min.js') ?>"> </script>
   
   <script src="<?php echo base_url('assets/js/jquery-form.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/bootstrap-transition.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/bootstrap-alert.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/bootstrap-modal.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/bootstrap-dropdown.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/bootstrap-scrollspy.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/bootstrap-tab.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/bootstrap-tooltip.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/bootstrap-popover.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/bootstrap-button.js') ?>"</script>
   <script src="<?php echo base_url('assets/js/bootstrap-collapse.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/bootstrap-carousel.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/bootstrap-typeahead.js') ?>"></script>

   
   <script src="<?php echo base_url('assets/js/jquery.price_format.1.7.js') ?>"> </script>
 <script language="javascript">	  
		$(document).ready(function(){
			$('input[id="valor"]').priceFormat({
				prefix: 'R$ ',
				centsSeparator: ',',
				thousandsSeparator: '.'
				});  		            
     });
     

     
     
     function confirmaExclusao(url) 
		{
			if(confirm('Você confirma a exclusão?')) 
			{
				location.href = url
		    }
		}
     
 </script>
 
 
<script type="text/javascript"> 
  $(function(){ 
    $('.carousel').carousel(); 
  }); 
</script> 

</head>
<body>


<!-- Model Window
					    ================================================== --> 
					<!-- Placed at the end of the document so the pages load faster -->
					<div class="modal hide fade in" id="addIdea">
					  <div class="modal-header">
					    <button class="close" data-dismiss="modal">×</button>
					    <h3>Atenção!</h3>
					  </div>
					  <div class="modal-body">
					    <h4>Seu Perfil não está liberado para exclusões.</h4>
					  </div>
					</div>

