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
     $post_date = Carbon::now()->format("Y-d-m");
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

//update
//  public function update(PostCrudRequest $request , $id){
//     $post_date = Carbon::now()->format("Y-m-d");
//     try{
//         $this->PostCrudService->updatePost($request->title, $request->image ,  $request->is_active ,$post_date , $id); 
        
//         $redirectRoute = route('user.post.all');
//         return response()->json(['redirect' => $redirectRoute , 'redirectMessage' => 'Post Updated Successfully'],200);               
    
//     }catch(Exception $e){
//         return response()->json(['error' => $e->getMessage()], 200);

//     }
//    }

//update
public function update(Request $request,$id){
    $post_date = Carbon::now()->format("Y-d-m");
    try {
        $my_post = Post::findOrFail(decrypt($id));
        $my_post->title = $request->title;
        $my_post->post_date = $post_date;
        $my_post->is_active = $request->is_active;
    
        // image insert 
        if ($request->image) {

            //insert that image
            if (File::exists('frontend/assets/task_img/' . $my_post->image)) {
                File::delete('frontend/assets/task_img/' . $my_post->image);
            }
            $image = $request->file('image');
            $img = time() . Str::random(12) . '.' . $image->getClientOriginalExtension();
            $location = public_path('frontend/assets/task_img/' . $img);
            Image::make($image)->save($location);
            $my_post->image = $img;
        }
        if ($my_post->save()) {
            $redirectRoute = route('user.post.all');
            return response()->json(['redirect' => $redirectRoute , 'redirectMessage' => 'Post Updated Successfully'],200);               
        }
    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 200);
    }
}

//delete
   public function delete($id){
        $my_post = Post::findOrFail(decrypt($id));
        if (!is_null($my_post)) {
            if (File::exists('frontend/assets/task_img/' . $my_post->image)) {
                File::delete('frontend/assets/task_img/' . $my_post->image);
            }
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
