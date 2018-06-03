<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="style-ov.css">


</head>

<body>






<?php 
 //error_reporting(E_ALL);
//ini_set("display_errors", 1);

 $username = 'gbs2_7a8le';
 $password = 'ZuLu12^*)(';
 $dates = array('2016-01-16','2016-02-16','2016-03-16',date("Y-m-d"));

try 
   {
       
    $conn = new PDO('mysql:host=localhost;dbname=gbs2_prestashop', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
	for ($i = 0; $i < count($dates); $i++) 
	{
	      $corpreg[$i]= $conn->query("SELECT count(distinct(email)) as emails FROM ps_corporates where date_created <'".$dates[$i]."'");
		  $corpreg_c[$i] = $corpreg[$i]->fetchColumn();
		  
		  $sstreg[$i]= $conn->query("SELECT count(distinct(email)) as emails FROM ps_customer where date_add <'".$dates[$i]."'");
		  $sstreg_c[$i] = $sstreg[$i]->fetchColumn();	  
	}
	
	    print "<h1 style=\"color:#da3b44\">Sit-Stand.Com registrations</h1>";
	
	    print "<table border='1'><tr><th>database</th>";
	 
		for ($i = 0; $i < count($dates); $i++) 
	    {		
		    print "<th>".$dates[$i]."</th>";
		}
	    print "</tr>";
          

     
        print "<tr><td>Corporate Registrations</td>";  
		for ($i = 0; $i < count($dates); $i++) 
	    {		
		    print "<td align=\"center\" class=\"content\">".$corpreg_c[$i]."</td>";
		}	 
		print "</tr>";

        
		print "<tr><td>Website Registrations</td>";  
		for ($i = 0; $i < count($dates); $i++) 
	    {		
		    print "<td align=\"center\" class=\"content\">".$sstreg_c[$i]."</td>";
		}	 
		print "</tr>";
	
	
	   echo "</table>";
	
	
	
	
	
	
	
	
	

	 
	 } 
catch(PDOException $e) 
   {
    echo 'ERROR: ' . $e->getMessage();
   }




?>




</body>
</html>