<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteBeaconsBatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:deleteBeacons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute DeleteBeaconsBatch.php';

    public $accessToken = '';
    public $tokenGetTime = '';
    public $tokenExpires = '';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //$this->_deleteBeacons();
        $beacons = $this->_getBeacons();
        echo count($beacons);
        return 0;
    }

    
    /**
     * Delete All Beacons
     */
    private function _deleteBeacons() {
        echo ("_deleteBeacons Start\n");
        $beacons = $this->_getBeacons();
        for ($i = 0 ; $i < count($beacons) ; $i++) {
          $this->_deleteBeacon($beacons[$i]);
        }
      }

    /**
     * When token exists and valid mre than 60 seconds, use Old token. Otherwise, get new Token
     */
    private function _getAccessToken() {
        echo ("_getAccessToken Start\n");

        if ($this->accessToken && $this->tokenExpires > 60) {
            echo ("Uses old Token");
            $this->tokenExpires = $this->tokenExpires - (time() - $this->tokenGetTime);
            return $this->accessToken;
        } else  {
            echo ("Get New Token");

            $curl = curl_init();
  
            curl_setopt_array($curl, array(
                CURLOPT_URL => config('app.API_AUTH_URI') . 'v2/token',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{"grant_type":"client_credentials","client_id":"' . config('app.API_CLIENT_ID') .'","client_secret":"'. config('app.API_CLIENT_SECRET') .'"}',
                CURLOPT_HTTPHEADER => array(
                  'Content-Type: application/json'
                ),
              ));
    
            $response = curl_exec($curl);
            curl_close($curl);
            $json = $response;
            $res = json_decode($json, true);
            $this->tokenGetTime = time();
            $this->accessToken = $res['access_token'];
            $this->tokenExpires = $res['expires_in'];
            return $this->accessToken;
        }
        
      }

      /**
       * get Beason ID List
       */
      private function _getBeacons() {
        echo("getBeacons Start\n");
  
        $accessToken = $this->_getAccessToken();
        $curl = curl_init();
  
        curl_setopt_array($curl, array(
          CURLOPT_URL => config('app.API_REST_URI') . "push/v1/location/".'?$pageSize=20000',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer {$accessToken}"
          ),
        ));
  
        $response = curl_exec($curl);
        curl_close($curl);
        $json = $response;
        $res = json_decode($json, true);
        $items = $res['items'];
        $beaconIds = [];
        for($i = 0 ; $i < count($items) ; $i++) {
          array_push($beaconIds, $items[$i]['id']);
        }

        echo("getBeacons End\n");
        return $beaconIds;
      }

      /**
       * Delete individual Beacon
       */
      private function _deleteBeacon($id) {
        echo ("_deleteBeacon Start : " . $id . "\n");
        $accessToken = $this->_getAccessToken();
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => config('app.API_REST_URI') . "push/v1/location/{$id}",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "DELETE",
          CURLOPT_POSTFIELDS =>"",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer {$accessToken}"
          ),
        ));
        
        $response = curl_exec($curl);
        var_dump($response);
        curl_close($curl);
      }
}
