<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getStatistics(Request $request)
    {
        $currentMonth = Carbon::now()->startOfMonth();
        $endOfMonth = $currentMonth->copy()->endOfMonth();

        // 🔹 Filtro opcional por título
        $title = $request->query('title');

        // 🔹 Base query de tickets dentro del mes actual
        $query = Ticket::whereBetween('created_at', [$currentMonth, $endOfMonth]);

        // 🔹 Si el usuario selecciona un título, aplicamos el filtro
        if ($title) {
            $query->where('title', 'like', "%{$title}%");
        }

        // 🔹 Reutilizamos el query filtrado en todas las estadísticas
        $tickets = (clone $query)->get();

        $totalTickets = $tickets->count();
        $activeTickets = $tickets->where('status', '!=', 'resolved')->count();
        $resolvedTickets = $tickets->where('status', 'resolved')->count();

        $avgResolutionTime = (clone $query)
            ->where('status', 'resolved')
            ->whereNotNull('completed_at')
            ->select(DB::raw('AVG(TIMESTAMPDIFF(HOUR, created_at, completed_at)) as avg_time'))
            ->value('avg_time') ?? 0;

        $statusDistribution = [
            'open' => (clone $query)->where('status', 'open')->count(),
            'onprogress' => (clone $query)->where('status', 'onprogress')->count(),
            'resolved' => (clone $query)->where('status', 'resolved')->count(),
            'rejected' => (clone $query)->where('status', 'rejected')->count(),
        ];

        $dashboardData = [
            'total_tickets' => $totalTickets,
            'active_tickets' => $activeTickets,
            'resolved_tickets' => $resolvedTickets,
            'avg_resolution_time_hours' => round($avgResolutionTime, 1),
            'status_distribution' => $statusDistribution,
        ];

        return response()->json([
            'message' => 'Dashboard statistics retrieved successfully',
            'data' => $dashboardData,
        ], 200);
    }
}
