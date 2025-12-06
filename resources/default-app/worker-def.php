#!/usr/bin/env php

<?php 

$cwd = $_SERVER["PWD"];
$app_files_dir = "$cwd/.app-files/";

function help() {
	global $argv;
	// echo "Usage: ". $argv[0] . " [OPTION]... [SUB-OPTION]... \n\n";
	echo "Usage: worker [OPTION]... [SUB-OPTION]... \n\n";
	echo "option:\n";
	echo "\tinstall - Install App from Given [DIRECTORY-PATH]\n";
	echo "\tuninstall - Completely Remove App and It's Files\n";
	echo "\tinit - Initialise Current Directory for worker\n";
	echo "\thelp - Show This Message\n";
	echo "\n";
	echo "sub-option:\n";
	echo "\tinstall:\n";
	echo "\tUse Case: install [PATH] [APP]\n";
	echo "\t  [PATH] - Give path for Directory containing appfiles\n";
	echo "\t  [APP] - Appname for symlink\n";
}

function uninstall() {
	if (isset($argv[2])) {
		if (!file_exists($argv[2])) {
			echo "\"$argv[2]\" is not Installed, so not uninstalled\n";
		} else {
			echo "Uninstalling... $argv[2]\n";
		}
	} else {
		echo "Please! Provide App Name\n";
	}
}

if (count($argv) == 1) {
	help();
} else {
	if ($argv[1] == "install") {
		if (isset($argv[2]) && isset($argv[3])) {
			// if (str_starts_with($argv[2], "/")) {
			// 	$argv[2] = substr($argv[2], 1);
			// }
			if (str_ends_with($argv[2], "/")) {
				$argv[2] = substr($argv[2], 0 , count_chars($argv[2] - 1));
				echo $argv[2];
			} else {
				$argv[2] = $argv[2] . "/";
			}
			$app_dir = $app_files_dir . $argv[2];
			echo "App Directory: $app_dir\n";
			echo "App Name: $argv[3]\n";
			if (is_dir($app_files_dir . $argv[2])) {
				echo "Directory Already Exists with same name!\n";
			} elseif (file_exists($argv[3])) {
				echo "App Already Exists\n";
			} else {
				echo "Installing... \"$argv[3]\"!\n";
				// $making_dir = mkdir($app_files_dir . $argv[2]);
				$making_dir = shell_exec("mkdir $app_files_dir" . $argv[2]);
			}
		} else {
			echo "Please! Provide Both: Path Name and App Name\n";
			// echo "Use case: php $argv[0] install [PATH] [APP]\n";
			echo "Use case: php worker install [PATH] [APP]\n";
		}
	} elseif ($argv[1] == "uninstall") {
		uninstall();
	} elseif ($argv[1] == "help") {
		help();
	} elseif ($argv[1] == "init") {
		echo "Initialising Current Directory for worker!\n";
		if (is_dir($app_files_dir)) {
			echo "Directory : '" . $app_files_dir . "' Exists already!\n";
		} else {
			mkdir($app_files_dir);
		}
	} else {
		echo "unknown option: $argv[1]\n\n";
		help();
	}
}

?>
