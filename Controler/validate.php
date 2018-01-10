<html>
<body>
<?php
$errors = array ();
$id = 0;

$name = "";
$message = "";
$link = "";
$email = "";
$x = -1;
$y = -1;
$width = 0;
$height = 0;
$imageFileType = "";
$filename = "";
$target_dir = "../Model/img/";

validateData($name, $message, $link, $email, $x, $y, $filename, $errors, $id);
validateImage($width, $height, $filename, $imageFileType, $errors, $id,	$target_dir);
if(count($errors) == 0) {
	writeInDB($errors, $width, $height, $filename, $imageFileType, $name, $message, $link, $email, $x, $y, $id);
	editCanvasImage($filename, $x, $y, $width, $height,	$target_dir);
} else {
	require '../View/html/Error.html';
	foreach ($errors as $error) {
		echo "<h3>$error</h3>";
	}
}





function validateData(&$name, &$message, &$link, &$email, &$x, &$y, &$filename, &$errors, &$id) {
	if(array_key_exists('company_name', $_POST)) {
		$name = $_POST['company_name'];
		if(strlen($name) > 255) {
			$errors[$id] = "Name TOO LONG";
			$id = $id + 1;
		}
		if(strlen($name) == 0) {
			$errors[$id] = "Name missing";
			$id = $id + 1;
		}
	} else {
		$errors[$id] = "Name missing";
		$id = $id + 1;
	}

	if(array_key_exists('message', $_POST)) {
		$message = $_POST['message'];
		if(strlen($message) > 255) {
			$errors[$id] = "message TOO LONG";
			$id = $id + 1;
		}
		if(strlen($message) == 0) {
			$errors[$id] = "MISSING message";
			$id = $id + 1;
		}
	} else {
		$errors[$id] = "MISSING message";
		$id = $id + 1;
	}

	if(array_key_exists('link', $_POST)) {
		$link = $_POST['link'];
		if(strlen($link) > 255) {
			$errors[$id] = "URL TOO LONG";
			$id = $id + 1;
		}
		if(strlen($link) == 0) {
			$errors[$id] = "MISSING URL";
			$id = $id + 1;
		}
		if (!filter_var($link, FILTER_VALIDATE_URL) === false) {
  
		} else {
    		$errors[$id] = "$link is not a valid URL";
			$id = $id + 1;
		}
	} else {
		$errors[$id] = "MISSING URL";
		$id = $id + 1;
	}


	if(!array_key_exists('mail', $_POST)) {
		$errors[$id] = "MISSING EMAIL";
		$id = $id + 1;
	} else {
		$email = $_POST["mail"];
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 			$errors[$id] = "INVALID EMAIL FORMAT";
 			$id = $id + 1; 
		}
	}


	if(!array_key_exists('X', $_POST)) {
		$errors[$id] = "CHOOSE VALID LOCATION";
		$id = $id + 1;
	} else {
		$x = $_POST['X'];
	}

	if(!array_key_exists('Y', $_POST)) {
		$errors[$id] = "CHOOSE VALID LOCATION";
		$id = $id + 1;
	} else {
		$y = $_POST['Y'];
	}
}


function validateImage(&$width, &$height, &$filename, &$imageFileType, &$errors, &$id, $target_dir){
	$target_file = $target_dir . basename($_FILES["img"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
    	$check = getimagesize($_FILES["img"]["tmp_name"]);
    	if($check !== false) {
    	    $uploadOk = 1;
    	} else {
    		$errors[$id] = "FAKE IMAGE";
			$id = $id + 1;
    	    $uploadOk = 0;
    	}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		$errors[$id] = "IMAGE ALREADY UPLOADED";
		$id = $id + 1;
    	$uploadOk = 0;
	}
	 // Check file size
	if ($_FILES["img"]["size"] > 500000) {
		$errors[$id] = "IMAGE TOO LARGE";
		$id = $id + 1;
    	$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
		$errors[$id] = "INVALID FORMAT";
		$id = $id + 1;
    	$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0 || count($errors) != 0) {
		$errors[$id] = "AN ERROR HAS OCURRED";
		$id = $id + 1;
	// if everything is ok, try to upload file
	} else {
    	$temp = explode(".", $_FILES["img"]["name"]);
		$filename = round(microtime(true)) . '.' . end($temp);
		move_uploaded_file($_FILES["img"]["tmp_name"], $target_dir . $filename);
		$data = getimagesize($target_dir . $filename);
		$width = $data[0];
		$height = $data[1];
	}
}

function writeInDB(&$errors, &$width, &$height, &$filename, &$imageFileType, &$name, &$message, &$link, &$email, &$x, &$y, &$id){
	$servername = "localhost";
	$username = "Stan";
	$password = "qwer";
	$dbname = "info";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 	
	$dt =  date ("Y-m-d H:i:s");
	$sql = "INSERT INTO info (Name, Email, Link, Message, File_Name, Purchase_Date)
		VALUES ('$name', '$email' , '$link', '$message', '$filename', '$dt')";
		if ($conn->query($sql) === TRUE) {
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$sql = "INSERT INTO logos (File_Name, File_Format, Coordinate_X, Coordinate_Y, width, height)
		VALUES ('$filename', '$imageFileType', '$x', '$y', '$width', '$height')";
	if ($conn->query($sql) === TRUE) {
	} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
	}
	require_once("../View/html/Error.html");
}

function editCanvasImage(&$filename, $x, $y, $ImageWidth, $ImageHeight, $target_dir) {
	$image = imagecreatefrompng($target_dir.$filename);
	$canvas = imagecreatefrompng('../View/recources/test.png');
	$heatmap = imagecreatefrompng('../View/recources/heatmap.png');
	$idk = imagecreate(100, 100);
	$red = imagecolorallocate($idk, 255, 0, 0);
	for($ImageX = 0; $ImageX < $ImageWidth; $ImageX++) {

		for($ImageY = 0; $ImageY < $ImageHeight; $ImageY++) {
			$ImagePixel = imagecolorat($image, $ImageX, $ImageY);
			imagesetpixel($canvas ,$x + $ImageX ,$y + $ImageY ,$ImagePixel );
			imagesetpixel($heatmap ,$x + $ImageX ,$y + $ImageY ,$red );
		}
	}
	imagepng($canvas, '../View/recources/test.png');
	imagepng($heatmap, '../View/recources/heatmap.png');
}

?>
</body>
</html>