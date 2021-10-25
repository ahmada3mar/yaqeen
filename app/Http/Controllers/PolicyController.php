<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Policy;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policies = [];
        return view('admin.policy.index' , compact('policies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.policy.create');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(Request $request)
    {
        // return $request->all();
        // return User::where('role' , 'exporter')->withCount('policy')->orderBy('policy_count' , 'desc')->first()->id ;
        $policy = Policy::create(
            [
                'name' => $request->name ,
                'branch_id' => 1 ,
                'type' => $request->policy_type ,
                'car_price' => $request->car_price ?? 3000 ,
                'car_type' => $request->type ,
                'car_number' => $request->number ,
                'car_name' => 'هينوداي' ,
                'car_model' => 2015 ,
                'body_number' => $request->body ,
                'eng_number' => $request->eng ,
                'start_at' => '2021-01-01' ,
                'end_at' => '2021-01-01' ,
                'policy_date' => date('Y'),
                'cost' => 86 ,
                'user_id' => User::where('role' , 'exporter')-> withCount('policy')->orderBy('policy_count' , 'desc')->first()->id ,
                'price' => $request->cost ,
                ]
            );
        return $policy;
    }

    public function getPolicy(Request $request)
    {
        // return $request();
        return Policy::where('branch_id' , 1)->latest()->get();
    }

    public function krooka(Request $request)
    {

        return view('admin.krooka.index' );
    }
    public function getkrooka(Request $request)
    {
        $request->validate([
            'ter' => 'required_without_all:reg,num,body',
            'reg' => 'required_without_all:ter,num,body',
            'num' => 'required_without_all:ter,reg,body',
            'body' => 'required_without_all:ter,num,reg',
        ] , [
            'required_without_all'=> 'يرجى تعبة حقل واحد على الاقل'
        ]);

        $res = null ;

        $client = new Client(['base_uri' => 'http://192.168.20.22/' , 'cookies' => true]);
        $response = $client->get( 'krooka/login.aspx?&d=1632004121646&UN=issakh&P=0000');

        $data = [
            'd' => '1632000500211' ,
            'VehNat' => '1' ,
            'PlateNoT' =>  $request->ter ?? '0' ,
            'PlateNo' =>  $request->num ?? '' ,
            'RegNo' => $request->reg ?? '' ,
            'ShasiNo' =>  $request->body ?? '',
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


        $cc = $response2->getBody()->getContents() ;
        $res = $this->html_to_obj($cc);



        return back()->with(['krooka' => $res])->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function pending()
    {
        return Policy::first();
    }

    public function BackID(Request $request){

        $file = $request->file('file');
        $destinationPath = 'file_storage/';
        $filename = microtime(false) . '.' .$file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);


        $process = new Process(['C:\\Users\\user\\AppData\\Local\\Programs\\Python\\Python39\\python.exe', 'main.py' , public_path('file_storage') . '\\' . $filename]);
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

    public function FrontID(Request $request){

        $file = $request->file('file');
        $destinationPath = 'file_storage/';
        $filename = microtime(false) . '.' .$file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);


        $process = new Process(['C:\\Users\\user\\AppData\\Local\\Programs\\Python\\Python39\\python.exe', 'main_front.py' , public_path('file_storage') . '\\' . $filename]);
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

    function html_to_obj( $html ) {
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML(mb_convert_encoding($html , 'HTML-ENTITIES', 'UTF-8'));
        // dd($dom);
        return $this->element_to_obj( $dom->getElementById('GridSearchResult') ?? $dom->getElementById('lblerr') ??  $dom->getElementById('lblResults') );
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
                    $obj['children'][] = $this->element_to_obj( $subElement );
                }
            }
        }
        return ( isset( $obj ) ) ? $obj : $element;

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
            'ShasiNo' => $request->car['body'],
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
            'varResp' => '0' ,
        ];

        $query = Arr::query($data);

        // dd($query);

        $response2 = $client->request('GET', "krooka/Search/SearchResultVehicle.aspx?&$query" );
        $client->request('GET', 'krooka/logout.aspx');


        $cc = $response2->getBody()->getContents() ;

        $krooka = $this->html_to_obj($cc);
        $cost =  $krooka['html'] == ' لا يوجد نتائج ، الرجاء المحاولة مرة أخرى ' ?  Branch::first()->total_los_cars : Branch::first()->total_los_cars_accedint ;




        return [
            'cost' => $cost ,
            'krooka' => $krooka
        ] ;
    }
}
