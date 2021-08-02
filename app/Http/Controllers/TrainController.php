<?php

namespace App\Http\Controllers;

use App\Http\Resources\TrainResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TrainController extends Controller
{
    public function index(Request $request) {
        $source = $request->query('source');
        $destination = $request->query('destination');

        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'x-rapidapi-key' => 'f4327cd6demshe31a69434fb8f69p1f86c2jsn0b378f2b2830',
            'x-rapidapi-host' => 'trains.p.rapidapi.com'
        ])->post('https://trains.p.rapidapi.com/', [
            'search' => $source,
        ]);

        $trains = $response->json();

        $trains = TrainResource::collection(collect($trains));
        
        return response()->json($trains, 200);
    }
}
