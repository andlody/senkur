<div class="col-lg-12">
    <div class="panel panel-primary text-justify">
        <div class="panel-body">
            <div class="form-group">

                <table class="table text-left">
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
                        <?php   $a = $v->get('body');
                                for($i=0;$i<sizeof($a);$i++){ ?>
                                    <tr>
                                        <td><?=($i+1)?></td>
                                        <td><?=$a[$i][0]?></td>
                                        <td><?=$a[$i][1]?> <?=$a[$i][2]?></td>
                                        <td><?=$a[$i][3]?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                        <?php   } ?>
                    </tbody>
                </table>

            </div>
        </div> 
    </div>
</div>