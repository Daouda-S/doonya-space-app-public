<?php

namespace App\Http\Controllers;

use App\Models\Espace;
use App\Models\Option;
use App\Models\EspaceImage;
use App\Models\Reservation;
use App\Models\EspaceOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EspaceController extends Controller
{
    public function index()
    {
        $espaces = Espace::with(['espaceImage', 'options'])->get();
        $total = Espace::count();
        return view('admin.espace.home', compact(['espaces','total']));
    }
    
    public function create()
    {
        $options = Option::all();
        return view('admin.espace.create', compact(['options']));
    }

    public function save(Request $request)
    {
        // dd($request);
        $validation = $request->validate([
            'nom' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
            'prix' => 'required|integer',
            'taille' => 'required|string',
            'capacite' => 'required|integer',
            'option.*' => 'nullable|integer',
            'espace_image.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        // dd($request);

        $espace = new Espace();
        $espace->nom = $request->nom;
        $espace->description = $request->description;
        $espace->status = $request->status;
        $espace->prix = $request->prix;
        $espace->taille = $request->taille;
        $espace->capacite = $request->capacite;
        $espace->save();

        if ( $request->option ){
            foreach ( $request->option as $option ){
                $espaceOption = new EspaceOption();
                $espaceOption->espace_id = $espace->id;
                $espaceOption->option_id = $option;
                $espaceOption->save();
            }
        }
        if ($request->hasFile('espace_image')) {
            foreach ($request->file('espace_image') as $image) {
                // Enregistrer l'image dans storage/app/public/upload/espace/images
                $path = $image->store('upload/espace/images', 'public'); // 'public' fait référence au disque 'public'
                // Enregistrer le chemin relatif dans la base de données
                $espaceImage = new EspaceImage();
                $espaceImage->espace_id = $espace->id;
                $espaceImage->image = $path; // Le chemin relatif à partir de public/storage
                $espaceImage->save();
            }
        }
        if ($espace) {
            session()->flash('success', 'Espace ajoutée avec succès');
            return redirect(route('admin.espaces'));
        } else {
            session()->flash('error', 'Une erreur est survenue');
            return redirect(route('admin.espaces.create'));
        }
    }

    public function edit(Espace $espace)
    {
        $options = Option::all();
        return view('admin.espace.edit', compact(['espace','options']));
    }
    

    public function update(Request $request, Espace $espace)
    {
        $validation = $request->validate([
            'nom' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'prix' => 'required|integer',
            'taille' => 'required|string',
            'capacite' => 'required|integer',
            'option.*' => 'nullable|integer',
            'espace_image.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        
        try {
            $reservationEspaceId = Reservation::where('espace_id', $espace->id)->get();
            if($reservationEspaceId && $reservationEspaceId->count() > 0){
                session()->flash('error', 'Une erreur est survenue: l\'espace est deja reservé impossible de modifier');
                return redirect()->route('admin.espaces.edit', $espace);
            }else{
                $espace->nom = $request->nom;
                $espace->description = $request->description;
                $espace->status = $request->status;
                $espace->prix = $request->prix;
                $espace->taille = $request->taille;
                $espace->capacite = $request->capacite;
                $espace->save();
                if ($request->has('option')) {
                    $espace->options()->detach();
                    foreach ( $request->option as $option ){
                        $espaceOption = new EspaceOption();
                        $espaceOption->espace_id = $espace->id;
                        $espaceOption->option_id = $option;
                        $espaceOption->save();
                    }
                }
                
                if ($request->hasFile('espace_image')) {
                    // Ajouter les nouvelles images
                    foreach ($request->file('espace_image') as $image) {
                        // Sauvegarder l'image dans le dossier public
                        $path = $image->store('upload/espace/images', 'public');
                
                        // Créer un nouvel enregistrement pour chaque nouvelle image
                        $espaceImage = new EspaceImage();
                        $espaceImage->espace_id = $espace->id;
                        $espaceImage->image = $path;  // Sauvegarder le chemin relatif de l'image
                        $espaceImage->save();  // Sauvegarder dans la base de données
                    }
                }
            }

            // Message de succès
            session()->flash('success', 'espace mise à jour avec succès');
            return redirect()->route('admin.espaces');
        } catch (\Exception $e) {
            // Message d'erreur en cas de problème
            session()->flash('error', 'Une erreur est survenue'.$e->getMessage());
            return redirect()->route('admin.espaces.edit', $espace);
        }
    }

    public function destroy($id)
    {
        // Récupérer l'option à supprimer avec ses images associées et les relations avec les options
        $espace = Espace::with('espaceImage', 'options')->findOrFail($id);
        
        try {
            // Supprimer les relations dans la table pivot 'espace_option'
            $espace->options()->detach();  // Détacher toutes les options liées à cet espace
            $espace->options()->detach();
            // Supprimer les images du stockage
            foreach ($espace->espaceImage as $image) {
                // Supprimer l'image du stockage
                if (Storage::exists($image->image)) {
                    Storage::delete($image->image);  // Supprimer l'image du stockage
                }
                // Supprimer l'entrée de l'image dans la base de données
                $image->delete();
            }
    
            // Supprimer l'espace de la base de données
            $espace->delete();
    
            // Message de succès
            session()->flash('success', 'Espace et ses images supprimées avec succès');
            return redirect()->route('admin.espaces');
        } catch (\Exception $e) {
            // Message d'erreur en cas de problème
            session()->flash('error', 'Une erreur est survenue lors de la suppression : l\'espace est deja reservé');
            return redirect()->route('admin.espaces');
        }
    }

    public function deleteImage($imageId)
    {
        try {
            // Récupérer l'image à supprimer
            $image = EspaceImage::findOrFail($imageId);

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