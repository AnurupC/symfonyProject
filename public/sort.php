<?php
$arr = array(1,2,3,5,3,21,3,4,5);
for($x=0;$x<=count($arr);$x++)
{
    for($j=0;$j<(count($arr)-1);$j++)
    {
        if($arr[$j] > $arr[$x])
        {
            $t = $arr[$j];
            $arr[$j] = $arr[$j+1];
            $arr[$j+1] = $t;
        }
    }
    //print_r($arr);
}
print_r($arr);
?>