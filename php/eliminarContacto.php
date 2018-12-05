<?php  
include '../includes/funciones.php';
$conecta = conexionBD();
header("Content-type: application/json");
if (!$conecta) {
	echo "Fallo la conexion";
}
if (isset($_GET['accion']) == 'borrar') 
{
	$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
	if (!empty($id)) 
	{
		$sql_elimina = "DELETE FROM contactos WHERE id_contacto='$id'";
		$resultado = eliminarContacto($sql_elimina, $conecta);
		if ($resultado !== false) 
		{
			if ($resultado->rowCount() == 1) 
			{
				$respuesta = array('success' => 'true');
			}
		}
		echo json_encode($respuesta);
	}
}
?>