<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$csrf = [
	'name' => $this->security->get_csrf_token_name(),
	'hash' => $this->security->get_csrf_hash() 
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assetts/css/estilo_personal.css">
	<!-- Uso del remember token en la cabecera --> 
	<meta name="<?=$csrf['name']?>" id="token" value="<?=$csrf['hash']?>" content="<?=$csrf['hash']?>">
	<title>Bienvenido</title>		
</head>
<body>