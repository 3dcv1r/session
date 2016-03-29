<?php

// simple autoloader
spl_autoload_register(function ($class_name) {
    $paths = array(
        'src',
        'tests',
    );
        
     // Search each path for the class.
     foreach( $paths as $path ) {
         if( file_exists( "$path/$class_name.php" ) )
             require_once( "$path/$class_name.php" );
     }
});

