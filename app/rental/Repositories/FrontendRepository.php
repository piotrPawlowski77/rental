<?php


namespace App\rental\Repositories;

//komunikacja z BD

use App\Models\Contact;
use App\rental\Interfaces\FrontendRepositoryInterface;

class FrontendRepository implements FrontendRepositoryInterface
{
    public function sendContactMessage($request)
    {
        //Tworze instancje kontaktu
        $contact = new Contact();

        $contact->email = $request->input('email');
        $contact->message_content = $request->input('message_content');

        return $contact->save();
    }
}
