<!DOCTYPE html>
<html>
    <head>
	
        <title>PHP - google map</title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css" />
		<link rel="icon" type="image/png" href="img/menu.png" />
    </head>
    <body>
	
		<header>
			<ul>	
				<li><span>PHP</span></li>	<li><img src="img/logo.png" id="logo"/></li>	<li><span>Google Maps</span></li>
			</ul>
		</header>
		
		<section>
			<img src="img/menu.png">
			
			<article>
			
				<form name="localizacao" id="localiza" method="post" action="">
				
					<input type="text" name="local" placeholder="Local"><br>
					
					 <div id="per">Informe qual o tipo de lugar</div>
				    <input name="parametroLocal" type="radio" value="1" id="1" class="custom"> <label for="1">Continente</label><br>
				    <input name="parametroLocal" type="radio" value="2" id="2" class="custom"><label for="2">Pais</label><br>
				    <input name="parametroLocal" type="radio" value="3" id="3" class="custom"><label for="3">Estado</label><br>
				    <input name="parametroLocal" type="radio" value="4" id="4" class="custom"><label for="4">Cidade</label><br>
					
					<input type="submit" name="enviar" value="Visualizar" id="visualizar">
				</form>
				
			</article>
			
		</section>
		
		<aside>
		<?php
			$local = isset($_POST["local"])? $_POST["local"] : "";
			$parLocal = isset($_POST["parametroLocal"])?  $_POST["parametroLocal"] : "";
			
			
			if($local != ""){
				
					switch ($parLocal){

						case 1 : $local = $_POST["local"];
							echo ("<img src='https://maps.googleapis.com/maps/api/staticmap?center=$local &amp;zoom=2&amp;size=288x200&amp;markers=$local&amp;sensor=false'>");
						break;
						case 2:
							echo ("<img src='https://maps.googleapis.com/maps/api/staticmap?center=$local &amp;zoom=3&amp;size=288x200&amp;markers=$local&amp;sensor=false'>");
						break;
						case 3:
							echo ("<img src='https://maps.googleapis.com/maps/api/staticmap?center=$local &amp;zoom=5&amp;size=288x200&amp;markers=$local&amp;sensor=false'> ");
						break;
						case 4:
							echo ("<img src='https://maps.googleapis.com/maps/api/staticmap?center=$local &amp;zoom=12&amp;size=288x200&amp;markers=$local&amp;sensor=false'> ");
						break;
						default:
						
						break;

					}
				
			}
			else{}
			
			
		?>
		</aside>
		
		<div class="distancia">
			<form name="distancia" method="post" action=""> 
				<input type="text" name="origem" placeholder="Origem"><br>
				<input type="text" name="destino" placeholder="Destino"><br>
				<input type="submit" name="ver" value="Visualizar" id="visualizar">
			</form>
		</div>
		
		<div class="distancia">
			<?php
			
				echo "<div id='resultado'>";
					$origem = isset($_POST['origem'])? $_POST['origem'] : '';
					$destino = isset($_POST['destino'])? $_POST['destino'] : '';
					
					if(!empty($origem) and !empty($destino)){

						$mensagem = "Origem ".$origem;
						echo $mensagem;
						echo "<br>Destino: ".$destino;
						
						$corrida = trim("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$origem&destinations=$destino&mode=drive&language=pt-BR&sensor=false"); 
						$resultado = str_replace(" ","",$corrida);
					 
						$arquivo = $resultado;

						$info = file_get_contents($arquivo);

						$lendo = json_decode($info);

						foreach($lendo->rows as $campo){
							foreach($campo->elements as $dist){
								echo "<br>Distancia: ".$dist->distance->text."<br>";
								echo "Dura��o(carro): ".$dist->duration->text;
							}
						}
					}
					else{}
				echo "</div>";
			?>
		</div>
		
    </body>
</html>
