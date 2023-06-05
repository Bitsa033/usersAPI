<?php

namespace App\Trait;

trait HttpResponse{

    protected function success($data,$message=null,$code=200)
    {
        return response()->json([
            'statut'=>'Votre requette a été soumise avec succès',
            'message'=>$message,
            'data'=>$data
        ],$code);
    }

    protected function erreur($data,$message=null,$code)
    {
        return response()->json([
            'statut'=>'Une erreur inattendue est survenue',
            'message'=>$message,
            'data'=>$data,
        ],$code);
    }
}