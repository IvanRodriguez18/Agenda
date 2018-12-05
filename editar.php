<?php include 'includes/header.php'; ?>
<header class="cabecera">
	<div class="titulo-app">
		<div class="padre">
			<a href="index.php" class="btn-enlace"> &laquo; Volver</a>
			<h1>Editar Contacto</h1>
		</div>
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
</div>
<?php include 'includes/footer.php'; ?>