<!DOCTYPE html>
<html>
<head>
	<title>coneccion BD</title>
	<!--ARREGLAR EL INPUT DATE-->
</head>
<body><?php 

//sacamos la accion
$action=$_GET['ac'];
	//V/---------------------------HACEMOS LA CONEXION-------------------------------
	//V// creamos la conexion
	$variable_pdo = new PDO('mysql:host=localhost; dbname=practica_7_crud','Vilo','vilo0812');
	//V//inicializamos la modalidad de lectura de excepciones
	$variable_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//V/agragamos los caracteres tipo utf8
	$variable_pdo->exec("SET CHARACTER SET UTF8");
	//------------------------------PODEMOS EMPEZAR---------------------------------
//SQL antiguo
//$connect= mysqli_connect("localhost","gabriel","","p1");

switch ($action) {/*si es 1 agrega 2 actualiza 3 elimina*/
	case 1://---------------------------------insertar---------------------------------------------------
	//V/verificamos que se pasen las variables
	if (isset($_POST['enviar'])){
		//vamos a almacenar la variable fecha con el array asociativo que acabamos de resivir
		$fecha= $_POST['fecha'];
		$noticia= $_POST['noticia'];
		$titulo= $_POST['titulo'];

		/*agrega la informacion a la base de datos*/
		//SQL antiguo
		//$consult= "insert into noticias value (null,'$titulo', '$fecha', '$noticia')";
		//mysqli_query($connect, $consult);
		//----------------------------PDO------------------------------------------
		//hacemos una variable en la cual tendra la consulta
		$sql="INSERT INTO `news`(`id_new`, `title`, `date`, `new`) VALUES ( null, :n_title, :n_date, :n_new )";
		//V/creamos el PDOStatement para trabajarlo
		$variable_PDOStatement=$variable_pdo->prepare($sql);
		//V/ ejecutamos el PDOStatement
		$variable_PDOStatement->execute(array(':n_title'=>$titulo,':n_date'=>$fecha,':n_new'=>$noticia));

		echo "funciono".
		"<br>"."<a href='registro.php'>volver a registrar</a>";
	}else{echo "no funciono";?>

		<br><a href="registro.php">volver</a>
	  
	   <?php
	  }
	  ?>
	  <?php
	
		break;
		
	case 2://---------------------------------actualizar---------------------------------------------------
	$id = $_POST['id'];
	///MYSLI ANTIGUO
	/*$consult="UPDATE `noticias` SET `titulo`='$titulo',`fecha`='$fecha',`noticia`='$noticia' WHERE id = $id";
	mysqli_query($connect, $consult);*/
	///
	if (isset($_POST['enviar'])){
		//vamos a almacenar la variable fecha con el array asociativo que acabamos de resivir
		$fecha= $_POST['fecha'];
		$noticia= $_POST['noticia'];
		$titulo= $_POST['titulo'];
		$id= $_POST['id'];
		$sql="UPDATE `news` SET `id_new`=:n_id_new,`title`=:n_titulo,`date`=:n_fecha,`new`=:n_noticia WHERE id_new = :n_id_new";
		$variable_PDOStatement=$variable_pdo->prepare($sql);
		$variable_PDOStatement->execute(array(":n_titulo"=>$titulo, "n_fecha"=>$fecha, "n_noticia"=>$noticia,"n_id_new"=>$id));
		echo "la base de datos a sido actualizada";
	}else{
		echo "no funciono";
	}
	
	break;

	case 3://---------------------------------ELIMINAR---------------------------------------------------
	$id_new= $_GET['id'];
	///MYSQL antiguo
	/*$consult="DELETE FROM noticias WHERE id = $id";
	mysqli_query($connect, $consult);
	echo "se ha eliminado de la base de datos";*/

	///////Nuevo PDO BRUTAL
	///sentencia sql para borrar
	$sql="DELETE FROM news where id_new=:n_id_new";
	$variable_PDOStatement=$variable_pdo->prepare($sql);
	///ejecutamos la nueva variable y elimina automaticamente
	$variable_PDOStatement->execute(array(':n_id_new'=>$id_new));
	echo "registro eliminado";
	break;

	default:
		# code...
		break;
}
?>
 <br><a href="index.php">volver al inicio</a>

</body>
</html>