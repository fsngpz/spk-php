<?php
error_reporting(~E_NOTICE & ~E_DEPRECATED);
session_start();

include'config.php';
include'includes/ez_sql_core.php';
include'includes/ez_sql_mysqli.php';
$db = new ezsql_mysqli($config['username'], $config['password'], $config['database_name'], $config['server']);
include'includes/general.php';  
 if (isset($_GET['m'])){
    $mod = $_GET['m'];     
 } else {
     $mod = 'default_value';
 }
$act = isset($_GET['act'])? $_GET['act']: 'default_action';  

$nRI = array (
	1=>0,
	2=>0,
	3=>0.58,
	4=>0.9,
	5=>1.12,
	6=>1.24,
	7=>1.32,
	8=>1.41,
	9=>1.46,
	10=>1.49
);

$rows = $db->get_results("SELECT kode_alternatif, nama_alternatif FROM tb_alternatif ORDER BY kode_alternatif");
foreach($rows as $row){
    $ALTERNATIF[$row->kode_alternatif] = $row->nama_alternatif;
}

$rows = $db->get_results("SELECT kode_kriteria, nama_kriteria FROM tb_kriteria ORDER BY kode_kriteria");
foreach($rows as $row){
    $KRITERIA[$row->kode_kriteria] = $row->nama_kriteria;
}
function get_relkriteria(){
    global $db;
    $data = array();
    $rows = $db->get_results("SELECT k.nama_kriteria, rk.ID1, rk.ID2, nilai 
        FROM tb_rel_kriteria rk INNER JOIN tb_kriteria k ON k.kode_kriteria=rk.ID1 
        ORDER BY ID1, ID2");
    foreach($rows as $row){    
        $data[$row->ID1][$row->ID2] = $row->nilai;
    }
    return $data;
}   

function get_relalternatif($kriteria=''){
    global $db;
    $rows = $db->get_results("SELECT * FROM tb_rel_alternatif WHERE kode_kriteria='$kriteria' ORDER BY kode1, kode2");
    $matriks = array();
    foreach($rows as $row){
        $matriks[$row->kode1][$row->kode2] = $row->nilai;
    }
    return $matriks;
}

function get_kriteria_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_kriteria, nama_kriteria FROM tb_kriteria ORDER BY kode_kriteria");
    foreach($rows as $row){
        if($row->kode_kriteria==$selected)
            $a.="<option value='$row->kode_kriteria' selected>$row->kode_kriteria - $row->nama_kriteria</option>";
        else
            $a.="<option value='$row->kode_kriteria'>$row->kode_kriteria - $row->nama_kriteria</option>";
    }
    return $a;
}

function get_alternatif_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_alternatif, nama_alternatif FROM tb_alternatif ORDER BY kode_alternatif");
    foreach($rows as $row){
        if($row->kode_alternatif==$selected)
            $a.="<option value='$row->kode_alternatif' selected>$row->kode_alternatif - $row->nama_alternatif</option>";
        else
            $a.="<option value='$row->kode_alternatif'>$row->kode_alternatif - $row->nama_alternatif</option>";
    }
    return $a;
}

function get_nilai_option($selected = ''){
    $nilai = array(
        '1' => 'Sama penting dengan',
        '2' => 'Mendekati sedikit lebih penting dari',
        '3' => 'Sedikit lebih penting dari',
        '4' => 'Mendekati lebih penting dari',
        '5' => 'Lebih penting dari',
        '6' => 'Mendekati sangat penting dari',
        '7' => 'Sangat penting dari',
        '8' => 'Mendekati mutlak dari',
        '9' => 'Mutlak sangat penting dari',
    );
    foreach($nilai as $key => $value){
        if($selected==$key)
            $a.="<option value='$key' selected>$key - $value</option>";
        else
            $a.= "<option value='$key'>$key - $value</option>";
    }
    return $a;
}

function get_total_kolom($matriks = array()){
    $total = array();        
    foreach($matriks as $key => $value){
        foreach($value as $k => $v){
            $total[$k]+=$v;
        }
    }  
    return $total;
} 

function get_normalize($matriks = array(), $total = array()){
          
    foreach($matriks as $key => $value){
        foreach($value as $k => $v){
            $matriks[$key][$k] = $matriks[$key][$k]/$total[$k];
        }
    }     
    return $matriks;       
}

function get_rata($normal){
    $rata = array();
    foreach($normal as $key => $value){
        $rata[$key] = array_sum($value)/count($value); 
    } 
    return $rata;   
}

function get_mmult($matriks = array(), $rata = array()){
	$data = array();
    
    $rata = array_values($rata);
    
	foreach($matriks as $key => $value){
        $no=0;
		foreach($value as $k => $v){
			$data[$key]+=$v*$rata[$no];       
            $no++;  
		}				
	}  
    
	return $data;
}

function get_consistency_measure($matriks, $rata){
    $matriks = get_mmult($matriks, $rata);    
    foreach($matriks as $key => $value){
        $data[$key]=$value/$rata[$key];        
    }
    return $data;
}

function get_eigen_alternatif($kriteria=array()){
    $data = array();
    foreach($kriteria as $key => $value){
        $kode_kriteria = $key;
        $matriks = get_relalternatif($kode_kriteria);
        $total = get_total_kolom($matriks);
        $normal = get_normalize($matriks, $total);
        $rata = get_rata($normal);
        $data[$kode_kriteria] = $rata;                
    }
    $new = array();
    foreach($data as $key => $value){
        foreach($value as $k => $v){
            $new[$k][$key] = $v;
        }
    }
    return $new;
}

function get_rank($array){
    $data = $array;
    arsort($data);
    $no=1;
    $new = array();
    foreach($data as $key => $value){
        $new[$key] = $no++;
    }
    return $new;
}