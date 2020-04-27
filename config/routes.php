<?php
/**
 * Routes config
 *
 * actionList in TaskController (by default) define in components/Router.php
 */

return array(
	'addTask' => 'task/add', // actionAdd in TaskController
	'login' => 'user/login',
	'logout' => 'user/logout',
	'doneTask' => 'task/done',
	'undoneTask' => 'task/undone',
	'editTask' => 'task/edit' // actionEdit in TaskController
);