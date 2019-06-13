<div id="container">
	<h1>Ingresar al sistema</h1>
    <div id="body">
        <p>Favor ingresar: </p>
        <?php
        //Parámetros de entrada para formulario de registro
        $usuario=[
            'name'=>'user',
            'type'=>'text',
            'id'=>'user',
            'placeholder'=>'Ingrese su usuario...',
            'required'=>'',
        ];
        $password=[
            'name'=>'pass',
            'type'=>'password',
            'id'=>'pass',
            'required'=>'',
        ];
        $btn_ingreso=[
            'name'=>'btnLogin',
            'id'=>'btnLogin'
        ];
        ?>
        <!-- Formulario de registro -->
        <?=form_open('usuario-main') ?>
        <table>
            <tr>
                <td><?=form_label('Nombre usuario :','user')?></td>
                <td><?=form_input($usuario)?></td>
            </tr>
            <tr>
                <td><?=form_label('Contraseña :','pass')?></td>
                <td><?=form_input($password)?></td>
            </tr>
        </table>
        <br>
        <?=form_submit($btn_ingreso,'Ingresar al sistema') ?>
        <?=form_close() ?>
        <br>
        <?=form_open('registrar') ?>
		<?=form_submit('','Registrarse') ?>
		<?=form_close() ?>
        <br>
    </div>
</div>