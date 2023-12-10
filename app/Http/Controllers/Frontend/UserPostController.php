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
use Carbon\Carbon;

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
        
         $my_posts = Post::select('id','title','image','created_user_type','created_by','is_active','post_date')->where(['created_user_type'=>'user', 'created_by' => auth('user')->user()->id])->orderBy("id","desc")->get();
        return view($this->folderPath.'all-posts',compact('my_posts'));
    }

   public function create(){
    return view($this->folderPath.'create');
   }

   public function store(PostCrudRequest $request){
     $post_date = Carbon::now()->format("Y-m-d");
        try{
            $this->PostCrudService->storePost($request->title, $request->image , $post_date); 
            
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
    $post_date = Carbon::now()->format("Y-m-d");
    try{
        $this->PostCrudService->updatePost($request->title, $request->image ,  $request->is_active ,$post_date , $id); 
        
        $redirectRoute = route('user.post.all');
        return response()->json(['redirect' => $redirectRoute , 'redirectMessage' => 'Post Updated Successfully'],200);               
    
    }catch(Exception $e){
        return response()->json(['error' => $e->getMessage()], 200);

    }
   }

   public function delete($id){
        $my_post = Post::findOrFail(decrypt($id));
        if (!is_null($my_post)) {
            $my_post->delete();
        }
        session()->flash('success' , 'Post Deleted Successfull... ');
      return back();              

    }

    //search
    public function search(Request $request){
 
      $searchInput = $request->get('search');
         
         if($searchInput){
            $searchResult = Post::select('title','post_date')
            ->where(['created_by' => getAuthUserId(),
            'created_user_type' => getAuthUserType(),])
            ->where('post_date', 'like', $searchInput)
            ->orderBy("id","desc")
            ->take(20)
            ->get(); 
            if( $searchResult){
                return response()->json(['searchResult'=>$searchResult], 200);
            }
         }else{
            $searchResult = Post::orderBy("id","desc")->select('id','title','image','created_user_type','created_by','is_active','post_date')->where(['created_by' => getAuthUserId(),
            'created_user_type' => getAuthUserType(),])->orderBy("id","desc")->take(20)->get();
            return response()->json(['searchResult'=>$searchResult], 200);
         }
    }

 
}
