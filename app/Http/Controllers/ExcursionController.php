<?php

namespace App\Http\Controllers;
use App\Models\ExcursionModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\multi_image_Excu;
use App\Models\BlogCategory;
use App\Models\BlogPost;

class ExcursionController extends Controller
{
     public function AllExcursion(){
        $desti = ExcursionModel::latest()->get();
        return view('backend.excursion.all_excursion',compact('desti'));
    }
    public function AddExcursion(){
       
        return view('backend.excursion.add_excursion');
    }
    public function StoreExcursion(Request $request){

    
        $image_cap = $request->file('image_cap');
        $manager_cap = new ImageManager(new Driver());
        $name_gen_cap = hexdec(uniqid()).'.'.$image_cap->getClientOriginalExtension();
         $img_cap = $manager_cap->read($image_cap);
         $img_cap = $img_cap->resize(579,660);
         $img_cap->toJpeg(80)->save(base_path('public/upload/excursion_cap/'.$name_gen_cap));
         
          $save_url_cap = 'upload/excursion_cap/'.$name_gen_cap;

          $image = $request->file('image');
          $manager = new ImageManager(new Driver());
          $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
           $img = $manager->read($image);
           $img = $img->resize(1362,900);
           $img->toJpeg(80)->save(base_path('public/upload/image_excursion/'.$name_gen));
           
            $save_url_image = 'upload/image_excursion/'.$name_gen;
   
       $id_excursion = ExcursionModel::insertGetId([
           'name'=>$request->name,
           'short_descp'=>$request->short_descp,
           'long_descp'=>$request->long_descp,
           'image_cap'=>$save_url_cap,
           'image'=>$save_url_image,
           'type_excursion'=>$request->type_excursion,
           'lieux'=>$request->lieux,
           'prix'=>$request->prix,
           'prix'=>$request->prix_guide,
           'information'=>$request->information,
            'dure_sejour'=>$request->dure_excursion,
            'offre_guide'=>$request->offre_guide,

       ]);
        
       if( $id_excursion){
           $files = $request->multi_img;
           if(!empty($files)){
               $subimage = multi_image_Excu::where('id_excursion',$id_excursion)->get()->toArray();
               // multi_image::where('id_destination',$id_destination)->delete();
           }
           if(!empty($files)){
              foreach ($files as $file) {
                 $imgName = date('YmdHi').$file->getClientOriginalName();
                 $file->move('upload/excursion/multi_img/',$imgName);
                 $subimage['multi_img'] = $imgName;
                 $subimage =new multi_image_Excu();
                 $subimage->id_excursion = $id_excursion;
                 $subimage->image =  $imgName;
                 $subimage->save();
              }
           }
        } //End If
   
        $notification = array(
           'message' =>'Bravo, Excursion ajouter avec succés',
           'alert-type' => 'success'
       );
    
       return redirect()->back()->with($notification);
     
        } //End Methode

        public function EditExcursion($id){

            $dataDesti = ExcursionModel::find($id);
            $multiimgs = multi_image_Excu::where('id_excursion',$id)->get();

            return view('backend.excursion.edit_excursion',compact('dataDesti','multiimgs'));

         }

        
         public function UpdateExcursion(Request $request){
            $id=$request->id;
            $excursion = ExcursionModel::find($id);
            $excursion->name = $request->name;
            $excursion->short_descp = $request->short_descp;
            $excursion->long_descp = $request->long_descp;
            $excursion->prix = $request->prix;
            $excursion->prix_guide = $request->prix_guide;
            $excursion->dure_sejour = $request->dure_sejour;
            $excursion->type_excursion=$request->type_excursion;
            $excursion->lieux=$request->lieux;
            $excursion->offre_guide=$request->offre_guide;
            $excursion->prix_guide=$request->prix_guide;
            $excursion->information=$request->information;
            
    
            if($request->file('image_cap')) {
              

               $image_cap = $request->file('image_cap');
               $manager_cap = new ImageManager(new Driver());
               $name_gen_cap = hexdec(uniqid()).'.'.$image_cap->getClientOriginalExtension();
                $img_cap = $manager_cap->read($image_cap);
                $img_cap = $img_cap->resize(579,660);
                $img_cap->toJpeg(80)->save(base_path('public/upload/excursion_cap/'.$name_gen_cap));
                $save_url = 'upload/excursion_cap/'.$name_gen_cap;
                $excursion['image_cap'] = $save_url;

            }

            if ($request->file('image')) {
                
               $image = $request->file('image');
               $manager = new ImageManager(new Driver());
               $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                $img = $manager->read($image);
                $img = $img->resize(1362,900);
                $img->toJpeg(80)->save(base_path('public/upload/image_excursion/'.$name_gen));
                $save_url = 'upload/image_excursion/'.$name_gen;
                $excursion['image'] =  $save_url ;
            }
            $excursion->save();

                    //Update multi_image
            if($excursion->save()){
                $files = $request->multi_img;
                if(!empty($files)){
                    $subimage = multi_image_Excu::where('id_destination',$id)->get()->toArray();
                    // multi_image::where('id_destination',$id)->delete();
                }
                if(!empty($files)){
                foreach ($files as $file) {
                    $imgName = date('YmdHi').$file->getClientOriginalName();
                    $file->move('upload/destination/multi_img/',$imgName);
                    $subimage['multi_img'] = $imgName;
                    $subimage =new multi_image_excu();
                    $subimage->id_excursion= $excursion->id;
                    $subimage->image =  $imgName;
                    $subimage->save();
                }
                }
            } //End If

            $notification = array(
                'message' =>'Bravo, Destination modifier avec succés',
                'alert-type' => 'success'
            );
           

            return redirect()->back()->with($notification);
         } 

         //end

         public function DeleteMultiImage($id){
            $deleteData = multi_image_Excu::where('id',$id)->first();
            if($deleteData){
                $imagePath = $deleteData->multi_img;
                // Check idf the file exists before unlinking
   
                if(file_exists($imagePath)){
                    unlink($imagePath);
                    echo"Image unlink successfully";
                }else{
                   echo"Image does not exist";
                }
                //Delete The Recordform database
                multi_image_Excu::where('id',$id)->delete();
            }
            $notification = array(
               'message' =>'Image supprimer avec avec succés',
               'alert-type' => 'success'
           );
            
            return Redirect()->back()->with($notification);
       }

       public function DeleteExcursion($id) {
        $item = ExcursionModel::findOrFail($id);
        $img = $item->image_cap;
        $imgs = $item->image;
        unlink($img);
        unlink($imgs);
        ExcursionModel::findOrFail($id)->delete();
        $deleteData = multi_image_Excu::where('id_excursion',$id)->first();
            if($deleteData){
                $imagePath = $deleteData->multi_img;
                // Check idf the file exists before unlinking
   
                if(file_exists($imagePath)){
                    unlink($imagePath);
                    echo"Image unlink successfully";
                }else{
                   echo"Image does not exist";
                }
                //Delete The Recordform database
                multi_image_Excu::where('id_excursion',$id)->delete();
            }
        $notification = array(
            'message' =>'Destination Supprimer avec succes',
            'alert-type' => 'success'
        );
        
        return  redirect()->back()->with($notification);
    } 
    //end
    public function Excursion(){
        $destination = ExcursionModel::latest()->get();
        return view('frontend.excursion.excursion_all',compact('destination'));
     }  
    //end
    public function ExcursionDetail($id){

        $destination = ExcursionModel::where('id',$id)->first();
        $imageGalerie = multi_image_Excu::where('id_excursion',$id)->get();
        $bcategory = BlogCategory::latest()->get();
        $lpost = BlogPost::latest()->limit(3)->get();
      
        
    
        return view('frontend.excursion.detail_excursion', compact('destination','imageGalerie','bcategory','lpost'));
    
       }  



   


}
