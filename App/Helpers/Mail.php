<?php
namespace App\Helpers;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use stdClass;

class Mail
{
    private PHPMailer $mail;
    private stdClass $data;
    private Exception $error;

    public function __construct(string $lang = "br")
    {
        $this->mail = new PHPMailer(true);
        $this->data = new stdClass();

        $this->mail->isSMTP();
        $this->mail->setLanguage($lang);

        $this->mail->Port = $_ENV['MAIL_PORT'];
        $this->mail->Host = $_ENV['MAIL_HOST'];
        $this->mail->isHTML();
        $this->mail->SMTPSecure = "smtp";
        $this->mail->CharSet = "utf-8";

        $this->mail->SMTPAuth = true;
        $this->mail->Username = $_ENV['MAIL_USER'];
        $this->mail->Password = $_ENV['MAIL_PASSWORD'];
    }

    public function add(
        string $subject,
        string $body,
        string $recipientName,
        string $recipientEmail
    ): self {
        $this->data->subject = $subject;
        $this->data->body = $body;
        $this->data->recipientName = $recipientName;
        $this->data->recipientEmail = $recipientEmail;

        return $this;
    }

    public function attach(string $path, string $filename): self
    {
        $this->data->attach[$path] = $filename;
        return $this;
    }

    public function send(string $fromName = "", string $fromEmail = ""): bool
    {
        $fromName = $fromName !== "" ? $fromName : $_ENV['MAIL_FROM_NAME'];
        $fromEmail = $fromEmail !== "" ? $fromEmail : $_ENV['MAIL_FROM_EMAIL'];

        try {
            $this->mail->Subject = $this->data->subject;
            $this->mail->msgHTML($this->data->body);
            $this->mail->addAddress(
                $this->data->recipientEmail,
                $this->data->recipientName
            );

            $this->mail->setFrom($fromEmail, $fromName);

            if (!empty($this->data->attach)) {
                foreach ($this->data->attach as $path => $name) {
                    $this->mail->addAttachment($path, $name);
                }
            }

            $this->mail->send();
            return true;
        } catch (\Exception $exception) {
            $this->error = $exception;
            return false;
        }
    }

    public function getError(): ?Exception
    {
        return $this->error;
    }
}
