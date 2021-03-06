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

        if ($nameErr || $emailErr) {
            echo("<p>There was an error with your submission; please email <a href='mailto:scott.peterson@tsmgi.com'>scott.peterson@tsmgi.com</a> to confirm.</p>");
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

            if ($stmt = $conn->prepare("INSERT INTO tickets (name, email, phone, txId) VALUES (?,?,?,?)")) {

                $stmt->bind_param("ssss", $name, $email, $phone, $txId);

                if ($stmt->execute() === TRUE) {
                    echo("<p>Confirmed, thank you!</p>");
                } else {
                    $connErr = "Error: " . $sql . "<br>" . $conn->error;
                    echo("<p>There was an error with your submission; please email <a href='mailto:scott.peterson@tsmgi.com'>scott.peterson@tsmgi.com</a> to confirm.</p>");
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