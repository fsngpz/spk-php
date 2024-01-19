<?php
    function esc_field($str) {
        if (!function_exists('get_magic_quotes_gpc') || !get_magic_quotes_gpc()) {
            return addslashes($str);
        } else {
            return $str;
        }
    }

function redirect_js($url){
    echo '<script type="text/javascript">window.location.replace("'.$url.'");</script>';
}

function alert($url){
    echo '<script type="text/javascript">alert("'.$url.'");</script>';
}

function print_msg($msg, $type = 'danger'){
    echo('<div class="alert alert-'.$type.' alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$msg.'</div>');
}

function print_error($msg){
    die('<!DOCTYPE html>
    <html>
        <head><title>Error</title>
        <link href="../assets/css/united-bootstrap.min.css" rel="stylesheet"/>
        <body>
            <div class="container" style="margin:20px auto; width:400px">
                <p class="alert alert-warning">'.$msg.' <a href="javascript:history.back(-1)">Kembali</a></p>                
            </div>
        </body>
    </html>');
}