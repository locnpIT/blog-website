<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DailyVisit;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class VisitController extends Controller
{
    public function index(Request $request): Response
    {
        $query = DailyVisit::query()->orderByDesc('visit_date');

        if ($request->filled('from_date')) {
            $query->whereDate('visit_date', '>=', $request->string('from_date')->toString());
        }

        if ($request->filled('to_date')) {
            $query->whereDate('visit_date', '<=', $request->string('to_date')->toString());
        }

        $visits = $query->paginate(20)->withQueryString();

        return Inertia::render('Admin/Visits/Index', [
            'visits' => $visits->through(fn (DailyVisit $visit) => [
                'id' => $visit->id,
                'visit_date' => optional($visit->visit_date)->toDateString(),
                'visit_date_formatted' => optional($visit->visit_date)->format('d/m/Y'),
                'visit_count' => $visit->visit_count,
            ]),
            'totalVisits' => (clone $query)->sum('visit_count'),
            'todayVisits' => DailyVisit::query()->whereDate('visit_date', now()->toDateString())->value('visit_count') ?? 0,
            'filters' => $request->only('from_date', 'to_date'),
        ]);
    }
}
