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
                            <th scope="col">ID Alumno</th>
                            <th scope="col">Nombre alumno</th>
                            <?php   $b = $v->get('head');
                                    for($i=1;$i<sizeof($b);$i++){ ?>
                                        <th scope="col"><?= $b[$i][0] ?> <span style="font-size:10px;color:green">(<?= number_format($b[$i][1]) ?>%)</span></th>
                            <?php   } ?>
                            <th scope="col">Nota final</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php   for($i=0;$i<sizeof($a);$i++){ ?>
                                    <tr>
                                        <?php for($j=0;$j<sizeof($a[$i]);$j++){ ?>
                                            <td><?= $a[$i][$j] ?></td>
                                        <?php } ?>
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