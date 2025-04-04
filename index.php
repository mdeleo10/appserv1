<?php
/*
 phpinfo();
 */

// Add Local hostname to header for Frontdoor or other load balacing testing
$exec_str = "hostname";
//echo "Your exec_str is ", $exec_str, "<br>";
$host_name = exec($exec_str,$test);
echo "<head>";
echo "<title>",$host_name,"</title>";
echo "</head>";

if (!empty($_SERVER['HTTP_CLIENT_IP']))
  {
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
  }
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
  {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
//whether ip is from remote address
else
  {
    $ip_address = $_SERVER['REMOTE_ADDR'];
  }

$ip_address_final = $ip_address;
echo "This site supports IPv4 and IPv6 connectivity.<br>";
echo "Let us see if you are connecting with an IPv4 or IPv6 address..<br>";
//echo "Your IP address is ", $ip_address, "<br>";

//Fix IP Address
// $exec_str = "echo $ip_address | awk -F ':' '{print $1}'";
//Fix for IPv4 test
/// echo 
//$exec_str = "echo $ip_address | awk '{match($0,/[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+/); ip = substr($0,RSTART,RLENGTH); print ip}'";
// $ip_address = exec($exec_str,$test);
//echo "Your IPv4 address is ", $ip_address, "<br>";

//Reset for IPv6 testing
$ip_address = $ip_address_final;
$exec_str = "echo $ip_address | awk -F'[][]' '{print $2}'";
$ip_address = exec($exec_str,$test);

// If IP_ADDRESS has square brackets it is an IPv6 valid address, no need to check type
if (!empty($ip_address))
    {
echo "Your IPv6 address is ", $ip_address, "<br>";
    }
else
   { 
    $ip_address = $ip_address_final;
    $exec_str = "echo $ip_address | awk '{match($0,/[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+/); ip = substr($0,RSTART,RLENGTH); print ip}'";
    $ip_address = exec($exec_str,$test);
    echo "Your IPv4 address is ", $ip_address, "<br>";
   }

$exec_str = "host $ip_address 1.1.1.1| awk '{printf  $5 }' ";
//echo "Your exec_str is ", $exec_str, "<br>";
$host_name = exec($exec_str,$test);

if ($host_name == "3(NXDOMAIN)")
   {
   echo "Your hostname is not in the reverse DNS lookup, unknown. Error 3(NXDOMAIN) <br>";
   }
else 
   {
   echo "Your hostname is ", $host_name, "<br>";
   }

if (strpos($ip_address,':') == true)
     {
     echo "Congratuations, you are IPv6 enabled to this site. <br>";
     }
else
     {
     echo "You are IPv4 enabled to this site. If you believe you are IPv6 enabled, check your connectivity. <br>";
     }


// Testing with Internal AppGW
//echo "<br>";
//echo "<br>";
//echo "What is my outbound IP address connecting with to the INTRAnet...";
//echo "<br>";
//$exec_str="curl http://192.168.0.4 | grep 'Your IP address' ";
//echo "Your exec_str is ", $exec_str, "<br>";
//$host_name = exec($exec_str,$test);
//echo $host_name;
//echo "<br>";
//echo "What is my outbound IP address connecting with to the INTERNET...";
//echo "<br>";
//$exec_str="curl http://10.111.0.4 | grep 'Your IP address' ";
//echo "Your exec_str is ", $exec_str, "<br>";
//$host_name = exec($exec_str,$test);
//echo $host_name;

?>
