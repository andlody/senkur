<div class="row">
    <div class="col-lg-7">
        <div class="panel panel-primary text-justify" style="border-left: 2px solid #337ab7;">
            <div class="panel-body" style="padding: 5px 15px;">
                <div class="form-group">
                    <label>Seleccione un Campus:</label>
                    <select class="form-control" id="cbxCampus">
                        <?php $a = $v->get('campus');
                                for($i=0;$i<sizeof($a);$i++){ 
                                    if($a[$i][0]==$v->get('sede')){ ?>
                                        <option value="<?= $a[$i][0] ?>" selected><?= $a[$i][0] ?></option>
                                    <? }else{ ?>
                                        <option value="<?= $a[$i][0] ?>"><?= $a[$i][0] ?></option>
                        <?php           }
                                }   ?>
                    </select>
                </div>
            </div> 
        </div>
    </div>
    <div class="col-lg-3">
        <div class="panel panel-primary text-justify" style="border-left: 2px solid #337ab7;">
            <div class="panel-body" style="padding: 5px 15px;">
                <div class="form-group">
                    <label>Seleccione el Periodo:</label>
                    <select class="form-control" id="cbxPeriodo">
                        <option value="0" <?= ($v->get('periodo')=='0' || $v->get('periodo')=='')?'selected':'' ?>>Todos</option>
                        <option value="201810" <?= ($v->get('periodo')=='201810')?'selected':'' ?>>201810</option>
                        <option value="201820" <?= ($v->get('periodo')=='201820')?'selected':'' ?>>201820</option>
                    </select>
                </div>
            </div> 
        </div>
    </div>
    <div class="col-lg-2">
        <div class="panel panel-primary text-justify" style="border-left: 2px solid #337ab7;">
            <div class="panel-body" style="padding: 5px 15px;">
                <div class="form-group">
                    <label style="color:#fff">.</label>
                    <button class="form-control btn btn-sm btn-primary" style="font-size: 15px;" onclick="verCursos()">Buscar</button>
                </div>
            </div> 
        </div>
    </div>
</div>


<div class="row" style="font-size:12px;">

    <div class="col-lg-4">
        <div class="panel panel-primary text-justify">
            <div class="panel-body">
                <label style="font-size:14px;">REPORTE:</label> <br>
                <strong>CAMPUS:&nbsp;&nbsp;&nbsp;&nbsp;</strong> <span id="label-campus"><?=$v->get('sede')?></span> <br>
                <strong>PERIODO:&nbsp;&nbsp;&nbsp;</strong>  <span id="label-periodo"><?=$v->get('periodo')?></span>
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
                        <?php $a = $v->get('body');
                            for($i=0;$i<sizeof($a);$i++){ ?>
                            <tr><td><?= ($i+1) ?></td>
                                <td><?=$a[$i][0]?></td>
                                <td><?=$a[$i][1]?></td>
                                <td><?=$a[$i][2]?></td>
                                <td><a href="?k=index/listado/<?=$v->get('sede') ?>/<?=$a[$i][0]?>">Listado</a></td>
                                <td><a href="?k=index/evidencias/<?=$v->get('sede') ?>/<?=$a[$i][0]?>">Evidencias</a></td></tr>
                        <?php   }   ?>
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
            location.href = '?k=index/senati/'+$("#cbxCampus").val()+'/'+$("#cbxPeriodo").val();
        }
</script>