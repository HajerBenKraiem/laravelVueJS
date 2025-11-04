<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Lister toutes les catégories
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::all()->toArray();
        return array_reverse($categories);
    }

    /**
     * Créer une nouvelle catégorie
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Récupère les données JSON correctement
        $data = $request->json()->all();

        // Création de la catégorie
        $categorie = Categorie::create($data);

        return response()->json($categorie, 201);
    }

    /**
     * Afficher une catégorie spécifique
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categorie = Categorie::find($id);

        if (!$categorie) {
            return response()->json(['error' => 'Catégorie non trouvée'], 404);
        }

        return response()->json($categorie);
    }

    /**
     * Mettre à jour une catégorie
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categorie = Categorie::find($id);

        if (!$categorie) {
            return response()->json(['error' => 'Catégorie non trouvée'], 404);
        }

        $data = $request->json()->all();
        $categorie->update($data);

        return response()->json($categorie);
    }

    /**
     * Supprimer une catégorie
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie = Categorie::find($id);

        if (!$categorie) {
            return response()->json(['error' => 'Catégorie non trouvée'], 404);
        }

        $categorie->delete();

        return response()->json(['message' => 'Catégorie supprimée !']);
    }
}
