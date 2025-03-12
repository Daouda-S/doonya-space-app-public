<?php

namespace App\Http\Controllers;

use App\Models\Espace;
use App\Models\Option;
use App\Models\OptionImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OptionController extends Controller
{

    public function index()
    {
        $options = Option::with('optionImage')->get();
        $total = Option::count();
        return view('admin.option.home', compact(['options','total']));
    }

    public function create()
    {
        $espaces = Espace::all();  // Pour afficher les espaces disponibles
        return view('admin.option.create', compact('espaces'));
    }

    public function save(Request $request)
    {
        $validation = $request->validate([
            'matricule' => 'required',
            'description' => 'required',
            'materiel' => 'required',
            'prix' => 'required',
            'option_image.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // $data = Option::create($validation);
        $option = new Option();
        $option->matricule = $request->matricule;
        $option->description = $request->description;
        $option->materiel = $request->materiel;
        $option->prix = $request->prix;
        $option->save();

        if ($request->hasFile('option_image')) {
            foreach ($request->file('option_image') as $image) {
                // Enregistrer l'image dans storage/app/public/upload/option/images
                $path = $image->store('upload/option/images', 'public'); // 'public' fait référence au disque 'public'
    
                // Enregistrer le chemin relatif dans la base de données
                $optionImage = new OptionImage();
                $optionImage->option_id = $option->id;
                $optionImage->image = $path; // Le chemin relatif à partir de public/storage
                $optionImage->save();
            }
        }

        if ($option) {
            session()->flash('success', 'Option ajoutée avec succès');
            return redirect(route('admin.options'));
        } else {
            session()->flash('error', 'Une erreur est survenue');
            return redirect(route('admin.options.create'));
        }
    }

    public function destroy($id)
    {
        // Récupérer l'option à supprimer avec ses images associées
        $option = Option::with('optionImage')->findOrFail($id);

        try {
            // Supprimer les images du stockage
            foreach ($option->optionImage as $image) {
                // Supprimer l'image du stockage
                if (Storage::exists($image->image)) {
                    Storage::delete($image->image);  // Supprimer l'image du stockage
                }
                // Supprimer l'entrée de l'image dans la base de données
                $image->delete();
            }

            // Supprimer l'option de la base de données
            $option->delete();

            // Message de succès
            session()->flash('success', 'Option et ses images supprimées avec succès');
            return redirect()->route('admin.options');
        } catch (\Exception $e) {
            // Message d'erreur en cas de problème
            session()->flash('error', 'Une erreur est survenue lors de la suppression');
            return redirect()->route('admin.options');
        }
    }


    public function edit(Option $option)
    {
        // Retourner la vue avec l'option et ses images
        return view('admin.option.edit', compact('option'));
    }

    // public function update(Request $request, Option $option)
    // {
    //     $validated = $request->validate([
    //         'matricule' => 'required',
    //         'materiel' => 'required',
    //         'description' => 'required',
    //         'prix' => 'required|numeric',
    //     ]);

    //     try {

    //         $option->update($validated);
    //         session()->flash('success', 'Option mise à jour avec succès');
    //         return redirect()->route('admin.options');

    //     } catch (\Exception $e) {

    //         session()->flash('error', 'Une erreur est survenue');
    //         return redirect()->route('admin.options.edit', $option);
            
    //     }
    // }

    public function update(Request $request, Option $option)
    {
        $validation = $request->validate([
            'matricule' => 'required',
            'description' => 'required',
            'materiel' => 'required',
            'prix' => 'required',
            'option_image.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        try {
        // Mise à jour des informations de l'option
        // $option = new Option();
        $option->matricule = $request->matricule;
        $option->description = $request->description;
        $option->materiel = $request->materiel;
        $option->prix = $request->prix;
        $option->save();

        if ($request->hasFile('option_image')) {
                // Supprimer les anciennes images
                foreach ($option->optionImage as $image) {
                    // Optionnel : supprimer les anciennes images du stockage
                    if (Storage::exists($image->image)) {
                        Storage::delete($image->image);  // Supprimer du stockage
                    }
                    $image->delete();  // Supprimer de la base de données
                }

                // Ajouter les nouvelles images
                foreach ($request->file('option_image') as $image) {
                    // Sauvegarder l'image dans le dossier public
                    $path = $image->store('upload/option/images', 'public');

                    // Créer un nouvel enregistrement pour chaque image
                    $optionImage = new OptionImage();
                    $optionImage->option_id = $option->id;
                    $optionImage->image = $path;  // Sauvegarder le chemin relatif
                    $optionImage->save();  // Sauvegarder dans la base de données
                }
        }
        // Message de succès
        session()->flash('success', 'Option mise à jour avec succès');
        return redirect()->route('admin.options');
        } catch (\Exception $e) {
        // Message d'erreur en cas de problème
        session()->flash('error', 'Une erreur est survenue');
        return redirect()->route('admin.options.edit', $option);
        }
        
    }

    
    public function deleteImage($imageId)
    {
        try {
            // Récupérer l'image à supprimer
            $image = OptionImage::findOrFail($imageId);

            // Supprimer l'image du stockage
            if (Storage::exists($image->image)) {
                Storage::delete($image->image);
            }

            // Supprimer l'image de la base de données
            $image->delete();

            session()->flash('success', 'Image supprimée avec succès.');
        } catch (\Exception $e) {
            session()->flash('error', 'Une erreur est survenue lors de la suppression de l\'image.');
        }

        return redirect()->back();
    }
    
}
