<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class LoginController extends Controller
{

    public function index($id){

    // return base_path();
        // $process = new Process(['C:\Users\User\AppData\Local\Programs\Python\Python39\python.exe' , 'main.py' , "F:\\Python\\POC\\$id.jpeg"]);
        // $process->run();

        // // executes after the command finishes
        // if (!$process->isSuccessful()) {
        //     throw new ProcessFailedException($process);
        // }

        // $data = $process->getOutput() ;
        // $data = json_decode($data , true );
        // if($data)
        //     return ['data' => $data];


        return redirect(route('portal'));
    }

    public function portal(){



        // $client = new Client(['base_uri' => 'http://192.168.20.22/' , 'cookies' => true]);
        // $response = $client->get( 'krooka/login.aspx?&d=1632004121646&UN=dina&P=0000');

        // $data = [
        //     'd' => '1632000500211' ,
        //     'VehNat' => '1' ,
        //     'PlateNoT' => '0' ,
        //     'PlateNo' => '' ,
        //     'RegNo' => '' ,
        //     'ShasiNo' => 'kmhdn41ap2u546611' ,
        //     'AccDateFromVar' => '' ,
        //     'AccDateToVar' => '' ,
        //     'EngineNo' => '' ,
        //     'VehCat' => '0' ,
        //     'VehType' => '0' ,
        //     'VehStatus' => '0' ,
        //     'VehOwnNameFirst' => '' ,
        //     'VehOwnNameFather' => '' ,
        //     'VehOwnNameGrand' => '' ,
        //     'VehOwnNameFamily' => '' ,
        //     'OwnerType' => '0' ,
        //     'varResp' => '1' ,
        // ];

        // $query = Arr::query($data);

        // // dd($query);

        // $response2 = $client->request('GET', "krooka/Search/SearchResultVehicle.aspx?&$query" );
        // $client->request('GET', 'krooka/logout.aspx');

        // function html_to_obj( $html ) {
        //     libxml_use_internal_errors(true);
        //     $dom = new \DOMDocument();
        //     $dom->loadHTML(mb_convert_encoding($html , 'HTML-ENTITIES', 'UTF-8'));
        //     // dd($dom);
        //     return element_to_obj( $dom->getElementById('GridSearchResult') ?? $dom->getElementById('lblerr')  );
        // }

        // function element_to_obj( $element ) {
        //     if ( isset( $element->tagName ) ) {
        //         $obj = array( 'tag' => $element->tagName );
        //     }
        //     if ( isset( $element->attributes ) ) {
        //         foreach ( $element->attributes as $attribute ) {
        //             $obj[ $attribute->name ] = $attribute->value;
        //         }
        //     }
        //     if ( isset( $element->childNodes ) ) {
        //         foreach ( $element->childNodes as $subElement ) {
        //             if ( $subElement->nodeType == XML_TEXT_NODE ) {
        //                 $obj['html'] = $subElement->wholeText;
        //             } elseif ( $subElement->nodeType == XML_CDATA_SECTION_NODE ) {
        //                 $obj['html'] = $subElement->data;
        //             } else {
        //                 $obj['children'][] = element_to_obj( $subElement );
        //             }
        //         }
        //     }
        //     return ( isset( $obj ) ) ? $obj : $element;

        // }
        // $cc = $response2->getBody()->getContents() ;



        // return  html_to_obj($cc)  ;


        return view('admin.portal.index' );
    }

    public function pending(){


        return view('admin.pending_policy.index');
    }

    public function test(Request $request){

        $file = $request->file('file');
        $destinationPath = 'file_storage/';
        $filename = microtime(false) . '.' .$file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);


        $process = new Process(['C:\\Users\\ahmad\\AppData\\Local\\Programs\\Python\\Python39\\python.exe', 'main.py' , public_path('file_storage') . '\\' . $filename]);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $data = $process->getOutput() ;
        return $data ;
        $data = json_decode($data , true );
        if($data)
            return ['data' => $data];

        return 'dd';
    }

    public function test_front(Request $request){

        $file = $request->file('file');
        $destinationPath = 'file_storage/';
        $filename = microtime(false) . '.' .$file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);


        $process = new Process(['C:\\Users\\ahmad\\AppData\\Local\\Programs\\Python\\Python39\\python.exe', 'main_front.py' , public_path('file_storage') . '\\' . $filename]);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $data = $process->getOutput() ;
        return $data ;
        $data = json_decode($data , true );
        if($data)
            return ['data' => $data];

        return 'dd';
    }

    public function checkKroka(Request $request){

        // return $request->body;
        $client = new Client(['base_uri' => 'http://192.168.20.22/' , 'cookies' => true]);
        $response = $client->get( 'krooka/login.aspx?&d=1632004121646&UN=issakh&P=0000');

        $data = [
            'd' => '1632000500211' ,
            'VehNat' => '1' ,
            'PlateNoT' => '0' ,
            'PlateNo' => '' ,
            'RegNo' => '' ,
            'ShasiNo' => $request->body,
            'AccDateFromVar' => '' ,
            'AccDateToVar' => '' ,
            'EngineNo' => '' ,
            'VehCat' => '0' ,
            'VehType' => '0' ,
            'VehStatus' => '0' ,
            'VehOwnNameFirst' => '' ,
            'VehOwnNameFather' => '' ,
            'VehOwnNameGrand' => '' ,
            'VehOwnNameFamily' => '' ,
            'OwnerType' => '0' ,
            'varResp' => '1' ,
        ];

        $query = Arr::query($data);

        // dd($query);

        $response2 = $client->request('GET', "krooka/Search/SearchResultVehicle.aspx?&$query" );
        $client->request('GET', 'krooka/logout.aspx');

        function html_to_obj( $html ) {
            libxml_use_internal_errors(true);
            $dom = new \DOMDocument();
            $dom->loadHTML(mb_convert_encoding($html , 'HTML-ENTITIES', 'UTF-8'));
            // dd($dom);
            return element_to_obj( $dom->getElementById('lblResults') ?? $dom->getElementById('lblerr')  );
        }

        function element_to_obj( $element ) {
            if ( isset( $element->tagName ) ) {
                $obj = array( 'tag' => $element->tagName );
            }
            if ( isset( $element->attributes ) ) {
                foreach ( $element->attributes as $attribute ) {
                    $obj[ $attribute->name ] = $attribute->value;
                }
            }
            if ( isset( $element->childNodes ) ) {
                foreach ( $element->childNodes as $subElement ) {
                    if ( $subElement->nodeType == XML_TEXT_NODE ) {
                        $obj['html'] = $subElement->wholeText;
                    } elseif ( $subElement->nodeType == XML_CDATA_SECTION_NODE ) {
                        $obj['html'] = $subElement->data;
                    } else {
                        $obj['children'][] = element_to_obj( $subElement );
                    }
                }
            }
            return ( isset( $obj ) ) ? $obj : $element;

        }
        $cc = $response2->getBody()->getContents() ;



        return  html_to_obj($cc)  ;
    }


}
