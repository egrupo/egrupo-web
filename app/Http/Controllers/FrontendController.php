<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{

    public function showHome(){
        return view('frontend.index');
    }

    public function showTour(){
        return view('frontend.tour');
    }

    public function showPricing(){
        return view('frontend.pricing');
    }

    public function showContact(){
        return view('frontend.contact');
    }

    public function sendMessage(Request $request){

            $vars = array(
                'nome' => $request->get('name'),
                'grupo' => $request->get('grupo'),
                'email' => $request->get('email'),
                'mensagem' => $request->get('message')
                );

            Mail::send('mail.frontend_contact',$vars,function($message){
                $message->from('hello.egrupo@gmail.com','Egrupo WEB');
                $message->subject('[EGRUPO] Contacto WEB');
                $message->to('kromoo@gmail.com');
            });

        dd($request);
    }
}
