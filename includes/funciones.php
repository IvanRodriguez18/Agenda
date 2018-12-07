<?php  
function conexionBD()
{
	try 
	{
		$conexion = new PDO('mysql:host=localhost;dbname=agenda', 'root', '');
		$conexion->query("SET NAMES 'utf8'");
		return $conexion;
	} catch (PDOException $e) 
	{
		return false;		
	}
}
function insertaContacto($sql, $conecta)
{
	$statement = $conecta->prepare($sql);
	$statement->execute();
	return $statement;
}
function obtenerContactos($sql, $conecta)
{
	$statement = $conecta->prepare($sql);
	$statement->execute();
	$resultado = $statement->fetchAll();
	return $resultado;
}
function obtenerContacto($sql, $conecta)
{
	$statement = $conecta->prepare($sql);
	$statement->execute();
	$resultado = $statement->fetch(PDO::FETCH_ASSOC);
	return $resultado;
}
function eliminarContacto($sql, $conecta)
{
	$statement = $conecta->prepare($sql);
	$statement->execute();
	return $statement;
}
function modificarContacto($sql, $conecta)
{
	$statement = $conecta->prepare($sql);
	$statement->execute();
	return $statement;
}
?>