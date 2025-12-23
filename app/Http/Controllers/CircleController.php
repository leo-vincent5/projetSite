<?php 

namespace App\Http\Controllers;

use App\Models\Circle;
use App\Models\User;
use Illuminate\Http\Request;


class CircleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:80'],
        ]);

        $circle = Circle::create([
            'owner_id' => auth()->id(),
            'name' => $request->name,
            'invite_token' => bin2hex(random_bytes(16)),
        ]);

        // owner est membre
        $circle->members()->syncWithoutDetaching([
            auth()->id() => ['role' => 'owner']
        ]);

        return redirect()->back()->with('invite_link', route('circles.invite', $circle->invite_token));
    }

    public function invite(string $token, Request $request)
    {
        $circle = Circle::where('invite_token', $token)->firstOrFail();

        // Pas connecté -> on mémorise le lien et on redirect login
        if (!auth()->check()) {
            $request->session()->put('invite_token', $token);
            return redirect()->route('login');
        }

        // Connecté -> page qui propose de rejoindre (ou déjà membre)
        $already = $circle->members()->where('user_id', auth()->id())->exists();

        return view('circles.invite', compact('circle', 'already'));
    }

    public function join(Circle $circle)
    {
        $circle->members()->syncWithoutDetaching([
            auth()->id() => ['role' => 'member']
        ]);

        return redirect()->route('circles.show', $circle)->with('success', 'Tu as rejoint le cercle ✅');
    }

      public function show(Circle $circle)
    {
        // Si tu veux charger les membres:
        $circle->load('members');

        return view('circles.show', compact('circle'));
    }


    public function removeMember(Circle $circle, User $user)
{
    $currentUser = auth()->user();

    // Vérifie que l'utilisateur connecté est admin du cercle
    $isAdmin = $circle->members()
        ->where('user_id', $currentUser->id)
        ->wherePivot('role', 'owner')
        ->exists();

    if (! $isAdmin) {
        abort(403, 'Action non autorisée');
    }

    // Empêche de supprimer le dernier admin
    if ($user->id === $currentUser->id) {
        $adminCount = $circle->members()
            ->wherePivot('role', 'admin')
            ->count();

        if ($adminCount <= 1) {
            return back()->withErrors('Impossible de quitter : vous êtes le dernier admin');
        }
    }

    $circle->members()->detach($user->id);

    return back()->with('success', 'Membre retiré du cercle');
}

}
