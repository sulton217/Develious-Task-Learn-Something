<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Repositories\ContactRepository; //import namespace \ clas
use Exception;
use Validator;

class ContactController extends Controller
{
    //
    private $contactRepository; //Atribut untuk menyimpan variabel construct
    public function __construct(ContactRepository $contactRepository) //memanggil repository
    {
        $this->contactRepository = $contactRepository; //memanggil method dari repository
    }
    public function index()
    {
        $contact = $this->contactRepository->getAll(); //memanggil method dari repository

        return $contact;
    }
 
    public function show($id)
    {
        $contact = $this->contactRepository->findById($id);
        return $contact;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
        'name' => 'required',
        'number' => 'required',
        'active' => 'required'
        ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
        $contact = $this->contactRepository->store($data);
        return $contact;

    }

    public function destroy($id)
    {
        $contact = $this->contactRepository->destroy($id);
        return $contact;
    }

}
