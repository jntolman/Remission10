<?php
    $pp_hostname = "www.sandbox.paypal.com"; // Change to www.sandbox.paypal.com to test against sandbox
    // read the post from PayPal system and add 'cmd'
    $req = 'cmd=_notify-synch';
    
    $tx_token = $_GET['tx'];
    $auth_token = "RzAo3mz7e4fRcNnbaCWYakD_SmijKMIQIgopYB1FNViQOlTziQchyBaRZ-G";
    $req .= "&tx=$tx_token&at=$auth_token";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://$pp_hostname/cgi-bin/webscr");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    //set cacert.pem verisign certificate path in curl using 'CURLOPT_CAINFO' field here,
    //if your server does not bundled with default verisign certificates.
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: $pp_hostname"));
    $res = curl_exec($ch);
    curl_close($ch);
    if(!$res){
        //HTTP ERROR
        //header('HTTP/1.0 403 Forbidden');
    }else{
        // parse the data
        $lines = explode("\n", trim($res));
        $keyarray = array();
        if (strcmp ($lines[0], "SUCCESS") == 0) {
            for ($i = 1; $i < count($lines); $i++) {
                $temp = explode("=", $lines[$i],2);
                $keyarray[urldecode($temp[0])] = urldecode($temp[1]);
            }
        // check the payment_status is Completed
        // check that txn_id has not been previously processed
        // check that receiver_email is your Primary PayPal email
        // check that payment_amount/payment_currency are correct
        // process payment
        $firstname = $keyarray['first_name'];
        $lastname = $keyarray['last_name'];
        $itemname = $keyarray['item_name'];
        $itemname = $keyarray['item_number'];
        $amount = $keyarray['payment_gross'];
        $useremail = $keyarray['payer_email'];
        
        echo ("<p><h3>Thank you for your purchase!</h3></p>");
        
        echo ("<b>Payment Details</b><br>\n");
        echo ("<li>Name: $firstname $lastname</li>\n");
        echo ("<li>Email: $useremail</li>\n");
        echo ("<li>Item: $itemname</li>\n");
        echo ("<li>Item: $itemnumber</li>\n");
        echo ("<li>Amount: $amount</li>\n");
        echo ("Your transaction has been completed, and a receipt for your purchase has been emailed to you.<br> You may log into your account at <a href='https://www.paypal.com'>www.paypal.com</a> to view details of this transaction.<br>");
        include("/vendor/paypal/mustang-confirm.php");
        }
        else if (strcmp ($lines[0], "FAIL") == 0) {
            // log for manual investigation
        }
    }
 
?>

 

