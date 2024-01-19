<div class="page-header">
    <h1>Nilai Bobot Alternatif</h1>
</div>
<div class="panel panel-default">
<div class="panel-heading">
<form class="form-inline">
    <input type="hidden" name="m" value="rel_alternatif" />
    <div class="form-group">
        <select class="form-control" name="kode_kriteria" onchange="this.form.submit()">
        <option value="">Pilih kriteria</option>
        <?=get_kriteria_option($_GET['kode_kriteria'])?>
        </select>
    </div>
</form>
</div>
<div class="panel-body">
<?php if($_POST) include'aksi.php'?>
<form class="form-inline" method="post" action="?m=rel_alternatif&kode_kriteria=<?=$_GET['kode_kriteria']?>">
    <input type="hidden" name="m" value="rel_alternatif" />
    <div class="form-group">
        <select class="form-control" name="kode1">
        <?=get_alternatif_option($_POST['kode1'])?>
        </select>
    </div>
    <div class="form-group">
        <select class="form-control" name="nilai">
        <?=get_nilai_option($_POST['nilai'])?>
        </select>
    </div>
    <div class="form-group">
        <select class="form-control" name="kode2">
        <?=get_alternatif_option($_POST['kode2'])?>
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
    </div>
</form>
</div>
<?php $data = get_relalternatif($_GET['kode_kriteria']); 
if($data):?>
    <table class="table table-bordered table-hover table-striped">
    <thead>
        <tr class="text-primary">
            <th>Kode</th>
            <?php 
            foreach($data as $key=>$value){
                echo "<th>$key</th>";
            }         
            ?>
        </tr>
    </thead>
    <?php
    
    $no=1;
    
    foreach($data as $key => $value):?>
    <tr>
        <th class="text-primary"><?=$key?></th>
        <?php  
        foreach($value as $dt){
            echo "<td>".round($dt, 3)."</td>";               
        }    
        ?>
    </tr>
    <?php endforeach?>
    </table>
<?php endif?>
</div>