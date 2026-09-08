<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactThanksMail;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        // まだ保存はしないが、Contactモデルに詰め替えることで
        // gender_label のようなモデルのアクセサをこの確認画面でも使えるようにする
        $contact = new Contact($request->all());
        $contact->tel1 = $request->tel1;
        $contact->tel2 = $request->tel2;
        $contact->tel3 = $request->tel3;
        $category = Category::find($contact['category_id']);
        $category_content = $category ? $category->content : '';

        return view('confirm', compact('contact', 'category_content'));
    }

    public function store(ContactRequest $request)
    {
        if($request->has('back')){
            return redirect('/')->withInput();
        }

        $contact = $request->only([
            'category_id', 'first_name', 'last_name', 'gender',
            'email', 'tel', 'address', 'building', 'detail'
        ]);

        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;
        $created = Contact::create($contact);

        Mail::to($created->email)->send(new ContactThanksMail($created));

        return view('thanks');
    }
}