<div class="page-header">
    <h1>Perhitungan</h1>
</div>
<?php    
    $c = $db->get_results("SELECT * FROM tb_rel_alternatif WHERE nilai>0");
    if (!$ALTERNATIF|| !$KRITERIA):
        echo "Tampaknya anda belum mengatur alternatif dan kriteria. Silahkan tambahkan minimal 3 alternatif dan 3 kriteria.";
    elseif (!$c):
        echo "Tampaknya anda belum mengatur nilai alternatif. Silahkan atur pada menu <strong>Nilai Bobot</strong> > <strong>Nilai Bobot Alternatif</strong>.";
    else:
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Mengukur Konsistensi Kriteria</h3>
    </div>
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Matriks Perbandingan Kriteria</h3>
            </div>
            <div class="panel-body">
                Pertama-tama menyusun hirarki dimana diawali dengan tujuan, kriteria dan alternatif-alternatif lokasi pada tingkat paling bawah. 
                Selanjutnya menetapkan perbandingan berpasangan antara kriteria-kriteria dalam bentuk matrik. 
                Nilai diagonal matrik untuk perbandingan suatu elemen dengan elemen itu sendiri diisi dengan bilangan (1) sedangkan isi nilai perbandingan antara (1) sampai dengan (9) kebalikannya, kemudian dijumlahkan perkolom. 
                Data matrik tersebut seperti terlihat pada tabel berikut. 
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead><tr>
                        <th></th>
                        <?php 
                        $matriks = get_relkriteria();   
                        $total = get_total_kolom($matriks);
                        
                        foreach($matriks as $key => $val):?>
                        <th><?=$key?></th>        
                        <?php endforeach?>
                    </tr></thead>
                    <?php foreach($matriks as $key => $val):?>
                    <tr>
                        <td><?=$key?> - <?=$KRITERIA[$key]?></td>
                        <?php foreach($val as $k => $v):?>
                        <td><?=round($v, 4)?></td>
                        <?php endforeach?>        
                     </tr>  
                      <?php endforeach?>                         
                     <tfoot><tr>
                        <td>Total kolom</td>
                        <?php foreach($total as $key => $val):?>
                        <td class="text-primary"><?=round($total[$key], 4)?></td>        
                        <?php endforeach?>
                     </tr></tfoot>
                </table>
            </div>
        </div>        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Matriks Bobot Prioritas Kriteria</h3>
            </div>
            <div class="panel-body">
                Setelah terbentuk matrik perbandingan maka dilihat bobot prioritas untuk perbandingan  kriteria.  
                Dengan  cara  membagi  isi  matriks  perbandingan  dengan jumlah  kolom  yang  bersesuaian,  kemudian  menjumlahkan  perbaris  setelah  itu hasil penjumlahan dibagi dengan banyaknya kriteria sehingga ditemukan bobot prioritas seperti terlihat pada berikut.  
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead><tr>
                        <th></th>
                        <?php 
                        $normal = get_normalize($matriks, $total);                  
                        $rata = get_rata($normal);
                        
                        foreach($matriks as $key => $val):?>
                        <th><?=$key?></th>        
                        <?php endforeach?>
                        <th>Bobot Prioritas</th>
                    </tr></thead>
                    <?php foreach($normal as $key => $val):?>
                    <tr>
                        <th><?=$key?></th>
                        <?php foreach($val as $k => $v):?>
                        <td><?=round($v, 4)?></td>
                        <?php endforeach?>				             
                        <td class="text-primary"><?=round($rata[$key],3)?></td>
                    </tr>	
                    <?php endforeach?>
                </table>
            </div>
        </div>        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Matriks Konsistensi Kriteria</h3>
            </div>
            <div class="panel-body">
            Untuk  mengetahui  konsisten  matriks  perbandingan dilakukan  perkalian  seluruh  isi  kolom  matriks  A  perbandingan  dengan  bobot prioritas  kriteria  A,  isi  kolom  B  matriks  perbandingan  dengan  bobot  prioritas kriteria  B  dan  seterusnya.  Kemudian  dijumlahkan  setiap  barisnya  dan  dibagi penjumlahan baris dengan bobot prioritas bersesuaian seperti terlihat pada tabel berikut. 
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                <thead><tr>
                        <th></th>
                        <?php 
                        $cm = get_consistency_measure($matriks, $rata);                                          
                        
                        foreach($matriks as $key => $val):?>
                        <th><?=$key?></th>        
                        <?php endforeach?>
                        <th>CM</th>
                    </tr></thead>
                    <?php foreach($normal as $key => $val):?>
                    <tr>
                        <th><?=$key?></th>
                        <?php foreach($val as $k => $v):?>
                        <td><?=round($v, 4)?></td>
                        <?php endforeach?>				             
                        <td class="text-primary"><?=round($cm[$key],3)?></td>
                    </tr>	
                    <?php endforeach?>
                </table>    
            </div>    
        <div class="panel-body">
            Berikut tabel ratio index berdasarkan ordo matriks.    
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>Ordo matriks</th>
                    <?php
                        foreach($nRI as $key => $val){
                            if(count($matriks)==$key)
                                echo "<td class='text-primary'>$key</td>";
                            else
                                echo "<td>$key</td>";
                        }
                    ?>
                </tr>
                <tr>
                    <th>Ratio index</th>
                    <?php
                        foreach($nRI as $key => $va){
                            if(count($matriks)==$key)
                                echo "<td class='text-primary'>$val</td>";
                            else
                                echo "<td>$val</td>";
                        }
                    ?>
                </tr>
            </table>
        </div>
        <div class="panel-footer">
        <?php
            $CI = ((array_sum($cm)/count($cm))-count($cm))/(count($cm)-1);	
        	$RI = $nRI[count($matriks)];
        	$CR = $CI/$RI;
        	echo "<p>Consistency Index: ".round($CI, 3)."<br />";	
        	echo "Ratio Index: ".round($RI, 3)."<br />";
        	echo "Consistency Ratio: ".round($CR, 3);
        	if($CR>0.10){
        		echo " (Tidak konsisten)<br />";	
        	} else {
        		echo " (Konsisten)<br />";
        	}
        ?>
        </div>
        </div>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Matriks Perbandingan Alternatif</h3>
    </div>
    <div class="panel-body">
        <p>Selanjutnya setelah menemukan bobot prioritas kriteria, menetapkan nilai skala perbandingan lokasi berdasarkan masing-masing kriteria. 
        Nilai skala sesuai dengan   kebijakan   perusahaan.   
        Langkah   selanjutnya   membuat   matriks perbandingan  alternatif  lokasi  berdasarkan  kriteria.  
        Setelah  terbentuk  matriks perbandingan  lokasi  berdasarkan  kriteria  maka  dicari  bobot  prioritas  untuk perbandingan lokasi terhadap masing,masing kriteria.  
        Buat kriteria selanjutnya dengan cara yang sama.</p>  
        <?php foreach($KRITERIA as $kode => $nama): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Matriks Perbandingan Alternatif Berdasarkan <strong><?=$nama?></strong></h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th></th>
                        <?php 
                        foreach($ALTERNATIF as $k => $v){
                            echo"<th>$k</th>";
                        }
                        ?>
                    </tr>
                    <?php 
                    $data = get_relalternatif($kode);                        
                    foreach($data as $key => $value){
                        echo"<tr><th>$key</th>";
                        foreach($value as $k => $v){
                            echo"<td>".round($v, 3)."</td>";
                        }
                        echo"</tr>";
                    }
                    
                    $total = get_total_kolom($data);
                    echo "<tfoot><tr><th>Total kolom</th>";
                    foreach($total as $key => $value){
                        echo "<td class='text-primary'>".round($total[$key],3)."</td>";        
                    }
                    echo "</tr></tfoot>";
                    ?>
                </table>
            </div>
            <div class="panel-body">
                Matrik bobot prioritas alternatif berdasarkan <strong><?=$nama?></strong>:
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th></th>
                        <?php 
                        foreach($ALTERNATIF as $k => $v){
                            echo"<th>$k</th>";
                        }
                        ?>
                        <th>Bobot</th>
                    </tr>
                    <?php 
                    $data = get_normalize($data, $total);
                    $ratax = get_rata($data);
                    
                    foreach($data as $key => $value){
                        echo"<tr><th>$key</th>";
                        foreach($value as $k => $v){
                            echo"<td>".round($v, 3)."</td>";
                        }
                        echo"<td class='text-primary'>".round($ratax[$key], 3)."</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Hasil Akhir</h3>
    </div>
    <div class="panel-body">    
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">EIGEN KRITERIA DAN ALTERNATIF</h3></div>
            <div class="panel-body">
                Setelah  menemukan  bobot  dari  masing-masing  kriteria terhadap  lokasi yang  sudah  ditentukan  oleh  pihak  perusahaan,  langkah  selanjutnya  adalah mengalikan bobot dari masing,masing kriteria dengan bobot dari masing-masing lokasi,  kemudian  hasil  perkalian  tersebut  dijumlahkan  perbaris.  
                Sehingga didapatkan total prioritas global seperti pada tabel berikut. 
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <?php		
                    echo "<tr><th>Alternatif</th>";   		
                    $no=1;	
                    foreach($KRITERIA as $key => $value){
                        echo "<th>$key</th>";
                        $no++;      
                    }      
                	echo "<th>Nilai</th><th>Rank</th>";
                    echo "<tr><td>Vektor Eigen</td>";
                    foreach($rata as $r){
                        echo "<td>".round($r, 3)."</td>";
                    }
                    echo "<td></td><td></td></tr>";            
                    
                    $eigen_alternatif = get_eigen_alternatif($KRITERIA);
                    $nilai = get_mmult($eigen_alternatif, $rata);                                                       
                    $rank = get_rank($nilai);
                    
                    foreach($eigen_alternatif as $key => $value){
                        echo "<tr>";
                        echo "<td>$key - ".$ALTERNATIF[$key]."</td>";
                        foreach($value as $k => $v){
                            echo "<td>".round($v,3)."</td>";    
                        }    
                        echo "<td class='text-primary'>".round($nilai[$key], 3)."</td>";
                        echo "<td class='text-primary'>$rank[$key]</td>";        
                        echo "</tr>";
                        $no++;
                    }    
                    echo "</tr>";            
                    ?>
                 </table> 
            </div>                        
        </div>
        <a class="btn btn-sm btn-default" href="cetak.php?m=hitung" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a>
    </div>
</div>
<?php endif?>
