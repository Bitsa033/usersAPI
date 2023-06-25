<?php

namespace App\Http\Controllers;

use App\Http\Requests\Promotion;
use App\Http\Requests\QteOut;
use App\Http\Requests\StoreAnimalRequest;
use App\Models\Animal;
use App\Http\Resources\Animal as ResourcesAnimal;
use App\Trait\HttpResponse;
use Illuminate\Support\Facades\DB;

class AnimalController extends Controller
{
    use HttpResponse;

    /**
     * Display all animals resource
     */
    public function getAll()
    {
       $animal= Animal::all();
       return new ResourcesAnimal($animal);
    }

    /**
     * Display the specified animal resource by id.
     */
    public function getOne($id)
    {
        if (!is_numeric($id)) {
            return "Le paramètre id doit etre un nombre";
        } else {
            $animal= Animal::find($id);
            return new ResourcesAnimal($animal);
        }
        
    }

    /**
     * Display the specified animal resource by name.
     */
    public function getByName($name)
    {
        if (!is_string($name)) {
            return "Le paramètre nom doit etre un string";
        } else {
            $animal= DB::table('animals')->where('nom', '=', $name)->get();
            return new ResourcesAnimal($animal);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnimalRequest $request)
    {
        $request->validated($request->all());
        $animal=Animal::create([
            'nom'=>$request->nom,
            'prix'=>$request->prix,
            'qte'=>$request->qte
        ]);

        return $this->success([
            'animal'=>$animal
        ]);

    }
    
    /**
     * Update the specified resource in storage.
     */
    function update(StoreAnimalRequest $request,$id){
        $request->validated($request->all());
        $animal= Animal::find($id);
        $animal->update([
            "nom"=>$request->nom,
            "prix"=>$request->prix,
            "qte"=>$request->qte,
            "promotion"=>$request->promotion
        ]);

        return $this->success([
            'animal'=>$animal
        ]);
        
    }

    /**
     * Update the qty resource in storage.
     */
    function addQte(QteOut $request,$id){
        $request->validated($request->all());
        $animal= Animal::find($id);
        $qte=$animal['qte'];
        $added= $qte + $request->qte;

        $animal->update([
            "qte"=>$added
        ]);

        return $this->success([
            'animal'=>$animal
        ]);
        
    }

    /**
     * Update the qty resource in storage.
     */
    function removeQte(QteOut $request,$id){
        $request->validated($request->all());
        $animal= Animal::find($id);
        $qte=$animal['qte'];
        $removed= $qte - $request->qte;

        $animal->update([
            "qte"=>$removed
        ]);

        return $this->success([
            'animal'=>$animal
        ]);
        
    }

    /**
     * Update the qty resource in storage.
     */
    function promotion(Promotion $request,$id){
        $request->validated($request->all());
        $animal= Animal::find($id);
        $qte=$animal['qte'];
        $removed= $qte - $request->qte;

        $animal->update([
            "promotion"=>$request->promotion
        ]);

        return $this->success([
            'animal'=>$animal
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        if (!is_numeric($id)) {
            return "Le paramètre id doit etre un nombre";
        } else {
            $animal=Animal::destroy($id);
            return $this->success([
                'animal'=>$animal
                // 'token'=>$user->remo('API key token pour '.$user->name)->plainTextToken
            ]);
        }
        
    }
}
