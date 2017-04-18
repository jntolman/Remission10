<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Remission10.com | Scott Peterson - 2017 LLS Man of the Year Candidate</title>

    <!-- Bootstrap Core CSS -->
    <!--<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Custom Fonts -->
    <!--<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="css/agency.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
    <![endif]-->

</head>

<body id="page-top" class="index bg-darkest-gray">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container bg-darkest-gray">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index.html" style="padding:0;"><img src="img/nav-brand-white.png"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="index.html">remission10.com</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <section id="mustang-confirm" class="bg-darkest-gray">
        <div class="row">
            <div class="col-lg-12 text-center">

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
                        $amount = $keyarray['payment_gross'];
                        $useremail = $keyarray['payer_email'];
                        
                        echo ("<div class=\"row\">
                                    <div class=\"col-lg-12 text-center\">
                                        <h3>Thank you for your support!</h3>
                                        <p>Please confirm your contact information. Drawing will be held May 31, 2017 and winner will be announced June 3, 2017.</p>
                                    </div>
                                </div>");
                        
                        // echo ("<b>Payment Details</b><br>\n");
                        // echo ("<li>Name: $firstname $lastname</li>\n");
                        // echo ("<li>Email: $useremail</li>\n");
                        // echo ("<li>Item: $itemname</li>\n");
                        // echo ("<li>Transaction ID: $tx_token</li>\n");
                        // echo ("<li>Amount: $amount</li>\n");
                        echo ("Your transaction has been completed, and a receipt for your purchase has been emailed to you.<br> You may log into your account at <a href='https://www.paypal.com'>www.paypal.com</a> to view details of this transaction.<br>");
                        include("vendor/paypal/mustang-confirm.php");
                        }
                        else if (strcmp ($lines[0], "FAIL") == 0) {
                            // log for manual investigation
                        }
                    }
                
                ?>

            </div>
        </div>
    
    <section id="rules">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Win The Remission10 / Wheelhouse Foundation Roush Mustang benefiting the Leukemia Lymphoma Society Official Raffle Drawing Rules</h3>
                        <p class="rules">Win The Remission10 / Wheelhouse Foundation Roush Mustang Raffle Drawing (‘Drawing”) to benefit the Leukemia Lymphoma Society is offered only in the United States and is open only to legal residents of the United States (except for residents of the states excluded below), 18 years of age or older at the time of entry. The Drawing begins at 9:00:00 A.M. EST on Wednesday, April 5, 2017 and ends at 9:00A.M. EST on Wednesday, May 31, 2017. The winner will be announced on June 3, 2017. The Drawing is subject to all applicable federal, state, and local laws and regulations, and is void in Alabama, Kansas, Hawaii, South Carolina, Utah and wherever prohibited or restricted by law. Employees, as well as their immediate family members (parents, children, siblings, spouse) and others living in their same household, whether related or not, of The Wheelhouse Foundation, Wheelhouse Media, Roush Performance, Roush Industries, Roush-Fenway Racing, Roush-Yates Engines, Fenway Sports Groups and any of their respective affiliated entities are not eligible to enter.</p>
                        <p class="rules"><b>HOW TO ENTER:</b> To enter the Drawing, please register online at <a href="http://remision10.com">www.remission10.com</a>. Online entries must be received by 9:00 A.M. EST on May 31, 2017. For mail entry, please write your name, complete address, daytime telephone number, email and date of birth and mail in an envelope with payment ($100.00 payable to The Wheelhouse Foundation to: The Remission10 Campaign, Attn: Win the Remission10 / Wheelhouse Foundation Roush Mustang, 1 S Cedar Street #201, Charlotte, NC, 28202. Entries by mail must be received no later than May 26, 2017, regardless of when postmarked. Winner will be drawn no later than June 1, 2017. All entries become the sole property of The Wheelhouse Foundation and will not be returned. The Wheelhouse Foundation is not responsible for lost, stolen, illegible, incomplete, misdirected, late, damaged, destroyed, or delayed entries or postage due to mail. The winner of the vehicle will be announced publicly via Wheelhouse Foundation, Remission10 and Roush Performance social media channels as well as at a June 3rd Gala in Charlotte, NC. Winners will be contacted directly by the campaign administrators and can be seen at <a href="http://remision10.com">www.remission10.com</a> no later than June 3, 2017. Entries will be certified and the winner drawn at random by Lee Piver of Piver and Anderson CPAs, 15430 US Highway N. Hampstead, NC 28443.</p>
                        <p class="rules"><b>PRIZES/ODDS OF WINNING:</b> <i>Grand Prize:</i> One (1) <a href="http://www.roushperformance.com/vehicles/mustang-2016-stage3.html">2016 Roush Performance Stage 3 Mustang</a> (“Vehicle” or “Prize”) (“as is”). The Wheelhouse Foundation will pay for the federal income taxes related to the Prize up to 15% of the Approximate Retail Value (“ARV”).   ARV of Vehicle is $75,995. The winner is responsible for State taxes.
                            <br><i>Second Prize:</i> Five (5) VIP VORE (Vegas Off-Road Experiences) packages will be given away to five (5) different winners valued at $765 each to include: 5 laps on the short course track, Drift intro package with Roush Mustang RS3, 3 machine gun shooting package & transportation to and from Vegas hotel. All transportation and lodging is the responsibility of the winner.
                            <br><i>Third Prize:</i> Twenty Five (25) Roush Performance T-Shirt & Hat Swag Bag Packages valued at $50 each.</p>
                        <p class="rules">Vehicle must be picked up in Concord, NC at Roush-Fenway Racing by 8/30/17. Winner will also receive a private tour of Roush-Fenway Racing at time of vehicle pick up. Winner must provide valid driver’s license and evidence of legally required insurance at time of pick up. Winner is solely responsible for all other costs incurred in claiming, and using the automobile, including, without limitation, costs associated with state emissions standards compliance. All unspecified expenses are winner’s sole responsibility. No prize substitution or cash equivalent of prize except at the sole discretion of The Wheelhouse Foundation. No Prize transfer. A maximum of 5,010 tickets will be sold. Odds of winning are determined by the total number of entries received, with the maximum odds of 1: 5,010 for the Grand Prize. Each day entries received by mail and the Internet will be counted to determine if the total sold to date exceeds 5,010. All entries received the day on which 5,010 entries are received will be entered into a preliminary lottery. The first entries drawn from that group up to a total of 5,010 will be included in the final drawing. All other entries received that day (and thereafter) will be returned or refunded.</p>
                        <p class="rules"><b>GENERAL CONDITIONS:</b> By entering, entrants accept and agree to the Official Rules and the decisions of the Wheelhouse Foundation, which are final and binding in all respects. Winner will be notified by telephone and email and will be required to execute and return an affidavit of eligibility, a liability release and a publicity release, where legal, within seven (7) days of notification. In the event of non-compliance with requirements, or if winner is unreachable, Prize will be forfeited and an alternate winner will be selected. By accepting the Prize, except where prohibited by law, winner agrees to the use of his or her name and/or photograph for advertising/publicity purposes without further compensation or notice. <b>Drawing entries are not tax-deductible contributions to The Wheelhouse Foundation.</b> By participating, entrant agrees to release and hold harmless Scott and Jaclyn Peterson, The Wheelhouse Foundation, Roush Performance, Roush Industries, Roush-Yates Engines, Roush-Fenway Racing, Fenway Sports Group and their respective parents, affiliates and subsidiaries, and the directors, officers, agents, members, family and employees of any such entity (collectively, the “released parties”) from any and all liability arising from participating in the Drawing and/or acceptance, possession or use/misuse of Prizes, regardless of whether such claims are founded in whole or part upon alleged negligence, gross negligence or willful misconduct of any of the released parties. The Wheelhouse Foundation reserves the right, at its sole discretion, to disqualify any individual it finds, in its sole discretion, to be tampering with the entry process or the operation of the Drawing; to be in violation of the Official Rules, or to be acting in a disruptive manner, or with the intent to annoy, abuse, threaten or harass any other person. Any activities intended to disrupt or interfere with the proper play of the Drawing or defraud the Wheelhouse Foundation in any way will be prosecuted to the fullest extent of the law. The Drawing is subject to all applicable laws of the United States.</p>
                        <p class="rules"><b>LIMITATIONS OF LIABILITY:</b> The Wheelhouse Foundation is not responsible for any incorrect or inaccurate information, including, without limitation, that which is caused by web site users, tampering, hacking, or by any of the equipment or programming associated with or utilized in the Drawing or by any technical or human error which may occur in the processing of entries in the Drawing. The Wheelhouse Foundation assumes no responsibilities for any error, omission, interruption, deletion, or defection, delay in operation or transmission, communications line failure, theft or destruction or unauthorized access to, or alteration of web site or entries in processing the Drawing entries. The Wheelhouse Foundation is not responsible for any problems or technical malfunction of any telephone network or lines, computer on-line systems, servers, or providers, computer equipment, software, failure of email or entrants on accounts of technical problems or traffic congestion on the Internet or at any web site associated with the Drawing. The Wheelhouse Foundation is not responsible for user cheating or fraud by any entrants. If, for any reason, the Drawing is not capable of running as planned, including, without limitation, unauthorized intervention, fraud, technical failures or any other causes beyond the control of The Wheelhouse Foundation which, in The Wheelhouse Foundation’s sole discretion could corrupt or affect the administration, security, fairness, integrity or proper conduct of the Drawing, The Wheelhouse Foundation may, in its sole discretion, cancel the Drawing and return/refund all entries or select the winner in a random drawing comprised of all eligible entries received prior to (and/or after, if appropriate) the action taken by The Wheelhouse Foundation. The Wheelhouse Foundation reserves the right at its sole discretion to cancel, terminate, modify or suspend the Drawing.</p>
                        <p class="rules">A copy of the latest Financial Report and Registration filed by this organization may be obtained by contacting it at: The Wheelhouse Foundation at: 1 S Cedar Street #201, Charlotte, NC, 28202, 704-360-1517 or by contacting any of the following state agencies: In addition, residents of the following states may obtain financial and/or licensing information from their states, as indicated. Registration with these states, or any other state, does not imply endorsement by the state. Your contribution is deductible to the extent permitted by federal law. · <b>Florida:</b> A COPY OF THE OFFICIAL REGISTRATION AND FINANCIAL INFORMATION MAY BE OBTAINED FROM THE DIVISION OF CONSUMER SERVICES BY CALLING TOLL FREE 1-800-HELP- FLA (1-800-435-7352) WITHIN THE STATE. REGISTRATION DOES NOT IMPLY ENDORSEMENT, APPROVAL, OR RECOMMENDATION BY THE STATE. 20-8353637. · <b>Georgia:</b> A full and fair description of the charitable program for which this solicitation campaign is being carried out, and a full and fair description of the programs and activities of this organization, will be sent upon request. A financial statement or summary, consistent with the financial statement required to be filed with the Secretary of State pursuant to Georgia Code § 43-17-5, will be sent upon request. · <b>Maryland:</b> A copy of the current financial statement of The Wheelhouse Foundation is available by writing the Wheelhouse Foundation 1 S Cedar Street #201, Charlotte, NC, 28202, 704-360-1517. Documents and information submitted under the Maryland Solicitations Act are also available, for the cost of postage and copies, from the Maryland Secretary of State, State House, Annapolis, MD 21401, (410) 974-5534. · <b>Mississippi:</b> The official registration and financial information of the Wheelhouse Foundation may be obtained from the Mississippi Secretary of State’s office by calling 800-236-6167. Registration by the Secretary of State does not imply endorsement by the Secretary of State. · <b>New Jersey:</b> INFORMATION FILED WITH THE ATTORNEY GENERAL CONCERNING THIS CHARITABLE SOLICITATION AND THE PERCENTAGE OF CONTRIBUTIONS RECEIVED BY THE CHARITY DURING THE LAST REPORTING PERIOD THAT WERE DEDICATED TO THE CHARITABLE PURPOSE MAY BE OBTAINED FROM THE ATTORNEY GENERAL OF THE STATE OF NEW JERSEY BY CALLING 973-504-6215 AND IS AVAILABLE ON THE INTERNET AT <a href="http://www.state.nj.us/lps/ca/charfrm.htm">http://www.state.nj.us/lps/ca/charfrm.htm</a>. REGISTRATION WITH THE ATTORNEY GENERAL DOES NOT IMPLY ENDORSEMENT. <b>New York:</b> A copy of the most recent annual report is available from the Office of the Attorney General at New York State Department of Law, Charities Bureau, 120 Broadway—3rd Floor, New York, New York 10271, 212-416-8401. · <b>North Carolina:</b> Financial information about this organization and a copy of its license are available from the State Solicitation Licensing Branch at 919-807-2214. The license is not an endorsement by the State. · <b>Pennsylvania:</b> The official registration and financial information of the Wheelhouse Foundation may be obtained from the Pennsylvania Department of State by calling toll-free, within Pennsylvania, 800-732-0999. Registration does not imply endorsement. · <b>Virginia:</b> A copy of the financial statement is available from the State Office of Consumer Affairs, Department of Agricultural and Consumer Services, P.O. Box 1163, Richmond, VA 23218, or by calling 800-552-9963 or 804-786-2042. · <b>Washington:</b> Thank you for supporting The Wheelhouse Foundation. For additional information regarding the organization’s activities or financial information, the Wheelhouse Foundation is registered with the Washington State Charities Program as required by law and information may be obtained by calling 800-332-4483 or 360-725-0378. · <b>West Virginia:</b> West Virginia residents may obtain a summary of the registration and financial documents from the Secretary of State, State Capitol, Charleston, West Virginia 25305. Registration does not imply endorsement. · <b>Wisconsin:</b> A financial statement of this charitable organization disclosing assets, liabilities, fund balances, revenue and expenses for the preceding fiscal year will be provided upon request.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="partners">

            <div class="row">
                <div class="col-lg-12 text-center">
                    <img src="img/dark-logo.png" class="img-responsive img-centered">
                    <h2 class="section-heading">In Partnership With</h2>
                    <!--<h3 class="section-subheading text-muted">We are honored by the support of our partners.</h3>-->
                </div>
            </div>

            <!-- Clients Aside -->
            <aside class="clients">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="#">
                                <img src="img/logos/roush.png" class="img-responsive img-centered" alt="">
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="#">
                                <img src="img/logos/wheelhouse.png" class="img-responsive img-centered" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </aside>
        </section>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <span class="copyright">Copyright &copy; remission10.com 2017</span>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-inline social-buttons">
                            <li>#remission10</li>
                            <!--<li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a>
                            </li>-->
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-inline quicklinks">
                            <li><a href="privacy.html">Privacy Policy</a>
                            </li>
                            <!--<li><a href="#">Terms of Use</a>
                            </li>-->
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <!-- jQuery -->
        <!--<script src="vendor/jquery/jquery.min.js"></script>-->
        <script
            src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
            crossorigin="anonymous"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <!-- Plugin JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

        <!-- Contact Form JavaScript -->
        <script src="js/jqBootstrapValidation.js"></script>
        <script src="js/contact_me.js"></script>

        <!-- Theme JavaScript -->
        <script src="js/agency.min.js"></script>

        <!-- Google Analytics -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-96039710-1', 'auto');
            ga('send', 'pageview');
        </script>

    </body>

</html>


