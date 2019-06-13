<?php
$btn_salida=[
    'name'=>'btnSalida',
    'id'=>'btnSalida'
];
?>
<h1>Entrado <?=$this->session->userdata('user_data')['nombre']?></h1>
<br>
<?=form_open('logout')?>
<?=form_submit($btn_salida,'Salir del sistema')?>
<?=form_close()?>