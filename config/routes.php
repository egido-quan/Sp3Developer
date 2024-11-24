<?php 

/**
 * Used to define the routes in the system.
 * 
 * A route should be defined with a key matching the URL and an
 * controller#action-to-call method. E.g.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 */
$routes = array(
	//'/test' => 'test#index',
	'/' => 'application#index',
	'/agregar' => 'application#agregar',
	'/conf_agregar' => 'application#confAgregar',
	'/modificar' => 'application#modificar',
	'/conf_modificar' => 'application#confModificar',
	'/eliminar' => 'application#eliminar',
	'/conf_eliminar' => 'application#confEliminar',
	'/buscar' => 'application#buscar',
	'/conf_buscar' => 'application#confBuscar',
	'/conf_borrar_lista' => 'application#confBorrarLista',
	'/cargar_lista' => 'application#cargarLista',
	'/conf_cargar_lista' => 'application#confCargarLista',
	'/borrar_lista' => 'application#borrarLista'
);
