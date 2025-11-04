<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Lister tous les articles avec leurs catégories et sous-catégories
     */
    public function index()
    {
        $articles = Article::with('categories', 'scategories')->get()->toArray();
        return array_reverse($articles);
    }

    /**
     * Créer un nouvel article
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new Article([
            'caracteristiques' => $request->input('caracteristiques'),
            'designation'      => $request->input('designation'),
            'marque'           => $request->input('marque'),
            'reference'        => $request->input('reference'),
            'qtestock'         => $request->input('qtestock'),
            'prixAchat'        => $request->input('prixAchat'),
            'prixVente'        => $request->input('prixVente'),
            'prixSolde'        => $request->input('prixSolde'),
            'imageartpetitf'   => $request->input('imageartpetitf'),
            'imageartgrandf'   => $request->input('imageartgrandf'),
            'categorieID'      => $request->input('categorieID'),
            'scategorieID'     => $request->input('scategorieID'),
        ]);

        $article->save();

        return response()->json(['message' => 'Article créé !']);
    }

    /**
     * Afficher un article spécifique
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['error' => 'Article non trouvé'], 404);
        }

        return response()->json($article);
    }

    /**
     * Mettre à jour un article
     *
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['error' => 'Article non trouvé'], 404);
        }

        $article->update($request->all());

        return response()->json(['message' => 'Article mis à jour !']);
    }

    /**
     * Supprimer un article
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['error' => 'Article non trouvé'], 404);
        }

        $article->delete();

        return response()->json(['message' => 'Article supprimé !']);
    }
}
