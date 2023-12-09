<?php
namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

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
    
    //update
    public function updatePost($title,$image, $is_active,$id){
        if (File::exists('frontend/assets/task_img/' . $image)) {
            File::delete('frontend/assets/task_img/' . $image);
        }
        $img = time() . Str::random(12) . '.' . $image->getClientOriginalExtension();
        $location = public_path('frontend/assets/task_img/' . $img);
        Image::make($image)->save($location);           
     
        Post::where('id', decrypt($id))
        ->update([
            'title' => $title,
            'image' =>$img ,
            'is_active' =>$is_active 
          ]);
    }
}


?>