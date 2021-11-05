<?php
define('PrasadDirectAccessRestriction', TRUE);
require_once("db.php");


//echo $_SERVER['REQUEST_METHOD'] ;
$endpoints = 1;
if (isset($_GET['email'])) {
    $email = $_GET['email'];
} else {
    // Fallback behaviour goes here
    $endpoints = 0;
}
if (isset($_GET['featureName'])) {
    $featureName = $_GET['featureName'];
} else {
    // Fallback behaviour goes here
    $endpoints = 0;
}
if (isset($_GET['enable'])) {
    $enable = $_GET['enable'];
} 
$sql = "SELECT * FROM FeatureTable";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    //IF GET METHOD IS USED, THEN ONLY DISPLAY RESULT

    if ($endpoints ==1) {
        if ($result->num_rows > 0) {
          // output data of each row
            //create an array
            $emparray = array();
            while($row =mysqli_fetch_assoc($result))
            {   
                //echo var_dump($row);
                if ($row[$featureName] == 1) {
                    $canAccess = "true";
                } else {
                    $canAccess = "false";
                }
                $new_arr = array("canAccess"=>$canAccess);
                $emparray[] = $new_arr;
                //echo $row[$featureName];

            echo json_encode($emparray);
            }
        } else {
          echo "0 results";
        }
    }
    
} else {
    //USING POST METHOD, ENABLE SQL CHANGE
    //echo $enable;
    $entityBody = file_get_contents('php://input');
    $bodyArray = json_decode($entityBody,true);
    //echo var_dump($bodyArray); 
    $featureName= $bodyArray["FeatureName"];
    $email= $bodyArray["email"];
    $enable = $bodyArray["enable"];
    if ($email == "" or $enable =="" or $featureName =="") {
        http_response_code(304);
    }
    if ($enable == "true"){
        $bool_enable = 1;
    }
    if ($enable == "false"){
        $bool_enable = 0;
    }
    $sql = "UPDATE FeatureTable SET $featureName=$bool_enable WHERE email='$email'";
    $result = $conn->query($sql);
    $sql = "SELECT * FROM FeatureTable";
    $result = $conn->query($sql);
    while($row =mysqli_fetch_assoc($result))
    {
        // added for debugging
        if ($row[$featureName] == 1) {
            $canAccess = "true";
        } else {
            $canAccess = "false";
        }
        //echo "{<br>\"FeatureName\": $featureName,<br>\"email\": $email,<br>\"canAccess\": $canAccess<br>}";
        $emparray[] = $row;
        //echo $row;
        //echo json_encode($emparray);
    }
    
    
}
$conn->close();
?>
