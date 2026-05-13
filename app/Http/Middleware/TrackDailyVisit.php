<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TrackDailyVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('get') && ! $request->is('admin/*')) {
            $today = now()->toDateString();
            $now = now()->toDateTimeString();

            DB::statement(
                'INSERT INTO daily_visits (visit_date, visit_count, created_at, updated_at)
                 VALUES (?, 1, ?, ?)
                 ON CONFLICT(visit_date)
                 DO UPDATE SET visit_count = daily_visits.visit_count + 1, updated_at = excluded.updated_at',
                [$today, $now, $now]
            );
        }

        return $next($request);
    }
}
