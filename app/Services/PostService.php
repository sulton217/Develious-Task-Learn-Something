<?php 

namespace App\Services;
use App\Repositories\PostRepository;
use InvalidArgumentException;
use Validator;

class PostService 
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAll()
    {
         return $this->postRepository
         ->getAll();
    }

    public function store($data)
    {
         $validator = Validator::make($data,[
                'title' => 'required',
                'description' => 'required',
         ]);

         if($validator->fails()){
               throw new InvalidArgumentException($validator->errors()->first());                              
         }

         $result = $this->postRepository->save($data);

         return $result;

    }

    // public function update($data)
    // {
    //      $validator = Validator::make($data,[
    //             'title' => 'required',
    //             'description' => 'required',
    //      ]);

    //      if($validator->fails()){
    //            throw new InvalidArgumentException($validator->errors()->first());                              
    //      }

    //      $result = $this->postRepository->update($data);

    //      return $result;

    // }

}
?>