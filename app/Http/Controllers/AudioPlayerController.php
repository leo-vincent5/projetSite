<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class AudioPlayerController extends Controller
{
    public function index()
    {
        // Tu peux aussi récupérer ça depuis la BDD
        $tracks = [
             [
                'title'  => 'Harry Potter 1',
                'url'    => asset('audio/1partie1.m4a'),
                'artist' => 'Leodible',      // optionnel
                'album'  => 'Notes voix', // optionnel
                'cover' => 'https://equicode.fr/img/covers/harry0.png',
            ],
             [
                'title'  => 'Harry Potter 2',
                'url'    => asset('audio/2partie1.m4a'),
                'artist' => 'Leodible',      // optionnel
                'album'  => 'Notes voix', // optionnel
                'cover' => 'https://equicode.fr/img/covers/harry2.png',
            ],
             [
                'title'  => 'Harry Potter 3',
                'url'    => asset('audio/3partie1.m4a'),
                'artist' => 'Leodible',      // optionnel
                'album'  => 'Notes voix', // optionnel
                'cover' => 'https://equicode.fr/img/covers/harry3.png',
            ],
             [
                'title'  => 'Harry Potter 4 part 1',
                'url'    => asset('audio/4partie1.m4a'),
                'artist' => 'Leodible',      // optionnel
                'album'  => 'Notes voix', // optionnel
                'cover' => 'https://equicode.fr/img/covers/harry4.png',
            ],
            [
                'title'  => 'Harry Potter 4 part 2',
                'url'    => asset('audio/4partie2.m4a'),
                'artist' => 'Leodible',      // optionnel
                'album'  => 'Notes voix', // optionnel
                'cover' => 'https://equicode.fr/img/covers/harry4.png',
            ],
            [
                'title'  => 'Harry Potter 5 part 1',
                'url'    => asset('audio/5partie1.m4a'),
                'artist' => 'Leodible',      // optionnel
                'album'  => 'Notes voix', // optionnel
                'cover' => asset('img/covers/harry5.png'),
            ],
            [
                'title'  => 'Harry Potter 5 part 2',
                'url'    => asset('audio/5partie2.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => 'https://equicode.fr/img/covers/harry5.png',
            ],
             [
                'title'  => 'Harry Potter 5 part 3',
                'url'    => asset('audio/5partie3.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => asset('img/covers/harry.png'),
            ],
             [
                'title'  => 'Harry Potter 6 part 1',
                'url'    => asset('audio/6partie1.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => 'https://equicode.fr/img/covers/harry6.png',
            ],
            [
                'title'  => 'Harry Potter 6 part 2',
                'url'    => asset('audio/6partie2.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => 'https://equicode.fr/img/covers/harry6.png',
            ],
             [
                'title'  => 'Harry Potter 7 part 1',
                'url'    => asset('audio/7partie1.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => asset('img/covers/harry7.png'),
            ],
             [
                'title'  => 'Harry Potter 7 part 2',
                'url'    => asset('audio/7partie2.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => asset('img/covers/harry7.png'),
            ],
             [
                'title'  => 'Harry Potter 7 part 3',
                'url'    => asset('audio/7partie3.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => asset('img/covers/harry7.png'),
            ],
            // ...
        ];

        $lastState = auth()->user()?->audio_resume;
        return view('alohomora', compact('tracks', 'lastState'));
    }


    public function saveResume(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $data = $request->validate([
            'url'    => 'required|string',
            'title'  => 'nullable|string',
            'artist' => 'nullable|string',
            'cover'  => 'nullable|string',
            'time'   => 'required|numeric|min:0',
        ]);

        $user->audio_resume = $data;
        $user->save();

        return response()->json(['status' => 'ok']);
    }
}
