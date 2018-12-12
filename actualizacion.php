<!DOCTYPE html>
<html>
<head>
	<title>actualizacion</title>
</head>
<body>
	<?php 
	$id= $_GET['id'];
	
	/*$connect= mysqli_connect("localhost","gabriel","","p1"); //host,user,pass,bd
	$registro= mysqli_query($connect,"select * from noticias where id=$id");
	$reg=mysqli_fetch_array($registro);*/

	//PDO nuevo metodo más aplicable

	//V// creamos la conexion
	$variable_pdo = new PDO('mysql:host=localhost; dbname=practica_7_crud','Vilo','vilo0812');
	//V//inicializamos la modalidad de lectura de excepciones
	$variable_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//V/agragamos los caracteres tipo utf8
	$variable_pdo->exec("SET CHARACTER SET UTF8");
	//preparamos la sentencia de modo que solo nos traiga un registro, que es el que necesitamos para pasar el id
	//a la siguiente ventana para poder actualizar
	$variable_PDOStatement=$variable_pdo->prepare("SELECT `id_new`, `title`, `date`, `new` FROM `news` WHERE id_new=:n_id_new");
	$variable_PDOStatement->execute(array(":n_id_new"=>$id));
	//almacenamos el registro especifico en la variable $reg 
	$reg=$variable_PDOStatement->fetch(PDO::FETCH_ASSOC);
	 ?>
<fieldset>
		<legend>Actualizar</legend>
		<form method="post" action="action.php?ac=2">
			<input type="hidden" name="id" value="<?php echo $id?>">
		<label for="titulo">titulo: </label>
		<input type="text" name="titulo" value="<?php echo $reg['title'] ?>"><br>
		<label for="fecha">fecha: </label>
		<input type="text" name="fecha" value="<?php echo $reg['date'] ?>"><br>
		<label for="noticia">noticia: </label>
		<textarea name="noticia"><?php echo $reg['new']  ?></textarea><br>
		<input type="submit" name="enviar" value="enviar">
		</form>
	</fieldset>
</body>
</html>