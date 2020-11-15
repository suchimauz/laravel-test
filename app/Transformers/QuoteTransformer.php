<?php

namespace App\Transformers;

use App\Models\Character;
use App\Models\Quote;
use Flugg\Responder\Transformers\Transformer;

class QuoteTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        'episode' => EpisodeTransformer::class,
        'character' => CharacterTransformer::class,
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
     * @param  \App\Models\Quote $quote
     * @return array
     */
    public function transform(Quote $quote)
    {
        return [
            'id' => (int) $quote->id,
            'quote' => $quote->quote,
        ];
    }
}
