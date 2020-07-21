<?php
//require ("/var/www/html/vendor/thingengineer/mysqli-database-class/MysqliDb.php");
$json = file_get_contents("php://input");
$obj = json_decode($json);
$mac = $obj[0]->mac;
for($x=1;$x<sizeof($obj);$x++){
$timestamp = $obj[$x]->timestamp;

$rssi = $obj[$x]->rssi;
$bcon = $obj[$x]->mac;
$corrent = $rssi;



$servername= '192.168.150.130';
$username= 'trackxDB_dbuser';
$password= 'EtCeMCPd8@Ugu3!6';
$db= 'trackxDB';

$conn = mysqli_connect($servername, $username, $password, $db);

//Insertion the data sent from the gateway


$sql = "INSERT INTO test1(timestamp, mac, rssi, bcon)
    VALUES('$timestamp', '$mac','$rssi', '$bcon');";
if (mysqli_query($conn, $sql))
{
        //echo "New record created successfully";
    } else
    {
        //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


}
$x= "SELECT rssi from test1 WHERE mac = 'AC233FC02137'ORDER BY id DESC LIMIT 1;";
$result = mysqli_query($conn, $x);
$a= mysqli_num_rows($result);
if (mysqli_num_rows($result) > 0)
{ 
    while($row = mysqli_fetch_assoc($result))
        $b = $row['rssi'];
        echo "<br>";
  
} else 
{
  echo "0 results";
}



$y= "SELECT rssi from test1 WHERE mac = 'AC233FC016D8'ORDER BY id DESC LIMIT 1;";
$result1 = mysqli_query($conn, $y);
$d= mysqli_num_rows($result1);
if (mysqli_num_rows($result1) > 0)
{ 
    while($row1 = mysqli_fetch_assoc($result1))
    $c = $row1['rssi'];  
    echo "<br>";
} else 
{
  echo "0 results";
}
echo $b;
echo $c;
if($b > $c){
    echo "<h1>user is near gateway AC233FC02137</h1>";
    $sql1= "SELECT gmac FROM test; ";
    $result2 = mysqli_query($conn, $sql1);
    $a= mysqli_num_rows($result2);
    echo $a;
    if (mysqli_num_rows($result2) == 0) 
    { 
        
        
        $sql2 = "INSERT INTO test( timestamp,gmac,rssi,bmac )
           VALUES('$timestamp','$mac','$rssi','$bcon')";
        if (mysqli_query($conn, $sql2)) 
        {
            echo "New record created successfully in test 2";
        } else
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
    } elseif(mysqli_num_rows($result2) > 0)
    {
        while($row = mysqli_fetch_assoc($result2)) 
        {  
        print_r($row);
            $corrent_gateway = $row['gmac'];
            echo "<br>";
        }
        echo "hai" . $corrent_gateway;
        if($corrent_gateway != 'AC233FC02137' )
        {
            $sql3 = "INSERT INTO test( timestamp,gmac,rssi,bmac )
           VALUES('$timestamp','$mac','$rssi','$bcon')";
        if (mysqli_query($conn, $sql3)) 
        {
            echo "New record created successfully in test 2";
        } else
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        }
  
    }
}elseif($b < $c)
{
    echo "<h1>user is near gateway AC233FC016D8</h1>";
    
    $sql4= "SELECT gmac FROM test; ";
    $result3 = mysqli_query($conn, $sql4);
    $a= mysqli_num_rows($result3);
    if (mysqli_num_rows($result3) == 0) 
    { 
        
        
        $sql5 = "INSERT INTO test( timestamp,gmac,rssi,bmac )
           VALUES('$timestamp','$mac','$rssi','$bcon')";
        if (mysqli_query($conn, $sql5)) 
        {
            echo "New record created successfully in test 2";
        } else
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
    } elseif(mysqli_num_rows($result3) > 0)
    {
        while($row2 = mysqli_fetch_assoc($result3))
        //foreach($rus) 
        { 
            print_r($row2);
            $corrent_gateway1 = $row2['gmac'];            
        } 
        echo $corrent_gateway1;
        if($corrent_gateway1 != 'AC233FC016D8' )
        {
            $sql6 = "INSERT INTO test( timestamp,gmac,rssi,bmac )
           VALUES('$timestamp','$mac','$rssi','$bcon')";
        if (mysqli_query($conn, $sql6)) 
        {
            echo "New record created successfully in test 2";
        } else
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        }
  
    }
}elseif($b == $c)
{
    echo "<h1>user in middile</h1>";
}
?>

