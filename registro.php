<!DOCTYPE html>
<html>
<head>
	<title>coneccion BD</title>
	<style type="text/css">
		input{
			margin-bottom: 10px;
		}
	</style>
</head>
<body>
	<fieldset>
		<legend>registro</legend>
		<form method="post" action="action.php?ac=1">
		<label for="titulo">titulo: </label>
		<input type="text" name="titulo" id="titulo"><br>
		<!--
			////////DATA TIME
			<label for="fecha">fecha: </label>
		<input type="datetime" name="fechahora" step="1" min="2013-01-01T00:00Z" max="2013-12-31T12:00Z" value="<?php echo date("Y-m-d\TH-i");?>">
		-->
		<!--
			//////////TIME
			<label for="fecha">fecha: </label>
		<input type="datetime" name="fecha" id="fecha" value="<?php echo date("Y-m-d");?>"><br>
		
		-->
		<label for="noticia">noticia: </label>
		<input type="hidden" name="fecha" value="<?php echo date("Y-m-d\TH-i");?>">

		<textarea name="noticia" id="noticia"></textarea><br>
		<input type="submit" name="enviar" value="enviar">
		</form>
	</fieldset>
</body>
</html>