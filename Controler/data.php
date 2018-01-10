
<?php
$servername = "localhost";
$username = "Stan";
$password = "qwer";
$dbname = "info";
$array = array();
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT info.Link, info.Message, logos.Coordinate_X, logos.Coordinate_Y, logos.width, logos.height FROM info JOIN logos ON info.File_Name = logos.File_Name";
$result = $conn->query($sql);



if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $var = array( 
         "Link" 		=> $row["Link"],
         "Message" 		=> $row["Message"],
         "Coordinate_X" => intval($row["Coordinate_X"]),
         "Coordinate_Y" => intval($row["Coordinate_Y"]),
         "width" 		=> intval($row["width"]),
         "height" 		=> intval($row["height"]),
         );
        $array[] = $var;
    }
}
$conn->close();

echo json_encode($array);
?>		
