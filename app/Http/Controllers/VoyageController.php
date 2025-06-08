<?php

namespace App\Http\Controllers;

use App\Models\VoyageModel;
use Illuminate\Http\Request;
use App\Models\multi_image;
use App\Models\BlogCategory;
use App\Models\BlogPost;

use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;

class VoyageController extends Controller
{
    //
       public function AllVoyages(){
        $voyage = VoyageModel::latest()->get();
        return view('backend.voyagegroupe.all_voyage_groupe',compact('voyage'));
    }

     public function AddVoyage(){
       
        return view('backend.voyagegroupe.add_voyage_groupe');
    }
    public function StoreVoyage(Request $request){

    
         $image_cap = $request->file('image_cap');
         $manager_cap = new ImageManager(new Driver());
         $name_gen_cap = hexdec(uniqid()).'.'.$image_cap->getClientOriginalExtension();
          $img_cap = $manager_cap->read($image_cap);
          $img_cap = $img_cap->resize(1049,803);
          $img_cap->toJpeg(80)->save(base_path('public/upload/voyage_cap/'.$name_gen_cap));
          
           $save_url_cap = 'upload/voyage_cap/'.$name_gen_cap;

           $image = $request->file('image');
           $manager = new ImageManager(new Driver());
           $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img = $img->resize(1362,900);
            $img->toJpeg(80)->save(base_path('public/upload/image_voyage/'.$name_gen));
            
             $save_url_image = 'upload/image_voyage/'.$name_gen;
    
        $id_destination = VoyageModel::insertGetId([
            'name'=>$request->name,
            'short_descp'=>$request->short_descp,
            'long_descp'=>$request->long_descp,
            'image_cap'=>$save_url_cap,
            'image'=>$save_url_image,
            'type_voyage'=>$request->type_circuit,
            'nombre_participant'=>$request->nbr_participant,
            'lieux'=>$request->lieux,
            'prix'=>$request->prix,
            'information'=>$request->information,
             'dure_sejour'=>$request->dure_circuit,
        
        ]);
         
        // if( $id_destination){
        //     $files = $request->multi_img;
        //     if(!empty($files)){
        //         $subimage = multi_image::where('id_destination',$id_destination)->get()->toArray();
        //         // multi_image::where('id_destination',$id_destination)->delete();
        //     }
        //     if(!empty($files)){
        //        foreach ($files as $file) {
        //           $imgName = date('YmdHi').$file->getClientOriginalName();
        //           $file->move('upload/destination/multi_img/',$imgName);
        //           $subimage['multi_img'] = $imgName;
        //           $subimage =new multi_image();
        //           $subimage->id_destination = $id_destination;
        //           $subimage->image =  $imgName;
        //           $subimage->save();
        //        }
        //     }
        //  } //End If
    
         $notification = array(
            'message' =>'Bravo, destination ajouter avec succés',
            'alert-type' => 'success'
        );
     
        return redirect()->back()->with($notification);
      
         } //End Methode

         
         public function EditVoyage($id){

            $dataDesti = VoyageModel::find($id);
            return view('backend.voyagegroupe.edit_voyage_groupe',compact('dataDesti'));

         }

          public function UpdateVoyage(Request $request){
            $id=$request->id;
            $voyage = VoyageModel::find($id);
            $voyage->name = $request->name;
            $voyage->short_descp = $request->short_descp;
            $voyage->long_descp = $request->long_descp;
            $voyage->prix = $request->prix;
            
            $voyage->dure_sejour = $request->dure_sejour;
            $voyage->type_voyage=$request->type_voyage;
            $voyage->nombre_participant=$request->nbr_participant;
            $voyage->lieux=$request->lieux;
            
            
            $voyage->information=$request->information;
            
    
            if($request->file('image_cap')) {
              

               $image_cap = $request->file('image_cap');
               $manager_cap = new ImageManager(new Driver());
               $name_gen_cap = hexdec(uniqid()).'.'.$image_cap->getClientOriginalExtension();
                $img_cap = $manager_cap->read($image_cap);
                $img_cap = $img_cap->resize(1049,803);
                $img_cap->toJpeg(80)->save(base_path('public/upload/voyage_cap/'.$name_gen_cap));
                $save_url = 'upload/voyage_cap/'.$name_gen_cap;
               $voyage['image_cap'] = $save_url;

            }

            if ($request->file('image')) {
                
               $image = $request->file('image');
               $manager = new ImageManager(new Driver());
               $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                $img = $manager->read($image);
                $img = $img->resize(1362,900);
                $img->toJpeg(80)->save(base_path('public/upload/image_desti/'.$name_gen));
                $save_url = 'upload/image_desti/'.$name_gen;
                $voyage['image'] =  $save_url ;
            }
            $voyage->save();

            //         //Update multi_image
            // if($destination->save()){
            //     $files = $request->multi_img;
            //     if(!empty($files)){
            //         $subimage = multi_image::where('id_destination',$id)->get()->toArray();
            //         // multi_image::where('id_destination',$id)->delete();
            //     }
            //     if(!empty($files)){
            //     foreach ($files as $file) {
            //         $imgName = date('YmdHi').$file->getClientOriginalName();
            //         $file->move('upload/destination/multi_img/',$imgName);
            //         $subimage['multi_img'] = $imgName;
            //         $subimage =new multi_image();
            //         $subimage->id_destination= $destination->id;
            //         $subimage->image =  $imgName;
            //         $subimage->save();
            //     }
            //     }
            // } //End If

            $notification = array(
                'message' =>'Bravo, Destination modifier avec succés',
                'alert-type' => 'success'
            );
           

            return redirect()->back()->with($notification);
         }

         public function DeleteVoyage($id) {
        $item = VoyageModel::findOrFail($id);
        $img = $item->image_cap;
        $imgs = $item->image;
        unlink($img);
        unlink($imgs);
        VoyageModel::findOrFail($id)->delete();
      
        $notification = array(
            'message' =>'Voyage Supprimer avec succes',
            'alert-type' => 'success'
        );
        
        return  redirect()->back()->with($notification);
    } 

    public function VoyageDetail($id){

        $destination = VoyageModel::where('id',$id)->first();
     
      
        
    
        return view('frontend.voyagegroupe.detail_voyage_groupe', compact('destination'));
    
       }  

       public function FormulaireVoyage(){
        return view('frontend.voyagegroupe.formulaire');

       }
        
}
