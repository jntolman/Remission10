<?php
    // define variables and set to empty values
    $nameErr = $emailErr = $phoneErr = "";
    $name = $email = $phone = $txId = $amount = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $txId = test_input($_POST["txId"]);
        $amount = test_input($_POST["amount"]);
        
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed"; 
            }
        }
        
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format"; 
            }
        }

        if (empty($_POST["phone"])) {
            $phoneErr = "Phone is required";
        } else {
            $phone = test_input($_POST["phone"]);
        }

        if ($nameErr || $emailErr || $phoneErr) {
            echo("empty");
        } else {

            $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

            $server = $url["host"];
            $username = $url["user"];
            $password = $url["pass"];
            $db = substr($url["path"], 1);

            // Create connection
            $conn = new mysqli($server, $username, $password, $db);

            // Check connection
            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            } 

            // $values = array($name, $email, $phone, $txId, $amount);

            if ($stmt = $conn->prepare("INSERT INTO tickets (name, email, phone, txId, amount) VALUES (?,?,?,?,?)")) {

                $stmt->bind_param("ssssi", $name, $email, $phone, $txId, $amount);

                if ($stmt->execute() === TRUE) {
                    echo("success");
                } else {
                    $connErr = "Error: " . $sql . "<br>" . $conn->error;
                    echo($connErr);
                }

            }

            $conn->close();
        }

    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>