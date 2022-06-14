<?php

require dirname( __DIR__ ) . '/vendor/autoload.php';

use mikehaertl\shellcommand\Command;

$command = new Command( "curl -s 'https://api.wordpress.org/secret-key/1.1/salt/'" );

if ( $command->execute() ) {
	$output = $command->getOutput();

	echo preg_replace( "/define\('([A-z]+)',\s+'(.+)'\);/", "$1='$2'", $output );
} else {
	echo $command->getError();
	$exitCode = $command->getExitCode();
}
