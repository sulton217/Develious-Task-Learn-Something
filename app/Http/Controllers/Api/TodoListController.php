<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TodoList;
//handling penulisan  status 200 menjadi successfully (simple) dari simfony
use Symfony\Component\HttpFoundation\Response;
class TodoListController extends Controller
{
    //
    
    public function show($id){

        $list = TodoList::find($id);
        return response($list);
    }

    public function store(Request $request){

        $list = TodoList::create($request->all());
        return $list;
    }

    public function destroy(TodoList $list){
        $list->delete();
        //use respon bawaan simfony
        return response('',Response::HTTP_NO_CONTENT);
    }

    public function update(Request $request,  TodoList $list){
        $list->update($request->all());
        //use respon bawaan simfony
        return $list;
    }
    
}
