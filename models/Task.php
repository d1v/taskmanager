<?php
/**
 * Model Task
 */

class Task
{
	/**
	 *  Returns an array of task items
	 * @return array
	 */
	public static function getTaskList(array $arParams = array('sortField' => 'id', 'sortOrder' => 'ASC', 'pageNum' => 1))
	{
		$taskList = array();
		$cleaned = array();
		$i = 1;

		$db = Db::getConnection();

		$page = intval($arParams['pageNum']);
		$offset = ($page - 1) * PAGE_LIMIT;

		$result = $db->query('SELECT * FROM tasks 
			ORDER by ' . $arParams['sortField'] . ' ' . $arParams['sortOrder']
			. ' LIMIT ' . PAGE_LIMIT
			. ' OFFSET ' . $offset);
		$result->setFetchMode(PDO::FETCH_ASSOC);

		while ($row = $result->fetch()) {
			$taskList[$offset + $i] = $row;
			$i++;
		}

		// use htmlspecialchars for result
		foreach ($taskList as $key => $task) {
			$cleaned[$key] = array_map("htmlspecialchars", $task);
		}

		return $cleaned;
	}

	/**
	 * Returns total tasks count
	 * @return int
	 */
	public static function getTotalTasksCount()
	{
		$db = Db::getConnection();
		$result = $db->query('SELECT count(id) AS count FROM tasks');
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$row = $result->fetch();
		return $row['count'];
	}

	/**
	 *    Add new task
	 * @return boolean
	 */
	public static function addTask($name, $email, $text)
	{
		$db = Db::getConnection();
		$sql = 'INSERT INTO tasks (name, email, text) VALUES (:name, :email, :text)';
		$result = $db->prepare($sql);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':text', $text, PDO::PARAM_STR);
		return $result->execute();
	}

	/**
	 *    Complete task
	 * @return boolean
	 */
	public static function doneTask($id)
	{
		$db = Db::getConnection();
		$sql = 'UPDATE tasks SET status = 1 WHERE id = :id';
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_STR);
		return $result->execute();
	}

	/**
	 *    Uncomplete task
	 * @return boolean
	 */
	public static function undoneTask($id)
	{
		$db = Db::getConnection();
		$sql = 'UPDATE tasks SET status = 0 WHERE id = :id';
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_STR);
		return $result->execute();
	}

	/**
	 *    Edit task
	 * @return boolean
	 */
	public static function editTask($id, $newText)
	{
		$db = Db::getConnection();
		$sql = 'UPDATE tasks SET text = :newText, edited = 1 WHERE id = :id';
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_STR);
		$result->bindParam(':newText', $newText, PDO::PARAM_STR);
		return $result->execute();
	}

	/**
	 *    Check text on change
	 * @return boolean
	 */
	public static function checkText($id, $newText)
	{
		$db = Db::getConnection();
		$sql = 'SELECT text FROM tasks WHERE id = :id';
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_STR);
		$result->execute();
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$row = $result->fetch();
		if ($row['text'] == $newText) {
			return false;
		} else {
			return true;
		}
	}

}
