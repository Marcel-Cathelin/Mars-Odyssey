<?php

namespace App\Controller;

use App\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;

use function Amp\Iterator\toArray;

class FormController extends AbstractController
{

    public function form()
    {
        return $this->twig->render('form.html.twig');
    }
}
