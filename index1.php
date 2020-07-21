<?php

$page = $_SERVER['PHP_SELF'];
$sec = "1";

$servername= '192.168.150.130';
$username= 'trackxDB_dbuser';
$password= 'EtCeMCPd8@Ugu3!6';
$db= 'trackxDB';

$conn = mysqli_connect($servername, $username, $password, $db);

$x= "SELECT rssi from test1 WHERE mac = 'AC233FC02137'ORDER BY id DESC LIMIT 1;";
$result = mysqli_query($conn, $x);
$a= mysqli_num_rows($result);
if (mysqli_num_rows($result) > 0) { 
    while($row = mysqli_fetch_assoc($result))
    $b = $row['rssi'];
    
    
    echo "<br>";
  
} else {
  echo "0 results";
}

$y= "SELECT rssi from test1 WHERE mac = 'AC233FC016D8'ORDER BY id DESC LIMIT 1;";
$result1 = mysqli_query($conn, $y);
$d= mysqli_num_rows($result1);
if (mysqli_num_rows($result1) > 0) { 
    while($row1 = mysqli_fetch_assoc($result1))
    $c = $row1['rssi'];
    
    
    echo "<br>";
  
} else {
  echo "0 results";
}
echo $b;
echo $c;
if($b > $c){
    echo "<h1>user is near gateway AC233FC02137</h1>";
}elseif($b < $c){
    echo "<h1>user is near gateway AC233FC016D8</h1>";
}elseif($b == $c){
    echo "<h1>user in middile</h1>";
}
?>

<html>
    <head>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    </head>
    <body>
    <?php
        echo "Watch the page reload itself in 1 second!";
    ?>
    </body>
</html>