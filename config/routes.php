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
	'/test' => 'test#index',
	'/' => 'application#index',
	'/agregar' => 'application#agregar',
	'/confAgregar' => 'application#confAgregar',
	'/eliminar' => 'application#eliminar',
	'/confEliminar' => 'application#confEliminar'
);
