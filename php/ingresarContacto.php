<?php  
header('Content-Type: application/json');
include '../includes/funciones.php';
$conecta = conexionBD();
if (isset($_POST['accion']) == 'crear') 
{
	$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
	$empresa = filter_var($_POST['empresa'], FILTER_SANITIZE_STRING);
	$telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);

	if (!empty($nombre) && !empty($empresa) && !empty($telefono)) 
	{
		$sql_ingresa = "INSERT INTO contactos VALUES(NULL, '$nombre', '$empresa', $telefono)";
		$resultado = insertaContacto($sql_ingresa, $conecta);
		if ($resultado !== false) 
		{
			if ($resultado->rowCount() == 1) 
			{
				$respuesta = array('success' => 'true',
								   'informacion' => array(
								   	'id_last' => $conecta->lastInsertId(),
							   		'nombre' => $nombre,
							   		'empresa' => $empresa,
							   		'telefono' => $telefono)
									);
			}
		}else{
			$respuesta = array('error' => 'false');
		}	
		echo json_encode($respuesta);
	}
}
?>