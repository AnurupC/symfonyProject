<?php
    session_start();
    global $sess_id;
    $sess_id = session_id();
    $session_data = $_REQUEST['session_data'];
    $_SESSION['session_data'] = $session_data;
    
?>
<!DOCTYPE html>
<html>
<body>

<?php
    include_once 'include.php';
    
    if(isset($_POST['button1'])){
        
        //$sql is the query to be executed
        $sql = "select * from first_table";

        //now executing the query and saving the content in result
        $result = mysqli_query($conn,$sql);
        
        //checking if the number of rows extracted from the table is more than 0
        //basicaly checking if the mysqli_query() got us any rows or not
        if(mysqli_num_rows($result)>0){
            
            //tabular representation
            echo '<table>';
            echo '<thead>';
                echo '<tr>';
                echo '<th>ID</th>';
                echo '<th>Session Name</th>';
                echo '<th>Phone</th>';
                echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                    echo "<td>".$row["id"]."</td>";
                    echo "<td>".$row["session_name"]."</td>";
                    echo "<td>".$row["phone"]."</td>";
                echo "</tr>";
            }
            echo '</tbody>';
            echo '</table>';
        }
    }

    if(isset($_POST['button2'])){
        
        $session_data = mysqli_real_escape_string($conn,$_POST['session_data']);
        
        $sql = "select * from first_table WHERE sess_id = '$sess_id'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0)
        {            
            $sql = "UPDATE first_table SET session_data = '$session_data' WHERE sess_id = '$sess_id';";
            $result = mysqli_query($conn,$sql);
        }
        else
        {
            $sql = "INSERT INTO  first_table ( session_data , sess_id) values('$session_data','$sess_id');";
            $result = mysqli_query($conn,$sql);    
        }
        echo "<script> location.href='welcome.php'</script>";
    }
    
?>
    <form method="POST">
        <input type="text" name ="session_data" placeholder="session data">
        <br><br>
        <input type="submit" name="button1" value="Get session data">
        <input type="submit" name="button2" value="Insert session data">

    </form>
    

</body>
</html>



