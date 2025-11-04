<?php

namespace App\Http\Controllers;

use App\Models\Scategorie;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ScategorieController extends Controller
{
    /**
     * Lister toutes les sous-catégories
     */
    public function index()
    {
        $scategories = Scategorie::with('categorie')->get();
        return response()->json(array_reverse($scategories->toArray()));
    }

    /**
     * Créer une nouvelle sous-catégorie
     */
    public function store(Request $request)
    {
        $data = $request->only(['nomscategorie', 'imagescat', 'categorieID']);

        // Vérifie que categorieID est fourni
        if (!isset($data['categorieID'])) {
            return response()->json(['error' => 'Le champ categorieID est requis'], 400);
        }

        // Vérifie que la catégorie existe
        $categorie = Categorie::find($data['categorieID']);
        if (!$categorie) {
            return response()->json(['error' => 'Categorie non trouvée'], 404);
        }

        // Création de la sous-catégorie
        $scategorie = Scategorie::create($data);

        return response()->json([
            'message' => 'Sous-catégorie créée avec succès',
            'scategorie' => $scategorie
        ], 201);
    }

    /**
     * Afficher une sous-catégorie spécifique
     */
    public function show($id)
    {
        $scategorie = Scategorie::with('categorie')->find($id);
        if (!$scategorie) {
            return response()->json(['error' => 'S/Categorie non trouvée'], 404);
        }
        return response()->json($scategorie);
    }

    /**
     * Mettre à jour une sous-catégorie
     */
    public function update(Request $request, $id)
    {
        $scategorie = Scategorie::find($id);
        if (!$scategorie) {
            return response()->json(['error' => 'S/Categorie non trouvée'], 404);
        }

        $data = $request->only(['nomscategorie', 'imagescat', 'categorieID']);

        // Vérifie que la catégorie existe si categorieID est fourni
        if (isset($data['categorieID'])) {
            $categorie = Categorie::find($data['categorieID']);
            if (!$categorie) {
                return response()->json(['error' => 'Categorie non trouvée'], 404);
            }
        }

        // Met à jour uniquement les champs existants
        foreach ($data as $key => $value) {
            $scategorie->$key = $value;
        }

        $scategorie->save(); // Important pour SQLite + timestamps=false

        return response()->json([
            'message' => 'Sous-catégorie mise à jour avec succès',
            'scategorie' => $scategorie
        ]);
    }

    /**
     * Supprimer une sous-catégorie
     */
    public function destroy($id)
    {
        $scategorie = Scategorie::find($id);
        if (!$scategorie) {
            return response()->json(['error' => 'S/Categorie non trouvée'], 404);
        }

        $scategorie->delete();
        return response()->json(['message' => 'S/Categorie supprimée !']);
    }

    /**
     * Lister les sous-catégories d'une catégorie donnée
     */
    public function showSCategorieByCAT($idcat)
    {
        $scategories = Scategorie::where('categorieID', $idcat)
            ->with('categorie')
            ->get();

        return response()->json($scategories);
    }
}
