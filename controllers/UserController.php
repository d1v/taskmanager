<?php
/**
 * User Controller
 */

class UserController
{
	public static function actionLogin()
	{
		$login = $_POST['login'];
		$password = $_POST['password'];

		if (($login != 'admin') || ($password != '123')) {
			$error = 'Access denied! Please check your login and password.';
			echo json_encode(['error' => $error]);
			die();
		}

		$_SESSION['user'] = 'admin';
		echo json_encode(['message' => 'success']);
		die();
	}

	public static function actionLogout()
	{
		unset($_SESSION['user']);
		header("Location: /");
	}

	/**
	 * @return bool
	 */
	public static function checkLogged()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}

		return false;
	}
}