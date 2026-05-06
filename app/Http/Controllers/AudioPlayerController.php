<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\SeriesProgressLog;
use App\Models\SeriesResume;
use Illuminate\Support\Arr;


class AudioPlayerController extends Controller
{
    public function index()
    {
        // Tu peux aussi récupérer ça depuis la BDD
        $tracks = [
             [
                'book_id' => 'hp1',
                'title'  => 'Harry Potter 1',
                'url'    => asset('audio/1partie1.m4a'),
                'artist' => 'Leodible',      // optionnel
                'album'  => 'Notes voix', // optionnel
                'cover' => 'https://equicode.fr/img/covers/harry0.png',
            ],
             [
                'book_id' => 'hp2',
                'title'  => 'Harry Potter 2',
                'url'    => asset('audio/2partie1.m4a'),
                'artist' => 'Leodible',      // optionnel
                'album'  => 'Notes voix', // optionnel
                'cover' => 'https://equicode.fr/img/covers/harry2.png',
            ],
             [
                'book_id' => 'hp3',
                'title'  => 'Harry Potter 3',
                'url'    => asset('audio/3partie1.m4a'),
                'artist' => 'Leodible',      // optionnel
                'album'  => 'Notes voix', // optionnel
                'cover' => 'https://equicode.fr/img/covers/harry3.png',
            ],
             [
                'book_id' => 'hp4a',
                'title'  => 'Harry Potter 4 part 1',
                'url'    => asset('audio/4partie1.m4a'),
                'artist' => 'Leodible',      // optionnel
                'album'  => 'Notes voix', // optionnel
                'cover' => 'https://equicode.fr/img/covers/harry4.png',
            ],
            [
                'book_id' => 'hp4b',
                'title'  => 'Harry Potter 4 part 2',
                'url'    => asset('audio/4partie2.m4a'),
                'artist' => 'Leodible',      // optionnel
                'album'  => 'Notes voix', // optionnel
                'cover' => 'https://equicode.fr/img/covers/harry4.png',
            ],
            [
                'book_id' => 'hp5a',
                'title'  => 'Harry Potter 5 part 1',
                'url'    => asset('audio/5partie1.m4a'),
                'artist' => 'Leodible',      // optionnel
                'album'  => 'Notes voix', // optionnel
                'cover' => asset('img/covers/harry5.png'),
            ],
            [
                'book_id' => 'hp5b',
                'title'  => 'Harry Potter 5 part 2',
                'url'    => asset('audio/5partie2.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => 'https://equicode.fr/img/covers/harry5.png',
            ],
             [
                'book_id' => 'hp5c',
                'title'  => 'Harry Potter 5 part 3',
                'url'    => asset('audio/5partie3.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => asset('img/covers/harry.png'),
            ],
             [
                'book_id' => 'hp6a',
                'title'  => 'Harry Potter 6 part 1',
                'url'    => asset('audio/6partie1.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => 'https://equicode.fr/img/covers/harry6.png',
            ],
            [
                'book_id' => 'hp6b',
                'title'  => 'Harry Potter 6 part 2',
                'url'    => asset('audio/6partie2.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => 'https://equicode.fr/img/covers/harry6.png',
            ],
             [
                'book_id' => 'hp7a',
                'title'  => 'Harry Potter 7 part 1',
                'url'    => asset('audio/7partie1.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => asset('img/covers/harry7.png'),
            ],
             [
                'book_id' => 'hp7b',
                'title'  => 'Harry Potter 7 part 2',
                'url'    => asset('audio/7partie2.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => asset('img/covers/harry7.png'),
            ],
             [
                'book_id' => 'hp7c',
                'title'  => 'Harry Potter 7 part 3',
                'url'    => asset('audio/7partie3.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => asset('img/covers/harry7.png'),
            ],
            [
                'book_id' => 'dune1',
                'title'  => 'Dune 1',
                'url'    => asset('audio/dune1.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => asset('img/covers/dune1.png'),
            ],
            [
                'book_id' => 'dune2',
                'title'  => 'Dune 2',
                'url'    => asset('audio/dune2.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => asset('img/covers/dune2.png'),
            ],
            [
                'book_id' => 'animaux1',
                'title'  => 'Les animaux fanstastique 1',
                'url'    => asset('audio/animaux1.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => asset('img/covers/animaux.png'),
            ],
            [
                'book_id' => 'seingeur1',
                'title'  => 'Le seigneur des anneaux 1',
                'url'    => asset('audio/Anneau1Part1.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => asset('img/covers/an1.png'),
            ],
            [
                'book_id' => 'seigneur2',
                'title'  => 'Le seigneur des anneaux 2',
                'url'    => asset('audio/Anneau2Part1.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => asset('img/covers/an2.png'),
            ],
            [
                'book_id' => 'mortsurlenil',
                'title'  => 'AGATHA CHRISTIE - MORT SUR LE NIL',
                'url'    => asset('audio/mortsurlenil.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => asset('img/covers/mortsurlenil.png'),
            ],
            [
                'book_id' => 'orientexpress',
                'title'  => 'Agatha Christie - Le Crime de l Orient Express',
                'url'    => asset('audio/orientexpress.m4a'),
                'artist' => 'Leodible',
                'album'  => 'Notes voix',
                'cover' => asset('img/covers/orientexpress.png'),
            ],

            // ...
        ];

       

$bookIds = collect($tracks)
        ->pluck('book_id')
        ->filter()
        ->unique()
        ->values();

    $circles = \App\Models\Circle::query()
        ->whereHas('members', fn($q) => $q->where('user_id', auth()->id()))
        ->with(['members:id,name']) // adapte si tu as prénom/username
        ->withCount('members')
        ->orderBy('name')
        ->get();

 $circleIds = $circles->pluck('id');

    $raw = auth()->user()?->audio_resume;

    // si c'est l'ancien format (un seul objet avec book_id)
    if (is_array($raw) && isset($raw['book_id'])) {
        $lastState = [
            $raw['book_id'] => $raw,
        ];
    } else {
        // nouveau format (map) ou vide
        $lastState = is_array($raw) ? $raw : [];
    }

      $totalSeconds = 0;
    if (is_array($lastState)) {
        foreach ($lastState as $key => $state) {
            if ($key === '__last') continue;
            $t = (float)($state['time'] ?? 0);
            if ($t > 0) $totalSeconds += $t;
        }
    }   
    
      $allComments = \App\Models\Comment::query()
        ->whereIn('book_id', $bookIds)
        ->whereIn('circle_id', $circleIds)
        ->with('user:id,name')
        ->orderBy('time_sec')
        ->get();

          $resumeTime = function(string $bookId) use ($lastState) {
        $t = data_get($lastState, "$bookId.time", 0);
        return is_numeric($t) ? (float)$t : 0;
    };


    $commentsByBookAndCircle = [];
    $hiddenCountsByBookAndCircle = [];

    foreach ($allComments as $c) {
        $key = $c->book_id.'|'.$c->circle_id;

        $userT = $resumeTime($c->book_id);

        if ($c->time_sec <= $userT) {
            $commentsByBookAndCircle[$key][] = $c;
        } else {
            $hiddenCountsByBookAndCircle[$key] = ($hiddenCountsByBookAndCircle[$key] ?? 0) + 1;
        }
    }


    return view('alohomora', compact('tracks', 'lastState', 'totalSeconds', 'circles','commentsByBookAndCircle','hiddenCountsByBookAndCircle'));
    }




  public function saveResume(Request $request)
{
    $user = $request->user();
    if (!$user) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }

    $data = $request->validate([
        'book_id' => 'required|string|max:100',
        'url'     => 'required|string',
        'title'   => 'nullable|string',
        'artist'  => 'nullable|string',
        'cover'   => 'nullable|string',
        'time'    => 'required|numeric|min:0',
    ]);

    // ancien JSON (peut être null, ou un ancien "objet simple")
    $existing = $user->audio_resume;

    // Si c'est un ancien format (un seul objet avec 'url'), on le convertit en tableau indexé
    if (is_array($existing) && isset($existing['url']) && !isset($existing[$data['book_id']])) {
        $legacyBookId = $existing['book_id'] ?? $existing['url'];
        $existing = [
            $legacyBookId => $existing,
        ];
    }

    if (!is_array($existing)) {
        $existing = [];
    }

    // Upsert par book_id
    $ts = (int) round(microtime(true) * 1000);

    $existing[$data['book_id']] = array_merge($data, [
        'updated_at' => $ts,
    ]);

    // Meta "dernier lu" (cross-device)
    $existing['__last'] = [
        'book_id'    => $data['book_id'],
        'time'       => (float) $data['time'],
        'updated_at' => $ts,
    ];

    $user->audio_resume = $existing;
    $user->save();

    return response()->json([
        'status' => 'ok',
        'audio_resume' => $existing,
    ]);
}


       public function show(Request $request)
    {
        $data = $request->validate([
            'book' => 'required|string',
            't'    => 'nullable|numeric|min:0',
            'd'    => 'nullable|integer|min:5|max:300', // extrait 5s → 5 min
        ]);

        $bookId = $data['book'];
        $start  = (float)($data['t'] ?? 0);
        $dur    = (int)($data['d'] ?? 30);

        // ⚠️ Source de vérité : ton catalogue (plus tard -> BDD)
        $tracks = [
            [
                'book_id' => 'hp1',
                'title'  => 'Harry Potter 1',
                'url'    => asset('audio/1partie1.m4a'),
                'artist' => 'Leodible',
                'cover'  => 'https://equicode.fr/img/covers/harry0.png',
            ],
            // ... copie les autres
        ];

        $track = collect($tracks)->firstWhere('book_id', $bookId);

        abort_if(!$track, 404);

        return view('audio_share', [
            'track' => $track,
            'start' => $start,
            'end'   => $start + $dur,
            'dur'   => $dur,
        ]);
    }


    public function aloserie()
    {


    $featuredResponse = Http::get('https://api.purstream.art/api/v1/catalog/movies', [
        'search' => '',
        'page' => 1,
        'sortBy' => 'newest',
        'types' => 'tv',
        'categoriesIds' => '*',
        'franchisesIds' => '*',
        'displayMode' => 'large',
        'perPage' => 20,

    ]);


      $response = Http::get('https://api.purstream.art/api/v1/catalog/movies', [
        'search' => '',
        'page' => 1,
        'sortBy' => 'best-rated',
        'types' => 'tv',
        'categoriesIds' => '*',
        'franchisesIds' => '*',
        'displayMode' => 'large',
        'perPage' => 200,

    ]);

    $videos = $response->json();
    $featuredJson = $featuredResponse->json();
    $featured = $featuredJson['data']['items']['data'];
    $datas = $videos['data']['items']['data'];

    $hero = $featured[array_rand($featured)];
   
    return view('series', compact('videos', 'datas', 'featured', 'hero'));
      
    }




    public function oneserie($id)
{
    $saison = (int) request('saison', 1);
    $lang = request('lang', 'fr');

    $responseResponse = Http::get("https://api.purstream.art/api/v1/media/{$id}/sheet");
    $responseJson = $responseResponse->json();
    
    $response = $responseJson['data']['items'] ?? [];
   
    if (!$response) {
        abort(404, 'Média introuvable');
    }

    $seriesResumes = collect();

    if (auth()->check()) {
        $seriesResumes = SeriesResume::query()
            ->where('user_id', auth()->id())
            ->where('series_id', $id)
            ->orderByDesc('updated_at_resume')
            ->get();
    }

    $latestResume = $seriesResumes->first();

    $progressMap = $seriesResumes
        ->mapWithKeys(function ($resume) {
            return [
                ((int) $resume->season_id . '|' . (int) $resume->episode_id) => (int) $resume->progress_percent,
            ];
        })
        ->all();

    // FILM
    if (Arr::get($responseJson, 'data.items.type') !== 'tv') {
        $result = [
            'fr' => [],
            'vo' => [],
        ];

        foreach (($response['urls'] ?? []) as $item) {
            $parsedLang = str_contains(strtoupper($item['name'] ?? ''), 'VF') || str_contains(strtoupper($item['name'] ?? ''), 'VF')
                ? 'fr'
                : 'vo';

            $result[$parsedLang][] = $item;
        }



        return view('oneserie', compact(
            'response',
            'result',
            'id',
            'lang',
            'latestResume',
            'progressMap',
            'seriesResumes'
        ));
    }

    // SERIE
    $responseSaisonResponse = Http::get("https://api.purstream.art/api/v1/media/{$id}/season/{$saison}");
    $responseSaisonJson = $responseSaisonResponse->json();

    $responseSaison = $responseSaisonJson['data']['items']['episodes'] ?? [];
   
    $parsed = collect($response['urls'] ?? [])
        ->map(function ($item) {
            if (preg_match('/S(\d+)\/E(\d+)/', $item['url'] ?? '', $m)) {
                return [
                    'season' => (int) $m[1],
                    'episode' => (int) $m[2],
                    'url' => $item['url'],
                    'name' => $item['name'] ?? '',
                    'raw' => $item,
                ];
            }

            return null;
        })
        ->filter()
        ->sortBy([
            ['season', 'asc'],
            ['episode', 'asc'],
        ])
        ->values();

    $result = [
        'fr' => [],
        'vo' => [],
    ];

    foreach ($parsed as $item) {
        $parsedLang = str_contains(strtoupper($item['name']), 'VF') || str_contains(strtoupper($item['name']), 'VF')
            ? 'fr'
            : 'vo';

        $result[$parsedLang][$item['season']][$item['episode']] = $item;
    }
  
    return view('oneserie', compact(
        'responseSaison',
        'response',
        'result',
        'id',
        'saison',
        'lang',
        'latestResume',
        'progressMap',
        'seriesResumes'
    ));
}


    public function search(Request $request)
    {
        $query = $request->validate([
            'q' => 'required|string|max:100',
        ])['q'];
        
        try {
            $response = Http::timeout(10)->get('https://api.purstream.art/api/v1/search-bar/search/' . urlencode($query) );
        
          
 if ($response->failed()) {
            return response()->json([
                'results' => [],
                'message' => 'Erreur API',
            ], 500);
        }

          $payload = $response->json();

        $results = collect($payload['data']['items']['movies']['items'] ?? [])
            ->values()
            ->toArray();

        return response()->json([
            'payload' => $payload,
            'results' => $results,
            'count' => $payload['data']['items']['movies']['count'] ?? count($results),
        ]);
        } catch (\Throwable $e) {
            return response()->json([
                'results' => [],
                'message' => 'Impossible de contacter l’API',
            ], 500);
        }
    }


    public function catalog()
{
    $type = request('type', 'all');

    if (!in_array($type, ['all', 'tv', 'movie'], true)) {
        $type = 'all';
    }

    $categoriesResponse = Http::get('https://api.purstream.art/api/v1/catalog/categories');

    $activeFilters = collect(request()->input('categories', []))
        ->map(fn ($id) => (int) $id)
        ->all();

    $categoriesIds = !empty($activeFilters)
        ? implode(',', $activeFilters)
        : '*';

    $filters = data_get($categoriesResponse->json(), 'data.items', []);

    $series = [];
    $movies = [];
    $items = [];

    if ($type === 'all' || $type === 'tv') {
        $seriesResponse = Http::get('https://api.purstream.art/api/v1/catalog/movies', [
            'search' => '',
            'page' => 1,
            'sortBy' => 'newest',
            'types' => 'tv',
            'categoriesIds' => $categoriesIds,
            'franchisesIds' => '*',
            'displayMode' => 'large',
            'perPage' => 200,
        ]);

        $series = collect(data_get($seriesResponse->json(), 'data.items.data', []))
            ->map(function ($item) {
                $item['type'] = 'tv';
                return $item;
            })
            ->values()
            ->all();
    }

    if ($type === 'all' || $type === 'movie') {
        $moviesResponse = Http::get('https://api.purstream.art/api/v1/catalog/movies', [
            'search' => '',
            'page' => 1,
            'sortBy' => 'newest',
            'types' => 'movie',
            'categoriesIds' => $categoriesIds,
            'franchisesIds' => '*',
            'displayMode' => 'large',
            'perPage' => 200,
        ]);
     

        $movies = collect(data_get($moviesResponse->json(), 'data.items.data', []))
            ->map(function ($item) {
                $item['type'] = 'movie';
                return $item;
            })
            ->values()
            ->all();
         
    }

    if ($type === 'all') {
        $items = collect(array_merge($series, $movies))
            ->sortByDesc(function ($item) {
                return strtotime($item['created_at'] ?? $item['release_date'] ?? '1970-01-01');
            })
            ->values()
            ->all();
    } elseif ($type === 'tv') {
        $items = $series;
    } else {
        $items = $movies;
    }

    return view('serie.catalog', compact(
        'filters',
        'activeFilters',
        'type',
        'items',
        'series',
        'movies'
    ));
}

 
public function store(Request $request)
    {
        $data = $request->validate([
            'series_id' => ['required', 'integer'],
            'series_title' => ['required', 'string', 'max:255'],
            'episode_id' => ['nullable', 'integer'],
            'season_id' => ['nullable', 'integer'],
            'episode_title' => ['nullable', 'string', 'max:255'],
            'current_time' => ['required', 'integer', 'min:0'],
            'duration' => ['nullable', 'integer', 'min:0'],
            'poster' => ['nullable', 'string', 'max:2000'],
            'event_type' => ['nullable', 'string', 'max:50'], // progress, pause, ended, next, start
            'media_type' => ['nullable', 'in:movie,series'],
        ]);


        
       

        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur non connecté',
            ], 401);
        }

        $duration = (int) ($data['duration'] ?? 0);
        $currentTime = (int) $data['current_time'];

        $progressPercent = $duration > 0
            ? min(100, (int) round(($currentTime / $duration) * 100))
            : 0;

        $eventType = $data['event_type'] ?? 'progress';

        $isFinished = $duration > 0 && $currentTime >= max(0, $duration - 30);

        SeriesProgressLog::create([
            'user_id' => $user->id,
            'series_id' => $data['series_id'],
            'series_title' => $data['series_title'],
            'episode_id' => $data['episode_id'] ?? null,
            'season_id' => $data['season_id'] ?? null,
            'episode_title' => $data['episode_title'] ?? null,
            'current_time' => $currentTime,
            'duration' => $duration,
            'progress_percent' => $progressPercent,
            'poster' => $data['poster'] ?? null,
            'event_type' => $isFinished ? 'ended' : $eventType,
            'media_type' => $data['media_type'] ?? 'series',
            'watched_at' => now(),
        ]);

       if ($isFinished) {
    SeriesResume::query()
        ->where('user_id', $user->id)
        ->where('series_id', $data['series_id'])
        ->where('season_id', $data['season_id'] ?? null)
        ->where('episode_id', $data['episode_id'] ?? null)
        ->delete();
} else {
    SeriesResume::updateOrCreate(
        [
            'user_id' => $user->id,
            'series_id' => $data['series_id'],
            'season_id' => $data['season_id'] ?? null,
            'episode_id' => $data['episode_id'] ?? null,
        ],
        [
            'series_title' => $data['series_title'],
            'episode_title' => $data['episode_title'] ?? null,
            'current_time' => $currentTime,
            'duration' => $duration,
            'progress_percent' => $progressPercent,
            'poster' => $data['poster'] ?? null,
            'media_type' => $data['media_type'] ?? 'series',
            'updated_at_resume' => now(),
        ]
    );
}
        return response()->json([
            'success' => true,
            'message' => $isFinished ? 'Lecture terminée, reprise supprimée' : 'Progression sauvegardée',
            'latest_resume' => SeriesResume::query()
                ->where('user_id', $user->id)
                ->where('series_id', $data['series_id'])
                ->orderByDesc('updated_at_resume')
                ->first(),
        ]);
    }


public function history()
{
    $continueWatchingGrouped = collect();
    $recentlyWatchedGrouped = collect();

    if (auth()->check()) {
        $continueWatching = SeriesResume::query()
            ->where('user_id', auth()->id())
            ->orderByDesc('updated_at_resume')
            ->get();

        $continueWatchingGrouped = $continueWatching
            ->groupBy('series_id')
            ->map(function ($items) {
                $items = $items->sortByDesc('updated_at_resume')->values();
                $latest = $items->first();
               
                return [
                    'series_id' => $latest->series_id,
                    'media_type' => $latest->media_type ?? 'series',
                    'series_title' => $latest->series_title,
                    'poster' => $latest->poster,
                    'latest' => $latest,
                    'episodes' => $items,
                    'updated_at_resume' => $latest->updated_at_resume,
                ];
            })
            ->sortByDesc('updated_at_resume')
            ->values();


        $recentlyWatched = SeriesProgressLog::query()
            ->where('user_id', auth()->id())
            ->where('event_type', 'ended')
            ->orderByDesc('watched_at')
            ->get()
            ->unique(function ($item) {
                return $item->series_id . '|' . ($item->season_id ?? 0) . '|' . ($item->episode_id ?? 0);
            })
            ->values();

        $recentlyWatchedGrouped = $recentlyWatched
            ->groupBy('series_id')
            ->map(function ($items) {
                $items = $items->sortByDesc('watched_at')->values();
                $latest = $items->first();

                return [
                    'series_id' => $latest->series_id,
                    'media_type' => $latest->media_type ?? 'series',
                    'series_title' => $latest->series_title,
                    'poster' => $latest->poster,
                    'latest_watched_at' => $latest->watched_at,
                    'episodes' => $items,
                ];
            })
            ->sortByDesc('latest_watched_at')
            ->values();
    }

    return view('serie.history', compact(
        'continueWatchingGrouped',
        'recentlyWatchedGrouped'
    ));
}




public function alofilm()
    {


    $featuredResponse = Http::get('https://api.purstream.art/api/v1/catalog/movies', [
        'search' => '',
        'page' => 1,
        'sortBy' => 'newest',
        'types' => 'movie',
        'categoriesIds' => '*',
        'franchisesIds' => '*',
        'displayMode' => 'large',
        'perPage' => 20,

    ]);


      $response = Http::get('https://api.purstream.art/api/v1/catalog/movies', [
        'search' => '',
        'page' => 1,
        'sortBy' => 'best-rated',
        'types' => 'movie',
        'categoriesIds' => '*',
        'franchisesIds' => '*',
        'displayMode' => 'large',
        'perPage' => 200,

    ]);

    $videos = $response->json();
    $featuredJson = $featuredResponse->json();
    $featured = $featuredJson['data']['items']['data'];
    $datas = $videos['data']['items']['data'];

    $hero = $featured[array_rand($featured)];
   
    return view('series', compact('videos', 'datas', 'featured', 'hero'));
      
    }

public function alocine()
{
    $featuredSeriesResponse = Http::get('https://api.purstream.art/api/v1/catalog/movies', [
        'search' => '',
        'page' => 1,
        'sortBy' => 'newest',
        'types' => 'tv',
        'categoriesIds' => '*',
        'franchisesIds' => '*',
        'displayMode' => 'large',
        'perPage' => 20,
    ]);

    $seriesResponse = Http::get('https://api.purstream.art/api/v1/catalog/movies', [
        'search' => '',
        'page' => 1,
        'sortBy' => 'best-rated',
        'types' => 'tv',
        'categoriesIds' => '*',
        'franchisesIds' => '*',
        'displayMode' => 'large',
        'perPage' => 200,
    ]);

    $featuredSeriesJson = $featuredSeriesResponse->json();
    $seriesJson = $seriesResponse->json();

    $featuredSeries = collect($featuredSeriesJson['data']['items']['data'] ?? [])
        ->map(function ($item) {
            $item['type'] = 'tv';
            return $item;
        })
        ->values()
        ->all();

    $series = collect($seriesJson['data']['items']['data'] ?? [])
        ->map(function ($item) {
            $item['type'] = 'tv';
            return $item;
        })
        ->values()
        ->all();

    $featuredMoviesResponse = Http::get('https://api.purstream.art/api/v1/catalog/movies', [
        'search' => '',
        'page' => 1,
        'sortBy' => 'newest',
        'types' => 'movie',
        'categoriesIds' => '*',
        'franchisesIds' => '*',
        'displayMode' => 'large',
        'perPage' => 20,
    ]);

    $moviesResponse = Http::get('https://api.purstream.art/api/v1/catalog/movies', [
        'search' => '',
        'page' => 1,
        'sortBy' => 'best-rated',
        'types' => 'movie',
        'categoriesIds' => '*',
        'franchisesIds' => '*',
        'displayMode' => 'large',
        'perPage' => 200,
    ]);

    $featuredMoviesJson = $featuredMoviesResponse->json();
    $moviesJson = $moviesResponse->json();

    $featuredMovies = collect($featuredMoviesJson['data']['items']['data'] ?? [])
        ->map(function ($item) {
            $item['type'] = 'movie';
            return $item;
        })
        ->values()
        ->all();

    $movies = collect($moviesJson['data']['items']['data'] ?? [])
        ->map(function ($item) {
            $item['type'] = 'movie';
            return $item;
        })
        ->values()
        ->all();

    $allFeatured = collect(array_merge($featuredSeries, $featuredMovies))->values()->all();
    $hero = !empty($allFeatured) ? $allFeatured[array_rand($allFeatured)] : null;


    
    return view('series', [
        'series' => $series,
        'featuredSeries' => $featuredSeries,
        'movies' => $movies,
        'featuredMovies' => $featuredMovies,
        'hero' => $hero,
    ]);
}


    }