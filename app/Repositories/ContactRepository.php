<?php 

namespace App\Repositories;
use App\Models\Contact;

class ContactRepository
{

    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function getAll(){
        $contact = Contact::orderBy('name')
        ->where('active',1)
        ->where('number','LIKE','+%')
        ->get()
        ->map(function ($contact){
                return $this->format($contact);
        });
        return $contact;
        
    }
    
    public function format($contact)
    {
        return [
            'contact_id' => $contact->id,
            'name' => $contact->name,
            'number' => $contact->number,
            'status' => $contact->active ? 'active' : 'inactive',

        ];
    }
    

    public function findById($id)
    {
        $contact = Contact::where('id',$id)->firstOrFail();
        return $this->format($contact);
    }


    public function store($data)
    {
        // $p = Post::where('id',1)->firstOrFail();
        // return $p;
        // $id = Post::where('title', '=', $data->title)->first();
        $contact = new $this->contact;
        $contact->name = $data['name'];
        $contact->number = $data['number'];
        $contact->active = $data['active'];

        $contact->save();
        return response()->json([
            "message" => "Contact created successfully.",
            "data" => $contact
            ],201);

    }


    
    public function destroy($id)
    {
    $contact = Contact::findOrFail($id);
    $contact->delete();

    if ($contact) {
        return response()->json([
            "message" => "Contact Deleted successfully.",
            "data" => $contact
            ],200);
    } else {
        return response()->json([
            "message" => "ID Tidak Ditemukan.",
            "data" => $contact
            ],400 );
    }

    }
}
?>