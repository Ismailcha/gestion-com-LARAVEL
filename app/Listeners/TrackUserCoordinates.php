<?php

namespace App\Listeners;

use App\Models\UserLocation;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Stevebauman\Location\Facades\Location;
use Illuminate\Contracts\Queue\ShouldQueue;


class TrackUserCoordinates
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        $user = $event->user;

        // Check if the user's role is 0 (deleguer)
        if ($user->role == 0) {
            // Get the latitude and longitude of the user's current location
            $location = Location::get();
            $latitude = $location->latitude;
            $longitude = $location->longitude;

            // Create a new user location record
            UserLocation::create([
                'user_id' => $user->id,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);
        }
    }
}
