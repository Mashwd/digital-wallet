
<?php include "config.php" ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "title.php" ?>
</head>
<body style="background: #F3F3F3;">

	
	<?php 
		define("filepath", "history.txt");

        $receiver = $amount = $category = "";
        $receiverErr = $amountErr = $categoryErr =  "";
        $store = "Select a Value";
        $successfulMessage = $errorMessage = "";
        $flag = false;

        if($_SERVER['REQUEST_METHOD'] === "POST") {
	        $category = $_POST['category'];
	        $receiver = $_POST['receiver'];
	        $amount = $_POST['amount'];


	        if(empty($category)) {
		        $categoryErr = "Category can not be empty!";
		        $flag = true;
	        }
	        else
	        {
	        	if($category === "merchantPay")
	        	{
	        		$store = "Merchant Pay";
	        	}
	        	else if($category === "mobileRecharge")
	        	{
	        		$store = "Mobile Recharge";
	        	}
	        	else
	        	{
	        		$store = "Send Money";
	        	}
	        }
	        if(empty($receiver)) {
		        $receiverErr = "Receiver can not be empty!";
		        $flag = true;	       
		    }	        
			if(empty($amount)) {
		        $amountErr = "Amount can not be empty!";
		        $flag = true;
	        }
	        else if ($amount < 0) {
			  	$amountErr = "Please enter a valid amount";
			  	$flag = true;
			}
	        
	        if(!$flag) {
		        $category = test_input($category);
		        $receiver = test_input($receiver);
		        $amount = test_input($amount);
		       
		        
				$fileData = read();
		        if(empty($fileData)) {
		        	$data[] = array("category" => $category, "receiver" => $receiver, "amount" => $amount, "transitionTime" => date('d-m-y h:i:s'));
		        }
		        else {
			        $data = json_decode($fileData);
			        $temp = array("category" => $category, "receiver" => $receiver, "amount" => $amount, "transitionTime" => date('d-m-y h:i:s'));
		        	array_push($data, $temp);
		        }
		        $data_encode = json_encode($data);
		        write("");
		        $result1 = write($data_encode);
		        if($result1) {
		        	$successfulMessage = "Successfully saved.";
		        }
		        else {
		        	$errorMessage = "Error while saving.";
		        }	
        	}
		}

        function write($content) {
	        $resource = fopen(filepath, "w");
	        $fw = fwrite($resource, $content);
	        fclose($resource);
	        return $fw;
        }

        function test_input($data) {
	        $data = trim($data);
	        $data = stripslashes($data);
	        $data = htmlspecialchars($data);
	        return $data;
        }
        function read() {
		    $resource = fopen(filepath, "r");
		    $fz = filesize(filepath);
		    $fr = "";
		    if($fz > 0) {
		    	$fr = fread($resource, $fz);
	    	}
		    fclose($resource);
		    return $fr;
		}
        
	?>
		
	<div style = "position: absolute; top: 40%; left: 50%; transform: translate(-49%, -49%);"> 
		<h2 style="text-align:center; color: seagreen;"><?php echo $CURRENT_PAGE; ?></h2>
		<span>
			<?php 
				include "links.php";
				echo "<br>"; 
			?>				
		</span>
		<br>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >

			    <label for="category">Select Categroy<span style="color: red;">*</span>:</label>
			    <select id="category" name="category">
				    <option value="<?php echo $category; ?>"><?php echo $store; ?></option>
				    <option value="mobileRecharge">Mobile Recharge</option>
				    <option value="merchantPay">Merchant Pay</option>
				    <option value="sendMoney">Send Money</option>
			    </select>
			    
			

			<br><br>
			<label for="receiver">To <span style="color: red;">*</span>: </label>
			<input type="tel" name="receiver" id="receiver" pattern="01[5,3,9,6,7,8]{1}[0-9]{8}" style="margin-left: 33px;" value="<?php echo $receiver; ?>">
			<span style="color: red;"><?php echo $receiverErr; ?></span>
			<br><br>

			<label for="amount">Amount <span style="color: red;">*</span>: </label>
			<input type="text" name="amount" id="amount" value="<?php echo $amount; ?>">
			<span style="color: red;"><?php echo $amountErr; ?></span>
			<br><br>


			<input type="submit" name="submit" value="Submit">
			 
		</form>
		<span style="color: green;"><?php echo $successfulMessage; ?></span>
		<span style="color: red;"><?php echo $errorMessage; ?></span>

</div>
</body>
</html>