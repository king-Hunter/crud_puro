$(document).ready(function(){

    $('body').on('click','#cargar_tablero_trabajadores',function(){
        Trabajadores.buscar_tablero();
    });

    $('body').on('click','#boton_nuevo_trabajador',function(){
        Trabajadores.formulario_trabajador_nuevo();
    });

    $('body').on('click','.boton_modificar_trabajador',function () {
        var idTrabajador = $(this).data('id_trabajador');
        Trabajadores.formulario_trabajador_editar(idTrabajador);
    });

    $('body').on('click','#boton_nuevo_telefono',function(){
        Trabajadores.obtener_row_telefono();
    });

    $(document).on('click','.boton_eliminar_trabajador',function(){
        var id_trabajador = $(this).data('id_trabajador');
        var confirmacion = confirm('¿Estas seguro de eliminar al trabajador?');
        if(confirmacion){
            Trabajadores.eliminar_trabajador(id_trabajador);
        }
    });

    $('body').on('click','.boton_eliminar_tel',function(){
        var boton = $(this);
        if($(this).closest('tr').find('.input_id_telefono_empleado').val() != ''){
            Trabajadores.eliminar_telefono_trabajador(boton);
        }else{
            boton.closest('tr').remove();
        }
    });

    $(document).on('click','#boton_guardar_trabajador',function(){
        //validar el formulario
        var validacion = Trabajadores.validar_form_trabajador();
        $('#msg_validacion_form').fadeOut();
        if(validacion.is_valid){
            //guarado de datos hacia la rut/controlador
            Trabajadores.guardar();
        }else{
            //mostrar mensajes hacia el usuario
            $('#msg_validacion_form').html(validacion.msg)
            $('#msg_validacion_form').fadeIn();
        }
    });
    
    $(document).on('click','#buscar_trabajador',function(){
        //validar el formulario
        var buscar = document.getElementById("input_buscar").value;
        console.log(buscar);
        $('#contenedor_mensajes').fadeOut();
        console.log("entro aqui");
        if($('#input_buscar').val() != ''){
            Trabajadores.buscar_empleado(buscar);
        }else{
            //mostrar mensajes hacia el usuario
            $('#contenedor_mensajes').html('<h6 style="padding-top: 10px;">Tu busqueda no es valida</h6> ')
            $('#contenedor_mensajes').fadeIn();
            setTimeout(function(){ $('#contenedor_mensajes').fadeOut(); }, 1000);
        }
    });
    
    Trabajadores.buscar_tablero();

});

var Trabajadores = {

    buscar_empleado : function(buscar){
        $.ajax({
            type : 'POST', //tipo de peticion
            url : 'routes/buscar_empleado.php', //direccion de la peticion url
            data : {
                buscar : buscar
            }, //paramentros a enviar por la peticion
            dataType : 'html',
            success : function(respuestaAjax){
                $('#contenedor_trabajadores').html(respuestaAjax);
                console.log(respuestaAjax);
            },
            error : function(err){
                alert('hubo un error en la petición');
                alert(err.status);
            }
        });
    },
    
    buscar_tablero : function(){
        $('#contenedor_trabajadores').html('<div class="spinner-border" role="status">\n' +
            '  <span class="visually-hidden">Loading...</span>\n' +
            '</div>');
        $.ajax({
            type : 'POST', //tipo de peticion
            url : 'routes/tablero.php', //direccion de la peticion url
            data : {}, //paramentros a enviar por la peticion
            dataType : 'html',
            success : function(respuestaAjax){
                $('#contenedor_trabajadores').html(respuestaAjax);
            },
            error : function(err){
                alert('hubo un error en la peticion');
                alert(err.status);
            }
        });
    },

    formulario_trabajador_nuevo : function(){
        $.ajax({
            type : 'POST', //tipo de peticion
            url : 'routes/nuevo_trabajador.php', //direccion de la peticion url
            data : {}, //paramentros a enviar por la peticion
            dataType : 'html',
            success : function(respuestaAjax){
                $('#contenedor_form_trabajadores').html(respuestaAjax);
                $('#form_trabajador').modal('show');
            },
            error : function(err){
                alert('hubo un error en la petición');
                alert(err.status);
            }
        });
    },

    formulario_trabajador_editar : function(idTrabajador){
        $.ajax({
            type : 'POST', //tipo de peticion
            url : 'routes/editar_trabajador.php', //direccion de la peticion url
            data : {
                id_trabajador : idTrabajador
            }, //paramentros a enviar por la peticion
            dataType : 'html',
            success : function(respuestaAjax){
                $('#contenedor_form_trabajadores').html(respuestaAjax);
                $('#form_trabajador').modal('show');
            },
            error : function(err){
                alert('hubo un error en la petición');
                alert(err.status);
            }
        });
    },

    obtener_row_telefono : function(){
        $.ajax({
            type : 'POST',
            url : 'routes/obtener_row_telefono.php',
            data : {},
            dataType : 'html',
            success : function(respuestaAjax){
                $('#tbody_rows_telefono').append(respuestaAjax);
            },
            error : function (err) {
                alert('error al obtener el row de telefono');
            }
        });
    },

    validar_form_trabajador : function () {
        var validacion = {
            is_valid : true,
            msg : ''
        };
        //nombre
        if($('#input_nombre').val() == ''){
            validacion.is_valid = false;
            validacion.msg += '<li>El nombre es requerido</li>';
        }
        //nombre
        if($('#input_apellido_paterno').val() == ''){
            validacion.is_valid = false;
            validacion.msg += '<li>El apellido paterno es requerido</li>';
        }
        //materno
        if($('#input_apellido_materno').val() == ''){
            validacion.is_valid = false;
            validacion.msg += '<li>El apellido materno es requerido</li>';
        }
        //correo
        if($('#input_correo').val() == ''){
            validacion.is_valid = false;
            validacion.msg += '<li>El correo es requerido</li>';
        }
        //fecha de nacimiento
        if($('#input_fecha_nacimiento').val() == ''){
            validacion.is_valid = false;
            validacion.msg += '<li>La fecha de nacimiento es requerida</li>';
        }
        //telefono(s)
        if($('#tbody_rows_telefono').find('tr').length == 0){
            validacion.is_valid = false;
            validacion.msg += '<li>Se requiere por lo menos un numero de telefono</li>';
        }else{
            //validar que existan datos en los rows de telefono
            $('#tbody_rows_telefono').find('tr').each(function(index, row){
                var value_slt_tipo_tel = $(this).find('.input_slt_tipo_telefono').val();
                var value_tel = $(this).find('.input_numero_telefono').val();
                if(value_slt_tipo_tel == ''){
                    validacion.is_valid = false;
                    validacion.msg += '<li>El tipo de telefono es requerido</li>';
                }if(value_tel == ''){
                    validacion.is_valid = false;
                    validacion.msg += '<li>El numero de telefono es requerido</li>';
                }
            });
        }
        return validacion;
    },

    guardar : function(){
        var formulario = {};
        var telefonos = {};
        $('#tbody_rows_telefono').find('tr').each(function (index) {
            var registro = {
                id_telefono_empleado : $(this).find('.input_id_telefono_empleado').val(),
                id_catalogo_telefono : $(this).find('.input_slt_tipo_telefono').val(),
                telefono : $(this).find('.input_numero_telefono').val(),
            }
            telefonos[index] = registro;
        });
        formulario = {
            id_empleado : $('#input_id').val(),
            nombre : $('#input_nombre').val(),
            paterno : $('#input_apellido_paterno').val(),
            materno : $('#input_apellido_materno').val(),
            correo : $('#input_correo').val(),
            nacimiento : $('#input_fecha_nacimiento').val(),
            telefonos : telefonos,
        };
        $.ajax({
            type : 'post',
            url : 'routes/guardar_trabajador.php',
            data : formulario,
            dataType : 'json',
            success : function(responseAjax){
                if(responseAjax.success){
                    $('#form_trabajador').modal('hide');
                    $('#contenedor_mensajes').html(responseAjax.msg);
                    Trabajadores.buscar_tablero();
                    $('#contenedor_mensajes').fadeIn();
                    setTimeout(function(){
                        $('#contenedor_mensajes').fadeOut();
                    },3000);
                }else{
                    $('#msg_validacion_form').html(responseAjax.msg);
                }
            },error : function (err) {
                alert('hubo un error en el guardar');
            }
        });
    },

    eliminar_telefono_trabajador : function(boton){
        var id_telefono_empleado = boton.closest('tr').find('.input_id_telefono_empleado').val();
        $.ajax({
            type : 'post',
            url : 'routes/eliminar_telefono_trabajador.php',
            data : {id_telefono_trabajador : id_telefono_empleado},
            dataType : 'json',
            success : function(responseAjax){
                if(responseAjax.success){
                    boton.closest('tr').remove();
                }
            },error : function (err) {
                alert('No pude eliminar el telefono del trabajador');
            }
        });
    },

    eliminar_trabajador : function(id_trabajador){
        $.ajax({
            type : 'post',
            url : 'routes/eliminar_trabajador.php',
            data : {id_trabajador : id_trabajador},
            dataType : 'json',
            success : function(responseAjax){
                if(responseAjax.success){
                    Trabajadores.buscar_tablero();
                }
                $('#contenedor_mensajes').html(responseAjax.msg);
                $('#contenedor_mensajes').fadeIn();
                setTimeout(function () {
                    $('#contenedor_mensajes').fadeOut();
                },3000);
            },error : function(err){
                alert('No se pudo eliminar el trabajador');
            }
        });
    }

};