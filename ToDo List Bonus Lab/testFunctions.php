<!------------------- Test Functions ----------------------->

<!-- Test Successful Connection to Database -->
<?php

//Test if we can get the every task from the database
function getTasks(){

    //connection to the database
	session_start();
    //Identify our database
    $database = "todo_list";
    //Connect to our database
    $db_handle = mysqli_connect('localhost', 'root', '');
    $conn = mysqli_select_db($db_handle, $database);

    //If connected
	if($conn){

        //Search for tasks 
        $sql0 = "SELECT * FROM list ";
        $result = mysqli_query($db_handle,$sql0);

        //Starting from ID n°1
        $id = 1;
        //Variable which will indicate if all have been done succesfully
        $error = 0;

        //If we got some result
        while($row = mysqli_fetch_array($result)){   
            //Check if ID we got is the same as $id 
            if($row['ID'] == $id){
                //If yes, increment ID
            	$id++;	
            }
            else { 
	            //Otherwise, increment indicator
	            $error++;
	        }
        } 
        //If all have been done successfully PASSED
        if($error == 0){
        	echo "<font color='green'><b>"."PASSED"."</b></font>\n";
        }
        else{
        	echo "<font color='red'><b>"."FAILED"."</b></font>\n";
        }
        
    }
    //Close opened database connection
    mysqli_close($db_handle);
}

//Test if we can not get all tasks from the database (because error on the ID $id which starts from "999")
function getTasks_failed(){

    //connection to the database
    //Identify our database
    $database = "todo_list";
    //Connect to our database
    $db_handle = mysqli_connect('localhost', 'root', '');
    $conn = mysqli_select_db($db_handle, $database);

    //If connected
	if($conn){

        //Search for tasks 
        $sql0 = "SELECT * FROM list ";
        $result = mysqli_query($db_handle,$sql0);

        //Starting from ID n°1
        $id = 999;
        //Variable which will indicate if all have been done succesfully
        $error = 0;

        //If we got some result
        while($row = mysqli_fetch_array($result)){   
            //Check if ID we got is the same as $id 
            if($row['ID'] == $id){
                //If yes, increment ID
            	$id++;	
            }
            else { 
	            //Otherwise, increment indicator
	            $error++;
	        }
        } 
        //If process failed, test PASSED
        if($error == 0){
        	echo "<font color='red'><b>"."FAILED"."</b></font>\n";
        }
        else{
        	echo "<font color='green'><b>"."PASSED"."</b></font>\n";
        }
        
    }
    //Close opened database connection
    mysqli_close($db_handle);
}

//Test if a new task is added successfully
function addTask(){

    //connection to the database
    //Identify our database
    $database = "todo_list";
    //Connect to our database
    $db_handle = mysqli_connect('localhost', 'root', '');
    $conn = mysqli_select_db($db_handle, $database);

    //If connected
	if($conn){

        //Add new task to "list" table of our database
        $task = "Study DevOps for exam";
        $sql = "INSERT INTO list(Task) VALUES ('$task')";
        $result = mysqli_query($db_handle, $sql);

        //Search for added task 
        $sql0 = "SELECT * FROM list WHERE Task = '$task'";
        $result2 = mysqli_query($db_handle,$sql0);

        //If we got some result
        if(mysqli_num_rows($result2)){   
            $data = mysqli_fetch_array($result2);
            //Check if task added exists inside database
            if($data['Task'] == $task){
                //If yes, test PASSED
				echo "<font color='green'><b>"."PASSED"."</b></font>\n";
			}
			else{
                //Else, test FAILED
        		echo "<font color='red'><b>"."FAILED"."</b></font>\n";
        	}
        }
    }
    //Close opened database connection
    mysqli_close($db_handle);
}

//Test if a new task couldn't be added (Fails because $taskError added intead of $task)
function addTask_failed(){

    //Connection to database
    //Identify our database
    $database = "todo_list";
    //Connect to our database
    $db_handle = mysqli_connect('localhost', 'root', '');
    $conn = mysqli_select_db($db_handle, $database);

    //If connected
	if($conn){

        //Add new task to "list" table of our database
        //Correct task 
        $task = "Study DevOps for exam";
        //Wrong task
        $taskError = "Study Maths"; 

        //Add the wrong task
        $sql = "INSERT INTO list(Task) VALUES ('$taskError')";
        $result = mysqli_query($db_handle, $sql);

        //Search for added task 
        $sql0 = "SELECT * FROM list WHERE Task = '$task'";
        $result2 = mysqli_query($db_handle,$sql0);

        //If we got some result
        if(mysqli_num_rows($result2)){   
            $data = mysqli_fetch_array($result2);
            //Check if task added exists inside database
            if($data['Task'] == $task){
                //If yes, Test FAILED
				echo "<font color='green'><b>"."PASSED"."</b></font>\n";
			}
			else{
                //If no, Test PASSED
        		echo "<font color='red'><b>"."FAILED"."</b></font>";
        	}
        }
    }
    //Close opened database connection
    mysqli_close($db_handle);
}

//Test if we can delete a task successfully
function deleteTask(){

    //Conection to database
    //Identify our database
    $database = "todo_list";
    //Connect to our database
    $db_handle = mysqli_connect('localhost', 'root', '');
    $conn = mysqli_select_db($db_handle, $database);

    //If connected
	if($conn){

        //Delete task from "list" table of our database
        $task = "Study DevOps for exam";
        $sql00 = "DELETE FROM list WHERE Task= '$task'";
        mysqli_query($db_handle, $sql00);

        //Search for specific task 
        $sql0 = "SELECT * FROM list WHERE Task = '$task'";
        $result2 = mysqli_query($db_handle,$sql0);

        //If we got some result (so we can still find the task)
        if(mysqli_num_rows($result2)){   
            //Test FAILED
			echo "<font color='red'><b>"."FAILED"."</b></font>\n";
		}	
		else{
            //Test PASSED
    		echo "<font color='green'><b>"."PASSED"."</b></font>\n";
    	}
    }
    //Close opened database connection
    mysqli_close($db_handle);
}

//Test if we couldn't delete a task (Fails because we deleted a wrong task that does not exist)
function deleteTask_failed(){

    //Connection to database
    //Identify our database
    $database = "todo_list";
    //Connect to our database
    $db_handle = mysqli_connect('localhost', 'root', '');
    $conn = mysqli_select_db($db_handle, $database);

    //If connected
	if($conn){

        //Delete task from "list" table of our database
        $task = "Study Maths";
        $taskError = "Pratice piano";
        $sql00 = "DELETE FROM list WHERE Task= '$taskError'";
        mysqli_query($db_handle, $sql00);

        //Search for added task 
        $sql0 = "SELECT * FROM list WHERE Task = '$task'";
        $result2 = mysqli_query($db_handle,$sql0);

        //If we got some result (so we can still find the task)
        if(mysqli_num_rows($result2)){ 
            //Test PASSED
        	echo "<font color='green'><b>"."PASSED"."</b></font>\n";
		}	
		else{
            //Test FAILED
    		echo "<font color='red'><b>"."FAILED"."</b></font>\n";
    	}
    }
    //Close opened database connection
    mysqli_close($db_handle);
}

//Test the connection to the database
function connectDB(){
	// Connect to our database
	$conn = mysqli_select_db(mysqli_connect('localhost', 'root', ''), "todo_list");

	// Check connection
	if (!$conn) {
        //If connected, Test PASSED
	    echo"<font color='red'><b>"."FAILED"."<b/></font>\n";
	}
	else{
        //Otherwise, Test FAILED
		echo "<font color='green'><b>"."PASSED"."</b></font>\n";
	}

}

//Test a failure when connecting to database
function connectDB_failed(){
	// Failure when connecting to our database (error on database name "_" missing)
	$conn = mysqli_select_db(mysqli_connect('localhost', 'root', ''), "todolist");

	// If not connected (which is supposed to be the case here)
	if (!$conn) {
        //Test PASSED
	    echo("<font color='green'><b>"."PASSED"."<b/></font>\n");
	}
	else{
        //Test FAILED
		echo "<font color='red'><b>"."FAILED"."</b></font>\n";
	}

}

//Test the disconnection to the database
function disconnectDB(){

    //Connection to database
    $conn = mysqli_select_db(mysqli_connect('localhost', 'root', ''), "todo_list");

	//Close a previously opened database connection
	$disconn = mysqli_close(mysqli_connect('localhost', 'root', ''));

	// If disconnected
	if ($disconn) {
        //Test PASSED
	    echo"<br/>Test_disconnection_database: <font color='green'><b>"."PASSED"."<b/></font>\n";
	}
	else{
        //Test FAILED
		echo "<br/>Test_disconnection_database: <font color='red'><b>"."FAILED"."</b></font>\n";
	}
}

//Test a failure when disconnecting to database
function disconnectDB_failed(){

    //Connection to database
	$conn = mysqli_select_db(mysqli_connect('localhost', 'root', ''), "todo_list");

	//Close a previously opened database connection (error on user "rooooot")
	$disconn = mysqli_close(mysqli_connect('localhost', 'rooooot', ''));
	// If not disconnected
	if (!$disconn) {
        //Test PASSED
	    echo"<br/>Test_disconnection_database_failed: <font color='green'><b>"."PASSED"."<b/></font>\n";
	}
	else{
        //Test FAILED
		echo "<br/>Test_disconnection_database: <font color='red'><b>"."FAILED"."</b></font>\n";
	}
}

?>


