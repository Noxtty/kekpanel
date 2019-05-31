<?php
function email ($to, $subject, $body) {
	mail($to, $subject, $body, 'From: noreply@kekpanel.com');
}
function already_logged() {
	if (logged_in() === true) {
		header('Location: panel.php');
		exit();
	}
}
function protected_page() {
	if (logged_in() === false) {
		header('Location: protected.php');
		exit();
	}
}

function admin_protect() {
	global $user_data;
	if (has_access($user_data['user_id'], 1) === false) {
		header('Location: panel.php');
		exit();
	}
}

function moderator_protect() {
	global $user_data;
	if (has_access($user_data['user_id'], 1 AND 2) === false) {
		header('Location: panel.php');
		exit();
	}
}
function array_sanitize(&$item) {
	$item = htmlentities(strip_tags(mysql_real_escape_string($item)));
}
function sanitize($data) {
	return htmlentities(strip_tags(mysql_real_escape_string($data)));
}

function output_errors($errors) {
	return '<ul class="errors"><li>' . implode('</li><li>', $errors) . '</li></ul>';
}
?>