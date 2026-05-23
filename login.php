<?php

$DB = [
    "host" => "ls-89b0d211c11b46e137e2c20fe0e0f67297afbbec.c6nya806a8ys.us-east-1.rds.amazonaws.com",
    "user" => "dbmasteruser",
    "password" => "BAv,e-r+Xc%2K>K*_f]GSJ)+r+a4%vgL",
    "database" => "2025projects",
    "port" => 3306,
    "charset" => "utf8mb4"
];

function get_conn() {
    return new mysqli($GLOBALS["DB"]["host"], $GLOBALS["DB"]["user"], $GLOBALS["DB"]["password"], $GLOBALS["DB"]["database"], $GLOBALS["DB"]["port"]);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["uname"];
    $passcode = $_POST["psc"];

    $conn = get_conn();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT student_name FROM gpalogininfo WHERE username = ? AND passcode = ?");
    $stmt->bind_param("ss", $username, $passcode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {    //login successful
        $st_name = $result
        $conn->close();

        $conn = get_conn();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT admin FROM gpalogininfo WHERE username = ?");
        $stmt->bind_param("ss", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        //***if admin, redirect to admin page, else redirect to student page***
    }
    else {  //login failure
        echo "Invalid username or passcode.";
    }
}