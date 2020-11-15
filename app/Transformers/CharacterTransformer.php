<?php

namespace App\Transformers;

use App\Models\Character;
use Flugg\Responder\Transformers\Transformer;

class CharacterTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        'episodes' => EpisodeTransformer::class,
        'quotes' => QuoteTransformer::class,
    ];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param  \App\Models\Character $character
     * @return array
     */
    public function transform(Character $character)
    {
        return [
            'id' => (int) $character->id,
            'name' => $character->name,
            'birthday' => $character->birthday,
            'occupations' => $character->occupations,
            'img' => $character->img,
            'nickname' => $character->nickname,
            'portrayed' => $character->portrayed,
        ];
    }
}
