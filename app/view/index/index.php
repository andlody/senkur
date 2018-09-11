<div class="row col-xs-12">
<span class="text-left col-xs-12" style="font-size:18px;color:#616161;margin-bottom:10px">Reporte de Jefes</span>

<div class="col-xs-4">
    <div class="panel panel-primary text-justify" style="border-left: 2px solid #337ab7;">
        <div class="panel-body" style="padding: 5px 15px;">
            <div class="form-group">
                <label for="sel1">Zonal:</label>
                <select class="form-control" id="cbxZonal" onchange="verCampus()">
                    <option> </option>
		    <?php for($i=0;$i<sizeof($v->get('sedes'));$i++){ ?>
                        <option value="<?= $v->get('sedes')[$i][0] ?>"><?= $v->get('sedes')[$i][0] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div> 
    </div>
</div>

<div class="col-xs-4" style="min-height: 84px;max-height: 84px;">
    <div class="panel panel-primary text-justify" style="border-left: 2px solid #337ab7;">
        <div class="panel-body" style="padding: 5px 15px;">
            <div class="form-group">
                <label for="sel1">Campus:</label>
                <span id="campus">
                    <select class="form-control">
                    </select>
                </span>
            </div>
        </div> 
    </div>
</div>

<div class="col-xs-4" style="min-height: 84px;max-height: 84px;">
    <div class="panel panel-primary text-justify" style="border-left: 2px solid #337ab7;">
        <div class="panel-body" style="padding: 5px 15px;">
            <div class="form-group">
                <label for="sel1">Carrera:</label>
                <span id="carreras">
                    <select class="form-control">
                    </select>
                </span>
            </div>
        </div> 
    </div>
</div>

</div>

<div class="row col-xs-12" style="font-size:12px;">

    <div class="col-xs-5">
        <div class="panel panel-primary text-justify">
            <div class="panel-body">
                <div class="form-group">

                    <table class="table text-left">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Curso</th>
                                <th scope="col">Categoria</th>
                            </tr>
                        </thead>
                        <tbody id="cursos">
                        </tbody>
                    </table>

                </div>
            </div> 
        </div>
    </div>



    <div class="col-xs-7">
        <div class="panel panel-primary text-justify">
            <div class="panel-body">
                <div class="form-group">

                    <table class="table text-left">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Correo</th>
                            </tr>
                        </thead>
                        <tbody id="alumnos">
                        </tbody>
                    </table>

                </div>
            </div> 
        </div>
    </div>

</div>
	<script>
		function verCampus(){
            $("#campus").html('<img src="public/img/loading.jpg" style="height:60px">');
			$.ajax({
                url: '?k=index/campus',
                data: {
                	'zonal':$("#cbxZonal").val()
                },
                success: function(d){
                    $("#campus").html('<select class="form-control" id="cbxCampus" onchange="verCarreras()"></select>');
					$("#cbxCampus").html(d);
                }
            });
		}

		function verCarreras(){
            $("#carreras").html('<img src="public/img/loading.jpg" style="height:60px">');
			$.ajax({
                url: '?k=index/carreras',
                data: {
                	'zonal':$("#cbxZonal").val(),
                	'campus':$("#cbxCampus").val()
                },
                success: function(d) {
                    $("#carreras").html('<select class="form-control" id="cbxCarreras" onchange="verCursos()"></select>');
					$("#cbxCarreras").html(d);
                }
            });
		}

        function verCursos(){
            $("#cursos").html('<img src="public/img/loading.jpg" style="height:60px">');
            verAlumnos();
            $.ajax({
                url: '?k=index/cursos',
                data: {
                    'zonal':$("#cbxZonal").val(),
                    'campus':$("#cbxCampus").val(),
                    'carrera':$("#cbxCarreras").val()
                },
                success: function(d) { //alert(d);
                    $("#cursos").html(d);
                }
            });
        }

        function verAlumnos(){
            $("#alumnos").html('<img src="public/img/loading.jpg" style="height:60px">');
            $.ajax({
                url: '?k=index/alumnos',
                data: {
                    'zonal':$("#cbxZonal").val(),
                    'campus':$("#cbxCampus").val(),
                    'carrera':$("#cbxCarreras").val()
                },
                success: function(d) { //alert(d);
                    $("#alumnos").html(d);
                }
            });
        }        







		function verPeriodo(){
			$.ajax({
                url: '?k=index/periodo',
                data: {
                	'zonal':$("#cbxZonal").val(),
                	'campus':$("#cbxCampus").val(),
                	'carrera':$("#cbxCarrera").val()
                },
                success: function(d) { //alert(d);
					$("#periodo").html(d);
                }
            });
		}
	</script>
