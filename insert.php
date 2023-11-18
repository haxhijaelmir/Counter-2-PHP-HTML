<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['username']) && isset($_POST['password']) &&
        isset($_POST['gender']) && isset($_POST['email']) &&
        isset($_POST['phoneCode']) && isset($_POST['phone'])) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phoneCode = $_POST['phoneCode'];
        $phone = $_POST['phone'];
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "register";
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM register WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO register(username, password, gender, email, phoneCode, phone) values(?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($SELECT);
 $stmt->bind_param("s", $EmailId);
 $stmt->execute();
 $stmt->bind_result($EmailId);
 $stmt->store_result();
 $rnum = $stmt->num_rows;
 if ($rnum==0) {
 $stmt->close();
 $stmt = $conn->prepare($INSERT);
 $stmt->bind_param("sssssi",$Customername, $EmailId, $ConfirmEmailId, $City, $Country, $Mobilenumber);
 $stmt->execute();
 echo "New record inserted successfully";
 }

else {
 echo "Someone already registered using this EmailId";
 }
 $stmt->close();
 $conn->close();
 }
} else {
 echo "All field are required";
 die();
}
?>