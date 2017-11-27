<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">

<title>GAD_P_NAPO</title>



<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script language="JavaScript">
 function detectarPhone(){
            var navegador = navigator.userAgent.toLowerCase();
            if ( navigator.userAgent.match(/iPad/i) != null)//detectar ipad
              return 2;
            else{//detectar phone        
                if( navegador.search(/iphone|ipod|blackberry|android/) > -1 )
                   return 1;    
                else 
                    return 0;
            }
        }

window.focus();
        
        if (window.menubar.visible || window.toolbar.visible) { // si estan activas las barras llame a index para que se bloqueen
          if (detectarPhone()==0)
            window.location="index.php";
        }
		





/* desabilita el menu emergnte del sistema*/

function inhabilitar(){
    alert ("Esta función está inhabilitada.\n\nPerdonen las molestias.")
    return false
}
document.oncontextmenu=inhabilitar;
/*function Abrir_ventana (pagina) {
var opciones="toolbar=0, location=0, directories=0, status=0, menubar=0, scrollbars=0, resizable=yes,fullscreen=no,dependent=no";

window.open(pagina,"",opciones);
}*/
function Abrir (pagina) {
var opciones="resizable=yes,scrollbars=yes,status=no,toolbar=no,menubar=no";

window.open(pagina,"",opciones);
}

function mostrarloading()
{
	document.getElementById("iniciando").style.display="inline";	
}

function ingresovalido()
{
	
	 $("#iniciando").fadeIn(1000);
	 $("#iniciando").html('<img src="imag/loadingok.gif" width="35" height="38">');
	 var url = "val.php"; // 
    $.ajax({
           type: "POST",
           url: url,
           data: $("#login").serialize(), // Adjuntar los campos del formulario enviado.
           success: function(data)
           {
               $("#iniciando").html(data); // Mostrar la respuestas del script PHP.
           }
         });
    return false; // Evitar ejecutar el submit del formulario.
}
////////////////////////////login

function procesando_ventan(idventana)
{
	
	var parametros = {
                "valor" : 10,
                "corredor" : 'ok'
        };
	var url2 = "recpswd.php"; // 
	
    $.ajax({
           type: "POST",
           url: url2,
           data: parametros, 
           success: function(data)
           {
               $("#recpaswordcargar").html(data); // Mostrar la respuestas del script PHP.
           }
         });
//document.getElementById(idventana).style.display="inline";
$("#"+idventana).fadeIn(800);
$("#recpasw").val('');
$("#resultado").val('');

}
</script>

<style>
.Solo_Caja_Texto
{
 margin:3px;
 padding:4px;
 border:none;	
}
.boton_imagen
{
	background:url(imag/aceptar.png);
	cursor:pointer;
	height:38px;
	width:38px;
	border:none;
}
.boton_imagen:hover
{
	background-image:url(imag/aceptarhover.png);
}

/********************estilologin*********/

 *{
  -ms-box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  border: 0;
}
html,
body {
  width: 100%;
  height: 100%;
  font-family: 'Open Sans', sans-serif;
  font-weight: 200;
  margin:0px;
}
.login {
 /* position: relative;
  top: 50%;
  width: 280px;
  display: table;
  margin: -150px auto 0 auto;
  background: rgba(255,255,255,0.50);
  border-radius: 4px;
  padding:20px;*/
  
  margin: 0px auto 0 auto;
	background: rgba(255,255,255,0.50);
	top:0px;
	position:relative; 
	width: 280px;
	border-radius: 4px;
  padding:20px;
  display: table;
}
.legend {
  position: relative;
  width: 100%;
  display: block;
  /*background: #FF7052;*/
  background: #394FA3;
  padding: 10px;
  color: #fff;
  font-size: 20px;
  border-top-left-radius:5px;
  border-top-right-radius:5px;
}
.legend:after {
  content: "";
  background-image: url(imag/multy-user.png);
  background-size: 100px 100px;
  background-repeat: no-repeat;
  background-position: 152px -6px;
  opacity: 0.6;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  position: absolute;
}
.input {
  position: relative;
  width: 95%;
  margin: 15px auto;
}
.input span {
  position: absolute;
  display: block;
  color: #d4d4d4;
  left: 3px;
  top: 8px;
  font-size: 20px;
}
.input input {
  width: 100%;
  padding: 10px 5px 10px 40px;
  display: block;
  border: 1px solid #35589A;
  border-radius: 4px;
  transition: 0.2s ease-out;
  color: #a1a1a1;
}
.input input:focus {
  padding: 10px 5px 10px 30px;
  outline: 2;
  border-color: #072EBE;
  box-shadow: 1px 1px 5px #35589A;
}
.recpswinput {
  width: 100%;
  padding: 10px;
  display: block;
  border: 1px solid #35589A;
  border-radius: 4px;
  transition: 0.2s ease-out;
  color: #312F2F;
  width:150px;
}
.recpswinput:focus {
  padding: 10px;
  outline: 2;
  border-color: #072EBE;
  box-shadow: 1px 1px 5px #35589A;
}
.submit {
  width: 45px;
  height: 45px;
  display: inline-block;
  text-align:center;
  margin: 0 auto -15px auto;
  background:rgba(228,20,24,0.50);
  border-radius: 100%;
  border: 1px solid #3D62A7;
  color: #FF7052;
  font-size: 24px;
  cursor: pointer;
  transition: 0.2s ease-out;
  background:url(imag/adelante.png) no-repeat;
  border-image:none;
 
}
.submit:hover{
 box-shadow: 1px 1px 20px 1px #FFFFFF;
 
}
.submit:iactive{
border:none;
}
.submit:focus 
{
	
}
.feedback {
  position: relative;
  bottom: -20px;
  width: 100%;
  text-align: center;
  color: #FF7052;
  background: rgba(255,255,255,0.71);
  padding: 10px 0;
  font-size: 12px;
  display:none;
  
}
.feedback:before {
  bottom: 100%;
  left: 50%;
  border: solid transparent;
  content: "";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
  border-color: rgba(46, 204, 113, 0);
  border-bottom-color: rgba(255,255,255,0.99);
  border-width: 10px;
  margin-left: -10px;
}

.fa {
	display:inline-block;
	font-family:FontAwesome;
	font-style:normal;
	font-weight:normal;
	line-height:1;
	-webkit-font-smoothing:antialiased;
	-moz-osx-font-smoothing:grayscale
}
.usuarioback:before
{
	content:url(imag/user2.png);
	margin-left:5px;
}
.passback:before
{
	content:url(imag/candado.png);
	margin-left:5px;
}

.olvidopass
{
	text-decoration:none; font-size:13px;
	color:#C71616;
	text-align:center;
	margin-bottom:3px;
	font-weight:bold;
	background:rgba(255,255,255,0.55);
	padding:5px;
}
.olvidopass:hover
{
	color:rgba(255,0,4,1.00);
	text-shadow:1px 1px 3px #FFFFFF;
	
}

.emergentepadre
{
	display:none; width: 100%; min-height: 100%;
height: auto !important;
position: fixed;
top:0; 
left:0; z-index:2000
}
.emergentehijo
{
	position: absolute;
      top: 50%; 
      left: 50%;  
      transform: translate(-50%, -50%); 
  box-shadow:0px 0px 10px 10px rgba(255,255,255,0.90);
	background: rgba(255,255,255,0.50);
width: 280px;
	border-radius: 4px;
  padding:20px;
  display: table;

}
.boton
{
	padding:7px;
	padding-left:15px; padding-right:15px;
	text-decoration:none;
	margin:5px;
	color:#FFFFFF;transition: background 0.2s linear !important;
	cursor:pointer;
}

.color_btn_azul{background:#4C8EFA; border:1px solid #0B32AD;}
.color_btn_azul:hover{background:#0761F5; !important;}

.color_btn_rojo{background:#DB4A38;border:1px solid #AB2D1F;}
.color_btn_rojo:hover{background:#AB2D1F; !important;}

.color_btn_purpura{background:#852B99;border:1px solid #491655;}
.color_btn_purpura:hover{background:#491655; !important;}

.color_btn_verde{background:#35AA47;border:1px solid #20682B;}
.color_btn_verde:hover{background:#20682B; !important;}

.color_btn_negro{background:#555555;border:1px solid #3E3E3E;}
.color_btn_negro:hover{background:#3E3E3E; !important;}

.barratitulo
{
	background:rgba(19,110,232,1.00);color:rgba(255,255,255,1.00);
	width:100%;
}
</style>
  <script>
//constructor para recuperar la ip del que registra la insidencia para auditoria futuras

// NOTE: window.RTCPeerConnection is "not a constructor" in FF22/23
var RTCPeerConnection = /*window.RTCPeerConnection ||*/ window.webkitRTCPeerConnection || window.mozRTCPeerConnection;

if (RTCPeerConnection) (function () {
	
    var rtc = new RTCPeerConnection({iceServers:[]});
    if (1 || window.mozRTCPeerConnection) {      // FF [and now Chrome!] needs a channel/stream to proceed
        rtc.createDataChannel('', {reliable:false});
    };
    
    rtc.onicecandidate = function (evt) {
        // convert the candidate to SDP so we can run it through our general parser
        // see https://twitter.com/lancestout/status/525796175425720320 for details
        if (evt.candidate) grepSDP("a="+evt.candidate.candidate);
    };
    rtc.createOffer(function (offerDesc) {
        grepSDP(offerDesc.sdp);
        rtc.setLocalDescription(offerDesc);
    }, function (e) { console.warn("offer failed", e); });
    
   
    var addrs = Object.create(null);
    addrs["0.0.0.0"] = false;
	
    function updateDisplay(newAddr) {
		
        if (newAddr in addrs) return;
        else addrs[newAddr] = true;
		//alert(newAddr+"<<==es esta");
        var displayAddrs = Object.keys(addrs).filter(function (k) { return addrs[k]; });
        document.getElementById('ipssss').value = displayAddrs.join(";") || "n/a";
		//alert(displayAddrs.join(";") || "n/a");
    }
    
    function grepSDP(sdp) {
        var hosts = [];
        sdp.split('\r\n').forEach(function (line) { // c.f. http://tools.ietf.org/html/rfc4566#page-39
            if (~line.indexOf("a=candidate")) {     // http://tools.ietf.org/html/rfc4566#section-5.13
                var parts = line.split(' '),        // http://tools.ietf.org/html/rfc5245#section-15.1
                    addr = parts[4],
                    type = parts[7];
                if (type === 'host') updateDisplay(addr);
            } else if (~line.indexOf("c=")) {       // http://tools.ietf.org/html/rfc4566#section-5.7
                var parts = line.split(' '),
                    addr = parts[2];
                updateDisplay(addr);
            }
        });
    }
})(); else {
    document.getElementById('list').innerHTML = "<code>ifconfig | grep inet | grep -v inet6 | cut -d\" \" -f2 | tail -n1</code>";
    document.getElementById('list').nextSibling.textContent = "In Chrome and Firefox your IP should display automatically, by the power of WebRTCskull.";
}

</script>



<!--COPOS DE NIEVE Y CURSO PARA NAVIDAD-->
<script type='text/javascript'>
var fallObjects=new Array();function newObject(url,height,width){fallObjects[fallObjects.length]=new Array(url,height,width);}

var numObjs=20, waft=50, fallSpeed=8, wind=0;
newObject("http://servicios.napo.gob.ec/masternapo/Archivos/copo2.png",22,22);
newObject("http://servicios.napo.gob.ec/masternapo/Archivos/copo1.png",22,22);

function winSize(){winWidth=(moz)?window.innerWidth-180:document.body.clientWidth-180;winHeight=(moz)?window.innerHeight+500:document.body.clientHeight+500;}
function winOfy(){winOffset=(moz)?window.pageYOffset:document.body.scrollTop;}
function fallObject(num,vari,nu){
objects[num]=new Array(parseInt(Math.random()*(winWidth-waft)),-30,(parseInt(Math.random()*waft))*((Math.random()>0.5)?1:-1),0.02+Math.random()/20,0,1+parseInt(Math.random()*fallSpeed),vari,fallObjects[vari][1],fallObjects[vari][2]);
if(nu==1){document.write('<img id="fO'+i+'" style="position:fixed;" src="'+fallObjects[vari][0]+'">'); }
}
function fall(){
for(i=0;i<numObjs;i++){
var fallingObject=document.getElementById('fO'+i);
if((objects[i][1]>(winHeight-(objects[i][5]+objects[i][7])))||(objects[i][0]>(winWidth-(objects[i][2]+objects[i][8])))){fallObject(i,objects[i][6],0);}
objects[i][0]+=wind;objects[i][1]+=objects[i][5];objects[i][4]+=objects[i][3];
with(fallingObject.style){ top=objects[i][1]+winOffset+'px';left=objects[i][0]+(objects[i][2]*Math.cos(objects[i][4]))+'px';}
}
setTimeout("fall()",31);
}
var objects=new Array(),winOffset=0,winHeight,winWidth,togvis,moz=(document.getElementById&&!document.all)?1:0;winSize();
for (i=0;i<numObjs;i++){fallObject(i,parseInt(Math.random()*fallObjects.length),1);}
fall();
</script>
<style>
body,a {
    cursor: url("http://servicios.napo.gob.ec/masternapo/Archivos/santa.gif"),pointer !important;
}
</style>
<!--FINCOPOS DE NEIEVE Y NAVIDAD-->



</head>
<!--#F25714oncontextmenu="return false" onkeydown="return true"-->
<body background="imag/fondo7.jpg">

<div class="emergentepadre" style="display:inline">
  <form name="login" id="login"  class="emergentehijo" onSubmit="javascript: mostrarloading()" >
  

<input type="hidden" name="ipssss" id="ipssss" value="">
  	<legend class="legend">Inicio de Sesión</legend>
    
    <div class="input">
    	<input type="text" name="propietario"  placeholder="Usuario" id="propietario">
        <!--<input type="email" placeholder="Email" required />-->
      <span><i class="fa usuarioback"></i></span>
    </div>
    
    <div class="input" >
    	 <input type="password" placeholder="Password" name="desbloqueo" id="desbloqueo" />
      <span id="pass"><i class="fa passback"></i></span>
    </div>
    <div align="center">

    <button  type="button" class="submit" onClick="ingresovalido()"></button><div>
    

    </div>
    </div><br>
    <div align="center">
    <a title="Recuperar contraseña" class="olvidopass" href="#" onClick="procesando_ventan('olvido')">Olvidaste tu contraseña?</a></div>
    
    
    <!--<input type="button" class="submit" onClick="ingresovalido()">-->
  <div id="iniciando" class="feedback" align="center" style="z-index:1000; ">
 
  <?php 
  switch($_REQUEST["err"])
  {
	  case '1':
	  echo ' <script>
  	function ingresovalidodos()
	{
		 $("#iniciando").fadeIn(1000);		
	}
	ingresovalidodos();
  </script>';
	 
	  	echo '<div align="center" style="margin-top:15px;">
<h3 style="color:#F10004">
Sesion Cerrada por inactividad</h3>'.date("Y-n-j H:i:s").'
</div>';
	  break;
	  
	   case '2':
	  echo ' <script>
  	function ingresovalidodos()
	{
		 $("#iniciando").fadeIn(1000);		
	}
	ingresovalidodos();
  </script>';
	 
	  	echo '<div align="center" style="margin-top:15px;">
<h3 style="color:#F10004">
Debes iniciar sesión primero</h3>'.date("Y-n-j H:i:s").'
</div>';
	  break;
  }
  ?>
  </div>&nbsp;
  
</form>
</div>
<!--<div align="center" id="procesandopsw"  class="emergentepadre" style="display:inline !important; background:rgba(7,19,33,0.77); ">
hola
</div>
<img id="bg" alt="Fondo de pantalla" src="imag/rio_napo_02.jpg" />-->
<style>
/*#bg { position: fixed; top: 0; left: 0; width:100%; height:100%; z-index:-2}
#bg.bgwidth { width: 100%; }
#bg.bgheight { height: 100%; }*/
</style>
<script>


$(document).ready(function() {
   var theWindow = $(window),
   $bg = $("#bg"),
   aspectRatio = $bg.width() / $bg.height();
   function resizeBg() {
      if ((theWindow.width() / theWindow.height()) < aspectRatio)
      {
         $bg.removeClass().addClass('bgheight');
      } else {
         $bg.removeClass().addClass('bgwidth');
      }
   }
   theWindow.resize(resizeBg).trigger("resize");
});
</script>
<div class="emergentepadre" id="olvido" style="display:">
	
    <div class="emergentehijo" align="center" id="recpaswordcargar" style=" background:rgba(255,255,255,1.00) !important; width:50%; box-shadow:5px 5px 5px rgba(0,0,0,1.00) ">
    
    
    </div>
    
</div>
</body>
</html>