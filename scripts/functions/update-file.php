<?php

namespace Studiometa\WPInstaller;

function updateFile( $path, $newLines ) {
	echo "\nUpdating $path...";
	$filePath = sprintf( '%s/../%s', dirname( __DIR__ ),  $path );
	$file = file( $filePath );

	// Update lines
	foreach ( $newLines as $index => $value ) {
		if ( ! empty( $value) ) {
			$file[$index] = $value . "\n";
		}
	}

	// Remove lines last to avoid index errors
	foreach ( $newLines as $index => $value ) {
		if ( empty( $value) ) {
			unset( $file[$index] );
		}
	}

	file_put_contents( $filePath, $file );
}
