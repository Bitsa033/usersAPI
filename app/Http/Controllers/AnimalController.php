<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Http\Requests\UpdateAnimalRequest;
use App\Http\Resources\Animal as ResourcesAnimal;
use App\Trait\HttpResponse;
use Illuminate\Http\Request;
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
     * Display the specified animal resource.
     */
    public function getOne($id)
    {
        if (!is_numeric($id)) {
            return "Le paramètre id doit etre un nombre";
        } else {
            $animal= DB::table('animals')->where('id', '=', $id)->get();
            return new ResourcesAnimal($animal);
        }
        
    }

    /**
     * Display the specified animal resource.
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
    public function store(Request $request)
    {
        if (!empty($request->get('nom')) && !empty($request->get('prix')) &&
         !empty($request->get('qte'))) {
            
            $animal=Animal::create([
                'nom'=>$request->nom,
                'prix'=>$request->prix,
                'qte'=>$request->qte
            ]);
    
            return $this->success([
                'animal'=>$animal,
                'message'=>"Animal enregistré avec succès ..."
            ]);
        }
        else {
            return "Verifiez vos champs: le nom, le prix et la 
            qté ne doivent pas etre vide ...";
        }

    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnimalRequest $request, Animal $animal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animal $animal)
    {
        //
    }
}
