<?php

namespace App\Listener;

use App\Event\CampaignCreated;
use App\Models\Campaign;
use App\Models\Token;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateSlug
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

    /**
     * Handle the event.
     *
     * @param  CampaignCreated  $event
     * @return void
     */
    public function handle(CampaignCreated $event)
    {
        $slug = Campaign::createSlug($event->campaign->name,$event->campaign->company_id); //add slug field to the request array
        Campaign::where('id',$event->campaign->id)->update(['slug' => $slug]);
    }
}
