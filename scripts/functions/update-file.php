<?php

namespace Studiometa\WPInstaller;

function updateFile( $path, $newLines ) {
	echo "\nUpdating $path...";
	$filePath = sprintf( '%s/../%s', dirname( __DIR__ ),  $path );
	$file = file( $filePath );
	foreach ($newLines as $index => $value) {
		$file[$index] = $value . "\n";
	}

	file_put_contents( $filePath, $file );
}
