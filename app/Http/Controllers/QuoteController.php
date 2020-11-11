<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->get('limit')) {
            $limit = $request->get('limit');
        } else {
            $limit = 10;
        }

        try {
            $quotes = Quote::paginate($limit);

            return responder()
                    ->success($quotes)
                    ->respond(200);
        } catch(\Exception $e) {
            return responder()
                    ->error($e->getMessage())
                    ->respond(500);
        }
    }

    public function random(Request $request)
    {
        $search = $request->get('author');

        try {
            $characters = Character::orderByRaw('RAND()');

            if ($search) {
                foreach(explode(' ', $search) as $s) {
                    $characters = $characters->where('name', 'like', '%' . $s . '%');
                }
            }

            $character = $characters->firstOrFail();

            $quote = $character->quotes()->orderByRaw('RAND()')->first();

            return responder()
                    ->success($quote)
                    ->respond(200);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return responder()
                    ->error('not_found', 'The desired resource was not found')
                    ->respond(404);
        } catch (\Exception $e) {
            return responder()
                    ->error('exception', $e->getMessage())
                    ->respond(500);
        }
    }
}
