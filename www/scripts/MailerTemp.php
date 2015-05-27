<?php
abstract class Mailer
{
    public static function Send($to, $subject, $message, $from = null, $attachmentName = null)
    {
        $ret = false;
        $santizer = Validator::instance();
        $to = $santizer->Sanitize("email", $to);
        $subject = $santizer->Sanitize("string", $subject);
        $message = $santizer->Sanitize("string", $message);
        $from = (($from === null) ? "noreply" : $santizer->Sanitize("string", $from));
        $domain = "@sitandbefitresearch.org";

        if (!$santizer->Validate("email", $to))
            echo "The 'To' address('$to') is not a valid email";
        else {
            $from .= $domain;
            $headers = array();
            $headers[] = "From: $from";
            $headers[] = "Reply-To: $from";
            $headers[] = "X-Mailer: PHP/" . phpversion();
            $headers = implode("\r\n", $headers);
			
			//------------------------------------------------
			if($attachmentName != null)
			{
				$attachment = chunk_split(base64_encode(file_get_contents('attachment.zip')));
				$message = $message . $attachment;
			}
			//-----------------------------------------------------------

            if ($_SERVER['SERVER_NAME'] === "localhost") {
                echo "Headers:\n\t$headers\n\n";
                echo "To:\n\t$to\n";
                echo "From:\n\t$from\n";
                echo "Subject:\n\t$subject\n";
                echo "Message:\n\t$message\n";
            } else
                $ret = mail($to, $subject, $message, $headers);
        }
        return $ret;
    }
	
}