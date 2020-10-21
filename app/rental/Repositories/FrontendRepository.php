<?php


namespace App\rental\Repositories;

//komunikacja z BD

use App\Models\Contact;
use App\rental\Interfaces\FrontendRepositoryInterface;

class FrontendRepository implements FrontendRepositoryInterface
{

    public function getEmailFromContactTable($request)
    {
        //$contact = Contact::select('email')->where('email', $request->email)->first();
        return Contact::select('email')->where('email', $request->email)->first();
        //dd($contact->email);
        //return $contact->email;
    }

    public function saveContactMessage($request)
    {
        //Tworze instancje kontaktu
        $contact = new Contact();

        $contact->email = $request->input('email');
        $contact->message_content = $request->input('message_content');

        $contact->save();

        return redirect()->back()->with('message', 'Dane wysłano pomyślnie.');
    }
}
