<div class="panel panel-primary text-justify" style="border-left: 2px solid #337ab7;">
    <div class="panel-body" style="padding: 5px 15px;">
        <div class="form-group">
            <label>Seleccione un Campus:</label>
            <select class="form-control" id="cbxCampus" onchange="verCursos()">
                <option> </option>
                <?php $a = $v->get('campus');
                        for($i=0;$i<sizeof($a);$i++){ ?>
                            <option value="<?= $a[$i][0] ?>"><?= $a[$i][0] ?></option>
                <?php   }   ?>
            </select>
        </div>
    </div> 
</div>


<div class="row" style="font-size:12px;">

    <div class="col-lg-4">
        <div class="panel panel-primary text-justify">
            <div class="panel-body">
                <label style="font-size:14px;">REPORTE:</label> <br>
                <!--<strong>CAMP:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> dasdsa <br> -->
                <strong>CAMPUS:&nbsp;&nbsp;&nbsp;&nbsp;</strong> <span id="label-campus"></span> <br>
                <strong>PERIODO:&nbsp;&nbsp;&nbsp;</strong>  <span id="label-periodo"></span>
            </div> 
        </div>
    </div>

    <div class="col-lg-12">
        <div class="panel panel-primary text-justify">
            <div class="panel-body">
                <div class="form-group">

                    <table class="table text-left  table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID CURSO</th>
                                <th scope="col">NOMBRE CURSO</th>
                                <th scope="col">ALUMNOS*</th>
                                <th scope="col">Ver</th>
                                <th scope="col">Ver</th>
                            </tr>
                        </thead>
                        <tbody id="cursos">
                        </tbody>
                    </table>

                </div>
            </div> 
        </div>
    </div>
</div>






<script>

        function verCursos(){
            $("#cursos").html('<img src="public/img/loading.jpg" style="height:60px">');
            $.ajax({
                url: '?k=index/getcursos',
                data: {
                    'campus':$("#cbxCampus").val()
                },
                success: function(d){
                    $("#cursos").html(d);
                    $("#label-periodo").html('201820');
                    $("#label-campus").html($("#cbxCampus").val());
                }
            });
        }

</script>