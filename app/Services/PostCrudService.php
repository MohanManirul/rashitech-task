<?php
namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostCrudService{
    public function storePost($title,$image){
         
        $img = time() . Str::random(12) . '.' . $image->getClientOriginalExtension();
        $location = public_path('frontend/assets/task_img/' . $img);
        Image::make($image)->save($location);           
     
        Post::create([
            'title' => $title,
            'image' =>$img ,
            'created_by' => getAuthUserId(),
            'created_user_type' => getAuthUserType(),
          ]);
    }
}


?>