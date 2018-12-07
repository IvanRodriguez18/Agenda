<?php 
	include 'includes/header.php';
	include 'includes/funciones.php';
	$conecta = conexionBD();
	$sql_consulta = "SELECT * FROM contactos ORDER BY id_contacto ASC";
	$resultados = obtenerContactos($sql_consulta, $conecta);
?>
<header class="cabecera">
	<div class="titulo-app">
		<h1>Agenda de Contactos</h1>
	</div>
</header>
<div class="contenedor">
	<div class="contacto">
		<div class="texto-formulario">
			<h3>Edita la información del contacto</h3>
			<p>Todos los campos son obligatorios</p>
		</div>
		<form id="registro">
			<?php include 'includes/formulario.php'; ?>
		</form>
	</div>
	<div class="registros">
		<div class="busqueda">
			<h2>Contactos</h2>
			<div class="campo-busqueda">
				<input type="search" name="buscar" id="buscador" placeholder="Buscar Contactos.....">
			</div>
		</div>
		<div class="contactos">
			<h4><span class="numero"></span> Contactos</h4>
		</div>
		<div class="tabla">
			<table id="listado-contactos">
				<thead>
					<tr>
						<th>NOMBRE</th>
						<th>EMPRESA</th>
						<th>TELÉFONO</th>
						<th>ACCIONES</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($resultados !== false):?>
						<?php foreach ($resultados as $resultado):?>
					<tr>
						<td><?php echo $resultado['nombre'];?></td>
						<td><?php echo $resultado['empresa'];?></td>
						<td><?php echo $resultado['telefono'];?></td>
						<td>
							<button type="button" data-id="<?php echo $resultado['id_contacto'];?>" title="Eliminar usuario" class="borrar">
								<i class="fas fa-trash"></i>
							</button>
							<a href="editar.php?id=<?php echo $resultado['id_contacto'];?>" title="Editar usuario">
								<i class="fas fa-edit"></i>
							</a>
						</td>
					</tr>
						<?php endforeach;?>
					<?php endif;?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php include 'includes/footer.php'; ?>