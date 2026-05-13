<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DailyVisit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitController extends Controller
{
    public function index(Request $request): View
    {
        $query = DailyVisit::query()->orderByDesc('visit_date');

        if ($request->filled('from_date')) {
            $query->whereDate('visit_date', '>=', $request->string('from_date')->toString());
        }

        if ($request->filled('to_date')) {
            $query->whereDate('visit_date', '<=', $request->string('to_date')->toString());
        }

        $visits = $query->paginate(20)->withQueryString();

        return view('admin.visits.index', [
            'visits' => $visits,
            'totalVisits' => (clone $query)->sum('visit_count'),
            'todayVisits' => DailyVisit::query()->whereDate('visit_date', now()->toDateString())->value('visit_count') ?? 0,
        ]);
    }
}
