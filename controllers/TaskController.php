<?php
/**
 * Task Controller
 */

class TaskController
{
	public static function render($viewName, array $arResult, array $arParams)
	{
		require_once(ROOTPATH . '/views/layouts/header.php');
		require_once(ROOTPATH . '/views/task/' . $viewName . '.php');
		require_once(ROOTPATH . '/views/layouts/footer.php');
	}

	/**
	 * @param array $arParams
	 *
	 * @return bool
	 */
	public function actionList(array $arParams)
	{
		$arResult = array();
		$pageCount = 0;

		if (!(isset($arParams['sortField']))) {
			$arParams['sortField'] = 'id';
		}

		if (!(isset($arParams['sortOrder']))) {
			$arParams['sortOrder'] = 'ASC';
		}

		if (!(isset($arParams['pageNum']))) {
			$arParams['pageNum'] = 1;
		}

		$arResult['taskList'] = Task::getTaskList($arParams);
		$totalTasksCount = Task::getTotalTasksCount();

		if ($totalTasksCount != 0) {
			if (($totalTasksCount % PAGE_LIMIT) == 0) {
				$pageCount = intval(($totalTasksCount) / PAGE_LIMIT);
			} else {
				$pageCount = intval(($totalTasksCount) / PAGE_LIMIT) + 1;
			}
		}

		if (UserController::checkLogged() == true) {
			$arResult['admin'] = true;
		}

		$arResult['pagination']['pageCount'] = $pageCount;
		$this::render('taskList', $arResult, $arParams);
		return true;
	}

	public function actionAdd()
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$text = $_POST['text'];

		if ($name == '') {
			$error = 'Please use correct name.';
			echo json_encode(['error' => $error]);
			die();
		}

		if (($email == '') || !(filter_var($email, FILTER_VALIDATE_EMAIL))) {
			$error = 'Please use correct email.';
			echo json_encode(['error' => $error]);
			die();
		}

		if ($text == '') {
			$error = 'Please use correct task\'s text.';
			echo json_encode(['error' => $error]);
			die();
		}

		$result = Task::addTask($name, $email, $text);

		if ($result) {
			echo json_encode(['message' => 'success']);
		} else {
			$error = 'Failed to add task!';
			echo json_encode(['error' => $error]);
			die();
		}
	}

	public function actionDone()
	{
		if (UserController::checkLogged() == true) {
			$id = $_POST['id'];
			$result = Task::doneTask($id);
			if ($result) {
				echo json_encode(['message' => 'success']);
			} else {
				$error = 'Failed to complete task!';
				echo json_encode(['error' => $error]);
				die();
			}
		} else {
			$error = 'auth';
			echo json_encode(['error' => $error]);
		}

	}

	public function actionUndone()
	{
		if (UserController::checkLogged() == true) {
			$id = $_POST['id'];
			$result = Task::undoneTask($id);
			if ($result) {
				echo json_encode(['message' => 'success']);
			} else {
				$error = 'Failed to uncomplete task!';
				echo json_encode(['error' => $error]);
				die();
			}
		} else {
			$error = 'auth';
			echo json_encode(['error' => $error]);
		}
	}

	public function actionEdit()
	{
		if (UserController::checkLogged() == true) {
			$id = $_POST['id'];
			$newText = $_POST['newText'];

			if ($newText == '') {
				$error = 'Please use correct task\'s text.';
				echo json_encode(['error' => $error]);
				die();
			}

			if (Task::checkText($id, $newText)) {
				$result = Task::editTask($id, $newText);

				if ($result) {
					echo json_encode(['message' => 'success']);
				} else {
					$error = 'Failed to edit task!';
					echo json_encode(['error' => $error]);
					die();
				}
			} else {
				$error = 'Text wasn\'t modified';
				echo json_encode(['error' => $error]);
				die();
			}
		} else {
			$error = 'auth';
			echo json_encode(['error' => $error]);
		}
	}
}