<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('name');

        if ($request->get('limit')) {
            $limit = $request->get('limit');
        } else {
            $limit = 10;
        }

        try {
            $characters = new Character();

            if ($search) {
                foreach (explode(' ', $search) as $s) {
                    $characters = $characters->where('name', 'like', '%' . $s . '%');
                }
            }

            return responder()
                ->success($characters->paginate($limit))
                ->with('episodes', 'quotes')
                ->only([
                    'episodes' => ['id'],
                    'quotes' => ['id']
                ])
                ->respond(200);
        } catch (\Exception $e) {
            return responder()
                ->error($e->getMessage())
                ->respond(500);
        }
    }

    public function random()
    {
        try {
            $character = Character::orderByRaw("RAND()")->first();

            return responder()
                ->success($character)
                ->respond(200);
        } catch (\Exception $e) {
            return responder()
                ->success($e->getMessage()())
                ->respond(500);
        }
    }
}
