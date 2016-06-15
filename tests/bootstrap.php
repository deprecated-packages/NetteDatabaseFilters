<?php

include __DIR__ . '/../vendor/autoload.php';

$tempDir = __DIR__ . '/temp';

define('TEMP_DIR', $tempDir);
@mkdir(TEMP_DIR, 0777, TRUE);

register_shutdown_function(function () {
	Nette\Utils\FileSystem::delete(TEMP_DIR);
});

// turns off needless errors for Nette\Database cache
error_reporting(0);
