<?php
ob_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>
        Output Buffering Testing
    </title>
</head>
<body>
    <h1>lets see if this works</h1>
    <p>this is the html for Fruits</p>
</body>
</html>

<?php

$contents = ob_get_contents();
$contents = str_replace("Fruits","Vegetables",$contents);
print_r($contents);

?>