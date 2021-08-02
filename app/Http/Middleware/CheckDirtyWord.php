<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckDirtyWord
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $words = [
            'apple',
            'orange'
        ];

        $aaa = $request->all();

        foreach($aaa as $key => $value){
            if($key == 'content'){
                foreach($words as $word){
                    if(strpos($value,$word) !== false){
                        return response('有錯誤字');
                    }
                }
            }
        }

        return $next($request);
    }
}