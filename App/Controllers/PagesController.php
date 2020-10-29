<?php
namespace App\Controllers;

use Core\Controller;

class PagesController extends Controller
{
    public function index()
    {
        return view("home.php", [
            "lang" => "pt-br",
            "name" => "John Doe",
            "header" => partial("templates/header.php"),
            "footer" => partial("templates/footer.php"),
        ]);
    }
}
