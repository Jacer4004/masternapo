
<?php 
# Cargamos la librería dompdf.
require_once 'dompdf_config.inc.php';
 
# Contenido HTML del documento que queremos generar en PDF.
$html='
<html>
<head>
  <style>
  body{text-align:justify}
    @page { margin: 236px 177px 236px 236px}
    #header { position: fixed; left: 0px; top: -230px; right: 0px; height: 200px;  border-bottom:4px solid red; text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -116px; right: 0px; height: 116px; background-color: lightblue; }
    #footer .page:after { content: counter(page, upper-number); }
  </style>
<body>
  <div id="header"><br>

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10"><img src="plantillas/logo.png"></td>
    <td><h3 align="center" style="margin:0px; padding:0px;">GOBIERNO AUTÓNOMO DESCENTRAIZADO</h3>
	<h2 align="center" style="margin:0px; padding:0px;"> PROVINCIAL DE NAPO</h2></td>
    
  </tr>
</table>
  
  </div>
  <div id="footer">
    <p class="page">Página </p>
  </div>
 
    <div id="demo-top-bar">

  <div id="demo-bar-inside">

    <h2 id="demo-bar-badge">
      <a href="/">CSS-Tricks Example</a>
    </h2>

    <div id="demo-bar-buttons">
          </div>

  </div>

</div>
	<div id="page-wrap">

		<h1 id="top">Smooth Page Scrolling</h1>

		<ul>
		  <li><a href="/examples/SmoothPageScroll/#two">Scroll to Section Two</a></li>
		  <li><a href="#three">Scroll to Section Three</a></li>
		</ul>

		<h1 id="one">Section One</h1>

		<p align="justify">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

		<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

		<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

		<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

        <h1 id="two">Section Two</h1>

        <p><a href="#top">Top</a></p>

        <p>quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

        <h1 id="three">Section Three</h1>

        <p><a href="#top">Top</a></p>

        <p>quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

        <p>quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>

        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>
		
<table width="99%" border="1" rules="all" style="font-size:12px">
  <tr>
    <td>#</td>
    <td>N°- INCIDENCIA</td>
    <td>CATEGORIA</td>
    <td>FECHA INICIO<br>
      FECHA FINALIZACIÓN</td>
    <td>REQUIRIENTE</td>
    <td>REQUERIMIENTO</td>
    <td>SOLUCIÓN</td>
    <td>ATENCIÓN</td>
    <td>IP-DONDE SOLICITA</td>
    <td>ESTADO</td>
    <td>PRIORIDAD</td>
    <td>OTROS DATOS</td>
    <td>TIEMPOS</td>
    <td>USUARIO&nbsp; CREA</td>
  </tr>
    <tr>
    <td>1</td>
    <td>SGT-2016-1</td>
    <td>Sistema QUIPUX</td>
    <td>2016-03-16 10:47:57<br>2016-03-16 10:51:06</td>
    <td>Lcda. Rosa Nelly Yumbo Chimbo;1500468150;SUBDIRECCIÓN DE TALENTO HUMANO</td>
    <td>Solicita compartir la bandeja de entrada del usuario Quipux de su Jefe inmediato superior.</td>
    <td>Se procedió a compartir la bandeja en el sistema quipux. 
Peticion realizada mediante CHAT. Se procede ya que es Asistente.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>192.168.101.1;172.16.1.161;192.168.56.1</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td>Petición realizada mediante CHAT. Se procede ya que es Asistente. </td>
    <td>
    3 Minutos<br>9 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>2</td>
    <td>SGT-2016-3</td>
    <td>Impresión de Datos</td>
    <td>2016-03-18 15:26:45<br>2016-03-18 15:44:17</td>
    <td>Sra. Graciela del Socorro Acosta Casino;0601314800;DIRECCIÓN DE OBRAS PUBLICAS</td>
    <td>Solicita se revise la confirugación predetermianda de papel ya que cada que tiene que imprimir debe estar configurando la impresi?n. </td>
    <td>Se procedió a configurar opciones predeterminadas de la impresora. </td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>192.168.101.1;172.16.1.161;192.168.56.1</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    17 Minutos<br>32 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>3</td>
    <td>SGT-2016-63</td>
    <td>Sistema QUIPUX</td>
    <td>2016-03-28 09:07:13<br>2016-03-28 09:49:47</td>
    <td>Sra. Claudia Fernanda Moscoso Castillo;1500578404;DIRECCIÓN DE SECRETARIA GADPN</td>
    <td>Solicita Modificar el nombre de la ciudad de San Francisco de Borja por Borja, pore el motivo que se extiende mucho al momento de ingresar. </td>
    <td>Se procedió a actualizar direcctamene en la base de datos la ciudad correspondiente de acuedo a lo solicitado.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>172.16.1.138</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    42 Minutos<br>34 Segundos    </td>
    <td>89</td>
  </tr>
    <tr>
    <td>4</td>
    <td>SGT-2016-65</td>
    <td>Comunicación Interna</td>
    <td>2016-03-28 09:49:49<br>2016-03-28 09:54:37</td>
    <td>Sr. Juan Gabriel Criollo Hidalgo;1501035073;SUBDIRECCIÓN DE COMUNICACIÓN INSTITUCIONAL</td>
    <td>El usuario no ingresa al Chat Interno Spark</td>
    <td>Se procedio a la revisión y se reseteó la contraseña </td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>172.16.1.161;192.168.56.1</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    4 Minutos<br>48 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>5</td>
    <td>SGT-2016-69</td>
    <td>Sistema QUIPUX</td>
    <td>2016-03-28 11:33:59<br>2016-03-28 11:36:00</td>
    <td>M.Sc. Cesar Manuel Ochoa Bolaños;1500372618;DIRECCIÓN DE PLANIFICACIÓN</td>
    <td>El usuario reporta que no puede acceder a la cuenta de quipux</td>
    <td>Seprocedió al reseteo de contraseña</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>172.16.1.161</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    2 Minutos<br>1 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>6</td>
    <td>SGT-2016-70</td>
    <td>Sistema QUIPUX</td>
    <td>2016-03-28 11:35:59<br>2016-03-28 12:24:00</td>
    <td>Dra. Danny Julissa Rivera Armijos;1709585622;UNIDAD DISPENSARIO MÉDICO</td>
    <td>El usuario reporta que no puede acceder a la cuenta de Quipux</td>
    <td>Seprocedió al reseteo de contraseña</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>172.16.1.161</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    48 Minutos<br>1 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>7</td>
    <td>SGT-2016-73</td>
    <td>Sistema QUIPUX</td>
    <td>2016-03-28 16:12:46<br>2016-03-30 08:13:26</td>
    <td>Servidor Linux para Sistema Quipux</td>
    <td>Instalación de servicio de red, Apache, Postgres,PHP y Mysql, para el servidor Quipux </td>
    <td>Se procedió a la isntalación de los requerimientos necesarios para la migracion del sistema quipux y sus aplicaciones</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td></td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    1 Días<br>16 horas<br>40 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>8</td>
    <td>SGT-2016-75</td>
    <td>Software (Otros)</td>
    <td>2016-03-28 16:58:53<br>2016-03-28 17:10:33</td>
    <td>CONFIGURACION SERVIDOR LINUX</td>
    <td>Se requiere configurar el servidor de Aplicaicones Linux para establecer por defecto el UTF-8 para que acepte tíldes y eñes por defecto </td>
    <td>Se procede a configura el archivo php.ini (default_char set  y httpd.conf (  se recomienda para forzar a codificar en el codico php usar  utf8_encode(variables). </td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td></td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td>La configuración se hace para el módulo del helpdesk ya que las tíldes no estaban codificandose.</td>
    <td>
    11 Minutos<br>40 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>9</td>
    <td>SGT-2016-78</td>
    <td>Sistema QUIPUX</td>
    <td>2016-03-29 08:33:33<br>2016-03-29 09:25:41</td>
    <td>Acceso al Sistema Quipux</td>
    <td>Los usuario no pueden Acceder al sistema Quipux</td>
    <td>Se detecto que el servico httpd estuvo detenido y pricedió a resetear el servido httpd del servidor</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td></td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    52 Minutos<br>8 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>10</td>
    <td>SGT-2016-87</td>
    <td>Fulltime</td>
    <td>2016-03-30 08:23:01<br>2016-03-30 17:19:42</td>
    <td>Ing. Rosa Natalia Grefa Aguinda;1500472046;SUBDIRECCIÓN DE GESTIÓN TECNOLÓGICA</td>
    <td>Modificación de los logos de Fulltime por los logos del GADPNAPO.</td>
    <td>Se procedió con lo solicitado.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td></td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    8 horas<br>56 Minutos<br>41 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>11</td>
    <td>SGT-2016-98</td>
    <td>Ofimática General</td>
    <td>2016-03-31 11:20:56<br>2016-03-31 11:53:24</td>
    <td>Tlga. Jenny Aurora Grefa Chimbo;1500128531;SUBDIRECCIÓN DE TALENTO HUMANO</td>
    <td>Requiere calcular años de servicio de los servidores públicos, se envia archivo en excel para colocar la fómula.</td>
    <td>Se procedió a colocar la fórmula en excel para que calcule los años, meses y días de servicio del funcionario de acuerdo a la fecha atual.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td></td>
    <td>FINALIZADO</td>
    <td>Alta</td>
    <td></td>
    <td>
    32 Minutos<br>28 Segundos    </td>
    <td>164</td>
  </tr>
    <tr>
    <td>12</td>
    <td>SGT-2016-99</td>
    <td>Sistema QUIPUX</td>
    <td>2016-03-31 11:23:00<br>2016-03-31 11:49:37</td>
    <td>Usuario Externo - Quipux</td>
    <td>Solicito el cambio de correo a : maferonatepaz@gmail.com    del usuario 1750304782 en el quipux 

</td>
    <td>Se procedió con la actualización del correo Electróico.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td></td>
    <td>FINALIZADO</td>
    <td>Alta</td>
    <td></td>
    <td>
    26 Minutos<br>37 Segundos    </td>
    <td>164</td>
  </tr>
    <tr>
    <td>13</td>
    <td>SGT-2016-100</td>
    <td>Comunicación Interna</td>
    <td>2016-03-31 11:31:06<br>2016-03-31 11:52:10</td>
    <td>Ing. José Ignacio Lobato Quiroz;0400900445;SUBDIRECCIÓN DE FISCALIZACIÓN</td>
    <td>EL usuario reporta que no puede ingresar al correo institucional (jlobato@napo.gob.ec) por olvido de Contraseña, Solicita se resetee la contraseña.</td>
    <td>Se procedió con el reseteo de la contraseña.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td></td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    21 Minutos<br>4 Segundos    </td>
    <td>203</td>
  </tr>
    <tr>
    <td>14</td>
    <td>SGT-2016-125</td>
    <td>Sistema QUIPUX</td>
    <td>2016-04-4 15:56:45<br>2016-04-4 16:30:13</td>
    <td>Ing. Angle Chela;Santodomingo de los Tsachilas</td>
    <td>Solicita asistencia técnica para utilización de los documentos externos o ciudadanos</td>
    <td>Se dió asistencia técnica con respecto a la generación de ticket al documento del ciudadano en el sistema documental quipux.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td></td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    33 Minutos<br>28 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>'.'
    <td>15</td>
    <td>SGT-2016-129</td>
    <td>Sistema QUIPUX</td>
    <td>2016-04-5 09:15:31<br>2016-04-5 09:30:15</td>
    <td>Ing. Marcelina Margarita Andy López;1500437015;SUBDIRECCIÓN DE PARTICIPACIÓN CIUDADANA</td>
    <td>El usuario reporta que no puede visualizar los documentos pdf en el Sistema Quipux</td>
    <td>Se procedió a dar asistencia via telefónica, para que el usuario active el plugin de adobe y pueda visualizar los documentos pdf generados en el quipux.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td></td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    14 Minutos<br>44 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>16</td>
    <td>SGT-2016-152</td>
    <td>Ofimática General</td>
    <td>2016-04-6 16:31:50<br>2016-04-6 20:40:39</td>
    <td>Lcda. Linda Karina Paredes Ron;1500569288;SUBDIRECCIÓN DE COMPRAS PÚBLICAS</td>
    <td>El usuario menciona que no puede guardar un documento creado en MSWord 2007.</td>
    <td>Se procedió a cerrar el programa word eliminando el proceso y se recuperó el documento, ya que el programa se encontraba bloqueado.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>172.16.1.161</td>
    <td>FINALIZADO</td>
    <td>Alta</td>
    <td></td>
    <td>
    4 horas<br>8 Minutos<br>49 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>17</td>
    <td>SGT-2016-155</td>
    <td>Sistema QUIPUX</td>
    <td>2016-04-8 16:01:59<br>2016-04-8 17:11:31</td>
    <td>Ing. Edwin Vladimir Torres</td>
    <td>Solicita reuperación contraseña de quipux y correo.</td>
    <td>se procedió a entregar contraseñas generando mediante código sql</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>172.16.1.161</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    1 horas<br>9 Minutos<br>32 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>18</td>
    <td>SGT-2016-156</td>
    <td>Comunicación Interna</td>
    <td>2016-04-11 08:49:15<br>2016-04-11 09:02:16</td>
    <td>Lcdo. Pablo Samuel Torres Villamagua;1900279637;SUBDIRECCIÓN DE TALENTO HUMANO</td>
    <td>Solicita se le resetee la contraseña del correo isnitucional ptorres@napo.gob.ec ya que se olvido.</td>
    <td>Se procedio a verificar los datos del usuario y se reseteó la contraseña.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>172.16.1.161</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    13 Minutos<br>1 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>19</td>
    <td>SGT-2016-157</td>
    <td>Comunicación Interna</td>
    <td>2016-04-11 09:18:52<br>2016-04-11 09:28:25</td>
    <td>Ing. Fresia Priscila Robalino Diaz;1500545940;SUBDIRECCIÓN DE MANTENIMIENTO, TRANSPORTE Y MAQUINARIA</td>
    <td>El usuario solicita usaurio y contraseña del spark.</td>
    <td>Se procedió dar a conocer el usuario y contraseña correspondiente del sistema spark al usuario.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>192.168.101.1;172.16.1.161;192.168.56.1</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    9 Minutos<br>33 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>20</td>
    <td>SGT-2016-172</td>
    <td>Sistema QUIPUX</td>
    <td>2016-04-12 10:28:15<br>2016-04-12 10:31:47</td>
    <td>Ing. Wider Luciano Frias Cordova;1801453075;SUBDIRECCIÓN DE FISCALIZACIÓN</td>
    <td>Solicita Asitencia sobre corrección de documento en el Sistema Quipux</td>
    <td>Se le dió a conocer el procedimiento correspondiente</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>192.168.101.1;172.16.1.161;192.168.56.1</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    3 Minutos<br>32 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>21</td>
    <td>SGT-2016-183</td>
    <td>Software (Otros)</td>
    <td>2016-04-14 09:59:31<br>2016-04-14 10:02:41</td>
    <td>REUNION PARA EL EVENTO DEL FLISOL</td>
    <td>Reunión de organización de temas para el evento de flisol</td>
    <td>Se participó en la reunión. </td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>192.168.101.1;172.16.1.161;192.168.56.1</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    3 Minutos<br>10 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>22</td>
    <td>SGT-2016-184</td>
    <td>Sistema QUIPUX</td>
    <td>2016-04-14 10:05:18<br>2016-05-9 11:31:05</td>
    <td>Ing. Juan Diego Rojas Escandón;1500743727;SUBDIRECCIÓN DE GESTIÓN TECNOLÓGICA</td>
    <td>Solicito para el Evento del FLISOL:
1 Mesa
1 Proyector o TV
2 Sillas
Conexión Eléctrica
Conexión a Internet.</td>
    <td>Se participo en el event con lo solicitado</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>192.168.101.1;172.16.1.161;192.168.56.1</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    25 Días<br>1 horas<br>25 Minutos<br>47 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>23</td>
    <td>SGT-2016-185</td>
    <td>Sistema Olympo</td>
    <td>2016-04-14 11:20:50<br>2016-04-14 11:48:58</td>
    <td>Instalacion de logmein</td>
    <td>Intalación de logmein para adminsitración remota con la empresa de Olympo.</td>
    <td>Seinstaló el logmein en los dos servidores</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>172.16.1.161;192.168.56.1</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    28 Minutos<br>8 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>24</td>
    <td>SGT-2016-198</td>
    <td>Sistema QUIPUX</td>
    <td>2016-04-18 08:30:15<br>2016-04-18 09:03:45</td>
    <td>Ing. Juan Pablo Ramirez Ocaña;1500576408;DIRECCIÓN ADMINISTRATIVA</td>
    <td>El usuario solicitó recuperar contraseña de Quipux y no llegó el link al correo.</td>
    <td>Se procedió a restaurar la contraseña manualmente desde la base de datos.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>192.168.101.1;172.16.1.161;192.168.56.1</td>
    <td>FINALIZADO</td>
    <td>Alta</td>
    <td></td>
    <td>
    33 Minutos<br>30 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>25</td>
    <td>SGT-2016-207</td>
    <td>Sistema QUIPUX</td>
    <td>2016-04-20 12:16:24<br>2016-04-26 16:04:40</td>
    <td>Lcdo. Pablo Samuel Torres Villamagua;1900279637;SUBDIRECCIÓN DE TALENTO HUMANO</td>
    <td>Los usuarios no pueden recuperar las contraseñas del sistema Quipux porque no se envia al correo institucional la notificación desde correspondiente. </td>
    <td>Se procede a dar solución mediante ejecución de código sql.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>172.16.1.164</td>
    <td>FINALIZADO</td>
    <td>Alta</td>
    <td></td>
    <td>
    6 Días<br>3 horas<br>48 Minutos<br>16 Segundos    </td>
    <td>202</td>
  </tr>
    <tr>
    <td>26</td>
    <td>SGT-2016-208</td>
    <td>Sistema QUIPUX</td>
    <td>2016-04-20 14:22:50<br>2016-04-22 10:22:21</td>
    <td>Ing. Alex Patricio Quingaluisa Saez;1500734221;SUBDIRECCIÓN DE FISCALIZACIÓN</td>
    <td>No puede recuperar la contraseña del Quipux</td>
    <td>Se procede a reseteo de contraseña directo a la base de datos mendiante codigo sql.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>172.16.1.138</td>
    <td>FINALIZADO</td>
    <td>Alta</td>
    <td>Comunicar al usuario</td>
    <td>
    1 Días<br>19 horas<br>59 Minutos<br>31 Segundos    </td>
    <td>89</td>
  </tr>
    <tr>
    <td>27</td>
    <td>SGT-2016-210</td>
    <td>Sistema QUIPUX</td>
    <td>2016-04-21 08:21:09<br>2016-04-21 08:30:56</td>
    <td>Ing. Alex Patricio Quingaluisa Saez;1500734221;SUBDIRECCIÓN DE FISCALIZACIÓN</td>
    <td>No puede ingresar al sistema Quipux por bloqueo de la contraseña.</td>
    <td>Se prcedió a resetear manualmente la contraseña desde codigo SQL y se comunico la usuario demás se le explico que debe cambiar la clave inmediatamente. </td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>192.168.101.1;172.16.1.161;192.168.56.1</td>
    <td>FINALIZADO</td>
    <td>Alta</td>
    <td></td>
    <td>
    9 Minutos<br>47 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>28</td>
    <td>SGT-2016-211</td>
    <td>Sistema QUIPUX</td>
    <td>2016-04-21 08:21:55<br>2016-04-21 08:31:16</td>
    <td>Tlgo. Klever Gonzalo Ocampo Urbina;1500801061;SUBDIRECCIÓN DE GESTIÓN TECNOLÓGICA</td>
    <td>No puede ingresar al quipux por Bloqueo de la contraseña.</td>
    <td>Se prcedió a resetear manualmente la contraseña desde codigo SQL y se comunico la usuario demás se le explico que debe cambiar la clave inmediatamente. </td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>192.168.101.1;172.16.1.161;192.168.56.1</td>
    <td>FINALIZADO</td>
    <td>Alta</td>
    <td></td>
    <td>
    9 Minutos<br>21 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>29</td>
    <td>SGT-2016-214</td>
    <td>Sistema QUIPUX</td>
    <td>2016-04-21 10:25:22<br>2016-04-21 15:17:02</td>
    <td>SERVIDOR LINUX </td>
    <td>El corrector ortográfico del quipux no funciona, aparece el mensaje:
Error executing aspell -a --lang=es --encoding=utf-8 -H --rem-sgml-check=alt < /tmp/aspell_data_Vt4CRG 2>&1sh: aspell: command not found</td>
    <td>Luego de indagar varios comentarios en los foros de internet, se logro solucionar instalando la libreria libaspell y libaspell-es
mediante:

yum install libaspell
yum install libaspell-es</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>192.168.101.1;172.16.1.161;192.168.56.1</td>
    <td>FINALIZADO</td>
    <td>Alta</td>
    <td></td>
    <td>
    4 horas<br>51 Minutos<br>40 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>30</td>
    <td>SGT-2016-217</td>
    <td>Sistema QUIPUX</td>
    <td>2016-04-21 17:03:15<br>2016-04-21 17:10:33</td>
    <td>Dr. Felipe Nery Ghía Moreno;1702950591;DIRECCIÓN DE PLANIFICACIÓN</td>
    <td>Solicita recuperar contraseña de Quipux.</td>
    <td>Se procedió a recupera la contraseña mendiante código SQL.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>192.168.101.1;172.16.1.161;192.168.56.1</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    7 Minutos<br>18 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>31</td>
    <td>SGT-2016-223</td>
    <td>Sistema QUIPUX</td>
    <td>2016-04-25 10:10:19<br>2016-04-25 10:21:50</td>
    <td>M.Sc. Holger Michler;1756427744;SUBDIRECCION DE COOPERACIÓN INTERNACIONAL</td>
    <td>Desactivar subrogación de Cargo</td>
    <td>Se procedió a desactivar la Subrogación de Cargo</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>192.168.101.1;172.16.1.161;192.168.56.1</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    11 Minutos<br>31 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>32</td>
    <td>SGT-2016-224</td>
    <td>Conectividad & Networking</td>
    <td>2016-04-25 10:53:53<br>2016-04-25 11:10:58</td>
    <td>Ing. Segundo Jose Taipe Maigua;1704953098;SUBDIRECCIÓN DE RIEGO Y DRENAJE</td>
    <td>No puede ingresar a Quipux no recuerda la contraseña y no llega el link de recuperación al correo institucional</td>
    <td>Por caso urgente, se procede a resetear mediante codigo sql, comunicar al usuario con clave por defeto(@gadnapo#1)</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>172.16.1.152</td>
    <td>FINALIZADO</td>
    <td>Alta</td>
    <td></td>
    <td>
    17 Minutos<br>5 Segundos    </td>
    <td>94</td>
  </tr>
    <tr>
    <td>33</td>
    <td>SGT-2016-240</td>
    <td>Software (Otros)</td>
    <td>2016-05-2 17:03:50<br>2016-05-9 11:29:35</td>
    <td>Lcda. Tatiana Paola Loaiza Grefa;1500641293;SUBDIRECCIÓN DE GESTIÓN TECNOLÓGICA</td>
    <td>Eliminar el registro de equipo de un parlante con codigo de activos 500-01-031 del sistema de soporte técnico, porque esta duplicado 
</td>
    <td>Se procedió con el eliminado del duplicado en la base de datos.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>172.16.1.152</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    6 Días<br>18 horas<br>25 Minutos<br>45 Segundos    </td>
    <td>94</td>
  </tr>
    <tr>
    <td>34</td>
    <td>SGT-2016-241</td>
    <td>Software (Otros)</td>
    <td>2016-05-3 09:36:05<br>2016-05-9 11:26:32</td>
    <td>Lcda. Tatiana Paola Loaiza Grefa;1500641293;SUBDIRECCIÓN DE GESTIÓN TECNOLÓGICA</td>
    <td>Crear en el sistema de soporte en el registro de software permitidos como Thunderbird</td>
    <td>Se Añadió como Software Autorizado el Thunderbird(software de gestión de correo electrónico)</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>172.16.1.152</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    6 Días<br>1 horas<br>50 Minutos<br>27 Segundos    </td>
    <td>94</td>
  </tr>
    <tr>
    <td>35</td>
    <td>SGT-2016-266</td>
    <td>Software (Otros)</td>
    <td>2016-05-10 09:21:39<br>2016-05-10 09:26:33</td>
    <td>EP-EMPRODECO</td>
    <td>Se reporta un error al subir la nómina de pagos</td>
    <td>Se procedió a revisar las configuraciones de inicio, se actualizó la version de generador de nómina, habilitación de los macros el excel.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>172.16.1.161</td>
    <td>FINALIZADO</td>
    <td>Alta</td>
    <td></td>
    <td>
    4 Minutos<br>54 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>36</td>
    <td>SGT-2016-281</td>
    <td>Software (Otros)</td>
    <td>2016-05-12 08:29:54<br></td>
    <td>Tlgo. Klever Gonzalo Ocampo Urbina;1500801061;SUBDIRECCIÓN DE GESTIÓN TECNOLÓGICA</td>
    <td>MANTENIMIENTO DEL SISTEMA DE REGISTRO DE EQUIPOS</td>
    <td></td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td></td>
    <td>EN ATENCIÓN</td>
    <td>Alta</td>
    <td></td>
    <td>
    1 Meses<br>12 Días<br>8 horas<br>5 Minutos<br>40 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>37</td>
    <td>SGT-2016-285</td>
    <td>Sistema QUIPUX</td>
    <td>2016-05-12 09:12:22<br>2016-05-12 14:14:36</td>
    <td>SUBDIRECCIÓN DE GESTIÓN TECNOLÓGICA</td>
    <td>Se requiere de la organización de documentos del Sistema Quipux en carpetas virtuales</td>
    <td>Se procede a revisar las carpetas virtuales en el sistema Quipux, se procede a eliminar en la tabla de trd de la base dedatos correspondientes los ejemplos realizados para reorganizar los niveles correspondientes, se queda de aceurdo al siguiente nivel:

Año=Nivel 1
Aéra= Niviel 2 del subnivel 1 
Carpeta= Carpeta de archivo</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>192.168.101.1;172.16.1.161;192.168.56.1</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    5 horas<br>2 Minutos<br>14 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>38</td>
    <td>SGT-2016-290</td>
    <td>Software (Otros)</td>
    <td>2016-05-16 08:26:55<br>2016-05-24 07:44:52</td>
    <td>Lcda. Tatiana Paola Loaiza Grefa;1500641293;SUBDIRECCIÓN DE GESTIÓN TECNOLÓGICA</td>
    <td>Solicito se inserte en el sistema de Gestión Tecnológica una casilla para el nombre de equipo de ser posible en la ventana de IP</td>
    <td>Se procedió a insertar un campo mas en el registro de IPs para el nombre del Host o hostname conforme a lo solicitado.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>172.16.1.152</td>
    <td>FINALIZADO</td>
    <td>Alta</td>
    <td>A fin unir a todos los usuarios al nuevo dominio</td>
    <td>
    7 Días<br>23 horas<br>17 Minutos<br>57 Segundos    </td>
    <td>94</td>
  </tr>
    <tr>
    <td>39</td>
    <td>SGT-2016-292</td>
    <td>Sistema QUIPUX</td>
    <td>2016-05-06 08:16:35<br>2016-05-06 10:25:51</td>
    <td>SERVIDOR LINUX </td>
    <td>No se envía los correos de recuperación de contraseña del sistema QUIPUX.</td>
    <td>Se procedió a levantar els ervicio faltante con la línea "setsebool -P httpd_can_sendmail=on" en la cosola</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>172.16.1.161</td>
    <td>FINALIZADO</td>
    <td>Alta</td>
    <td></td>
    <td>
    2 horas<br>9 Minutos<br>16 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>40</td>
    <td>SGT-2016-304</td>
    <td>Active Directory</td>
    <td>2016-05-19 08:42:43<br>2016-05-20 16:09:19</td>
    <td>INSTALACIÓN DE MAQUINA VIRTUAL</td>
    <td>Se requiere instalar una máquina virtual dentro del Windows Server 2012 para la migración del ESET-S. ENDPOINT.</td>
    <td>Se procedió a configurar el servicio Hyper-V de Windows Server 2012, donde se configuró una máquina virtual con los requerimientos necesarios para instalar ERA 6 de Eset, o otros requerimeintos como las ultimas update del SO, net Fra. 3.5, mozilla y adobre actualizados de aceurdo al requerimiento en pdf. de a empresa inforc.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>172.16.1.161;192.168.56.1</td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    1 Días<br>7 horas<br>26 Minutos<br>36 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>41</td>
    <td>SGT-2016-306</td>
    <td>Sistema Olympo</td>
    <td>2016-05-19 14:15:30<br>2016-05-20 16:10:24</td>
    <td>SERVIDOR WINDOWS SERVER 12</td>
    <td>Se requiere tener instalado el SQL Server Express en el Servidor de Windows Server R2 2012 para la igración del Sistema Olympo</td>
    <td>De acuerdo a los requerimientos se procedio a instalar y configurar el SQL-Server Express 2014 en el servidor de Windows Server 2012 R2 para migración del sistema Olympo.</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td></td>
    <td>FINALIZADO</td>
    <td>Normal</td>
    <td></td>
    <td>
    1 Días<br>1 horas<br>54 Minutos<br>54 Segundos    </td>
    <td>199</td>
  </tr>
    <tr>
    <td>42</td>
    <td>SGT-2016-309</td>
    <td>Active Directory</td>
    <td>2016-05-23 08:13:35<br>2016-05-23 12:36:11</td>
    <td>Ing. Pablo Andres Villavicencio Perez;1803705340;DIRECCIÓN FINANCIERA</td>
    <td>No puede acceder al sistema Olympo</td>
    <td>Se perdió la configuración dela red al cambiar de cableado a wiffi se procedió a actualizar la configuracion de red para que se enganche a CPNAPO.local</td>
    <td>Ing. Juan Diego Rojas Escandón</td>
    <td>10.10.1.18;172.16.1.161;192.168.56.1</td>
    <td>FINALIZADO</td>
    <td>Alta</td>
    <td></td>
    <td>
    4 horas<br>22 Minutos<br>36 Segundos    </td>
    <td>199</td>
  </tr>
  </table>
	</div>

 
</body>
</html>
';
 
# Instanciamos un objeto de la clase DOMPDF.
$mipdf = new DOMPDF();
 
# Definimos el tamaño y orientación del papel que queremos.
# O por defecto cogerá el que está en el fichero de configuración.
$mipdf ->set_paper("A4", "portrait");
 
# Cargamos el contenido HTML.
$mipdf ->load_html(utf8_decode($html));
 
# Renderizamos el documento PDF.
$mipdf ->render();
 
# Enviamos el fichero PDF al navegador.
$mipdf ->stream('FicheroEjemplo.pdf');
?>