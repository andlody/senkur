<span class="text-left col-xs-12" style="font-size:18px;color:#616161;margin-bottom:10px">Categoría de cursos</span>
<?php	$a=$v->get('cursos');
	for($i=0;$i<sizeof($a);$i++){?>
		<div class="col-xs-3">
			<a href="#" style="text-decoration: none;">
			<div class="panel panel-primary text-justify" style="border-left: 2px solid #337ab7;">
		        <div class="panel-body text-right" style="padding: 5px 5px;">
		            <span style="position: absolute;left: 25px;"><?= $a[$i][1] ?></span> 
		            <span style="color:#000;"><?= $a[$i][2] ?></span>
		        </div> 
		    </div>
			</a>
		</div>		
<? 	} ?>

<div class="col-xs-12">
	<div class="panel panel-primary text-justify">
        <div class="panel-body text-left" style="padding: 5px 5px;">
        	<div class="row">
            	<div class="col-xs-4"><strong>Categoria:</strong> Tecnologias de la informacion</div>
            	<div class="col-xs-4"><strong>Categoria:</strong> Tecnologias de la informacion</div>
            </div>
        </div> 
    </div>
</div>		