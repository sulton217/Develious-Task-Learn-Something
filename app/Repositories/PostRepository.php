<?php 

namespace App\Repositories;
use App\Models\Post;

class PostRepository
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAll()
    {
         return $this->post->get();
    }

    public function save($data)
    {
        // $p = Post::where('id',1)->firstOrFail();
        // return $p;
        // $id = Post::where('title', '=', $data->title)->first();
        $post = new $this->post;

        $post->title = $data['title'];
        $post->description = $data['description'];

        $post->save();

        return $post->fresh();
    }

    // public function update($data)
    // {

    //      $update = Post::where('title', '=', $data->title)->first();
       
    //         $update->update([
    //             'title' => $data->title,
    //             'description' => $data->description,
    //         ]);

    //     return $post->fresh();
    // }

}
?>