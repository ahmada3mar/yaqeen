<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index(){

        $client = new Client(['base_uri' => 'http://192.168.20.22/' , 'cookies' => true]);
        $response = $client->get( 'krooka/login.aspx?&d=1632004121646&UN=dina&P=0000');

        // $rrr = $client->getConfig('cookies')->toArray() ;

        // $cookieJar = CookieJar::fromArray([
        //     $rrr[0]['Name'] => $rrr[0]['Value'] ,
        //     'HttpOnly' => true
        // ], 'http://192.168.20.22/');

        // $client->addSubscriber($cookieJar);


        $response2 = $client->request('GET', 'krooka/Search/SearchResultVehicle.aspx?&d=1632000500211&VehNat=1&PlateNoT=15&PlateNo=25634&RegNo=&ShasiNo=&AccDateFromVar=&AccDateToVar=&EngineNo=&VehCat=0&VehType=0&VehStatus=0&VehOwnNameFirst=&VehOwnNameFather=&VehOwnNameGrand=&VehOwnNameFamily=&OwnerType=0&varResp=0' );


        $client->request('GET', 'krooka/logout.aspx');
        // // Set up a cookie - name, value AND domain.
        //     $cookie = new Cookie();


        //     // Set up a cookie jar and add the cookie to it.
        //     $jar = new Guzzle\Plugin\Cookie\CookieJar\ArrayCookieJar();
        //     $jar->add($cookie);

        //     // Set up the cookie plugin, giving it the cookie jar.
        //     $plugin = new Guzzle\Plugin\Cookie\CookiePlugin($jar);

        //     // Register the plugin with the client.

        //     // Now do the request as normal.
        //     $request = $client->get($url);
        //     $response = $client->send($request);

        $cc=$response2->getBody()->getContents();
        dd($cc);
        return redirect(route('portal'));
    }

    public function portal(){


        return view('admin.portal.index');
    }

    public function pending(){


        return view('admin.pending_policy.index');
    }


}
