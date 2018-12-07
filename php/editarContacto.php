<?php
header('Content-Type: application/json');
include '../includes/funciones.php';
$conecta = conexionBD();
if (isset($_POST['accion']) == 'editar') 
{
	$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
	$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
	$empresa = filter_var($_POST['empresa'], FILTER_SANITIZE_STRING);
	$telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
	if (!empty($id)) 
	{
		$sql_editar = "UPDATE contactos SET nombre='$nombre', empresa='$empresa', telefono='$telefono' 
					   WHERE id_contacto='$id'";
		$resultado = modificarContacto($sql_editar, $conecta);
		if ($resultado !== false) 
		{
			if ($resultado->rowCount() == 1) 
			{
				$respuesta = array('success' => 'true');
			}
		}
	}
	echo json_encode($respuesta);
}
?>