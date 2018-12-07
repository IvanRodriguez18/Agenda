<div class="campos">
	<input type="text" name="nombre" id="nombre" placeholder="Nombre de Contacto" 
	value="<?php echo (!isset($resultado['nombre'])) ? '' : $resultado['nombre'];?>">
	<input type="text" name="empresa" id="empresa" placeholder="Empresa Contacto"
	value="<?php echo (!isset($resultado['empresa'])) ? '' : $resultado['empresa'];?>">
	<input type="text" name="telefono" id="telefono" placeholder="Telefono"
	value="<?php echo (!isset($resultado['telefono'])) ? '' : $resultado['telefono'];?>">
</div>
	<?php 
		$textoBtn = (isset($resultado['nombre'])) ? 'Guardar' : 'Agregar';
		$textoAccion = (isset($resultado['nombre'])) ? 'editar' : 'crear';
	?>
<input type="hidden" id="accion" value="<?php echo $textoAccion;?>">
<?php if(isset($resultado['id_contacto'])):?>
	<input type="hidden" id="identificador" value="<?php echo $resultado['id_contacto'];?>">
<?php endif; ?>
<input type="submit" class="btn" value="<?php echo $textoBtn;?>">

