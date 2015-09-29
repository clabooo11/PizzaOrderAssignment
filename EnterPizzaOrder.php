<!DOCTYPE html>
<head>
<title>Enter a New Order</title>
<meta charset="utf-8" />
</head>
<body>
<h1>Pizza Entry</h1>
<?php
$ShowForm=FALSE;
	$fields = array('order_id', 'student', 'firstname', 'lastname', 'email', 'address', 'phone', 'price', 'size', 'anchovies', 'pineapples', 'pepperoni', 'peppers', 'olives', 'onions');	
	$report = array();

	if(isset($_POST['submit'])){
		foreach($fields as $field){
			if(isset($_POST[$field])){
				$report[$field] = stripslashes(trim($_POST[$field]));				
			}
			else{
				$report[$field] = "n";
			}
		}
		
		$report['order_id']= uniqid();
		


	}
	

if ($ShowForm===FALSE)
{
		$DBConnection = mysqli_connect("localhost", "root", "");
		if (!$DBConnection)
		{
			$error = "<p>Unable to connect to the database server.</p>\n"
			. "<p>Connection error code " . mysqli_connect_errno(). "</p> \n";
			include 'error.html.php';
			exit();
		}
		else
		{
			$DBName = "pizza";
			
			if(!mysqli_select_db($DBConnection, $DBName))
			{
				$error = "<p>Unable to connect to the $DBName database!</p>\n"
					."<p>Error code " .mysqli_errno($DBConnection)
						. ": " . mysqli_error($DBConnection) . "</p>\n";
				include 'error.html.php';
				exit();
			}
		
			else
			{
				$TableName = "orders";
				$fieldstr="";
				$valuestr="";
				$connector="";
				
				foreach ($fields as $field)
				{
					$fieldstr .=$connector . $field;
					
					$valuestr .= $connector . "'" . $report[$field] . "'";
					
					$connector=", ";
				}
				
				$sanitisedValues = mysqli_real_escape_string ($DBConnection, $valuestr);
				
				$SQLString = "INSERT INTO $TableName (" . $fieldstr .
				") VALUES ($valuestr)";
				echo $SQLString;

					
					if(!mysqli_query($DBConnection, $SQLString))
					{
						echo "<p>There was an error saving the record.<br />\n" .
							"The error was " .
							htmlspecialchars(mysqli_error($DBConnection),ENT_QUOTES) .
							".<br />\nThe query was '" .
							htmlspecialchars($SQLString,ENT_QUOTES ) .
							"'</p>\n";
					}
					else
					{
						echo "<p>The pizza order was saved.</p>\n";
					}
				}
			}	
		}		
			
else
{
	$ShowForm=TRUE;
}
if ($ShowForm===TRUE)
{
?>
<form action='EnterPizza.php' method='POST'>
<table>
<tr><td align='right'>Order ID</td><td align='left'>
	<input type='text' size='80' name='product' value='<?php echo $report ['order_id']; ?>' />
	</td></tr>
<tr><td align='right'>Student</td><td align='left'>
	<input type='text' size='10' name='version' value='<?php echo $report ['student']; ?>' />
	</td></tr>
<tr><td align='right'>First Name</td><td align='left'>
	<input type='text' size='10' name='version' value='<?php echo $report ['firstname']; ?>' />
	</td></tr>
<tr><td align='right'>Last Name</td><td align='left'>
	<input type='text' size='20' name='hardware' value='<?php echo $report ['lastname']; ?>' />
	</td></tr>
<tr><td align='right'>Email</td><td align='left'>
	<input type='text' size='20' name='os' value='<?php echo $report ['email']; ?>' />
	</td></tr>
<tr><td align='right'>Address</td><td align='left'>
	<input type='text' size='40' name='frequency' value='<?php echo $report ['address']; ?>' />
	</td></tr>
<tr><td align='right'>Phone</td><td align='left'>
	<input type='text' size='10' name='version' value='<?php echo $report ['phone']; ?>' />
	</td></tr>
<tr><td align='right'>Price</td><td align='left'>
	<input type='text' size='10' name='version' value='<?php echo $report ['price']; ?>' />
	</td></tr>
<tr><td align='right'>Size</td><td align='left'>
	<input type='text' size='10' name='version' value='<?php echo $report ['size']; ?>' />
	</td></tr>
<tr><td align='right'>Anchovies</td><td align='left'>
	<input type='text' size='10' name='version' value='<?php echo $report ['anchovies']; ?>' />
	</td></tr>
<tr><td align='right'>Pineapples</td><td align='left'>
	<input type='text' size='10' name='version' value='<?php echo $report ['pineapples']; ?>' />
	</td></tr>
<tr><td align='right'>Pepperoni</td><td align='left'>
	<input type='text' size='10' name='version' value='<?php echo $report ['pepperoni']; ?>' />
	</td></tr>
<tr><td align='right'>Peppers</td><td align='left'>
	<input type='text' size='10' name='version' value='<?php echo $report ['peppers']; ?>' />
	</td></tr>
<tr><td align='right'>Olives</td><td align='left'>
	<input type='text' size='10' name='version' value='<?php echo $report ['olives']; ?>' />
	</td></tr>
<tr><td align='right'>Onions</td><td align='left'>
	<input type='text' size='10' name='version' value='<?php echo $report ['onions']; ?>' />
	</td></tr>

<tr><td align='center' colspan='2'>
	<input type='reset' name='reset' value='Clear Form' /> &nbsp;
	<input type='submit' name='submit' value='Save Report' />
	</td></tr>
</table>
<?php
}
?>
<a href="ViewPizzaOrder.php">View Pizza Order</a>
</body>
</html>
	