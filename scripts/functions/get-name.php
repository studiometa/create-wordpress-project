<?php

namespace Studiometa\WPInstaller;

use Seld\CliPrompt\CliPrompt;

function getName() {
	echo "\nWhat is the project's name: ";
	return CliPrompt::prompt();
}
