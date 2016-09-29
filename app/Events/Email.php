<?php

class Email
{

    /**
     * 邮件发送
     * @param array $data [to:发给谁；subject:主题；body：消息体(html类型)]
     * @param bool $debug
     */
    static public function send($data = [], $debug = false)
    {
        $register = Register::getInstance();
        $config = $register->config->offsetGet('email');

        $mail = new PHPMailer;
        $mail->isSMTP();                                // Set mailer to use SMTP
        $mail->Host = $config['Host'];                // Specify main and backup SMTP servers
        $mail->SMTPAuth = $config['SMTPAuth'];          // Enable SMTP authentication
        $mail->Username = $config['Username'];          // SMTP username
        $mail->Password = $config['Password'];          // SMTP password
        $mail->SMTPSecure = $config['SMTPSecure'];      // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $config['Port'];                  // TCP port to connect to

        $mail->setFrom($config['Username'], $config['Who']);
        $mail->addAddress($data['to']);                // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $data['subject'];
        $mail->Body = $data['body'];
        if ($debug != false) {
            $mail->SMTPDebug = 3;                                // Enable verbose debug output
        }
        echo $mail->send() ? 'Message has been sent' : $mail->ErrorInfo;
    }
}