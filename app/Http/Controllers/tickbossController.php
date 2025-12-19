<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\CodeCalling;
use Illuminate\Http\Request;

class tickbossController extends Controller
{
    public function test(Request $request)
    {
        $numero = $request->get('phoneNumber');
        $name = $request->get('displayName');
        $interlocuteur = $request->get('name');

        $newCall = new Call();
        $newCall->numero = $numero;
        $newCall->name = $name;
        $newCall->interlocuteur = $interlocuteur;
        $newCall->status = "open";
        $newCall->save();

        // Rediriger avec un paramètre pour ouvrir la modal du nouvel appel
        return redirect()->route('viewCalls', ['openModal' => true, 'callId' => $newCall->id]);
    }


    public function updateStatus(Request $request, $id)
    {
        // Récupérer l'appel et mettre à jour son statut
        $call = Call::find($id);
        $call->status = $request->get('status');
        $call->save();

        // Retourner une réponse JSON pour confirmer le succès
        return response()->json(['success' => true, 'status' => $call->status]);
    }

    public function addNote(Request $request, $id)
    {
        $call = Call::find($id);
        $call->note = $request->get('note');
        $call->save();

        // Retourner la note dans la réponse JSON
        return response()->json(['success' => true, 'note' => $call->note]);
    }


    public function showCalls(Request $request)
    {
        $openModal = $request->get('openModal');
        $callId = $request->get('callId');

        // Vérifie si des paramètres existent et redirige seulement s'ils ne sont pas pertinents
        if ($request->query->count() > 0 && (!$openModal || !$callId)) {
            return redirect()->route('viewCalls');
        }

        // Récupérer tous les appels
        $calls = Call::all();
        $codeCalling = null;
        $recentCalls = [];

        // Si callId est fourni, on cherche l'appel et les appels ayant le même code client
        if ($callId) {
            $call = Call::find($callId);

            // Si l'appel existe, on cherche le code client associé à ce numéro via la relation
            if ($call) {
                $codeCalling = $call->codeCalling;

                // Si un code est trouvé, récupérer les 5 derniers appels ayant le même code, excluant l'appel en cours
                if ($codeCalling) {
                    $recentCalls = Call::whereHas('codeCalling', function($query) use ($codeCalling) {
                        $query->where('code', $codeCalling->code);
                    })
                        ->where('id', '!=', $call->id) // Exclure l'appel actuel
                        ->orderBy('created_at', 'desc')
                        ->take(10)
                        ->get();
                }
            }
        }

        // Passer les variables à la vue
        return view('call')->with([
            'calls' => $calls,
            'openModal' => $openModal,
            'callId' => $callId,
            'codeCalling' => $codeCalling,
            'recentCalls' => $recentCalls
        ]);
    }

    public function saveClientCode(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'numero' => 'required',
            'code' => 'required',
        ]);

        // Vérifier si un code existe déjà pour ce numéro
        $codeCalling = CodeCalling::firstOrNew(['numero' => $request->get('numero')]);

        // Mettre à jour le code
        $codeCalling->code = $request->get('code');
        $codeCalling->save();

        // Rediriger ou faire autre chose après la sauvegarde
        return redirect()->route('viewCalls')->with('success', 'Code client enregistré avec succès.');
    }

}
