<?php
$response = array();
/**
 IMPORTANT : 
  - Change mailcimp API Key and List ID by your own
  - Change message from user email recipient by your own
*/
/*
 *Handle Email Subscription Form, Use GET instead of POST since Internet Explorer makes restriction on POST request
 */
// check email into post data
if (isset($_GET['submit_email'])) {
//    $email = $_GET['email'];  
    $email = filter_var(@$_GET['email'], FILTER_SANITIZE_EMAIL );   
    if (!isset($response['error']) || $response['error'] === '') {

//      Store email address
//        $response = $this->storeAddress($email);
        $response = storeAddress($email);
    }
    echo json_encode($response);    
} 

/**
 * store address to mailchimp mailing list
 * IMPORTANT : 
 - Replace 'YOUR_APIKEY_HERE' by your api key from your mailchimp
     Get one here http://admin.mailchimp.com/account/api/
 - Replace 'YOUR_LISTID_HERE' by your list's unique ID
    Create a list here http://admin.mailchimp.com/lists/
    Then Click the "settings" link for the list - the Unique Id is at the bottom of that page. 
 */
function storeAddress($user_email){
	$m_response = array();
    
	// Validation
	if(!$user_email){ 
        $m_response['error'] = "No email address provided";
        return $m_response; 
    } 

	if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $user_email)) {
        $m_response['error'] = "Email address is invalid";
        return $m_response; 
	}

	require_once('MCAPI.class.php');
    
	// grab an API Key from http://admin.mailchimp.com/account/api/
	$api = new MCAPI('YOUR_APIKEY_HERE');
	
	// grab your List's Unique Id by going to http://admin.mailchimp.com/lists/
	// Click the "settings" link for the list - the Unique Id is at the bottom of that page. 
	$list_id = "YOUR_LISTID_HERE";

	if($api->listSubscribe($list_id, $user_email, '') === true) {
		// It worked!	
        $m_response['success'] = 'You will be notified';
		//return 'Success! Check your email to confirm sign up.';
	}else{
		// An error ocurred, return error message
        $m_response['error'] = 'Error: Something went wrong' . $api->errorMessage;
		//return 'Error: ' . $api->errorMessage;
	}
	return $m_response;
}



/*
 *Handle Message From
 */
// check email into post data
if (isset($_GET['submit_message'])) {
    $email = trim($_GET['email']);
    $name = trim($_GET['name']);
    $message = trim($_GET['message']);
    
    
	$email = filter_var(@$_GET['email'], FILTER_SANITIZE_EMAIL );
	
	$name = htmlentities($name);
	$message = htmlentities($message);

//    Form validation handles by the server here if required
	/*
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['error']['email'] = "<li>A valid email is required.</li>";
    }
    if (empty($name) || strlen($name) < 3) {
        $response['error']['name'] = '<li>Name is required with at least 3 characters</li>';
    }
    if (empty($message)) {
        $response['error']['message'] = '<li>Empty message is not allowed</li>';
    }
	*/
//    End form validation


    if (!isset($response['error']) || $response['error'] === '') {       

        
		/* in this sample code, messages will be stored in a text file */
//        PROCESS TO STORE MESSAGE GOES HERE
        
        $content = "Name: " . $name . " \r\nEmail: " . $email . " \r\nMessage: " . $message;
        $content = str_replace(array('<','>'),array('&lt;','&gt;'),$content);
        $name = str_replace(array('<','>'),array('&lt;','&gt;'),$name);
        $message = str_replace(array('<','>'),array('&lt;','&gt;'),$message);
        
        // -- BELOW : EXAMPLE SEND YOU AN EMAIL CONTAINING THE MESSAGE (comment to disable it/ uncomment it to enable it)
        // Set the recipient email address.
        // IMPORTANT - FIXME: Update this to your desired email address (relative to your server domaine).
        $recipient = "your@email.com";

        // Set the email subject.
        $subject = "Message From ".$name;

        // Build the email content.
        $email_content = $message."\n \n";        
        $email_content .= "Sincerely,";
        $email_content .= "From: $name\n\n";
        $email_content .= "Email: $email\n\n";

        // Build the email headers.
        $email_headers = "From: $name <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
           // http_response_code(200);
            $response['success'] = 'You will be notified';
            //echo "Thank You! Your message has been sent.";
        } else {
            // Set a 500 (internal server error) response code.
           // http_response_code(500);
            $response['error'] = 'Something went wrong';
            //echo "Oops! Something went wrong and we couldn't send your message.";
        }
        // -- END OF : EXAMPLE YOU AN EMAIL CONTAINING THE MESSAGE 
        
        // -- BELOW : EXAMPLE TO STORE MESSAGE USERS EMAIL IN A FILE "message.txt" (comment to disable it/ uncomment to enable it)
        /*
        file_put_contents("message.txt", $content . "\r\n---------\r\n", FILE_APPEND | LOCK_EX);
        */
        // -- END OF : EXAMPLE TO STORE MESSAGE USERS EMAIL IN A FILE
        
        
//        End  PROCESS TO STORE MESSAGE GOES HERE

        $response['success'] = 'Message sent successfully';
    } else {
        $response['error'] = '<ul>' . $response['error'] . '</ul>';
    }


    $response['email'] = $email;
    echo json_encode($response);
}

