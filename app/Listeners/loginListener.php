<?php

namespace App\Listeners;

use DB;
use Session;
use App\Events\LoginEvent;
use App\Mail\welcomeEmail;
use GeoIp2\Database\Reader;
use App\Mail\UserLoggedInEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class loginListener
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
    public function handle(LoginEvent $event): void
    {

              $session = DB::table('sessions')->where('user_id', $event->user->id)->first();

              if( $session){  
                
                $data = [
                'device' =>  $session->user_agent,
                'ip_address' => $session->ip_address,
              ];
                  
                  
              }
              
            $data = [
                'device' =>  'unknown',
                'ip_address' => 'hidden',
              ];
              

            
        
             
        // Send email to the user
         //Mail::to($event->user->email)->send(new UserLoggedInEmail($data));
    }

    private function getCountryFromIp($ipAddress)
    {
        // Path to the GeoIP2 database file
        $databasePath = storage_path('app/geoip/GeoLite2-Country.mmdb');
        
        // Initialize GeoIP2 reader
        $reader = new Reader($databasePath);
        
        // Try to get country from IP address
        try {
            $record = $reader->country($ipAddress);
            return $record->country->isoCode; // Return country code
        } catch (\Exception $e) {
            // Handle exception if unable to get country
            return null;
        }
    }

  
}
