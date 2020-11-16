<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApiRequestStatsController extends Controller
{
    public function stats() {
        try {
            $totalRequests = Cache::get('api-total-requests');

            return responder()
                ->success(['totalRequests' => $totalRequests])
                ->respond(200);
        } catch (\Exception $e) {
            return responder()
                ->error($e->getMessage())
                ->respond(500);
        }
    }

    public function userStats(Request $request) {
        try {
            $userId = $request->user()->id;
            $key = 'api:users:' . $userId;
            $totalRequests = Cache::get($key);

            return responder()
                ->success(['totalRequests' => $totalRequests])
                ->respond(200);
        } catch (\Exception $e) {
            return responder()
                ->error($e->getMessage())
                ->respond(500);
        }
    }
}
