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

    Booking::create([
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
        ->route('family-apartment.dashboard')
        ->with('success', 'Le séjour a bien été enregistré.');
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

}
