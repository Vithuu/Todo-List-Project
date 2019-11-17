<!---------------------- TODO LIST ---------------------------->
<?php 
    session_start();

    //Identify our database
    $database = "todo_list";

    //Connect to our database
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    //Case database found
    if($db_found){

        //Case Add Task button clicked
        if (isset($_POST['add'])) {   
            //Get the data entered (Reminder: $_POST = "name" is linked to the name of the <input> of the HTML page)
            $task = isset($_POST["task"])? $_POST["task"] : "";

            //Check if empty
            if(!empty($_POST['task'])) {
                //Check if more than 255 characters 
                if(strlen($task) <= 255) {

                    //Check if this task is already in "list" table of our database
                    $sql = "SELECT * FROM list";
                    //If task input is not empty
                    if ($task != ""){ 
                        //Search for the same task
                        $sql .= " WHERE Task = '$task'";  
                    }
                    //If this task is not already inside "list" table
                    $result = mysqli_query($db_handle, $sql);
                    if (mysqli_num_rows($result) == 0) { 

                        //Add new task to "list" table of our database
                        $sql = "INSERT INTO list(Task) 
                                VALUES ('$task')";
                        $result = mysqli_query($db_handle, $sql);
                        $error = "Task added successfully. ";
                    }
                    else{
                        $error = "This task already exists !";
                    }
                }
                else{
                    $error = "Task must not exceed 255 characters !";
                }
            }
            else{
                $error = "Write the new task to do !";
            }
        }
    
?>

<html>
<head>
    <title>ToDo List</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div >
        <h2> ToDo List </h2>

        <form method="post" action="">

            <!--TODO LIST-->
            <table>
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Tasks</th>
                    <th scope="col">Done</th>
                </tr>
            <br/>

            <?php 

            //Getting all tasks
            $sql = "SELECT * FROM list";
            $tasks = mysqli_query($db_handle,$sql);
            $i = 1; 

            //Displaying all tasks
            while ($row = mysqli_fetch_array($tasks)) { ?>
                <tr>
                    <th scope="row"> <?php echo $i; ?> </th>
                    <td> <?php echo $row['Task']; ?> </td>
                    <td class="delete"> 
                        /<!--Delete button-->
                        <a href="todolist.php?del_task=<?php echo $row['ID'] ?>">x</a> 
                    </td>
                </td>          
                </tr>
                <br/>
            <?php $i++; 
            }

            // Delete task
            if (isset($_GET['del_task'])) {
                $id = $_GET['del_task'];

                $sql00 = "DELETE FROM list WHERE ID=".$id;
                mysqli_query($db_handle, $sql00);
                header('location: todolist.php');
            }

            ?>
            

            <!--ADDING A NEW TASK-->
            <table>
                <br/><br/>
                <tr>
                    <td><br/>
                        <!-- value to let displayed what has been entered--> 
                        <input type="text" placeholder="Task to do" name="task" value="<?php if(isset($task)) { echo $task; } ?>">
                    </td> 
                    
                        <!--Adding task button-->
                        <td align="center"><br/>
                        <input type="submit" name="add" value="Add Task"></td>
                    
                </tr>
            </table>

        </form>

        <?php
            //Display message in error case
            if(isset($error)) {
                echo '<font color="red">'.$error."</font>";
            }
        ?>
    </div>
</body>
</html>

<!-- CLOSING CONNECTION TO DATABASE -->
<?php    
//Display error message if database not found
} 
else {
     echo "Database not found.";
}
mysqli_close($db_handle);
?>