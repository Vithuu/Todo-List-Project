<!------------ Test Session Starts ---------------->

<?php
	
	//importing all the test functions from testfunctions.php'
	include 'testfunctions.php';

	//Title
	echo "<b>TEST SESSION</b>";

	//CONNECTION TO DATABASE
	echo "<br/><br/><b>Test_connection_database: </b>";
	connectDB();

	echo "<br/><b>Test_connection_database_failed: </b>";
	connectDB_failed();

	//GETTING ALL TASKS
	echo "<br/>Test_get_all_tasks: ";
	getTasks();

	echo "<br/>Test_get_all_tasks_failed: ";
	getTasks_failed();

	//ADDING TASK
	echo "<br/>Test_add_task: ";
	addTask();

	echo "<br/>Test_add_task_failed: ";
	addTask_failed();

	//DELETING TASK
	echo "<br/>Test_delete_task: ";
	deleteTask();

	echo "<br/>Test_delete_task_failed: ";
	deleteTask_failed();

	//DISCONNECTION FROM DATABASE
	disconnectDB();

	disconnectDB_failed();

?>