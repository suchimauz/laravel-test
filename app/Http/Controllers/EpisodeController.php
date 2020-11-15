<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;
use Flugg\Responder\TransformBuilder;

class EpisodeController extends Controller
{
    public function index(Request $request, TransformBuilder $transformation)
    {
        if ($request->get('limit')) {
            $limit = $request->get('limit');
        } else {
            $limit = 10;
        }

        try {
            $episodes = Episode::paginate($limit);

            return responder()
                ->success($episodes)
                ->respond(200);
        } catch (\Exception $e) {
            return responder()
                ->error($e->getMessage())
                ->respond(500);
        }
    }

    public function show($id)
    {
        try {
            $episode = Episode::findOrFail($id)->with('characters');
            return responder()
                ->success($episode)
                ->respond();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return responder()
                ->error('not_found', 'Episode with ID = ' . $id . ' not found!')
                ->respond(404);
        } catch (\Exception $e) {
            return responder()
                ->error('exception', $e->getMessage())
                ->respond(500);
        }
    }
}
