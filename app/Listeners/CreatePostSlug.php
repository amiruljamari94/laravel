<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use illuminate\Support\Str;
use App\Events\PostCreated;

class CreatePostSlug
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    
    public function __construct()
    {
        //
    }

    /*
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $slug = Str::slug($event->post->title) . '.' . $event->post->id;
        $event->post->update(['slug' => $slug]);
    }
}
