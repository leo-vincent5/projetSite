<?php

namespace App\Http\Controllers;

use App\Models\CompteurMariage;
use Illuminate\Http\Request;

class PoneyController extends Controller
{
    public function index(Request $request ){

        $newMariage = new CompteurMariage();
        $newMariage->name = 'pauline';
        $newMariage->ip = $_SERVER['REMOTE_ADDR'];
        $newMariage->save();

        return view('poney.pauline');
    }

    public function stats(){
        // Récupérer les entrées qui ont le nom "pauline"
        $visits = CompteurMariage::where('name', 'pauline')->orderBy('created_at', 'desc')->get();

        return view('poney.pauline-stats', ['visits' => $visits, 'total' => $visits->count()]);
    }

    public function deletePaulineEntries() {
        // Supprimer toutes les entrées qui ont le nom "pauline"
        CompteurMariage::where('name', 'pauline')->delete();
        return redirect('/pauline-stats')->with('success', 'Toutes les entrées "pauline" ont été supprimées.');
    }



}
