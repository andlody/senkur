<div class="row col-xs-12">
<span class="text-left col-xs-12" style="font-size:18px;color:#616161;margin-bottom:10px">Reporte de Jefes</span>

<div class="col-xs-6">
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

<div class="col-xs-6" style="min-height: 84px;max-height: 84px;">
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

</div>

<div class="row col-xs-12" style="font-size:12px;">

        <div class="panel panel-primary text-justify">
            <div class="panel-body">
                <div class="form-group">

                    <table class="table text-left">
                        <thead>
                            <tr>
                                <th scope="col">ID CURSO</th>
                                <th scope="col">NOMBRE CURSO</th>
                                <th scope="col">ALUMNOS*</th>
                            </tr>
                        </thead>
                        <tbody id="cursos">
                        </tbody>
                    </table>

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
                    $("#campus").html('<select class="form-control" id="cbxCampus" onchange="verCursos()"></select>');
					$("#cbxCampus").html(d);
                }
            });
		}

        function verCursos(){
            $("#cursos").html('<img src="public/img/loading.jpg" style="height:60px">');
            $.ajax({
                url: '?k=index/cursos',
                data: {
                    'zonal':$("#cbxZonal").val(),
                    'campus':$("#cbxCampus").val()
                },
                success: function(d){alert(d);
                    $("#cursos").html(d);
                }
            });
        }

		</script>
