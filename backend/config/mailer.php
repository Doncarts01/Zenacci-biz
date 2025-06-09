<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    private $mail;

    public function __construct(PHPMailer $mail) { 
        $this->mail = $mail;
        $this->setup();
    }

    private function setup() {
        try {
            $this->mail->SMTPDebug = 0; 
            $this->mail->isSMTP();
            $this->mail->Host = $_ENV['MAIL_HOST']; 
            $this->mail->SMTPAuth = true;
            $this->mail->Username = $_ENV['MAIL_USERNAME'];
            $this->mail->Password = $_ENV['MAIL_PASSWORD'];
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = $_ENV['MAIL_PORT']; 
            $this->mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
        } catch (Exception $e) {
            throw new \Exception("Mailer setup error: " . $this->mail->ErrorInfo);
        }
    }

    public function sendMail($to, $subject, $body, $isHTML = true, $attachments = []) {
        try {
            $this->mail->addAddress($to);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->AltBody = strip_tags($body); // Plain text version
            $this->mail->isHTML($isHTML);

            if($attachments){
                foreach ($attachments as $attachment) {
                    $this->mail->addAttachment($attachment);
                }
            }


            if (!$this->mail->send()) {
                throw new \Exception("Email sending failed: " . $this->mail->ErrorInfo);
            }

            return true; // Success

        } catch (Exception $e) {
            throw new \Exception("Email sending failed: " . $this->mail->ErrorInfo);
        }
    }
}


?>