<?php include "config.php" ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "title.php" ?>
</head>
<body style="background: #F3F3F3;">
	
	<div style = "position: absolute; top: 40%; left: 50%; transform: translate(-49%, -49%);"> 
		<h2 style="text-align:center; color: seagreen;"><?php echo $CURRENT_PAGE; ?></h2>
		<span style="margin-left: 55px;">
			<?php 
				include "links.php";
				echo "<br>"; 
			?>	
			<br>			
		</span>
		<?php

		define("filepath", "history.txt");
		$fileData = read();
		$fileDataExplode = json_decode($fileData,true);
		echo "<table border = 2px>";
	    echo "<tr>";
	    echo "<th>";
	    echo "Category";
	    echo "</th>";
	    echo "<th>";
	    echo "To";
	    echo "</th>";
		echo "<th>";
	    echo "Amount";
	    echo "</th>";
	    echo "<th>";
	    echo "Transition Time";
	    echo "</th>";
	    echo "</tr>"; 

		foreach((object)$fileDataExplode as $item) {
			echo "<tr>";
			echo "<td>";
			echo $item['category'];
			echo "</td>";
			echo "<td>";
			echo $item['receiver'];
			echo "</td>";
			echo "<td>";
			echo $item['amount'];
			echo "</td>";
			echo "<td>";
			echo $item['transitionTime'];
			echo "</td>";
			echo "</tr>";
	    }
	    echo "</table>";
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

</div>
	
</body>
</html>