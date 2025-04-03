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

echo "This site supports IPv4 and IPv6 connectivity.<br>";
echo "Let us see if you are connecting with an IPv4 or IPv6 address..<br>";
echo "Your IP address is ", $ip_address, "<br>";

//Fix IP Address
$exec_str = "echo $ip_address | awk -F ':' '{print $1}'";
$ip_address = exec($exec_str,$test);
//echo "Your IP address is ", $ip_address, "<br>";
echo preg_match('/(?:(?:25[0-5]|2[0-4]\d|1?\d\d?)\.){3}(?:25[0-5]|2[0-4]\d|1?\d\d?)/', $ip_address);

$exec_str = "host $ip_address 1.1.1.1| awk '{printf  $5 }' ";
//echo "Your exec_str is ", $exec_str, "<br>";
$host_name = exec($exec_str,$test);
echo "Your hostname is ", $host_name, "<br>";
if (strpos($ip_address,':') == true)
     {
     echo "Congratuations, you are IPv6 enabled to this site. <br>";
     }
else
     {
     echo "You are IPv4 enabled to this site. If you believe you are IPv6 enabled, check your connectivity. <br>";
     }

echo "<br>";
echo "<br>";
echo "What is my outbound IP address connecting with to the INTRAnet...";
echo "<br>";
$exec_str="curl http://192.168.0.4 | grep 'Your IP address' ";
//echo "Your exec_str is ", $exec_str, "<br>";
$host_name = exec($exec_str,$test);
echo $host_name;
echo "<br>";
echo "What is my outbound IP address connecting with to the INTERNET...";
echo "<br>";
$exec_str="curl http://10.111.0.4 | grep 'Your IP address' ";
//echo "Your exec_str is ", $exec_str, "<br>";
$host_name = exec($exec_str,$test);
echo $host_name;

?>
