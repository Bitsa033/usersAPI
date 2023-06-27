<?php

namespace App\Http\Controllers;
use App\Http\Requests\Promotion;
use App\Http\Requests\QteOut;
use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use App\Http\Resources\Produit as ResourcesProduit;
use App\Models\Produit;
use App\Trait\HttpResponse;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{
    use HttpResponse;

    /**
     * Display all products
     */
    public function index()
    {
       $produit= Produit::all();
       return new ResourcesProduit($produit);
    }

    /**
     * Display the specified product by id.
     */
    public function show($id)
    {
        if (!is_numeric($id)) {
            return "Le paramètre id doit etre un nombre";
        } else {
            $produit= Produit::find($id);
            return new ResourcesProduit($produit);
        }
        
    }

    /**
     * Display the specified product by name.
     */
    public function showByName($name)
    {
        if (!is_string($name)) {
            return "Le paramètre nom doit etre un string";
        } else {
            $produit= DB::table('produits')->where('nom', $name)->get();
            return new ResourcesProduit($produit);
        }
        
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProduitRequest $request)
    {
        $request->validated($request->all());
        $produit=Produit::create([
            'nom'=>$request->nom,
            'prix'=>$request->prix,
            'qte'=>$request->qte,
            'promotion'=>$request->promotion
        ]);

        return $this->success([
            'produit'=>$produit
        ]);

    }
    
    /**
     * Update the specified product in storage.
     */
    function update(UpdateProduitRequest $request,$id){
        $request->validated($request->all());
        $produit= Produit::find($id);
        $produit->update([
            "nom"=>$request->nom,
            "prix"=>$request->prix,
            "qte"=>$request->qte,
            "promotion"=>$request->promotion
        ]);

        return $this->success([
            'produit'=>$produit
        ]);
        
    }

    /**
     * Add the qty of product in storage.
     */
    function addQte(QteOut $request,$id){
        $request->validated($request->all());
        $produit= Produit::find($id);
        $qte=$produit['qte'];
        $added= $qte + $request->qte;

        $produit->update([
            "qte"=>$added
        ]);

        return $this->success([
            'produit'=>$produit
        ]);
        
    }

    /**
     * Withdrap the qty of product in storage.
     */
    function removeQte(QteOut $request,$id){
        $request->validated($request->all());
        $produit= Produit::find($id);
        $qte=$produit['qte'];
        $removed= $qte - $request->qte;

        $produit->update([
            "qte"=>$removed
        ]);

        return $this->success([
            'produit'=>$produit
        ]);
        
    }

    /**
     * Set the promotion of product in storage.
     */
    function SetPromotion(Promotion $request,$id){
        $request->validated($request->all());
        $produit= Produit::find($id);

        $produit->update([
            "promotion"=>$request->promotion
        ]);

        return $this->success([
            'produit'=>$produit
        ]);
        
    }

    /**
     * Remove the specific product from storage.
     */
    public function delete($id)
    {
        if (!is_numeric($id)) {
            return "Le paramètre id doit etre un nombre";
        } else {
            $produit=Produit::destroy($id);
            return $this->success([
                'produit'=>$produit
                // 'token'=>$user->remo('API key token pour '.$user->name)->plainTextToken
            ]);
        }
        
    }
}
