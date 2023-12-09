<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCrudRequest;
use App\Models\Post;
use App\Services\PostCrudService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Exception;


class UserPostController extends Controller
{
    protected $folderPath;
    protected $PostCrudService;
    public function __construct(PostCrudService $PostCrudService)
    {
        $this->folderPath = 'frontend.posts.';
        $this->PostCrudService = $PostCrudService ;
    }
    public function index(){
        
         $my_posts = Post::select('id','title','image','created_user_type','created_by','is_active','created_at')->where(['created_user_type'=>'user', 'created_by' => auth('user')->user()->id])->get();
        return view($this->folderPath.'all-posts',compact('my_posts'));
    }

   public function create(){
    return view($this->folderPath.'create');
   }

   public function store(PostCrudRequest $request){
  
        try{
            $this->PostCrudService->storePost($request->title, $request->image); 
            
            $redirectRoute = route('user.post.all');
            return response()->json(['redirect' => $redirectRoute , 'redirectMessage' => 'Post Created Successfully'],200);               
        
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 200);

        }

   }

   //edit
   public function edit($id)
    {  
        $my_post = Post::findOrFail(decrypt($id));
        return view($this->folderPath.'edit', compact('my_post'));
       
   }


 public function update(PostCrudRequest $request , $id){
    try{
        $this->PostCrudService->updatePost($request->title, $request->image ,  $request->is_active , $id); 
        
        $redirectRoute = route('user.post.all');
        return response()->json(['redirect' => $redirectRoute , 'redirectMessage' => 'Post Updated Successfully'],200);               
    
    }catch(Exception $e){
        return response()->json(['error' => $e->getMessage()], 200);

    }
   }

 
}
