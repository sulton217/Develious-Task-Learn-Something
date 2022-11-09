<?php

namespace App\Http\Controllers;
use App\Services\PostService;
use Exception;
use Illuminate\Http\Request;
use Validator;
use App\Models\Post;
class PostController extends Controller
{
    //
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $result =['status' => 200];

        try{
            $result['data'] = $this->postService->getAll();
        } catch (Exception $e){
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result ['status']);
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'description',
        ]);

        $result = ['status' => 201];

        try {
                $result['data'] = $this->postService->store($data);
        } catch (Exception $e){
                $result = [
                    'status' => 500,
                    'error'  => $e->getMessage()
                ];
        }

        return response()->json($result, $result ['status']);
    }

    // public function update(Request $request )
    // {
    //     $data = $request->only([
    //         'title',
    //         'description',
    //     ]);

    //     $result = ['status' => 201];

    //     try {
    //             $result['data'] = $this->postService->update($data);
    //     } catch (Exception $e){
    //             $result = [
    //                 'status' => 500,
    //                 'error'  => $e->getMessage()
    //             ];
    //     }

    //     return response()->json($result, $result ['status']);
    // }

}
