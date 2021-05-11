<?php

namespace App\Controller;

use App\Model\MessageManager;

class MessageController extends AbstractController
{
    public function message(): string
    {
        $success = [];
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (empty($_POST['firstname'])) {
                $errors = "Indique ton prénom Martien! .";
            }

            if (strlen($_POST['message']) < 5) {
                $errors = "Le message doit contenir plus de 5 caractères .";
            }

            if (empty($this->errors)) {
                $success = "Merci pour ton message ";

                $data = array_map('trim', $_POST);
                $firstname =  htmlentities($data['firstname']);
                $message = htmlentities($data['message']);

                $manager = new MessageManager();
                $manager->insert($firstname, $message);
                return $this->twig->Render('Home/index.html.twig', [
                    'success' => $success
                ]);
            }
        }

        return $this->twig->render('Message/form.html.twig', [
            'errors' => $errors
        ]);
    }
}
