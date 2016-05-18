<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use Auth;
use Log;

use Mail;

class UsersController extends MyBaseController {

    public function __construct(){
        $this->middleware('auth.organization');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organization.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($slug,Request $request) {
        
        $user = new User;

        $password = str_random(16);

        $user->fill([
            'user'     => strtolower($request->get('user')),
            'name'     => $request->get('nome'),
            'email'    => $request->get('email'),
            'level'    => $request->get('level'),
            'password' => bcrypt($password),
            'organization_id' => Auth::user()->organization_id,
        ]);

        if(!$user->isValid()){
            return redirect()->back()->withInput();
        }

        $user->save();

        //Send email
        $vars = array(
                    'user_model' => $user,
                    'password' => $password,
                    'nome' => $user->name,
                    'numero_grupo' => $user->organization->number,
                    'username' => $user->user
                );

        Mail::queue('mail.user_registration', $vars, function ($message) use ($user) {
            $message->from('hello.egrupo@gmail.com','Egrupo WEB');
            $message->subject('[EGRUPO] Bem vindo - Confirmação de Registo');
            $message->to($user->email);
        });

        return redirect()->to('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        dd($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, $id)
    {
        return view('organization.users.edit',array('user' => User::find($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($slug,Request $request, $id)
    {
        $user = User::find($id);

        $user->divisao = $request->get('divisao');
        $user->escoteiro_id = $request->get('escoteiro_id');
        $user->email = $request->get('email');
        $user->level = $request->get('level');

        $user->save();

        return redirect()->to('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug,$id)
    {
        User::find($id)->delete();
        return redirect()->to('admin');
    }

    public function mudarDivisao($slug,$divisao_id){

        $u = Auth::user();
        $u->divisao = $divisao_id;
        $u->save();
        // dd($u);

        return redirect()->back();
    }

    public function showChangePassword(){
        return view('organization.users.editpassword');
    }

    public function changePassword(Request $request){
        $pass1 = $request->get('password_nova_1');
        $pass2 = $request->get('password_nova_2');

        if($pass1 == $pass2){
            Auth::user()->password = bcrypt($pass1);
            Auth::user()->save();
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors('As passwords inseridas são diferentes uma da outra!'); 
        }
    }
}
