<?php
    header("Access-Control-Allow-Origin: http://localhost:8080");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Methods: POST");
    

    // Database connection credentials
    $servername = "localhost";
    $username = "user1";
    $password = "abc";
    $dbname = "mydatabase";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get employee information from form submission
    $firstName = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $lastName = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
    $job = isset($_POST['job']) ? $_POST['job'] : '';
    $salary = isset($_POST['salary']) ? $_POST['salary'] : '';

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO employees (firstName, lastName, dob, job, salary) VALUES (?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Error: " . $conn->error);
    }
    
    $stmt->bind_param("ssssd", $firstName, $lastName, $dob, $job, $salary);

    // Execute SQL statement and check for errors
    if ($stmt->execute() === TRUE) {
        echo "New employee record created successfully";
    }   
    else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
?>
