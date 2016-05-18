<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\BetaInvite;

use Mail;

class BetaInviteController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.beta_signup_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $betaInvite = new BetaInvite;
        
        $betaInvite->fill($request->all());
        $betaInvite->code = bin2hex(openssl_random_pseudo_bytes(16));

        if($betaInvite->isValid()){
            $betaInvite->save();

            //Send Email!!
            $vars = array(
                    'grupo' => $request->get('numero_grupo'),
                    'email' => $request->get('email'),
                    'nome' => $request->get('nome'),
                    'num_elems' => $request->get('npessoas')
                );

            Mail::send('mail.beta_signup',$vars,function($message){
                $message->from('hello.egrupo@gmail.com','Egrupo WEB');
                $message->subject('[EGRUPO] Novo Pedido Convite');
                $message->to('kromoo@gmail.com');
            });

            return redirect()->back()->with('messages',array('O teu pedido foi registado!'));
        } else {
            return redirect()->back()->withInput();
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
        //
    }
}
