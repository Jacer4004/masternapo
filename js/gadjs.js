//jquery GADPNAPO Ing. Diego Rojas. jdieguito84@hotmail.com  0995828517

// 1. funcion que ejecuta la animacion del menu vertical en la pagina de inicio
 $(function() {
				$('#menulateral a').stop().animate({'marginLeft':'-115px'},1000);
			
				$('#menulateral > li').hover(
                    function () {
                        $('a',$(this)).stop().animate({'marginLeft':'-1px'},200);
                    },
                    function () {
                        $('a',$(this)).stop().animate({'marginLeft':'-115px'},200);
                    }
                );
            });
// fin 1.

//funcion de inicio para indicar que si esta trabajando la pagina
function procesando_ventan()
{
document.getElementById("procesando").style.display="inline";
}
//2. funcion para recuperar color y modulo abierto
function js_general(pag_mod,bg_color,expira)
{
	
	procesando_ventan();
	
	//var expirat=expira;
	//var tiempovida=new Date();
	
	//tiempovida.setTime(tiempovida.getTime()+(expirat*60*1000));
	
	//alert(tiempovida.setTime(tiempovida.getTime()+(expirat*60*1000)));
	
	
	//tiempovida.setTime(tiempovida.getTime()+(expirat*60*1000));
	//convertimos la fecha a formato UTC
	//var strExpiracion=tiempovida.toGMTString();
	
	//var strExpiracion=tiempovida;
	//alert(strExpiracion+"<<<"+tiempovida);
	
	
	if(bg_color!='')
	{
		//document.cookie="color_bg="+bg_color+';expires='+strExpiracion; original
		document.cookie="color_bg="+bg_color;
	}
	//document.cookie='mod='+pag_mod+';expires='+strExpiracion;orifinal
		document.cookie='mod='+pag_mod;
	
	
}
// fin 2.

//2. funcion para recuperar color y modulo abierto
function js_general_guardados(pag_mod,bg_color,expira)
{
	//var expirat=expira;
	//var tiempovida=new Date();
	//tiempovida.setTime(tiempovida.getTime()+(expirat*60*1000));
	//convertimos la fecha a formato UTC
	//var strExpiracion=tiempovida.toGMTString();
	
	if(bg_color!='')
	{
		//document.cookie="color_bg="+bg_color+';expires='+strExpiracion;
		document.cookie="color_bg="+bg_color+';expires=""';
		//document.cookie="color_bg="+bg_color;
	}
	//document.cookie='mod='+pag_mod+';expires='+strExpiracion;
	document.cookie='mod='+pag_mod+';expires=""';
	
	
}
// fin 2.
//3. hacer un fadeIn
function Entrada_con_fade_in(objeto,tiempo)
{
	document.getElementById(objeto).style.display='none';
	var objetoA="#"+objeto;
$(objetoA).fadeIn(tiempo);
}
// fin 3.
//4. hacer un fadeOut
function Entrada_con_fade_out(objetos,tiempos)
{
	var objetoB="#"+objetos;
$(objetoA).fadeOut(tiempos);
}
// fin 4.

// 5. funcion para buscar en una tabla#####################################

$(document).ready(function(){
	// ejecuta la funcion al  momento que alza la tecla
	$("#buscador").keyup(function(){
		// ejecuta cuando el valor no es vacio
		if( $(this).val() != "")
		{
			// oculta todo y muestra solo los resultados, oculta la inf. adicional
			$("#report tbody>tr").hide();
			$("#report td:contains-ci('" + $(this).val() + "')").parent("tr").show();
			$("#report tbody>#nobuscaraqui").hide();
		}
		else
		{
			// cuanto esta vacion la caja de buscar muestra todo menos la inf. adicional
			
			$("#report tbody>tr").show();
			$("#report tbody>#nobuscaraqui").hide();
		}
	});
});
// jQuery expresion de buscar
$.extend($.expr[":"], 
{
    "contains-ci": function(elem, i, match, array) 
	{
		return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
	}
});
//fin 5. 

//6. para mostrar los detalles de una fila de una tabla

$(document).ready(function(){
            $("#report tr:odd").addClass("odd");
            $("#report tr:not(.odd)").hide();
            $("#report tr:first-child").show();
            
            $("#report tr.odd").click(function(){
                $(this).next("tr").toggle();
                $(this).find(".arrow").toggleClass("up");
            });
            //$("#report").jExpand();
        });

////***********limpiar clase odd de la tabla dentro de tabla

		
function Refrescartabla()
{

            
            $("#report tr.odd").click(function(){
                $(this).next("tr").toggle();
                $(this).find(".arrow").toggleClass("up");
            });
			$("#report tr:odd").addClass("odd");
            $("#report tr:not(.odd)").hide();
            $("#report tr:first-child").show();
			
			$("#report tr.odd").click(function(){
                $(this).next("tr").toggle();
                $(this).find(".arrow").toggleClass("up");
            });
			
       //     $("#report").jExpand();
        
}
/// fin 6.

// 7. Funcion enviar formulario
function Enviar_fromulario(fomulario)
{
	var formul=formulario;
	document.formul.submit()
}

//8. funcion enviar post de un formulario 
function enviar_datos_no_usar(divmensaje,formulario,archivo){
var salida2='#'+divmensaje;
$(salida2).fadeIn(1500);

	var salida=document.getElementById(divmensaje),
	datos=new FormData(document.forms.namedItem(formulario));
	var enviar=new XMLHttpRequest();
	enviar.open("POST",archivo,true);
	enviar.onload=function(oevent){
		if(enviar.status==200){
			salida.innerHTML="datos guardados";
			}else{
				salida.innerHTML="error"+enviar.status+"ha ocurrido problemas.<br \/>";
				}
		};
	enviar.send(datos);
	
setTimeout(function(){
	$(salida2).fadeOut(1500);
	},3000);	
	}
	
//8. funcion para cerra o abrir elementos con desplazamiento
	function cerrar_abrir(cierra,abre)
{

	var objetoabre='#'+abre;
	var objetocierra='#'+cierra;
	
	$(objetocierra).slideUp();
	$(objetoabre).slideDown();
	

}

//9. FUNCION ENVIR DATOS POST CON AJAX
function enviar_datos(formulario,archivo,resultado) {
   
	var el_form="#"+formulario;
	var salida_mensaje="#"+resultado;
    $(el_form).validate({
        /*rules: {
            name: { required: true, minlength: 2},
            lastname: { required: true, minlength: 2},
            email: { required:true, email: true},
            phone: { minlength: 2, maxlength: 15},
            years: { required: true},
            //message: { required:true, minlength: 2}
        },
        messages: {
            name: '<span style="background:#FF0308; color:#FFFFFF; padding:4px">Debe introducir su nombre.</span>',
            lastname: "Debe introducir su apellido.",
            email : "Debe introducir un email válido.",
            phone : "El número de teléfono introducido no es correcto.",
            years : "Debe introducir solo números.",
           // message : "El campo Mensaje es obligatorio.",
        },*/
        submitHandler: function(form){
			var dataString= $(el_form).serialize();//recoge todo del fomulario			
            $.ajax({
                type: "POST",
                url:archivo,
                data: dataString,
                success: function(data){
                    $(salida_mensaje).html(data);
					$(salida_mensaje).fadeIn(1000);                   
					//cierra despues 3segundos
					setTimeout(function(){
					$(salida_mensaje).fadeOut(1500);
					},3000);
					//cierra
					//cerrar_abrir('nuevo','contenedor');
                },
				error: function() {
         		 alert(" ERROR \n Ha ocurrido un problema \n Comuniquese con el administrador del sistema");
				}
            });
        }
    });
}
////////////////

function enviar_datoss(formulario,archivo,resultado) {
     
	var el_form="#"+formulario;
	var salida_mensaje="#"+resultado;
	alert(el_form+"--"+archivo+"--"+salida_mensaje);
    $(el_form).validate({
        /*rules: {
            name: { required: true, minlength: 2},
            lastname: { required: true, minlength: 2},
            email: { required:true, email: true},
            phone: { minlength: 2, maxlength: 15},
            years: { required: true},
            //message: { required:true, minlength: 2}
        },
        messages: {
            name: '<span style="background:#FF0308; color:#FFFFFF; padding:4px">Debe introducir su nombre.</span>',
            lastname: "Debe introducir su apellido.",
            email : "Debe introducir un email válido.",
            phone : "El número de teléfono introducido no es correcto.",
            years : "Debe introducir solo números.",
           // message : "El campo Mensaje es obligatorio.",
        },*/
        submitHandler: function(form){
			var dataString= $(el_form).serialize();//recoge todo del fomulario			
            $.ajax({
                type: "POST",
                url:archivo,
                data: dataString,
                success: function(data){
                    $(salida_mensaje).html(data);
					$(salida_mensaje).fadeIn(1000);                   
					//cierra despues 3segundos
					/*setTimeout(function(){
					$(salida_mensaje).fadeOut(1500);
					},3000);*/
                }
				
            });
        }
    });
}

//10. funcion pasar valores a un objeto
function Pas_val(valor,objeto)
{
	document.getElementById(objeto).value=valor;	
}
//11 funcion para recargar compos con datos de una base de datos


//funcion que permite recargar combos

function cargarcombo(dato,archivo,selct)
{	
	
	//$("#cargando2").css("display", "inline");//para mostrar el loadin 
	var combo="#"+selct;
	$(combo).css("display", "none");//id del select
	$(combo).fadeOut(1000);
	//hasta aqui para mostrar el loading
	
	var variable_post=dato;
	$.post(archivo, { variable: variable_post }, function(data){
	$(combo).html(data);
	//cierra el loading despues de cargar 
	//$("#cargando2").css("display", "none");
	//$(combo).css("display", "inline");
	$(combo).fadeIn(1000);
	//$("#botonguardar").css("display", "inline");
	});			
}

/***********para limpiar un frmulario****/

function Reset_fomulario(elform)
{
document.getElementById(elform).reset();	

}

/**************************recargar un combo*******/
function Recargar_combo(combo,resultado)
{	
	var result="#"+resultado;
	var variable_post=combo;
	var archivo="combos/combos.combo.php";
	$.post(archivo, { variable: variable_post }, function(data){
	$(result).html(data);
	});			
}
////////////****funcion para ventanas emergentes**********///
////////////////***************++++++BUSCAR DENTRO DE UNA TABLA******//

$(document).ready(function(){
	// Write on keyup event of keyword input element
	$("#kwd_search").keyup(function(){
		// When value of the input is not blank
		if( $(this).val() != "")
		{
			// Show only matching TR, hide rest of them
			$("#my-table tbody>tr").hide();
			$("#my-table td:contains-ci('" + $(this).val() + "')").parent("tr").show();
		}
		else
		{
			// When there is no input or clean again, show everything back
			$("#my-table tbody>tr").show();
		}
	});
});
// jQuery expression for case-insensitive filter
$.extend($.expr[":"], 
{
    "contains-ci": function(elem, i, match, array) 
	{
		return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
	}
});

//////HASTA A QUI BUSCAR EN UNA TABLA**/
//QUITAR ESPACIOS EB UNA CADENA////
function Quitarespacios(valor_str)
{
	var textostr=document.getElementById(valor_str).value;
	miValor=textostr.replace( /\s/g, "");
	//alert(miValor);
	document.getElementById(valor_str).value=miValor;
	
}

//validar si es requerido o  no
function requerido_control(control,control2)
{
	if(document.getElementById(control).checked==true)
	{
		$(control2).removeAttr("required");
	}
	else
	{
		$(control2).attr("required", "");
	}
	
}

//PARA CARGAR UNA PAGINA SIN ENVIAR DATOS DE UN FORMULARIO 
function cargarContenido(pagina,mostrador)
{	
	//$("#mostrarcontenido").html('<img src="imag/iconoanime.png">');
	$(mostrador).html('<h4 align="center"><img src="imag/loader-orange.gif"></h4>');
	$(mostrador).load(pagina,{v11:'ejecutar', v2:'ok'}, 
	function(response, status, xhr) 
	{
		if (status == "error") 
		{
			var msg = '<h4 align="center"><img src="imag/loader-orange.gif"><br><strong>Error!: </strong>';
			
			$(mostrador).html(msg + xhr.status + " " + xhr.statusText+'</h4>');
		}
	});
}

function Actualizar_titulo(idtitulo,titulo)
{
	$(idtitulo).html(titulo);
}

//carga desde lectura para asignar el toogleclass y decirel seleccionado a los menus verticales de las ventanas internas
/*$( document ).ready(function() {
	
$( ".menuvertical> li a" ).click(function() {

    if ( $(this).hasClass('menuvertical_selecto') ) {
        $(this).removeClass('menuvertical_selecto');
		
    } else {
        $('.menuvertical>  li a.menuvertical_selecto').removeClass('menuvertical_selecto');
        $(this).addClass('menuvertical_selecto');    
    }
});
});*/

function cambiar_vetana(abrir,cerrar)
{
	$(cerrar).hide();
	$(abrir).fadeIn(500);

}

function cargardiv_form(pagina,mostrador,formulario)
{	
	
	var parametros = $(formulario).serialize()+ '&activate=true';/*{
                "nombres" : 'Juan',
                "apellidos" : 'Rojas'
        };*/
		 $.ajax({
                data:  parametros,
                url:   pagina,
                type:  'post',
				enctype:'multipart/form-data',
			
                beforeSend: function () {
						
                        //$(mostrador).html("Procesando, espere por favor...");
						$(mostrador).html('<h4 align="center"><img src="imag/loader-orange.gif"></h4>');
                },
                success:  function (response) {
					
                        $(mostrador).html(response);
                }
        });
		
		$(formulario)[0].reset();
}

//funcion que permite recargar combos
function cargar_general(datos,file,objet)
{	
	
	//$("#cargando2").css("display", "inline");//para mostrar el loadin 
	var obj="#"+objet;
	$(obj).html('<h4 align="center"><img src="imag/loader-orange.gif"></h4>');//id del select
	//hasta aqui para mostrar el loading
	
	var variable_post=datos;
	$.post(file, { variable: variable_post }, function(data){
	$(obj).html(data);
	//cierra el loading despues de cargar 
	//$("#cargando2").css("display", "none");
	//$(obj).css("display", "inline");
	//$("#botonguardar").css("display", "inline");
	});			
}

//SOLO NUMEROS Y BORRAR
function soloNumeros_punto(e,objinsertar)
{
var key = window.Event ? e.which : e.keyCode
return ((key >= 48 && key <= 57) || (key==8))
}

function soloNumerosm1(evt){

var nav4 = window.Event ? true : false;
// Backspace = 8, Enter = 13, ’0′ = 48, ’9′ = 57, ‘.’ = 46
var key = nav4 ? evt.which : evt.keyCode;
return (key <= 13 || (key >= 48 && key <= 57) );
}


//SOLO NUMEROS, puntodecima, dos decimales Y BORRAR
function soloNumeros(e,objinsertar)
{
   // capturamos la tecla pulsada
   var teclaPulsada=window.event ? window.event.keyCode:e.which;

   // capturamos el contenido del input
    var valor=document.getElementById(objinsertar).value;
        // 45 = tecla simbolo menos (-)
        // Si el usuario pulsa la tecla menos, y no se ha pulsado anteriormente
        // Modificamos el contenido del mismo añadiendo el simbolo menos al
        // inicio
    if(teclaPulsada==45 && valor.indexOf("-")==-1)
        {
         document.getElementById(objinsertar).value="-"+valor;
        }
        // 13 = tecla enter , 8 borrar, 0 direccionales
        // 46 = tecla punto (.)
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto

        if(teclaPulsada==8 || teclaPulsada==0|| (teclaPulsada==46 && valor.indexOf(".")==-1))
        {	 
            return true;
        }
        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
}

function dosdecimales(objvalidar)
{
	var num = $(objvalidar).val();
	var entero = new Number(num);
$(objvalidar).val(entero.toFixed(2));
}

function Abrir_ventana_reportes (paginas) {

var opcioness="resizable=yes,scrollbars=yes,status=no,toolbar=no,menubar=yes";


var ventana_reportes=window.open(paginas,"EMERGENTE_GAD_reportes",opcioness);
ventana_reportes.focus();

}


//VALIAR NUMERO DE CEDULA

function validar_cedula(ci,smserror)
{
    /**
     * Algoritmo para validar cedulas de Ecuador
     * @Author : Victor Diaz De La Gasca.
     * @Fecha  : Quito, 15 de Marzo del 2013 
     * @Email  : vicmandlagasca@gmail.com
     * @Pasos  del algoritmo
     * 1.- Se debe validar que tenga 10 numeros
     * 2.- Se extrae los dos primero digitos de la izquierda y compruebo que existan las regiones
     * 3.- Extraigo el ultimo digito de la cedula
     * 4.- Extraigo Todos los pares y los sumo
     * 5.- Extraigo Los impares los multiplico x 2 si el numero resultante es mayor a 9 le restamos 9 al resultante
     * 6.- Extraigo el primer Digito de la suma (sumaPares + sumaImpares)
     * 7.- Conseguimos la decena inmediata del digito extraido del paso 6 (digito + 1) * 10
     * 8.- restamos la decena inmediata - suma / si la suma nos resulta 10, el decimo digito es cero
     * 9.- Paso 9 Comparamos el digito resultante con el ultimo digito de la cedula si son iguales todo OK sino existe error.     
     */

     var cedulaci = $(ci).val();

     //Preguntamos si la cedula consta de 10 digitos
     if(cedulaci.length == 10){
        
        //Obtenemos el digito de la region que sonlos dos primeros digitos
        var digito_region = cedulaci.substring(0,2);
        
        //Pregunto si la region existe ecuador se divide en 24 regiones
        if( digito_region >= 1 && digito_region <=24 ){
          
          // Extraigo el ultimo digito
          var ultimo_digito   = cedulaci.substring(9,10);

          //Agrupo todos los pares y los sumo
          var pares = parseInt(cedulaci.substring(1,2)) + parseInt(cedulaci.substring(3,4)) + parseInt(cedulaci.substring(5,6)) + parseInt(cedulaci.substring(7,8));

          //Agrupo los impares, los multiplico por un factor de 2, si la resultante es > que 9 le restamos el 9 a la resultante
          var numero1 = cedulaci.substring(0,1);
          var numero1 = (numero1 * 2);
          if( numero1 > 9 ){ var numero1 = (numero1 - 9); }

          var numero3 = cedulaci.substring(2,3);
          var numero3 = (numero3 * 2);
          if( numero3 > 9 ){ var numero3 = (numero3 - 9); }

          var numero5 = cedulaci.substring(4,5);
          var numero5 = (numero5 * 2);
          if( numero5 > 9 ){ var numero5 = (numero5 - 9); }

          var numero7 = cedulaci.substring(6,7);
          var numero7 = (numero7 * 2);
          if( numero7 > 9 ){ var numero7 = (numero7 - 9); }

          var numero9 = cedulaci.substring(8,9);
          var numero9 = (numero9 * 2);
          if( numero9 > 9 ){ var numero9 = (numero9 - 9); }

          var impares = numero1 + numero3 + numero5 + numero7 + numero9;

          //Suma total
          var suma_total = (pares + impares);

          //extraemos el primero digito
          var primer_digito_suma = String(suma_total).substring(0,1);

          //Obtenemos la decena inmediata
          var decena = (parseInt(primer_digito_suma) + 1)  * 10;

          //Obtenemos la resta de la decena inmediata - la suma_total esto nos da el digito validador
          var digito_validador = decena - suma_total;

          //Si el digito validador es = a 10 toma el valor de 0
          if(digito_validador == 10)
            var digito_validador = 0;

          //Validamos que el digito validador sea igual al de la cedula
          if(digito_validador == ultimo_digito){
            //alert('la cedula:' + cedulaci + ' es correcta');
			$(ci).removeClass("error")
			$(smserror).fadeOut(1000);
          }else{
			  //document.getElementById('cedula').focus();
            //alert('La cédula:' + cedulaci + ' es incorrecta');
			//$('#cedula').focus();
			//document.getElementById(
			//document.getElementById('cedula').focus();
			$(smserror).html("Error: Cédula no existe"); 
			$(smserror).fadeIn(1000);
			
			$(ci).addClass("error");
			
          }
          
        }else{
          // imprimimos en consola si la region no pertenece
         // alert('Esta cédula no pertenece a ninguna provincia');
		  $(ci).addClass("error");
		  $(smserror).html("Error: Cédula no pertenece a ninguna provincia");
		  $(smserror).fadeIn(1000);
		  
		  
        }
     }else{
        //imprimimos en consola si la cedula tiene mas o menos de 10 digitos
        //alert('El número de cédula está incompleto o mal escrito');
		$(ci).addClass("error");
		$(smserror).html("Error: Cédula incompleta");
		$(smserror).fadeIn(1000);
		
     }    
  
}