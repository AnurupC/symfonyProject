<?php 
session_start();
echo "the session data that has been stored is : ";
echo "<br>";
echo $_SESSION['session_data'];

if(isset($_REQUEST['sess_end'])){

    //setcookie to destroy the PHPSESSID
    setcookie("PHPSESSID", "", time() - 3600);
    
    session_unset();
    session_destroy();
    echo "<script> location.href= 'testing.php' </script>";
}
?>

<!DOCTYPE html>
<html>
<body>

    <form method="POST">
        <input type="submit" name="sess_end" value="End Session">
    </form>
    

</body>
</html>