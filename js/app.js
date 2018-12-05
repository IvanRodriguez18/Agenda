const formularioContactos = document.querySelector('#registro'),
	  listadoContactos = document.querySelector('#listado-contactos tbody');
var texto, clase;
eventosAll();
function eventosAll() {
	// aqui van a ir todos los eventos del proyecto
	formularioContactos.addEventListener('submit', leerFormulario);
	// Evento para eliminar registros de la base de datos
	listadoContactos.addEventListener('click', eliminarContacto);
}
// Funcion de leerFormulario
function leerFormulario(event){
	event.preventDefault();
	// leer valor de los campos de texto del formulario
	var nombre = document.querySelector('#nombre').value,
		empresa = document.querySelector('#empresa').value,
		telefono = document.querySelector('#telefono').value,
		accion = document.querySelector('#accion').value;
		if (nombre === '' || empresa === '' || telefono === '') 
		{
			texto = 'Todos los campos son obligatorios';
			clase = 'error';
			mostrarNotificacion(texto, clase);
			console.log(accion);
		}else{
			const datosContacto = new FormData();
			datosContacto.append('nombre', nombre);
			datosContacto.append('empresa', empresa);
			datosContacto.append('telefono', telefono);
			datosContacto.append('accion', accion);
			// console.log(...datosContacto);
			if (accion === 'crear') 
			{
				// Crear nuevo contacto
				ingresarContacto(datosContacto);
			}else{
				// Modificar nuevo contacto
			}
			// texto = 'Registro exitoso';
			// clase = 'success';
			// mostrarNotificacion(texto, clase);
		}
}
// Función para ingresar un contacto mediante AJAX
function ingresarContacto(datos) 
{
	// crear el objeto ajax
	var xhr = new XMLHttpRequest();
	// abrir la conexion
	xhr.open('POST', 'php/ingresarContacto.php', true);
	// ver respuesta 
	xhr.onload = function() {
		if (xhr.readyState === 4 && xhr.status === 200) 
		{
			var respuesta = JSON.parse(xhr.responseText);
			console.log(respuesta);
			if (respuesta.success == 'true') 
			{
				texto = 'Contacto registrado exitosamente';
				clase = 'success';
				const filaContacto = document.createElement('tr'),
					  contenedorBotones = document.createElement('td'),
					  iconoEditar = document.createElement('i'),
					  btnEditar = document.createElement('a'),
					  iconoDelete = document.createElement('i'),
					  btnDelete = document.createElement('button');
				filaContacto.innerHTML = `
					<td>${respuesta.informacion.nombre}</td>
					<td>${respuesta.informacion.empresa}</td>
					<td>${respuesta.informacion.telefono}</td>
				`;
				// Código para crear el boton para eliminar
				iconoDelete.classList.add('fas', 'fa-trash');
				btnDelete.appendChild(iconoDelete);
				btnDelete.setAttribute('data-id', respuesta.informacion.id_last);
				btnDelete.classList.add('borrar');
				contenedorBotones.appendChild(btnDelete);
				// Código para crear el enlace a la pagina de editar
				iconoEditar.classList.add('fas', 'fa-edit');
				btnEditar.appendChild(iconoEditar);
				btnEditar.href = `editar.php?id=${respuesta.informacion.id_last}`;
				contenedorBotones.appendChild(btnEditar);
				// agregando los botones al tr padre
				filaContacto.appendChild(contenedorBotones);
				listadoContactos.appendChild(filaContacto);
				// Resetear el formulario
				document.querySelector('form').reset();
				// mostrando la notificacion
				mostrarNotificacion(texto, clase);
			}
		}
	}
	// enviar los datos al archivo PHP
	xhr.send(datos);
}
// Funcion para eliminar contactos
function eliminarContacto(event) 
{
	if (event.target.classList.contains('borrar') ==  true) {
		var id = event.target.getAttribute('data-id'),
			condicion = confirm('¿Deseas eliminar al usuario?');
		if (condicion) 
		{
			// Petición Ajax para eliminar al usuario
			var xhr = new XMLHttpRequest();
			xhr.open('GET', `php/eliminarContacto.php?id=${id}&accion=borrar`, true);
			xhr.onload = function () {
				if (xhr.readyState === 4 && xhr.status === 200) 
				{
					var resultado = JSON.parse(xhr.responseText);
					if (resultado.success === 'true') 
					{
						// Eliminar registros del DOM cuando se elimine de la BD
						console.log(event.target.parentElement);
						event.target.parentElement.parentElement.remove();
						texto = 'Contacto eliminado correctamente';
						clase = 'success';
						mostrarNotificacion(texto, clase);
					}
				}
			}
			xhr.send();
		}
	}
}
// FUNCION PARA CREAR LA NOTIFICACIÓN
function mostrarNotificacion(texto, clase) 
{
	const notificacion = document.createElement('div');
	notificacion.classList.add(clase, 'notificacion');
	notificacion.textContent = texto;
	formularioContactos.insertBefore(notificacion, document.querySelector('form .campos'));
	// establecer el tiempo en que se mostrará la notificacion
	setTimeout(() =>{
		notificacion.classList.add('visible');
		setTimeout(() =>{
			notificacion.classList.remove('visible');
			setTimeout(() =>{
				notificacion.remove();
			}, 700);
		}, 3000);
	},100);
}