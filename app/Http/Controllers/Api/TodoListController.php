<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TodoList;

class TodoListController extends Controller
{
    //
    
    public function show($id){

        $list = TodoList::find($id);
        return response($list);
    }
}
