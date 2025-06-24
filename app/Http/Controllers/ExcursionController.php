<?php

namespace App\Http\Controllers;

use App\Models\ExcursionModel;
use App\Models\multi_image_Excu;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Helpers\HtmlCleaner;

class ExcursionController extends Controller
{
    /**
     * Affiche toutes les excursions.
     */
    public function AllExcursion()
    {
        $desti = ExcursionModel::latest()->get();
        return view('backend.excursion.all_excursion', compact('desti'));
    }

    /**
     * Affiche le formulaire d'ajout d'une excursion.
     */
    public function AddExcursion()
    {
        return view('backend.excursion.add_excursion');
    }

    /**
     * Enregistre une nouvelle excursion.
     */
    public function StoreExcursion(Request $request)
    {
        // Upload de l'image de couverture
        $image_cap = $request->file('image_cap');
        $manager = new ImageManager(new Driver());
        $name_gen_cap = hexdec(uniqid()) . '.' . $image_cap->getClientOriginalExtension();
        $manager->read($image_cap)->resize(579, 660)->toJpeg(80)->save(public_path('upload/excursion_cap/' . $name_gen_cap));
        $save_url_cap = 'upload/excursion_cap/' . $name_gen_cap;

        // Upload de l'image principale
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $manager->read($image)->resize(1362, 900)->toJpeg(80)->save(public_path('upload/image_excursion/' . $name_gen));
        $save_url_image = 'upload/image_excursion/' . $name_gen;

        // Insertion de l'excursion
        $id_excursion = ExcursionModel::insertGetId([
            'name' => $request->name,
            'short_descp' => HtmlCleaner::sanitizeQuill($request->short_descp),
            'long_descp' => HtmlCleaner::sanitizeQuill($request->long_descp),
            'image_cap' => $save_url_cap,
            'image' => $save_url_image,
            'type_excursion' => $request->type_excursion,
            'lieux' => $request->lieux,
            'prix' => $request->prix,
            'prix_guide' => $request->prix_guide,
            'dure_sejour' => $request->dure_excursion,
            'information' => HtmlCleaner::sanitizeQuill($request->information),
            'offre_guide' => HtmlCleaner::sanitizeQuill($request->offre_guide),
        ]);

        // Upload des images multiples
        if ($id_excursion && $request->hasFile('multi_img')) {
            foreach ($request->file('multi_img') as $file) {
                $imgName = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/excursion/multi_img/'), $imgName);

                multi_image_Excu::create([
                    'id_excursion' => $id_excursion,
                    'image' => $imgName,
                ]);
            }
        }

        return redirect()->route('all.excursion')->with(['message' => 'Bravo, Excursion ajoutée avec succès', 'alert-type' => 'success']);
    }

    /**
     * Affiche le formulaire de modification d'une excursion.
     */
    public function EditExcursion($id)
    {
        $dataDesti = ExcursionModel::findOrFail($id);
        $multiimgs = multi_image_Excu::where('id_excursion', $id)->get();

        // Decode les entités HTML pour Quill
        $dataDesti->information = HtmlCleaner::decodeEntities($dataDesti->information);
        $dataDesti->offre_guide = HtmlCleaner::decodeEntities($dataDesti->offre_guide);
        $dataDesti->short_descp = HtmlCleaner::decodeEntities($dataDesti->short_descp);
        $dataDesti->long_descp = HtmlCleaner::decodeEntities($dataDesti->long_descp);

        return view('backend.excursion.edit_excursion', compact('dataDesti', 'multiimgs'));
    }

    /**
     * Met à jour une excursion existante.
     */
    public function UpdateExcursion(Request $request)
    {
        $excursion = ExcursionModel::findOrFail($request->id);

        // Mise à jour des champs textuels
        $excursion->fill([
            'name' => $request->name,
            'short_descp' => HtmlCleaner::sanitizeQuill($request->short_descp),
            'long_descp' => HtmlCleaner::sanitizeQuill($request->long_descp),
            'prix' => $request->prix,
            'prix_guide' => $request->prix_guide,
            'dure_sejour' => $request->dure_sejour,
            'type_excursion' => $request->type_excursion,
            'lieux' => $request->lieux,
            'information' => HtmlCleaner::sanitizeQuill($request->information),
            'offre_guide' => HtmlCleaner::sanitizeQuill($request->offre_guide),
        ]);

        // Mise à jour des images si fournies
        if ($request->hasFile('image_cap')) {
            $image_cap = $request->file('image_cap');
            $name_gen = hexdec(uniqid()) . '.' . $image_cap->getClientOriginalExtension();
            (new ImageManager(new Driver()))->read($image_cap)->resize(579, 660)->toJpeg(80)->save(public_path('upload/excursion_cap/' . $name_gen));
            $excursion->image_cap = 'upload/excursion_cap/' . $name_gen;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            (new ImageManager(new Driver()))->read($image)->resize(1362, 900)->toJpeg(80)->save(public_path('upload/image_excursion/' . $name_gen));
            $excursion->image = 'upload/image_excursion/' . $name_gen;
        }

        $excursion->save();

        // Mise à jour des images multiples si fournies
        if ($request->hasFile('multi_img')) {
            foreach ($request->file('multi_img') as $file) {
                $imgName = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/excursion/multi_img/'), $imgName);

                multi_image_Excu::create([
                    'id_excursion' => $excursion->id,
                    'image' => $imgName,
                ]);
            }
        }

        return redirect()->route('all.excursion')->with(['message' => 'Excursion modifiée avec succès', 'alert-type' => 'success']);
    }

    /**
     * Supprime une image multiple d'une excursion.
     */
    public function DeleteMultiImage($id)
    {
        $deleteData = multi_image_Excu::findOrFail($id);
        $path = public_path('upload/excursion/multi_img/' . $deleteData->image);

        if (file_exists($path)) {
            unlink($path);
        }

        $deleteData->delete();

        return redirect()->back()->with(['message' => 'Image supprimée avec succès', 'alert-type' => 'success']);
    }

    /**
     * Supprime une excursion complète (et ses images).
     */
    public function DeleteExcursion($id)
    {
        $item = ExcursionModel::findOrFail($id);

        if (file_exists(public_path($item->image_cap))) unlink(public_path($item->image_cap));
        if (file_exists(public_path($item->image))) unlink(public_path($item->image));

        $item->delete();

        $images = multi_image_Excu::where('id_excursion', $id)->get();
        foreach ($images as $img) {
            $path = public_path('upload/excursion/multi_img/' . $img->image);
            if (file_exists($path)) unlink($path);
            $img->delete();
        }

        return redirect()->back()->with(['message' => 'Excursion supprimée avec succès', 'alert-type' => 'success']);
    }

    /**
     * Filtrage des excursions selon la durée (frontend).
     */
    public function Excursion(Request $request)
    {
        $query = ExcursionModel::query();

        if ($request->duree === 'demi-journee') {
            $query->where('dure_sejour', 'LIKE', '%demi%');
        } elseif ($request->duree === 'journee') {
            $query->where('dure_sejour', 'LIKE', '%journ%')->where('dure_sejour', 'NOT LIKE', '%demi%');
        }

        $destination = $query->latest()->get();
        return view('frontend.excursion.excursion_all', compact('destination'));
    }

    /**
     * Détail d'une excursion (frontend).
     */
    public function ExcursionDetail($id)
    {
        $destination = ExcursionModel::findOrFail($id);
        $imageGalerie = multi_image_Excu::where('id_excursion', $id)->get();
        $bcategory = BlogCategory::latest()->get();
        $lpost = BlogPost::latest()->limit(3)->get();

        return view('frontend.excursion.detail_excursion', compact('destination', 'imageGalerie', 'bcategory', 'lpost'));
    }
}
