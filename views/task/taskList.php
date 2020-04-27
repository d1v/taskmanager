<div class="card-header text-center">
	<h2>Task List</h2>
</div>

<div class="card-body">
	<a href="" id="addFormBtn" class="btn btn-primary">Add new Task</a>
	<table class="table mt-4 table-bordered table-striped table-hover container-fluid">
		<thead class="thead-dark">
		<tr class="d-flex text-center taskTable">
			<th scope="col" class="canSort col-1 text-dark bg-secondary">#</th>
			<th scope="col" class="canSort col-2"><a class="nav-link text-break text-white
				<? if (($arParams['sortField'] == 'name') && ($arParams['sortOrder'] == 'ASC')) {
					echo 'text-success';
				} elseif (($arParams['sortField'] == 'name') && ($arParams['sortOrder'] == 'DESC')) {
					echo 'text-danger';
				} ?>"
				href="?sortField=name&sortOrder=<? if (($arParams['sortField'] == 'name') && ($arParams['sortOrder'] == 'ASC')) {
					 echo 'DESC';
				 } else {
					 echo 'ASC';
				 } ?>&pageNum=<?= $arParams['pageNum']; ?>
					">Name</a></th>
			<th scope="col" class="canSort col-2"><a class="nav-link text-break text-white
					<? if (($arParams['sortField'] == 'email') && ($arParams['sortOrder'] == 'ASC')) {
					echo 'text-success';
				} elseif (($arParams['sortField'] == 'email') && ($arParams['sortOrder'] == 'DESC')) {
					echo 'text-danger';
				} ?>"
				href="?sortField=email&sortOrder=<? if (($arParams['sortField'] == 'email') && ($arParams['sortOrder'] == 'ASC')) {
					 echo 'DESC';
				 } else {
					 echo 'ASC';
				 } ?>&pageNum=<?= $arParams['pageNum']; ?>
					">Email</a></th>
			<th scope="col" class="canSort col-<? if (isset($arResult['admin'])) {
					echo 4;
				} else {
					echo 5;
				} ?>"><a class="nav-link text-break text-white
					<? if (($arParams['sortField'] == 'text') && ($arParams['sortOrder'] == 'ASC')) {
					echo 'text-success';
				} elseif (($arParams['sortField'] == 'text') && ($arParams['sortOrder'] == 'DESC')) {
					echo 'text-danger';
				} ?>"
				href="?sortField=text&sortOrder=<? if (($arParams['sortField'] == 'text') && ($arParams['sortOrder'] == 'ASC')) {
						 echo 'DESC';
					 } else {
						 echo 'ASC';
					 } ?>&pageNum=<?= $arParams['pageNum']; ?>
					">Text</a></th>
			<th scope="col" class="canSort col-1"><a class="nav-link text-break text-white
					<? if (($arParams['sortField'] == 'status') && ($arParams['sortOrder'] == 'ASC')) {
					echo 'text-success';
				} elseif (($arParams['sortField'] == 'status') && ($arParams['sortOrder'] == 'DESC')) {
					echo 'text-danger';
				} ?>"
				href="?sortField=status&sortOrder=<? if (($arParams['sortField'] == 'status') && ($arParams['sortOrder'] == 'ASC')) {
					 echo 'DESC';
				 } else {
					 echo 'ASC';
				 } ?>&pageNum=<?= $arParams['pageNum']; ?>
					">Status</a></th>
			<th scope="col" class="canSort col-1"><a class="nav-link text-break text-white
					<? if (($arParams['sortField'] == 'edited') && ($arParams['sortOrder'] == 'ASC')) {
					echo 'text-success';
				} elseif (($arParams['sortField'] == 'edited') && ($arParams['sortOrder'] == 'DESC')) {
					echo 'text-danger';
				} ?>"
				href="?sortField=edited&sortOrder=<? if (($arParams['sortField'] == 'edited') && ($arParams['sortOrder'] == 'ASC')) {
					 echo 'DESC';
				 } else {
					 echo 'ASC';
				 } ?>&pageNum=<?= $arParams['pageNum']; ?>
					">Edited</a></th>
			<? if (isset($arResult['admin'])): ?>
				<th scope="col" class="canSort col-1 text-dark bg-secondary"></th>
			<? endif; ?>
		</tr>
		</thead>
		<tbody>
		<? foreach ($arResult['taskList'] as $key => $task): ?>
			<tr class="d-flex <? if ($task['status'] == 1): ?>table-success<? endif; ?>">
				<td class="col-1 text-center">
					<?= $key; ?>
				</td>
				<td class="col-2 text-break">
					<p class="text-break"><?= $task['name']; ?></p>
				</td>
				<td class="col-2">
					<p class="text-break"><?= $task['email']; ?></p>
				</td>
				<td id='task-<?= $task['id'] ?>' data="<?= $task['text']; ?>"
				    class="col-<? if (isset($arResult['admin'])) {
						echo 4;
					} else {
						echo 5;
					} ?> align-middle">
					<p class="text-break"><?= $task['text']; ?></p>
				</td>
				<td class="col-1 text-center">
					<? if ($task['status'] == 1): ?>
						<p class="text-break">Done</p>
					<? endif; ?>
				</td>
				<td class="col-1 text-center">
					<? if ($task['edited'] == 1): ?>
						<p class="text-break">Edited by admin</p>
					<? endif; ?>
				</td>

				<? if (isset($arResult['admin'])): ?>
					<td class="col-1 align-middle text-center">
						<button type="submit" data="<?= $task['id'] ?>"
						        class="editFormBtn colBtn btn btn-primary btn-sm text-break">Edit
						</button>
						<? if ($task['status'] == 1): ?>
							<button type="submit" data="<?= $task['id'] ?>"
							        class="undoneBtn colBtn btn btn-danger btn-sm text-break">Undone
							</button>
						<? else: ?>
							<button type="submit" data="<?= $task['id'] ?>"
							        class="doneBtn colBtn btn btn-success btn-sm text-break">Done
							</button>
						<? endif; ?>
					</td>
				<? endif; ?>
			</tr>
		<? endforeach; ?>
		</tbody>
	</table>
	<nav aria-label="Page navigation example">
		<ul class="pagination justify-content-center">
			<? for ($i = 1; $i <= $arResult['pagination']['pageCount']; $i++): ?>
				<li class="page-item <? if ($arParams['pageNum'] == $i) {
					echo 'disabled';
				} ?>"><a class="page-link"
				         href="?sortField=<?= $arParams['sortField']; ?>&sortOrder=<?= $arParams['sortOrder']; ?>&pageNum=<?= $i ?>"><?= $i ?></a>
				</li>
			<? endfor; ?>
		</ul>
	</nav>
</div>

<!-- Add task modal -->
<div id='addTaskModal' class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title contentTitle">Add new task form</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span>X</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="addTaskForm">
					<input type='text' class="form-control" id='nameInput' placeholder="Name"/>
					<input type='email' class="form-control" id='emailInput' placeholder="Email"/>
					<textarea id="taskArea" class="form-control" placeholder="Task"></textarea>
					<button type="submit" id='addTaskBtn' formmethod="POST" class="btn btn-success">Submit</button>
				</form>
				<p id="contentError" class="redText"></p>
			</div>
		</div>
	</div>
</div>

<!-- Auth. modal -->
<div id='authModal' class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title contentTitle">Log in form</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span>X</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="authForm">
					<input type='text' class="form-control" id='loginInput' placeholder="Login" autofocus/>
					<input type='password' class="form-control" id='passwordInput' placeholder="Password"/>
					<button type="submit" id='authBtn' formmethod="POST" class="btn btn-success">Submit</button>
				</form>
				<p id="loginError" class="redText"></p>
			</div>
		</div>
	</div>
</div>

<!-- Edit task modal -->
<? if (isset($arResult['admin'])): ?>
	<div id='editTaskModal' class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
	     aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title contentTitle">Edit task form</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span>X</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="editTaskForm">
						<textarea id="editTaskArea" class="form-control" placeholder="Task"></textarea>
						<button type="submit" id='editTaskBtn' class="btn btn-success">Save</button>
					</form>
					<p id="editError" class="redText"></p>
				</div>
			</div>
		</div>
	</div>
<? endif; ?>