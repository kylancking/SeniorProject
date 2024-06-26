<?php

	session_start();
	
	$now = time();
	if (isset($_SESSION["discard_after"]) && $now > $_SESSION["discard_after"]) {
		session_unset();
		session_destroy();
		session_start();
	}

	$_SESSION["discard_after"] = $now + 360;

function message() {
		if (isset($_SESSION["message"])) {
			
			$output = "<div class='row'>";
			$output .= "<div data-alert class='alert-box info round'>";
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";
			$output .= "</div>";
			
			// clear message after use
			$_SESSION["message"] = null;
			
			return $output;
		}
		else {
			return null;
		}
	}

	function errors() {
		if (isset($_SESSION["errors"])) {
			$errors = $_SESSION["errors"];
			
			// clear message after use
			$_SESSION["errors"] = null;
			
			return $errors;
		}
	}
