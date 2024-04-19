<?php

namespace App\Controller;

use App\Model\ContactManager;
use App\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * Display contact page
     */
    public function contact(): string
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $contact = array_map('trim', $_POST);
            // TODO validations (length, format...)
            if (empty($contact['lastname'])) {
                $errors['lastname'] = 'Le nom est obligatoire';
            }
            if (empty($contact['firstname'])) {
                $errors['firstname'] = 'Le prénom est obligatoire';
            }
            if (empty($contact['email'])) {
                $errors['email'] = 'L\'email du contact est obligatoire';
            }
            if (filter_var($contact['email'], FILTER_VALIDATE_EMAIL) === false) {
                $errors['email'] = 'L\'adresse email n\'est pas valide';
            }
            if (mb_strlen($contact['message']) < 30) {
                $errors['message'] = 'Le message doit faire plus de 30 caractères';
            }
            if (empty($errors)) {
                // if validation is ok, insert and redirection
                $contactManager = new ContactManager();
                $contactManager->insert($contact);
            }
        }
        return $this->twig->render('Contact/contact.html.twig', ['errors' => $errors]);
    }
}
