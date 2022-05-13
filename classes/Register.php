<?php


class Register{

	public $database;
	public $dataFormat;


	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();
	}

	// verify email address......
	public function send_user_verify_email($name, $email, $userVToken){

		try {
			$mail = new PHPMailer(true);
			$mail->isSMTP();           
			$mail->SMTPAuth   = true; 

	        //Enable SMTP authentication
	        $mail->Host       = 'smtp.gmail.com';  
		    $mail->Username   = 'minulhasanrokan@gmail.com';                     //SMTP username
		    $mail->Password   = '...G1999e@';                               //SMTP password
		    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
		    $mail->Port       = 587;                                    //

		    //Recipients
		    $mail->setFrom('minulhasanrokan@gmail.com', 'Admin');
		    $mail->addAddress('$email', '$name');     //Add a recipient

		    //Content
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->Subject = 'Here is the subject';
		    $emailTemplate = "<h2>
		    					You Have Successfully Registered with this Email: 
		    				  </h2>".$email."<p>Please Verify Your Email Account To Login your Account click the link blew:</p>
		    				  <a href='http://localhost/blog/admin/verify-email.php?token=".$userVToken."'>Click Here</a>
		    				  ";
		    $mail->Body    = $emailTemplate;

		    $mail->send();
		} catch (Exception $e) {
		    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
}