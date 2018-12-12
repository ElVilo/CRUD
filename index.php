<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>conexion BD</title>
</head>
<body>
	<?php 
	try{
	//V// creamos la conexion
	$variable_pdo = new PDO('mysql:host=localhost; dbname=practica_7_crud','Vilo','vilo0812');
	//V//inicializamos la modalidad de lectura de excepciones
	$variable_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//V/agragamos los caracteres tipo utf8
	$variable_pdo->exec("SET CHARACTER SET UTF8");
	//------------------------------CON ARRAY ASOCIATIVO---------------------------------
	//V//creamos el objeto PDOStatemen que contendra los datos de la consulta, recordar que el ':nombre_variable' representa una variable    que puede ser 
	//rellenada cuando se ejecute el PDOStament con un array asociativo
	//$variable_PDOStatement=$variable_pdo->prepare("SELECT `id_new`, `title`, `date`, `new` FROM `news` WHERE          date=:n_variable_uno and title=:n_variable_dos");
	$variable_PDOStatement=$variable_pdo->prepare("SELECT `id_new`, `title`, `date`, `new` FROM `news` WHERE :n_variable");

	//V//ejecutamos el PDOStatement, el cual permite llenar las variables vacias de informacion, de la consul<ta del PDOStatment 
	//para eso usamos un array asociativo// en este caso lo hice estatico para probarlo
	//$variable_PDOStatement->execute(array("n_variable_uno"=>'2018-12-10 22:00:00', "n_variable_dos"=>'the people in venezuelan are crazies'));
	$variable_PDOStatement->execute(array("n_variable"=>1));
	//------------------------------CON ARRAY normal '?'--------------------------------
	//V//creamos el objeto PDOStatemen que contendra los datos de la consulta, recordar que el '?' representa una variable que puede ser rellenada cuando se ejecute el PDOStament
	//$variable_PDOStatement=$variable_pdo->prepare("SELECT `id_new`, `title`, `date`, `new` FROM `news` WHERE ?");
	//V//ejecutamos el PDOStatement, el cual permite llenar las variables vacias de informacion, de la consul<ta del PDOStatment
	//$variable_PDOStatement->execute(array(1));
	//-------------------------------FIN ARRAY '?'----------------------------------


	//utilizamos el metodo fetch(PDO::FETCH_ASSOC para crear un ciclo while que no se detendra hasta recorrerlo todo y a su vez lo 
	//V// lo guardamos en una variable para poder ir mostrandolo poco a poco
	while($resultado=$variable_PDOStatement->fetch(PDO::FETCH_ASSOC)){
		//V// aqui aprobechamos el bucle para mostrar la imformacion que necesitamos, en este caso lo encerre en un cuadro muy mono
		echo  
			"<fieldset><legend>new ".$resultado['id_new']."</legend>".
			$resultado['title'] ."<br>".
		     $resultado['date'] ."<br>".
			 "this is the  new number ".$resultado['id_new']."<br>".$resultado['new']. "<br>"
			 ." <a href='actualizacion.php?id=".$resultado['id_new']." '> actualizar </a>"
		     ."<a href='action.php?id=".$resultado['id_new']."&ac=3'> eliminar </a> "."<tr>"."</fieldset>";
	}
	//V/no es obligatorio usar el closecursor(), pero es recomendable ya que consume memoria
	$variable_PDOStatement->closecursor();
	}catch(exception $e){
		die('Error:' . $e->GetMessage());
	}finally{
		$variable_pdo=null;
	}
/*
	//asi lo hice cuando no sabia sobre pdo
	
	$connect= mysqli_connect("localhost","gabriel","","p1"); //host,user,pass,bd
	$registro= mysqli_query($connect, "select * from noticias");
	while($reg=mysqli_fetch_array($registro)){
		
	echo $reg['titulo']."<br>";
		echo $reg['fecha']."<br>";
		echo $reg['noticia']."<br>";
		echo " <a href='actualizacion.php?id=".$reg['id']."'>actualizar</a>";
		echo "<a href='action.php?id=".$reg['id']."&ac=3'>eliminar</a>";
		echo "<br><hr>	";
	}
*/
 ?>
 <br>
 <a href="registro.php">insertar</a>
</body>
</html>