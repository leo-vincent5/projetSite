<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Circle;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        // ✅ accepte plusieurs noms pour éviter les galères JS
        $request->merge([
            'book_id'  => $request->input('book_id') ?? $request->input('book'),
            'progress' => $request->input('progress') ?? $request->input('t'),
        ]);

        $data = $request->validate([
            'circle_id' => ['required', 'integer'],
            'book_id'   => ['required', 'string'],
            'progress'  => ['required', 'integer', 'min:0'],
        ]);

        $circleId = (int) $data['circle_id'];
        $bookId   = (string) $data['book_id'];
        $progress = (int) $data['progress'];

        // ✅ sécurité : il faut être membre du cercle
        $circle = Circle::findOrFail($circleId);
        abort_unless(
            $circle->members()->where('users.id', auth()->id())->exists(),
            403
        );

        $base = Comment::query()
            ->where('circle_id', $circleId)
            ->where('book_id', $bookId)
            ->with('user:id,name');

        $visible = (clone $base)
            ->where('time_sec', '<=', $progress)
            ->orderBy('time_sec')
            ->get();

        $lockedCount = (clone $base)
            ->where('time_sec', '>', $progress)
            ->count();

        // ✅ format stable pour ton JS (visible + locked_count)
        return response()->json([
            'visible' => $visible,
            'locked_count' => $lockedCount,
        ]);
    }

    public function store(Request $request)
    {
        // ✅ accepte content/timecode au cas où
        $request->merge([
            'book_id'  => $request->input('book_id') ?? $request->input('book'),
            'time_sec' => $request->input('time_sec') ?? $request->input('timecode'),
            'body'     => $request->input('body') ?? $request->input('content'),
        ]);

        $data = $request->validate([
            'circle_id'   => ['required','integer'],
            'book_id'     => ['required','string'],
            'time_sec'    => ['required','integer','min:0'],
            'track_title' => ['nullable','string','max:255'],
            'body'        => ['required','string','max:5000'],
        ]);

        $circle = Circle::findOrFail((int) $data['circle_id']);

        abort_unless(
            $circle->members()->where('users.id', auth()->id())->exists(),
            403
        );

        $comment = Comment::create([
            'circle_id'   => $circle->id,
            'user_id'     => auth()->id(),
            'book_id'     => $data['book_id'],
            'time_sec'    => (int) $data['time_sec'],
            'track_title' => $data['track_title'] ?? null,
            'body'        => $data['body'],
        ]);

        return response()->json([
            'ok' => true,
            'comment' => $comment->load('user:id,name'),
        ]);
    }

    public function my(Request $request)
    {
        $request->merge([
            'book_id'  => $request->input('book_id') ?? $request->input('book'),
            'progress' => $request->input('progress') ?? $request->input('t'),
        ]);

        $data = $request->validate([
            'book_id'   => ['required', 'string'],
            'progress'  => ['required', 'integer', 'min:0'],
        ]);

        $bookId   = (string) $data['book_id'];
        $progress = (int) $data['progress'];
        $userId   = auth()->id();

        // ids des cercles où je suis membre
        $circleIds = \App\Models\Circle::query()
            ->whereHas('members', fn($q) => $q->where('users.id', $userId))
            ->pluck('id');

        // commentaires visibles de mes cercles
        $visible = \App\Models\Comment::query()
            ->whereIn('circle_id', $circleIds)
            ->where('book_id', $bookId)
            ->where('time_sec', '<=', $progress)
            ->with(['user:id,name', 'circle:id,name'])
            ->orderBy('time_sec')
            ->get();

        // combien restent verrouillés (anti-spoil)
        $lockedCount = \App\Models\Comment::query()
            ->whereIn('circle_id', $circleIds)
            ->where('book_id', $bookId)
            ->where('time_sec', '>', $progress)
            ->count();

        return response()->json([
            'visible' => $visible,
            'locked_count' => $lockedCount,
        ]);
    }
}