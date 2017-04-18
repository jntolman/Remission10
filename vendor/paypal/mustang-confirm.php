
                    <form name="contactConfirm" id="confirmForm" action="mustang-complete.php" method="POST" novalidate>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input type="text" class="form-control" value=<?php echo("'$fullname'") ?> id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control" value=<?php echo("$useremail") ?> id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone *</label>
                                    <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <input type="hidden" id="txId" value=<?php echo("$tx_token") ?>  >
                            <input type="hidden" id="amount" value=<?php echo("$amount") ?>  >
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl">Confirm!</button>
                            </div>
                        </div>
                    </form>

                    <script>

                        // $(function() {

                        //     $("#confirmForm input,#confirmForm textarea").jqBootstrapValidation({
                        //         preventSubmit: true,
                        //         submitError: function($form, event, errors) {
                        //             // additional error messages or events
                        //         },
                        //         submitSuccess: function($form, event) {
                        //             event.preventDefault(); // prevent default submit behaviour
                        //             // get values from FORM
                        //             var name = $("input#name").val();
                        //             var email = $("input#email").val();
                        //             var phone = $("input#phone").val();
                        //             var txId = $("input#txId").val();
                        //             var amount = $("inpute#amount").val();
                        //             // var message = $("textarea#message").val();
                        //             var firstName = name; // For Success/Failure Message
                        //             // Check for white space in name for Success/Fail message
                        //             if (firstName.indexOf(' ') >= 0) {
                        //                 firstName = name.split(' ').slice(0, -1).join(' ');
                        //             }
                        //             $.ajax({
                        //                 url: "./mustang-complete.php",
                        //                 type: "POST",
                        //                 data: {
                        //                     name: name,
                        //                     phone: phone,
                        //                     email: email,
                        //                     txId: txId,
                        //                     amount: amount
                        //                 },
                        //                 cache: false,
                        //                 success: function() {
                        //                     // Success message
                        //                     $('#success').html("<div class='alert alert-success'>");
                        //                     $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        //                         .append("</button>");
                        //                     $('#success > .alert-success')
                        //                         .append("<strong>Confirmation complete! </strong>");
                        //                     $('#success > .alert-success')
                        //                         .append('</div>');

                        //                     //clear all fields
                        //                     $('#confirmForm').trigger("reset");
                        //                 },
                        //                 error: function() {
                        //                     // Fail message
                        //                     $('#success').html("<div class='alert alert-danger'>");
                        //                     $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        //                         .append("</button>");
                        //                     $('#success > .alert-danger').append($("<strong>").text("Sorry " + firstName + ", it seems that my mail server is not responding. Please email confirmation to scott.peterson@tsmgi.com."));
                        //                     $('#success > .alert-danger').append('</div>');
                        //                     //clear all fields
                        //                     $('#confirmForm').trigger("reset");
                        //                 },
                        //             });
                        //         },
                        //         filter: function() {
                        //             return $(this).is(":visible");
                        //         },
                        //     });

                        //     $("a[data-toggle=\"tab\"]").click(function(e) {
                        //         e.preventDefault();
                        //         $(this).tab("show");
                        //     });
                        // });


                        // /*When clicking on Full hide fail/success boxes */
                        // $('#name').focus(function() {
                        //     $('#success').html('');
                        // });

                    </script>
                