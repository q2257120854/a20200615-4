"use strict";
/*
 *Your Ajax Server Here if it was not defined in html site-config element, 
 * use internal url (such as './ajaxserver/server.php') or 
 * external URL such as:  url: 'http://www.example.com/avenir/ajaxserver/server.php'
 * depending to your requirements
 */
var email_server_url = './ajaxserver/serverfile.php';
var message_server_url = './ajaxserver/serverfile.php';
//Check if action attribute (which indicates server) of form tag is set, then choose it (low 
if($('.send_email_form').attr('action') && ($('.send_email_form').attr('action')) != ''){
    email_server_url = $('.send_email_form').attr('action');
}

if($('.send_message_form').attr('action') && ($('.send_message_form').attr('action') != '')){
    message_server_url = $('.send_message_form').attr('action');
}



$(function () {

    var $ajax = {
        sendEmail: function (p) {
            var form_fill = $(p);

            // Get the form data.
            var form_inputs = form_fill.find(':input');
            var form_data = {};
            form_inputs.each(function () {
                form_data[this.name] = $(this).val(); 
            });
            console.log(form_data);
//            var form_data = $(form_fill).serialize();
//            form_data['email'] = $('#email-sub').val(); 
            $.ajax(
                {
                    /*
                     *Your Ajax Server Here, 
                     * use internal url (such as './ajaxserver/server.php') or 
                     * external URL such as:  url: 'http://www.example.com/avenir/ajaxserver/server.php'
                     * depending to your requirements
                     */
                    url: email_server_url,
                    // url: $('.send_email_form').attr('action'),
                    type: 'get',
                    data: form_data,
                    dataType: 'json',

                    /* CALLBACK FOR SENDING EMAIL GOEAS HERE */
                    success: function (data) {
                        //Ajax connexion was a success, now handle response
                        if (data && !data.error) {
                            // Hide for if no error
                            $('.invite').addClass('invisible');
                            $('.send_email_form .email_f').addClass('invisible');
                            $('.send_email_form .email_b').addClass('invisible');
                            $('.send_email_form .fields').addClass('invisible');
                            $('.send_email_form .email-ok').removeClass('invisible');
                        }
                        // Else the login credentials were invalid.
                        else {
                           //Ajax connexion reject an error a success, now handle response
                            console.log('Could not process AJAX request to server');
                        }
                    },
                    /* show error message */
                    error: function (jqXHR, textStatus, errorThrown) {
                        //ajax error
                        console.log('ajax error');
                        
                    }
                    /* END EMAIL SENDING CALLBACK */
                });
        },
            
        sendMessage:function (p) {
            var form_fill = $(p);

            // Get the form data.
            var form_inputs = form_fill.find(':input');
            var form_data = {};
            form_inputs.each(function () {
                form_data[this.name] = $(this).val(); 
            });
            console.log(form_data);
            
            $.ajax(
                {
                    /*
                     *Your Ajax Server Here, 
                     * use internal url (such as './ajaxserver/server.php') or 
                     * external URL such as:  url: 'http://www.example.com/avenir/ajaxserver/server.php'
                     * depending to your requirements
                     */
                    url: message_server_url,
                    // url: $('.send_message_form').attr('action'),
                    type: 'get',
                    data: form_data,
                    dataType: 'json',

                    /* CALLBACK FOR SENDING EMAIL GOEAS HERE */
                    success: function (data) {

                        // If the returned login value successful.
                        if (data && !data.error) {

                           // notify user that message has been sent
  $('.send_message_form input').val("");
  $('.send_message_form textarea').val("");
  $('.message-ok').removeClass('invisible');
                        }
                        // Else the login credentials were invalid.
                        else {
                            /* show validation error */
                            $('.message').html(data.error);
                        }
                    },
                    /* show error message */
                    error: function (jqXHR, textStatus, errorThrown) {
                        $('.message').html('Error when sending email.');
                    }
                    /* END EMAIL SENDING CALLBACK */
            });
        }
    };

    /* delegate submit event via ajax */
    $('.send_email_form').submit(function (event) {
        event.preventDefault();
        console.log('request sent to server');
        $ajax.sendEmail(this);
    });
    
    $('.send_message_form').submit(function (event) {
        event.preventDefault();
        console.log('message should be sent');
        $ajax.sendMessage(this);
    });
    
});

