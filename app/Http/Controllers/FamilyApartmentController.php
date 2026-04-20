<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\Tip;

class FamilyApartmentController extends Controller
{
    public function index()
{
    $monthParam = request('month');

    $month = $monthParam
        ? Carbon::createFromFormat('Y-m', $monthParam)->startOfMonth()
        : now()->startOfMonth();

    $month = $month->locale('fr');

    $calendarStart = $month->copy()->startOfMonth()->startOfWeek(Carbon::MONDAY);
    $calendarEnd = $month->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);

    $bookings = Booking::query()
        ->whereDate('start_date', '<=', $calendarEnd)
        ->whereDate('end_date', '>=', $calendarStart)
        ->orderBy('start_date')
        ->get();

    $days = [];
    $week = [];

    foreach (CarbonPeriod::create($calendarStart, $calendarEnd) as $date) {
        $events = [];

        foreach ($bookings as $booking) {
            $bookingStart = Carbon::parse($booking->start_date);
            $bookingEnd = Carbon::parse($booking->end_date);

            if ($date->betweenIncluded($bookingStart, $bookingEnd)) {
                $events[] = [
                    'label' => $booking->name,
                    'type' => $booking->status === 'pending' ? 'pending' : 'booking',
                    'booking_id' => $booking->id,
                ];
            }
        }

        $week[] = [
            'day' => $date->day,
            'date' => $date->toDateString(),
            'current_month' => $date->month === $month->month,
            'today' => $date->isToday(),
            'events' => $events,
        ];

        if (count($week) === 7) {
            $days[] = $week;
            $week = [];
        }
    }

    $upcomingBookings = Booking::query()
        ->whereDate('end_date', '>=', now()->startOfDay())
        ->orderBy('start_date')
        ->take(5)
        ->get()
        ->map(function ($booking) {
            return [
                'name' => $booking->name,
                'dates' =>   Carbon::parse($booking->start_date)->locale('fr')->translatedFormat('d M')
    . ' - ' .
    Carbon::parse($booking->end_date)->locale('fr')->translatedFormat('d M'),
                'status' => $booking->status === 'pending' ? 'En attente' : 'Confirmé',
                'avatar' => null,
                'url' => route('family-apartment.bookings.show', $booking),
            ];
        });

        $tips = Tip::query()
    ->latest()
    ->take(3)
    ->get();


    return view('family-apartment.index', [
        'month' => $month,
        'calendarWeeks' => $days,
        'currentMonthLabel' => $month->translatedFormat('F Y'),
        'upcomingBookings' => $upcomingBookings,
            'tips' => $tips,
    ]);
}

public function create()
{
    return view('family-apartment.bookings.create');
}
public function store(Request $request)
{
    $data = $request->validate([
        'series_id' => ['required', 'integer'],
        'series_title' => ['required', 'string', 'max:255'],
        'episode_id' => ['nullable', 'integer'],
        'episode_title' => ['nullable', 'string', 'max:255'],
        'current_time' => ['required', 'integer', 'min:0'],
        'duration' => ['nullable', 'integer', 'min:0'],
        'poster' => ['nullable', 'string', 'max:2000'],
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

    $resumes = collect($user->series_resumes ?? []);

    $isFinished = $duration > 0 && $currentTime >= max(0, $duration - 30);

    $sameEntry = function ($item) use ($data) {
        return (int) ($item['series_id'] ?? 0) === (int) $data['series_id']
            && (int) ($item['episode_id'] ?? 0) === (int) ($data['episode_id'] ?? 0);
    };

    if ($isFinished) {
        $resumes = $resumes->reject($sameEntry)->values();
    } else {
        $newEntry = [
            'series_id' => $data['series_id'],
            'series_title' => $data['series_title'],
            'episode_id' => $data['episode_id'] ?? null,
            'episode_title' => $data['episode_title'] ?? null,
            'current_time' => $currentTime,
            'duration' => $duration,
            'progress_percent' => $progressPercent,
            'poster' => $data['poster'] ?? null,
            'updated_at' => now()->toDateTimeString(),
        ];

        $resumes = $resumes
            ->reject($sameEntry)
            ->push($newEntry)
            ->sortByDesc(function ($item) {
                return strtotime($item['updated_at'] ?? '1970-01-01 00:00:00');
            })
            ->values();
    }

    $user->update([
        'series_resumes' => $resumes->all(),
    ]);

    return response()->json([
        'success' => true,
        'message' => $isFinished ? 'Épisode retiré de la reprise' : 'Progression sauvegardée',
        'series_resumes' => $user->fresh()->series_resumes,
    ]);
}


public function show($id)
{
    $booking = Booking::findOrFail($id);
    return view('family-apartment.bookings.show', compact('booking'));
}


public function infos()
{
    return view('family-apartment.infos');  

}

public function history(){
    $pastBookings = Booking::query()
        ->whereDate('end_date', '<', now()->startOfDay())
        ->orderBy('start_date', 'desc')
        ->get();

    return view('family-apartment.history', compact('pastBookings'));
}

public function destroy(Request $request, $id)
{
    $booking = Booking::findOrFail($id);
    $booking->delete();

    return redirect()
        ->route('family-apartment.dashboard')
        ->with('success', 'Le séjour a bien été supprimé.');

}


public function edit($id)
{
    $booking = Booking::findOrFail($id);    

    return view('family-apartment.bookings.edit', compact('booking'));
}


public function update(Request $request, Booking $booking)
{
    $validated = $request->validate([
        'title' => ['nullable', 'string', 'max:255'],
        'name' => ['required', 'string', 'max:255'],
        'start_date' => ['required', 'date'],
        'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        'status' => ['required', 'in:confirmed,pending,cancelled'],
        'guests_count' => ['nullable', 'integer', 'min:1'],
        'description' => ['nullable', 'string'],
        'practical_info' => ['nullable', 'string', 'max:255'],
        'reminder_note' => ['nullable', 'string'],
    ]);

    $startDate = Carbon::parse($validated['start_date'])->toDateString();
    $endDate = Carbon::parse($validated['end_date'])->toDateString();

    $overlappingBooking = Booking::query()
        ->where('id', '!=', $booking->id)
        ->where('status', '!=', 'cancelled')
        ->whereDate('start_date', '<=', $endDate)
        ->whereDate('end_date', '>=', $startDate)
        ->first();

    if ($overlappingBooking) {
        $conflictStart = Carbon::parse($overlappingBooking->start_date)->locale('fr');
        $conflictEnd = Carbon::parse($overlappingBooking->end_date)->locale('fr');

        if ($conflictStart->month === $conflictEnd->month && $conflictStart->year === $conflictEnd->year) {
            $periodLabel = $conflictStart->translatedFormat('d') . ' - ' . $conflictEnd->translatedFormat('d F Y');
        } else {
            $periodLabel = $conflictStart->translatedFormat('d M Y') . ' - ' . $conflictEnd->translatedFormat('d M Y');
        }

        return back()
            ->withInput()
            ->withErrors([
                'start_date' => 'Cette période est déjà réservée par ' . $overlappingBooking->name . ' du ' . $periodLabel . '.',
            ]);
    }

    $booking->update([
        'title' => $validated['title'] ?: null,
        'name' => $validated['name'],
        'start_date' => $startDate,
        'end_date' => $endDate,
        'status' => $validated['status'],
        'guests_count' => $validated['guests_count'] ?? null,
        'description' => $validated['description'] ?? null,
        'practical_info' => $validated['practical_info'] ?? null,
        'reminder_note' => $validated['reminder_note'] ?? null,
    ]);

    return redirect()
        ->route('family-apartment.bookings.show', $booking)
        ->with('success', 'Le séjour a bien été modifié.');
}

}
