<?php

require dirname( __DIR__ ) . '/vendor/autoload.php';

use Seld\CliPrompt\CliPrompt;

echo "\nWhat is the project's name: ";

$name = CliPrompt::prompt();

echo "\nUpdating package.json...";
$packageJsonPath = dirname( __DIR__ ) . '/package.json';
$packageJson = file( $packageJsonPath );
$packageJson[1] = sprintf( "  \"name\": \"%s\",\n", $name );
$packageJson[2] = "  \"version\": \"0.0.0\",\n";
file_put_contents( $packageJsonPath, $packageJson );

echo "\nUpdating README.md...";
$readmePath = dirname( __DIR__ ) . '/README.md';
$readme = file( $readmePath );
$readme[0] = sprintf( "# %s\n", $name );
file_put_contents( $readmePath, $readme );
echo PHP_EOL;
