<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Flugg\Responder\Contracts\Transformers\TransformerResolver;

class TransformerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->make(TransformerResolver::class)->bind([
            \App\Models\Character::class => \App\Transformers\CharacterTransformer::class,
            \App\Models\Episode::class => \App\Transformers\EpisodeTransformer::class,
            \App\Models\Quote::class => \App\Transformers\QuoteTransformer::class,
        ]);
    }
}
