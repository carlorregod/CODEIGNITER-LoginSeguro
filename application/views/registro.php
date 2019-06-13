<div id="container">
<h1>Registrarse</h1>
    <div id="body">
        <p>Ingresar para registro:</p>
        <?php
        //Parámetros de entrada para formulario de registro
        $nombre=[
            'name'=>'nombre',
            'type'=>'text',
            'id'=>'nombre',
            'placeholder'=>'Ingrese su nombre...'
        ];
        $correo=[
            'name'=>'email',
            'type'=>'text',
            'id'=>'email',
            'placeholder'=>'Ingrese su correo...'
        ];
        $usuario=[
            'name'=>'user',
            'type'=>'text',
            'id'=>'user',
            'placeholder'=>'Ingrese su usuario...'
        ];
        $password=[
            'name'=>'pass',
            'type'=>'password',
            'id'=>'pass',
        ];
        $btn_ingreso=[
            'name'=>'btnIngresar',
            'id'=>'btnIngresar'
        ];
        ?>
        <!-- Formulario de registro -->
        <table>
            <tr>
                <td><?=form_label('Nombre :','nombre')?></td>
                <td><?=form_input($nombre)?></td>
            </tr>
            <tr>
                <td><?=form_label('Correo electrónico :','email')?></td>
                <td><?=form_input($correo)?></td>
            </tr>
            <tr>
                <td><?=form_label('Nombre usuario :','user')?></td>
                <td><?=form_input($usuario)?></td>
            </tr>
            <tr>
                <td><?=form_label('Contraseña :','pass')?></td>
                <td><?=form_input($password)?></td>
            </tr>
        </table>
        <!--Opciones -->
        <br>
        <?=form_button($btn_ingreso,'Efectuar registro') ?>
        <br><br>
        <?=form_open('ingresar') ?>
		<?=form_submit('','Ingresar') ?>
		<?=form_close() ?>
        <br>
    </div>
</div>