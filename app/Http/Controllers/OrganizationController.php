<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Escoteiro;
use App\Models\Signup;
use App\Models\Organization;
use App\Models\BetaInvite;
use App\User;

use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Mail;

class OrganizationController extends MyBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function login(){
        if(Auth::check()){
            if(Auth::user()->user_type == 1){
                Auth::user()->last_login_at = date('Y-m-d H:i:s');
                Auth::user()->save();
                return redirect()->to('dashboard');    
            }
        }

        return view('frontend.login');
    }

    public function register(Request $request){

        $token = $request->get('invite_token');
        $betaInvite = BetaInvite::where('code',$token)
                    ->where('claimed_at',null)
                    ->where('can_signup',true)
                    ->first();
        
        if(!$betaInvite){
            return redirect()->back()->withInput()->withErrors(['O Convite não é válido ou já foi usado']);
        }

        if($betaInvite->numero_grupo != $request->get('organization_number')){
            return redirect()->back()->withInput()->withErrors(['Este convite não é destinado ao grupo '.$request->get('organization_number')]);
        }

        $signup = new Signup($request->all());

        $res = $signup->save();
        if($res){
            $betaInvite->claimed_at = date('Y-m-d H:i:s');
            $betaInvite->save();

            Auth::login($signup->user);

            Auth::user()->last_login_at = date('Y-m-d H:i:s');
            Auth::user()->save();

            //Send mail to admin!
            $vars = array(
                    
                );

            Mail::send('mail.group_register',$vars,function($message){
                $message->from('hello.egrupo@gmail.com','Egrupo WEB');
                $message->subject('[EGRUPO] Novo Registo');
                $message->to('kromoo@gmail.com');
            });

            return redirect()->to('http://'.$signup->org->slug.'.'.env('APP_HOST'));
        } else {
            return redirect()->back()->withInput($request->flash())->withErrors($signup->errors);
        };
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $slug = explode('.',$request->getHost())[0];
        $id = Organization::where('slug',$slug)->pluck('id');
        
        if(Auth::attempt(['user' => $request->get('user'), 'password' => $request->get('password'),'user_type' => 1, 'organization_id' => $id])){
            Auth::user()->last_login_at = date('Y-m-d H:i:s');
            Auth::user()->save();
            return redirect()->to('dashboard');
        } else {
            return redirect()->back()->withInput($request->flash())->withErrors(['Erro! User/Password errado']);
        }
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
        Auth::logout();
        return redirect()->to('/');
    }

}
