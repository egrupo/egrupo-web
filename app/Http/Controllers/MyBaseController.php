<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MyBaseController extends Controller {
    
    protected $currentUser;
    protected $currentOrg;

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
            $this->layout = View::make($this->layout);
        }
    }

    protected function currentUser(){
        if (! $this->currentUser) {
            $this->currentUser = Auth::user() ?: new Guest();
        }
        
        return $this->currentUser;
    }

    protected function currentOrg(){
        return Organization::find($this->crurrentUser->organization_id);
    }
}
