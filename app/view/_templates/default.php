<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include $v->partial("head"); ?>
    </head>
    <body>
	  	<!-- navbar -->
			<?php include $v->partial("navbar"); ?>
		<!-- fin navbar -->
		<div class="container">
            <div class="row">
				<!-- body --> 
		        	<div class="col-lg-12">
		            	<div class="panel panel-body text-center" style="background:#f1f1f1;">
		                	<?php include $v->body; ?>
		            	</div>
					</div>
				<!-- fin body --> 
            </div>		
		</div>
		<!-- footer -->			
			<?php include $v->partial("footer"); ?>
        <!-- fin footer -->
    </body>
</html>