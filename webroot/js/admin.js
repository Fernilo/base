if (typeof jQuery === "undefined") {
    throw new Error("necesita jQuery");
}

$.Admin = {};
$.Admin.opciones = {
    debug: true,
    izi: {
        timeout: 20000,
        position: 'topRight'
    }
};
if (typeof AdminOpciones !== "undefined") {
    $.extend(true, $.Admin.opciones, AdminOpciones);
}

// var o = $.Admin.opciones;

// Constructor
_iniciar();

// Ejecutar apenas inicia todo


// Ejecutar cuando todo este cargado
$(window).on("load", function () {

    "use strict";

    // Cargar aquí los métodos que quiere que carguen
    $.Admin.sidebar.iniciar();
    $.Admin.flash.iniciar();
    $.Admin.select2.iniciar();
    $.Admin.summernote.iniciar();
    $.Admin.flatpickr.iniciar(); //Fechas
    $.Admin.password.iniciar();

    

    /* Resalta de Rojo un error en input */
    if ($(".input").hasClass("error")) {
        $(".error").parent().parent().addClass('has-error');
        $(".error-message").css('color', '#dd4b39');
    }
});

// Ejecutar en cada scroll
$(document).on('scroll', function (e) {

});

// Ejecutar en resize
$(window).on('resize', function (e) {

});

// 
function _iniciar() {

    'use strict';

    /**
     * Mensajes FLASH
     * Método para manejar los mensajes
     * Cualquier duda ver la doc: https://izitoast.marcelodolza.com/
     */
    $.Admin.flash = {
        opciones: {
            timeout: 20000,
            position: 'topRight',
            message: ""
        },
        iniciar: function () {
            var _this = this;
        },
        info: function (msj) {
            var _this = this;
            if (msj) {
                _this.opciones.message = msj,
                iziToast.info(_this.opciones);
            }
        },
        error: function (msj) {
            var _this = this;
            if (msj) {
                _this.opciones.message = msj,
                iziToast.error(_this.opciones);
            }
        },
    };

    /**
     * Método para manejar los datetimepicker del desplegable
     */
    $.Admin.flatpickr = {
        opciones: {
            dateFormat: "d/m/Y",
            // locale: "es",  // TODO: VER SI SE PUEDE USAR DIRECTAMENTE ESTO
            locale: {
                firstDayOfWeek: 1,
                weekdays: {
                    shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],      
                }, 
                months: {
                    shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                    longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                },
            },
            // wrap: true, // Boton de agenda y de limpiar campo
            inline: false, // TRUE: Visualizar el calendario en un estado siempre abierto.
        },
        iniciar: function () {
            var _this =  this;

            if ($('.fechahora').length) {
                _this.opciones.dateFormat = "d-m-Y H:i";
                $('.fechahora').flatpickr(_this.opciones);
                /* .keydown(function (e) {
                    return false;
                }); */

            }

            if ($('.fechas').length) {
                _this.opciones.dateFormat = "d-m-Y";
                $('.fechas').flatpickr(_this.opciones);
                /* .keydown(function (e) {
                    return false;
                }); */
            }
            
            if ($('.horas').length) {
                _this.opciones.dateFormat = "H:i";
                _this.opciones.enableTime = true;
                _this.opciones.noCalendar = true;
                // _this.opciones.time_24hr = true; //Formato 24hs
                // _this.opciones.defaultDate = "13:45"; //Hora por defecto
                $('.horas').flatpickr(_this.opciones);
                /* .keydown(function (e) {
                    return false;
                }); */

            }
        },
        reiniciar: function () {
            if ($('[data-toggle="datetimepicker"]').length) {
                var _this = this;
                $('[data-toggle="datetimepicker"]').datetimepicker('destroy');

                _this.iniciar();
            }
        }
    };

    /**
     * SELECT2
     * Método para configurar el select2
     * Cualquier duda consultar la doc: https://select2.org/
     */
    $.Admin.select2 = {
        elementos: [],
        historico: false,
        opciones: {
            language: "es",
            placeholder: "",
            allowClear: true,
            dropdownParent: null,
            miembro_email: "",
        },
        iniciar: function () {
            var _this = this;

            if ($(".select2").length) {
                $('.select2').each(function (i, e) {
                    let elemJquery = $(e);
                    let opciones = Object.create(_this.opciones);
                    
                    if (elemJquery.hasClass('select2-usuarios')) {
                        var rol = elemJquery.data('rol');
                        opciones.ajax = {
                            url: HOST + "admin/api/getUsuarios",
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    rol: rol || '',
                                    search: params.term,
                                    page: params.page || 1,
                                };
                            },
                            processResults: function (data, params) {
                                params.page = params.page || 1;

                                return {
                                    results: data.items,
                                    pagination: {
                                        more: (params.page * 25) < data.total_count
                                    }
                                };
                            },
                            cache: true
                        };
                        opciones.escapeMarkup = function (markup) {
                            return markup;
                        };
                        opciones.minimumInputLength = 3;
                        opciones.templateResult = _this.formatResultado;
                        opciones.templateSelection = _this.formatResultadoSelection;
                    }

                    if (elemJquery.data('dropdownparent')) {
                        opciones.dropdownParent = $(elemJquery.data('dropdownparent'));
                    }
                    if (elemJquery.data('placeholder')) {
                        opciones.placeholder = elemJquery.data('placeholder');
                    }
                    _this.elementos.push(e);
                    elemJquery.select2(opciones);
                });

            }
        },
        reiniciar: function () {
            var _this = this;
            if ($(".select2").length) {
                _this.elementos.forEach(function (e) {
                    $(e).select2("destroy"),
                        $(e).val(null),
                         // $(e).select2(_this.opciones);
                        _this.iniciar();
                });
            }
         },
        formatResultadoSelection: function (resultado) {
            return resultado.text || "Selecciona una opción";
        },
        formatResultado: function (resultado) {
            if (resultado.loading) return resultado.text; //return "Buscando...";
            
            return '<span>' + resultado.text + '</span>';

            /* var render = '<div class="consulta" style="line-height: 2px;"><h4 style="font-size: 1rem;font-weight: 700;">' + resultado.text + '</h4>';
            render += "</div>";
            return render; */

        }
    };

    /* SUMMERNOTE - Editor de texto */
    $.Admin.summernote = {
        iniciar: function () {
            
            if ($(".summernote-disabled").length) {
                $('.summernote-disabled').summernote('disable');
            }
        }
    };

    $.Admin.sidebar = {
        iniciar: function () {
            var opciones = $.Admin.opciones;
            if(opciones.controlador){
                var opcion = $(".sidebar-menu").find("."+opciones.controlador);
                
                if (opcion.hasClass('dropdown')) {
                    opcion.addClass('active');
                    let item = opcion.find('.'+opciones.accion).addClass('active');
                }else{
                    opcion.addClass('active');
                }
            }
        }
    };

    $.Admin.password = {
        selector: $(".pwstrength"),
        iniciar: function () {
            var _this = this;

            if (_this.selector.length) {
                _this.selector.pwstrength({
                    texts: ['muy débil', 'débil', 'mediocre', 'fuerte', 'muy fuerte']
                });
            }
        }
    }
};

// Funcion para loguear
function _d(d, v) {
    if ($.Admin.opciones.debug) {
        m = d;
        if (v || v === 0 || v === false) {
            m = m + " : " + v;
        }
        console.log(m);
    }
}



function verImagen(url) {
    var w = window.open();
    w.document.open();
    w.document.write('<img src="' + url + '">');
    w.document.close();
    // w.onload = function() { w.print(); w.close(); };
}



function isEmpty(x) {
    if (!x) return true;
    if (x == null)  return true;
    if (x == undefined) return true;
    if (x === undefined) return true;
    if (typeof x == 'undefined') return true;
    if (x === '') return true;
    if (x === ' ') return true;
    if (x.length == 0)  return true;
    if (!x.length) return true;

    return false;
}


function validarForm(form) {
    if(form){
        for (var value of form) {
            let input = $(value);
            if (input.attr('required')) {
                if (!input.attr('disabled')) {
                    if (!input.val()) {
                        let title = input.attr('title');
                        $.Master.flash.error("Debe completar el campo "+title);
                        input.focus();
                        return false;
                    }
                }
            }
        }
        return true;
    }
    return false;
}