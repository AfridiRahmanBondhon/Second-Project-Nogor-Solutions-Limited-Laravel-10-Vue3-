<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class MyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $filePath = public_path('tmp.json');

        if(File::isFile($filePath)){
            $jsonString = file_get_contents(public_path('tmp.json'));
            $data = json_decode($jsonString);
            $userId = $data->userId;
            
            if($userId){
                return $next($request);
            }else{
                return abort(403);
            }
        }else{
            return abort(403);
        }
        
    }
}
