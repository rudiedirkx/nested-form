<?php

spl_autoload_register(function( $class ) {
	$ns = explode('\\', $class);
	$lib = array_splice($ns, 0, 2);
	if ( $lib == array('rdx', 'nestedform') ) {
		if ( file_exists($file = __DIR__ . '/src/' . implode('/', $ns) . '.php') ) {
			include $file;
		}
	}
});
