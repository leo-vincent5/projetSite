<?php

namespace App\Http\Controllers;

use App\Paiement;
use App\Panier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Util\Json;

class PanierController extends Controller
{
    public function viderPanier(){
        $id = Auth::user()->id;
        $paniers = Panier::query()->where('id_user','=',$id)->get();

        foreach ($paniers as $panier){
            $panier->delete();
        }
        return "success";
    }

    public function deleteOne(Request $request){
        $id_photo = $request->id_photo;

        $panier = Panier::query()->where('id','=',$id_photo)->where('id_user','=',Auth::user()->id)->first()->delete();

        return 'success';
    }

    public function paiementAccept(Request $request){
        $details = $request->details;
       // dd($details);
        $id = $request->id_user;
        $panier_user  = Panier::query()->where('id_user','=',Auth::user()->id)->get();
        foreach ($panier_user as $panier )
        {
            $paiement = new Paiement();
            $paiement->id_user = $panier->id_user;
            $paiement->id_photo = $panier->id_photo;
            $paiement->json = serialize($details);
            $paiement->save();

            $panier->delete();
        }
       return true;

    }
}
