/*Sección de validadores*/
var validador = function() 
{
    _revisaEmail = function(email)
    {
        //Variable regex permitirá almacenar criterio de validación: nombre1@ejemplo.com.
        var regex = /^([a-zA-Z])([a-zA-Z0-9_.-])+\@(([a-zA-Z0-9\-])+([\.]){1})([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email) ? true : false;
    };
    this.revisaEmail = function(mail)
    {
        return _revisaEmail(mail);
    };

    _revisaUser = function(user)
    {
        //Consultar si el caracter tiene dígitos
        var regex_num = /\d+/;
        //Consultar si el caracter tiene letras
        var regex_txt= /([a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ])+/;
        if(user.search(regex_num) == -1 || user.search(regex_txt) == -1)
        {
            alert("Alias del usuario debe poseer al menos, una letra y/o un número. Vuelva a ingresar.")
            return false;
        }
        //Consulta si la cadena posee al menos, 5 líneas de extensión
        if(user.length<=5)
        {
            alert("Alias del usuario debe poseer más de 5 caracteres. Número y letras obligatorio.")
            return false;
        }
        //Caso de éxito retornará un verdadero...
        return true;
    };
    this.revisaUser = function(usuario)
    {
        return _revisaUser(usuario);
    };

    _revisaNombreApellido = function(nombre)
    {
        //Variable regex permitirá almacenar criterio de validación: Hola Mundo.
        var regex = /^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+[\ ]{1}([a-zA-ZñÑáéíóúÁÉÍÓÚ])+/;
        return regex.test(nombre) ? true : false;
    };
    this.revisaNombreApellido = function(u)
    {
        return _revisaNombreApellido(u);
    };

    _revisaPassword = function(pw)
    {
        //Consultar si el caracter tiene dígitos
        var regex_num = /\d+/;
        //Consultar si el caracter tiene letras
        var regex_txt= /([a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ])+/;
        if(pw.search(regex_num) == -1 || pw.search(regex_txt) == -1)
        {
            alert("Contraseña debe poseer al menos, una letra y/o un número. Vuelva a ingresar.")
            return false;
        }
        //Consulta si la cadena posee al menos, 5 líneas de extensión
        if(pw.length<=5)
        {
            alert("Contraseña debe poseer más de 5 caracteres. Número y letras obligatorio.")
            return false;
        }
        //Caso de éxito retornará un verdadero...
        return true;
    };
    this.revisaPassword = function(pass)
    {
        return _revisaPassword(pass);
    };

    _formularioCompleto = function(matriz) 
    {
        var respuesta = true;
        matriz.forEach(function(element) {
            if(element == '') 
            {
                respuesta = false;
                return respuesta;
            }
        });
        return respuesta;
    };
    this.formularioCompleto = function(arreglo)
    {
        return _formularioCompleto(arreglo);
    }
};

/*Código del callback*/
registro_callback = function(res) {
    //Respuesta recibida como json de antemano
    switch(res.respuesta)
    {
        case 0:
            alert('Registro efectuado');
            break;
        case 1:
            alert('Usuario en uso. No se ha efectuado el registro');
            break;
        case 2:
            alert('Correo electrónico en uso. No se ha efectuado el registro');
            break;
        case 3:
            alert('Error en base de datos, favor reintentar');
            break;
        case 4:
            alert('Complete todos los datos del formulario');
            break;
        default:
            alert('Desconocido');
            break;
    }
};

$(document).on('click','#btnIngresar',function() {
    //Capturando valores
    var nombre = $('#nombre').val();
    var email = $('#email').val();
    var usuario = $('#user').val();
    var pass = $('#pass').val();
    var array = [nombre,email,usuario,pass];
    //Validando cosas
    var valida = new validador;
    if(!valida.formularioCompleto(array))
        alert('Complete todos los campos del formulario');
    else if(!valida.revisaNombreApellido(nombre))
        alert('El nombre debe poseer nombre y apellido');
    else if(!valida.revisaEmail(email))
        alert('Ingrese un correo válido');
    else if(!valida.revisaUser(usuario))
        ;
    else if(!valida.revisaPassword(pass))
        ;
    else
    {
        //La base de la url:
        var base_url = $('input:hidden[name="url_base"]').val();
        //Empaquetando params:
        params =    {'nombre': nombre,
                    'email'  : email,
                    'usuario':usuario,
                    'password':pass};
        method = 'POST';
        url    = base_url+'index.php/login/registro';
        ajaxCallbackJQuery(params, url, method, registro_callback);
    }
});