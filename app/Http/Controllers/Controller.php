<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * get 404 error
     * @param Exception $ex
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    protected function getViewException($exception)
    {
        
        throw $exception;
        
       // return view('errors._404', compact('exception'));
    }
    /**
     * get 404 error
     * @param mixed $error
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    protected function getErrorView($message)
    {
        throw new Exception($message);
        
        //return view('errors._404', compact('message'));
    }
    protected function getError()
    {
        return view('errors._404');
    }
}
