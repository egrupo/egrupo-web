<?php

namespace App\Models;

use App\User;
use Storage;

use Validator;

class Signup {

    public $org;
    public $errors;
    public $user;
    protected $params;
    public $validator;
    public $messages = array('organization_number.unique' => 'Este grupo já está registado',
                'email.unique' => 'Este email já se encontra registado'
        );
    
    public function __construct($params){
        $this->user = new User;
        $this->org  = new Organization;
        $this->params = $params;
        $this->validator = Validator::make($params, [
            'organization_number'  => 'required|unique:organizations,number|numeric',
            'user'			       => 'required',
            'name'                 => 'required',
            'email'                => 'required|unique:users,email|email',
            'password'             => 'required|confirmed'
        ],$this->messages);
    }

    public function save(){
        if ($this->validator->fails()){
            $this->errors = $this->validator->messages();
            return false;
        }
            
        $this->org->number = $this->params['organization_number'];
        $this->org->slug = 'grupo'.$this->params['organization_number'];
        $this->user->admin  = true;
        $this->user->level = 1;
        $this->user->active = true;

        $this->org->save();

        $this->user->fill([
            'user'     => strtolower($this->params['user']),
            'name'     => $this->params['name'],
            'email'    => $this->params['email'],
            'password' => bcrypt($this->params['password']),
            'organization_id' => $this->org->id,
        ]);

        $this->user->save();

        Storage::disk('local')->makeDirectory($this->org->slug);
        Storage::disk('local')->makeDirectory($this->org->slug.'/avatars');
        Storage::disk('local')->makeDirectory($this->org->slug.'/os');
        
        return true;
        
    }

    public function getUser(){
        return $this->user;
    }
}
