<?php
namespace App\Controllers;

use App\Helpers\Mail;
use Core\Controller;

class MailController extends Controller
{
    public function index()
    {
        return view("mail.php", [
            "lang" => "pt-br",
            "name" => "John Doe",
        ]);
    }

    public function send()
    {
        $mail = new Mail();
        $isMailSent = $mail
            ->add(
                "teste",
                "<h1>Hello</h1><p>World</p>",
                "lincoln",
                "lincoln.ayabe@gmail.com"
            )
            ->send();

        if (!$isMailSent) {
            echo $mail->getError()->getMessage();
            return;
        }

        echo "E-mail enviado com sucesso";
    }
}
