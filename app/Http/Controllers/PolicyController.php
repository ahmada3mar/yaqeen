<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Branch;
use App\Models\Car;
use App\Models\Policy;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $user = Auth::user() ;

        $policies = $user->getMyPolicy()->latest()->paginate(100);

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
        try {
            //code...

        $user_id = User::where('role' , 'exporter')->withCount(['policy as policy_count' => function($q){
            $q->where('created_at' , '>=' , Carbon::today())
            ->where('status' , '0');
        }])
        ->orderBy('policy_count')
        ->first()->id ;

        $policy = Policy::create(
            [
                'name' => $request->name ,
                'branch_id' => Auth::user()->branch_id ,
                'type' => $request->policy_type ,
                'car_price' => $request->car_price ?? 3000 ,
                'car_type' => $request->type ,
                'car_number' => $request->number ,
                'car_name' =>  $request->car_name ,
                'car_model' =>  $request->car_model ,
                'body_number' => $request->body ,
                'eng_number' => $request->eng ,
                'start_at' =>  date('Y-m-d' ,strtotime($request->start_at)) ,
                'end_at' =>  date('Y-m-d' ,strtotime($request->end_at)) ,
                'policy_date' => date('Y'),
                'cost' => 86 ,
                'user_id' => $user_id ,
                'price' => $request->cost ,
                'front_id' => $request->front_id ,
                'back_id' => $request->back_id ,
                ]
            );
        return $policy;
    }  catch (\Exception  $e) {
        return $request->all();
    }
    }

    public function getPolicy(Request $request)
    {
        $user = Auth::user();
        return $user->getMyPolicy()->where('created_at' , '>=' , Carbon::today())->latest()->get();
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
        $response = $client->get( 'krooka/login.aspx?&d=1632004121646&UN=rashed&P=0000');

        $data = [
            'd' => '1632000500211' ,
            'VehNat' => '1' ,
            'PlateNoT' =>  $request->ter ?? '0' ,
            'PlateNo' =>  $request->num ?? '' ,
            'RegNo' => $request->reg ?? '' ,
            'ShasiNo' =>  $request->body ?? '',
            'AccDateFromVar' =>  now()->subYear()->format('d/m/Y') ,
            'AccDateToVar' => now()->format('d/m/Y') ,
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

        try{

            $response2 = $client->request('GET', "krooka/Search/SearchResultVehicle.aspx?&$query" );
            $client->request('GET', 'krooka/logout.aspx');
        }catch (\Exception $e) {

            $client->request('GET', 'krooka/logout.aspx');
            return $e->getMessage();
        }


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
    public function show(Policy $policy)
    {
        abort_if($policy->status != 1 , 404);
        return view('admin.pending_policy.index' , compact('policy')) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Policy $policy)
    {
        $cars = Car::all() ;
        $accounts = Account::all() ;
        return view('admin.policy.edit' , compact('policy'  , 'cars' , 'accounts')) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Policy $policy)
    {
        $user = Auth::user();

        if($user-> role != 'admin' && $policy->user_id != $user->id){
            return abort(403, 'لا يسمح لك بالتعديل على البوليصة');
        }

       $data = $request->validate([
            'name' => 'required|string|regex:/^([^0-9]*)$/',
            'type' => "required|string|in:1,2,3",
            'car_price' => 'required|numeric',
            'account_id' => 'required|numeric|exists:accounts,id',
            'car_type' => 'required|string',
            'car_number' => 'required|string',
            'car_name' => 'required|string',
            'car_model' => 'required',
            'body_number' => 'required|regex:/^[A-HJ-NPR-Z\d]{8}[A-HJ-NPR-Z\d]{3}\d{6}$/',
            'eng_number' => 'required|string',
            'start_at' => 'required|date|after_or_equal:' . Carbon::now()->format('Y-m-d'),
            'end_at' => 'required|date|after:start_at',
            'policy_number' => 'required|numeric',
            'policy_date' => 'required|numeric',
            'status' => 'required|numeric|in:-1,1'
        ]);

        $policy->name = $data['name'] ;
        $policy->type = $data['type'] ;
        $policy->car_price = $data['car_price'] ;
        $policy->car_type = $data['car_type'] ;
        $policy->car_number = $data['car_number'] ;
        $policy->car_name = $data['car_name'] ;
        $policy->car_model = $data['car_model'] ;
        $policy->body_number = $data['body_number'] ;
        $policy->eng_number = $data['eng_number'] ;
        $policy->start_at = $data['start_at'] ;
        $policy->end_at = $data['end_at'] ;
        $policy->policy_number = $data['policy_number'] ;
        $policy->status = $data['status'] ;

        $policy->save();

        if($data['status'] == 1 && !$policy->transaction){
            $p_type = Policy::$types[$policy->type] ;
            Transaction::create([
                'description' => "بدل اصدار بوليصة تامين $p_type رقم عقد $data[policy_date]/$data[policy_number]" ,
                'type' => "Debit" ,
                'branch_id' => $policy->branch_id ,
                'user_id' => $policy->user_id ,
                'policy_id' => $policy->id ,
                'amount' => $policy->price ,
            ]);

            Transaction::create([
                'description' => "بدل اصدار بوليصة تامين $p_type رقم عقد $data[policy_date]/$data[policy_number]" ,
                'type' => "Credit" ,
                'user_id' => $policy->user_id ,
                'account_id' => $policy->account_id,
                'amount' => $policy->cost ,
            ]);
        }

        return redirect(route('pending-policy'))->with('CRUD' , 'تم الاصدار بنجاح');
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
        $policies = Policy::query() ;
        $policies->where('status' , '0') ;

        if(Auth::user()->role != 'admin'){
            $policies->where('user_id' , Auth::user()->id);
        }

        $policies = $policies->where('created_at' , '>=' , Carbon::today())->latest()->paginate(100);
        return view('admin.policy.index' , compact('policies'));
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
        $data = json_decode($data , true) ;
        $data['path'] = $filename ;

        return $data ;
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
        $data = json_decode($data , true) ;
        $data[] = [
            'type' => 'path' ,
            'value' => $filename
            ] ;

        return $data ;
    }

    function html_to_obj( $html ) {
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML(mb_convert_encoding($html , 'HTML-ENTITIES', 'UTF-8'));
        // dd($dom);
        return $this->element_to_obj( $dom->getElementById('lblerr') ??  $dom->getElementById('lblResults') );
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


    try {
        //code...

        $count = 0 ;
        $client = new Client(['base_uri' => 'http://192.168.20.22/' , 'cookies' => true]);
        $response = $client->get( 'krooka/login.aspx?&d=1632004121646&UN=rashed&P=0000');

        $data = [
            'd' => '1632000500211' ,
            'VehNat' => '1' ,
            'PlateNoT' => $request->body ? '0' :( $request->tar ?? '0') ,
            'PlateNo' => $request->body ? '' : ( $request->number ?? '') ,
            'RegNo' => $request->body ? '' : ($request->reg ?? '') ,
            'ShasiNo' => $request->body ?? '',
            'AccDateFromVar' => now()->subYear()->format('d/m/Y') ,
            'AccDateToVar' => now()->format('d/m/Y') ,
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

        $data['varResp'] = '3' ;
        $query2 = Arr::query($data);

        // dd($query);.


        $response = $client->request('GET', "krooka/Search/SearchResultVehicle.aspx?&$query");
        $response2 = $client->request('GET', "krooka/Search/SearchResultVehicle.aspx?&$query2");

        $client->request('GET', 'krooka/logout.aspx');


        $cc = $response->getBody()->getContents();
        $cc2 = $response2->getBody()->getContents();


        $krooka = $this->html_to_obj($cc);
        $krooka2 = $this->html_to_obj($cc2);

        $count =  (int) filter_var($krooka['html'], FILTER_SANITIZE_NUMBER_INT) + (int) filter_var($krooka2['html'], FILTER_SANITIZE_NUMBER_INT);

        $branch = Auth::user()->branch ;

        switch ($request->type) {
            case 'ركوب صغير':
                $cost =   $count  ?  $branch->total_los_cars_accedint : $branch->total_los_cars ;

                break;
            case 'شحن':
                $cost =  $count  ?  $branch->total_los_vans_accedint : $branch->total_los_vans;

                break;
            case 'نقل مشترك':
                $cost =  $count  ?  $branch->total_los_pickups_accedint : $branch->total_los_pickups;
                break;
            case 'نقل ملكية':
                $cost =  15;
                break;

            default:
                $cost = 0 ;
        }



        return [
            'cost' => $cost ,
            'krooka' => $count
        ] ;

    } catch (\Exception  $e) {
        $client->request('GET', 'krooka/logout.aspx');
        return $e->getMessage();
    }
    }
}
