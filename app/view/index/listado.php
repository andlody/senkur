<?php   $a = $v->get('body'); ?>
<div class="col-lg-12">
    <div class="panel panel-primary text-justify" style="border-left: 2px solid #337ab7;">
        <div class="panel-body" style="padding: 5px 15px;">
            <div class="row">
                <div class="col-xs-2 text-right" style="font-weight:600">
                    Nombre de Curso:<br>
                    Id del Curso:<br>
                    Campus:<br>
                    Alumnos:
                </div>
                <div class="col-xs-8">
                    <?= $v->get('curso') ?><br>
                    <?= $v->get('id') ?><br>
                    <?= $v->get('campus') ?><br>
                    <?= sizeof($a) ?>
                </div>
                <div class="col-xs-2 text-right"><br><a class="btn btn-primary" href="javascript:window.history.back();">Regresar</a></div>
            </div>
        </div> 
    </div>
</div>

<div class="col-lg-12">
    <div class="panel panel-primary text-justify">
        <div class="panel-body">
            <div class="form-group">

                <table class="table text-left table-striped" style="font-size:12px">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID ALUMNO</th>
                            <th scope="col">NOMBRE ALUMNO</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">Nota</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php   for($i=0;$i<sizeof($a);$i++){ 
                                if(trim($a[$i][4])=='') 
                                    $rst = '-';
                                else
                                    $rst = (number_format($a[$i][4],1)>10.5)?'<span style="color:blue">Aprobado</span>':'<span style="color:red">Desaprobado</span>';
                        ?>
                                    <tr>
                                        <td><?=($i+1)?></td>
                                        <td><?=$a[$i][0]?></td>
                                        <td><?=$a[$i][1]?> <?=$a[$i][2]?></td>
                                        <td><?=$a[$i][3]?></td>
                                        <td><?=($rst=='-')?'-':number_format($a[$i][4],1) ?></td>
                                        <td><?=$rst;  ?></td>
                                    </tr>
                        <?php   } ?>
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
</div>

<div class="col-lg-12 text-left">
    <a class="btn btn-primary" href="javascript:window.history.back();">Regresar</a>
</div>