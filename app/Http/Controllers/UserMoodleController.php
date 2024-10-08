<?php

namespace App\Http\Controllers;

use App\Models\UserMoodle;
use App\Models\EnteOrganismo;
use App\Models\Area;
use App\Models\DependenciaDepartamento;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class UserMoodleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prefix = "mdl";
        $field = "managed";
        $usersMoodle = DB::connection('second_db')->table($prefix.'_user')
                    ->join($prefix.'_user_info_data', $prefix.'_user.id', '=', $prefix.'_user_info_data.userid')
                    ->join($prefix.'_user_info_field', $prefix.'_user_info_data.fieldid', '=', $prefix.'_user_info_field.id')
                    ->where($prefix.'_user_info_field.shortname', $field)
                    ->where($prefix.'_user_info_data.data', 1)
                    ->get();
        
        return view('moodleusers.index')->with('usersMoodle',$usersMoodle);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $entes = EnteOrganismo::all()->sortBy('name');
        $dependencias = DependenciaDepartamento::all()->sortBy('name');
        $areas = Area::all()->sortBy('name');
        $ubicaciones = Ubicacion::all()->sortBy('name');
        //dd($entes);
        return view('moodleusers.create')
                ->with('entes',$entes)
                ->with('dependencias',$dependencias)
                ->with('ubicaciones',$ubicaciones)
                ->with('areas',$areas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //dd($request);
       
        $url="https://plataforma3.ehcampus.online/webservice/rest/server.php?";
        $token="39fa8d55935732c910958c42e5a28ce8";
        $function="core_user_create_users";
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'institution' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required'],
        ]);

        $response = Http::post($url.
            "wstoken=".$token.
            "&wsfunction=".$function.
            '&users[0][username]='.$request->username.
            '&users[0][auth]=manual'.
            '&users[0][password]='.$request->password.
            '&users[0][firstname]='.$request->firstname.
            '&users[0][lastname]='.$request->lastname.
            '&users[0][email]='.$request->email.
            '&users[0][description]='.$request->description.
            '&users[0][institution]='.$request->institution.
            '&users[0][department]='.$request->department.
            '&users[0][address]='.$request->address.
            '&users[0][customfields][0][type]=managed'.
            '&users[0][customfields][0][value]=1'.
            '&moodlewsrestformat=json'
        );
        return redirect()->route('moodleusers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserMoodle  $userMoodle
     * @return \Illuminate\Http\Response
     */
    public function show(UserMoodle $userMoodle)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserMoodle  $userMoodle
     * @return \Illuminate\Http\Response
     */
    public function edit($userMoodle)
    {
        $user = UserMoodle::find($userMoodle);
        $entes = EnteOrganismo::all()->sortBy('name');
        $dependencias = DependenciaDepartamento::all()->sortBy('name');
        $areas = Area::all()->sortBy('name');
        $ubicaciones = Ubicacion::all()->sortBy('name');
        //dd($entes);
        return view('moodleusers.edit')
                ->with('entes',$entes)
                ->with('dependencias',$dependencias)
                ->with('areas',$areas)
                ->with('ubicaciones',$ubicaciones)
                ->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserMoodle  $userMoodle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userMoodle)
    {
        
        $url="https://plataforma3.ehcampus.online/webservice/rest/server.php?";
        $token="39fa8d55935732c910958c42e5a28ce8";
        $function="core_user_update_users";
        if(isset($request->password)){
            $response = Http::post($url.
            "wstoken=".$token.
            "&wsfunction=".$function.
            '&users[0][id]='.$userMoodle.
            '&users[0][username]='.$request->username.
            '&users[0][auth]=manual'.
            '&users[0][password]='.$request->password.
            '&users[0][firstname]='.$request->firstname.
            '&users[0][lastname]='.$request->lastname.
            '&users[0][email]='.$request->email.
            '&users[0][description]='.$request->description.
            '&users[0][institution]='.$request->institution.
            '&users[0][department]='.$request->department.
            '&users[0][address]='.$request->address.
            '&users[0][customfields][0][type]=managed'.
            '&users[0][customfields][0][value]=1'.
            '&moodlewsrestformat=json'
            );
        }else{
            $response = Http::post($url.
            "wstoken=".$token.
            "&wsfunction=".$function.
            '&users[0][id]='.$userMoodle.
            '&users[0][username]='.$request->username.
            '&users[0][auth]=manual'.
            '&users[0][firstname]='.$request->firstname.
            '&users[0][lastname]='.$request->lastname.
            '&users[0][email]='.$request->email.
            '&users[0][description]='.$request->description.
            '&users[0][institution]='.$request->institution.
            '&users[0][department]='.$request->department.
            '&users[0][address]='.$request->address.
            '&users[0][customfields][0][type]=managed'.
            '&users[0][customfields][0][value]=1'.
            '&moodlewsrestformat=json'
            );
        }
        
        return redirect()->route('moodleusers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserMoodle  $userMoodle
     * @return \Illuminate\Http\Response
     */
    public function destroy($userMoodle)
    {
        $url="https://plataforma3.ehcampus.online/webservice/rest/server.php?";
        $token="39fa8d55935732c910958c42e5a28ce8";
        $function="core_user_delete_users";
        $response = Http::post($url.
            "wstoken=".$token.
            "&wsfunction=".$function.
            '&userids[0]='.$userMoodle.
            '&moodlewsrestformat=json'
        );
        return redirect()->route('moodleusers.index');
    }

    public function multiDestroy(Request $request)
    {
        $url="https://plataforma3.ehcampus.online/webservice/rest/server.php?";
        $token="39fa8d55935732c910958c42e5a28ce8";
        $function="core_user_delete_users";
        $users=$request->all();
        foreach($users as $username => $iduser){
            if($username != "_token"){
                $response = Http::post($url.
                "wstoken=".$token.
                "&wsfunction=".$function.
                '&userids[0]='.$userMoodle.
                '&moodlewsrestformat=json'
                );
            }    
        }
     
       
        
        return redirect()->route('moodleusers.index');
    }
}
