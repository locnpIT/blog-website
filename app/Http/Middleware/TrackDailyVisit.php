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

            DB::table('daily_visits')->upsert(
                [[
                    'visit_date' => $today,
                    'visit_count' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]],
                ['visit_date'],
                [
                    'visit_count' => DB::raw('visit_count + 1'),
                    'updated_at' => now(),
                ],
            );
        }

        return $next($request);
    }
}
