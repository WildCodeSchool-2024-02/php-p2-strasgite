<?php

namespace App\Controller;

class ContactController extends AbstractController
{
    /**
     * Display contact page
     */
    // public function contact(): string
    // {
    //     return $this->twig->render('Home/contact.html.twig');
    // }
        /**
     * Send contact form
     */
    public function contact(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $contact = array_map('trim', $_POST);
            // $contact = array_map('htmlentities', $contact);
            $errors = [];

            // TODO validations (length, format...)
            if (empty($contact['lastname'])) {
                $errors[] = 'Le nom est obligatoire';
            }
            if (empty($contact['firstname'])) {
                $errors[] = 'Le prénom est obligatoire';
            }
            if (empty($contact['email'])) {
                $errors[] = 'L\'email du contact est obligatoire';
            }
            if (empty($contact['message'])) {
                $errors[] = 'Le message est obligatoire';
            }
            if (!filter_var($contact['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'L\'adresse email n\'est pas valide';
            }
            if (mb_strlen($contact['message']) < 30) {
                $errors[] = 'Le message doit faire plus de 30 caractères';
            } else {
            // if validation is ok, insert and redirection
                $contactManager = new ContactManager();
                $id = $contactManager->insert($contact);

                header('Location:/contact/sent?id=' . $id);
                return null;
            }
        }

        return $this->twig->render('Home/contact.html.twig');
    }
        /**
     * Show informations for a specific item
     */
    public function sent(int $id): string
    {
        $contactManager = new ContactManager();
        $contact = $contactManager->selectOneById($id);

        return $this->twig->render('Item/recapForm.html.twig', ['contact' => $contact]);
    }
        /**
     * Show informations for a specific item
     */
    public function recap(int $id): string
    {
        $contactManager = new ContactManager();
        $contact = $contactManager->selectOneById($id);

        return $this->twig->render('Item/recapForm.html.twig', ['contact' => $contact]);
    }
}
