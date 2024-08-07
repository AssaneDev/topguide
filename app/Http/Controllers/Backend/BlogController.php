<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller
{
    public function BlogCategory(){
       $category = BlogCategory::latest()->get();
       return view('backend.category.blog_category',compact('category'));
    }
    //end methode

    public function StoreBlogCategory(Request $request){
          BlogCategory::insert([
            'category_name'=>$request->category_name,
            'category_name_en'=>$request->category_name,
            'category_name_es'=>$request->category_name,
            'category_slug'=>strtolower(str_replace(' ','-',$request->category_name)),
            'category_slug_en'=>strtolower(str_replace(' ','-',$request->category_name_en)),
            'category_slug_es'=>strtolower(str_replace(' ','-',$request->category_name_es)),

          ]);
          $notification = array(
            'message'=>'Categorie Ajouter avec succes',
            'type'=>'success'
        );
        
        return redirect()->back()->with($notification);

    }
    //end methode
    public function EditBlogCategory($id){
        $categories = BlogCategory::find($id);

        return response()->json($categories);

    }//end methode
    public function UpdateBlogCategory(Request $request){
        $cat_id = $request->cat_id;
        BlogCategory::find($cat_id)->update([
          'category_name'=>$request->category_name,
          'category_name_en'=>$request->category_name_en,
          'category_name_es'=>$request->category_name_es,
          'category_slug'=>strtolower(str_replace(' ','-',$request->category_name)),
          'category_slug_en'=>strtolower(str_replace(' ','-',$request->category_name_en)),
          'category_slug_es'=>strtolower(str_replace(' ','-',$request->category_name_es)),
        ]);
        Artisan::call('optimize');
        $notification = array(
          'message'=>'Categorie mise à jour avec succes',
          'type'=>'success'
      );
      return redirect()->back()->with($notification);

  }//End 

  public function DeteleBlogCategory($id){
    BlogCategory::find($id)->delete();
    $notification = array(
        'message'=>'Categorie Supprimer avec succes',
        'type'=>'success'
    );
    
    return redirect()->back()->with($notification);
    
  }//End


  //All Blog Post Methode

  public function AllBlogPost(){
      $post = BlogPost::latest()->get();
      return view('backend.post.all_post',compact('post'));
  }//End

  public function AddBlogPost(){

    $blogcat = BlogCategory::latest()->get();
        return view('backend.post.add_post',compact('blogcat'));
  }//End

  public function StoreBlogPost(Request $request){
    $image = $request->file('post_image');
    $manager = new ImageManager(new Driver());
    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
      $img = $manager->read($image);
      $img = $img->resize(491,360);
      $img->toJpeg(80)->save(base_path('public/upload/article/'.$name_gen));
      
       $save_url = 'upload/article/'.$name_gen;

    BlogPost::insert([
        'blogcat_id'=>$request->blogcat_id,
        'user_id'=>Auth::user()->id,
        'post_title'=>$request->post_title,
        'post_slug'=>strtolower(str_replace(' ','-',$request->post_title)),
        'post_title_en'=>$request->post_title_en,
        'post_slug_en'=>strtolower(str_replace(' ','-',$request->post_title_en)),
        'post_title_es'=>$request->post_title_es,
        'post_slug_es'=>strtolower(str_replace(' ','-',$request->post_title_es)),
        'post_image'=>$save_url,
        'short_descp'=>$request->short_descp,
        'long_descp'=>$request->long_descp,
        'short_descp_en'=>$request->short_descp_en,
        'long_descp_en'=>$request->long_descp_en,
        'short_descp_es'=>$request->short_descp_es,
        'long_descp_es'=>$request->long_descp_es,

        'created_at'=>Carbon::now(),

    ]);
    $notification = array(
        'message' =>'Article ajouter avec succes',
        'alert-type' => 'success'
    );
    
    return  redirect()->route('all.blog.post')->with($notification);
}// END METHODE 


public function EditBlogPost($id){
   $post = BlogPost::find($id);
   $blogcat = BlogCategory::latest()->get();
    return view('backend.post.edit_post',compact('post','blogcat'));
}

public function UpdateBlogPost(Request $request){
    

        $post_id = $request->id;

        if ($request->file('post_image')) {
            $image = $request->file('post_image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
              $img = $manager->read($image);
              $img = $img->resize(491,360);
              $img->toJpeg(80)->save(base_path('public/upload/article/'.$name_gen));
            $save_url = 'upload/article/'.$name_gen;
             

        BlogPost::findOrFail ($post_id)->update([
            'blogcat_id'=>$request->blogcat_id,
            'user_id'=>Auth::user()->id,
            'post_title'=>$request->post_title,
            'post_slug'=>strtolower(str_replace(' ','-',$request->post_title)),
            'post_title_en'=>$request->post_title_en,
            'post_slug_en'=>strtolower(str_replace(' ','-',$request->post_title_en)),
            'post_title_es'=>$request->post_title_es,
            'post_slug_es'=>strtolower(str_replace(' ','-',$request->post_title_es)),
            'post_image'=>$save_url,
            'short_descp'=>$request->short_descp,
            'long_descp'=>$request->long_descp,
            'short_descp_en'=>$request->short_descp_en,
            'long_descp_en'=>$request->long_descp_en,
            'short_descp_es'=>$request->short_descp_es,
            'long_descp_es'=>$request->long_descp_es,
            'created_at'=>Carbon::now(),

        ]);
        $notification = array(
            'message' =>'Article modifier avec succes',
            'alert-type' => 'success'
        );
        
        return  redirect()->route('all.blog.post')->with($notification);
        }else{
            BlogPost::findOrFail ($post_id)->update ([
                'blogcat_id'=>$request->blogcat_id,
                'user_id'=>Auth::user()->id,
                'post_title'=>$request->post_title,
                'post_slug'=>strtolower(str_replace(' ','-',$request->post_title)),
                'post_title_en'=>$request->post_title_en,
                'post_slug_en'=>strtolower(str_replace(' ','-',$request->post_title_en)),
                'post_title_es'=>$request->post_title_es,
                'post_slug_es'=>strtolower(str_replace(' ','-',$request->post_title_es)),
                'short_descp'=>$request->short_descp,
                'long_descp'=>$request->long_descp,
                'short_descp_en'=>$request->short_descp_en,
                'long_descp_en'=>$request->long_descp_en,
                'short_descp_es'=>$request->short_descp_es,
                'long_descp_es'=>$request->long_descp_es,
                'created_at'=>Carbon::now(),
            ]);
            $notification = array(
                'message' =>'Article modifier avec succes',
                'alert-type' => 'success'
            );
            
            return  redirect()->route('all.blog.post')->with($notification);
      
    }
}//end methode
public function DeleteBlogPost($id) {
        $item = BlogPost::findOrFail($id);
        $img = $item->post_image;
        unlink($img);
        BlogPost::findOrFail($id)->delete();
        $notification = array(
            'message' =>'Article Supprimer avec succes',
            'alert-type' => 'success'
        );
        return  redirect()->back()->with($notification);
    } 
        
   public function BlogDetail($slug){

    $blog = BlogPost::where('post_slug',$slug)->first();
    $bcategory = BlogCategory::latest()->get();
    $lpost = BlogPost::latest()->limit(3)->get();

    return view('frontend.blog.blog_details', compact('blog','bcategory','lpost'));

   }

   public function BlogCatList($id){

    $blog = BlogPost::where('blogcat_id',$id)->get();
    $namecat = BlogCategory::where('id',$id)->first();
    $bcategory = BlogCategory::latest()->get();
    $lpost = BlogPost::latest()->limit(3)->get();

    return view('frontend.blog.blog_cat_list', compact('blog','bcategory','lpost','namecat'));


    

   }//End 
   public function BlogList(){
    $blog = BlogPost::latest()->paginate(4);
    $bcategory = BlogCategory::latest()->get();
    $lpost = BlogPost::latest()->limit(3)->get();

    return view('frontend.blog.blog_all', compact('blog','bcategory','lpost'));
   }



}

