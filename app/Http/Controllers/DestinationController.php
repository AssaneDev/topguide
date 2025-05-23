<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\multi_image;
use App\Models\BlogCategory;
use App\Models\BlogPost;

use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;


class DestinationController extends Controller
{
    //

    public function AllDestination(){
        $desti = Destination::latest()->get();
        return view('backend.destination.all_destination',compact('desti'));
    }

    public function AddDestination(){
       
        return view('backend.destination.add_destination');
    }

    public function StoreDestination(Request $request){

    
         $image_cap = $request->file('image_cap');
         $manager_cap = new ImageManager(new Driver());
         $name_gen_cap = hexdec(uniqid()).'.'.$image_cap->getClientOriginalExtension();
          $img_cap = $manager_cap->read($image_cap);
          $img_cap = $img_cap->resize(370,150);
          $img_cap->toJpeg(80)->save(base_path('public/upload/dest_cap/'.$name_gen_cap));
          
           $save_url_cap = 'upload/dest_cap/'.$name_gen_cap;

           $image = $request->file('image');
           $manager = new ImageManager(new Driver());
           $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img = $img->resize(1362,900);
            $img->toJpeg(80)->save(base_path('public/upload/image_desti/'.$name_gen));
            
             $save_url_image = 'upload/image_desti/'.$name_gen;
    
        $id_destination = Destination::insertGetId([
            'name'=>$request->name,
            'short_descp'=>$request->short_descp,
            'long_descp'=>$request->long_descp,
            'image_cap'=>$save_url_cap,
            'image'=>$save_url_image,
            'type_circuit'=>$request->type_circuit,
            'lieux'=>$request->lieux,
            'prix'=>$request->prix,
            'prix'=>$request->prix_guide,
            'information'=>$request->information,
             'dure_sejour'=>$request->dure_circuit,
             'offre_guide'=>$request->offre_guide,

            // //Anglais
            // 'name_en'=>$request->name_en,
            // 'short_descp_en'=>$request->short_descp_en,
            // 'long_descp_es'=>$request->long_descp_en,

            // //Espagnol
            // 'name_es'=>$request->name_es,
            // 'short_descp_es'=>$request->short_descp_es,
            // 'long_descp_es'=>$request->long_descp_es,
        ]);
         
        if( $id_destination){
            $files = $request->multi_img;
            if(!empty($files)){
                $subimage = multi_image::where('id_destination',$id_destination)->get()->toArray();
                // multi_image::where('id_destination',$id_destination)->delete();
            }
            if(!empty($files)){
               foreach ($files as $file) {
                  $imgName = date('YmdHi').$file->getClientOriginalName();
                  $file->move('upload/destination/multi_img/',$imgName);
                  $subimage['multi_img'] = $imgName;
                  $subimage =new multi_image();
                  $subimage->id_destination = $id_destination;
                  $subimage->image =  $imgName;
                  $subimage->save();
               }
            }
         } //End If
    
         $notification = array(
            'message' =>'Bravo, destination ajouter avec succés',
            'alert-type' => 'success'
        );
     
        return redirect()->back()->with($notification);
      
         } //End Methode


         public function EditDestination($id){

            $dataDesti = Destination::find($id);
            $multiimgs = multi_image::where('id_destination',$id)->get();

            return view('backend.destination.edit_destination',compact('dataDesti','multiimgs'));

         }


         public function UpdateDestination(Request $request){
            $id=$request->id;
            $destination = Destination::find($id);
            $destination->name = $request->name;
            $destination->short_descp = $request->short_descp;
            $destination->long_descp = $request->long_descp;
            $destination->prix = $request->prix;
            $destination->prix_guide = $request->prix_guide;
            $destination->dure_sejour = $request->dure_sejour;
            $destination->type_circuit=$request->type_circuit;
            $destination->lieux=$request->lieux;
            $destination->offre_guide=$request->offre_guide;
            $destination->prix_guide=$request->prix_guide;
            $destination->information=$request->information;
            


            //  //Anglais
            // $destination->name_en = $request->name_en;
            // $destination->short_descp_en = $request->short_descp_en;
            // $destination->long_descp_en = $request->long_descp_en;
 
            //  //Espagnol
            //  $destination->name_es = $request->name_es;
            //  $destination->short_descp_es = $request->short_descp_es;
            //  $destination->long_descp_es = $request->long_descp_es;
    
           
    
            //update une image
    
            if($request->file('image_cap')) {
              

               $image_cap = $request->file('image_cap');
               $manager_cap = new ImageManager(new Driver());
               $name_gen_cap = hexdec(uniqid()).'.'.$image_cap->getClientOriginalExtension();
                $img_cap = $manager_cap->read($image_cap);
                $img_cap = $img_cap->resize(370,150);
                $img_cap->toJpeg(80)->save(base_path('public/upload/dest_cap/'.$name_gen_cap));
                $save_url = 'upload/dest_cap/'.$name_gen_cap;
               $destination['image_cap'] = $save_url;

            }

            if ($request->file('image')) {
                
               $image = $request->file('image');
               $manager = new ImageManager(new Driver());
               $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                $img = $manager->read($image);
                $img = $img->resize(1362,900);
                $img->toJpeg(80)->save(base_path('public/upload/image_desti/'.$name_gen));
                $save_url = 'upload/image_desti/'.$name_gen;
                $destination['image'] =  $save_url ;
            }
            $destination->save();

                    //Update multi_image
            if($destination->save()){
                $files = $request->multi_img;
                if(!empty($files)){
                    $subimage = multi_image::where('id_destination',$id)->get()->toArray();
                    // multi_image::where('id_destination',$id)->delete();
                }
                if(!empty($files)){
                foreach ($files as $file) {
                    $imgName = date('YmdHi').$file->getClientOriginalName();
                    $file->move('upload/destination/multi_img/',$imgName);
                    $subimage['multi_img'] = $imgName;
                    $subimage =new multi_image();
                    $subimage->id_destination= $destination->id;
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


         public function DeleteMultiImage($id){
            $deleteData = multi_image::where('id',$id)->first();
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
                multi_image::where('id',$id)->delete();
            }
            $notification = array(
               'message' =>'Image supprimer avec avec succés',
               'alert-type' => 'success'
           );
            
            return Redirect()->back()->with($notification);
       }

       public function DeleteDestination($id) {
        $item = Destination::findOrFail($id);
        $img = $item->image_cap;
        $imgs = $item->image;
        unlink($img);
        unlink($imgs);
        Destination::findOrFail($id)->delete();
        $deleteData = multi_image::where('id_destination',$id)->first();
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
                multi_image::where('id_destination',$id)->delete();
            }
        $notification = array(
            'message' =>'Destination Supprimer avec succes',
            'alert-type' => 'success'
        );
        
        return  redirect()->back()->with($notification);
    } 

   
    public function DestinationDetail($id){

        $destination = Destination::where('id',$id)->first();
        $imageGalerie = multi_image::where('id_destination',$id)->get();
        $bcategory = BlogCategory::latest()->get();
        $lpost = BlogPost::latest()->limit(3)->get();
      
        
    
        return view('frontend.destination.detail_circuit', compact('destination','imageGalerie','bcategory','lpost'));
    
       }  
       
       
     public function destination(){
        $destination = Destination::latest()->get();
        return view('frontend.destination.destination_all',compact('destination'));
     }  
    

     //Voiture start
     public function Vehicule(){
        return view('frontend.vehicules.vehicule');
     }

     //Voiture Ended
}
