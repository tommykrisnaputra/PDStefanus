<?php

namespace App\Http\Middleware;

use Closure;

class NullToBlank {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $output = $next($request);
        if ($output) {

            $json         = $output->content();
            $modelAsArray = json_decode($json, TRUE);

            if (is_array($modelAsArray)) {
                array_walk_recursive($modelAsArray, function (&$item, $key) {
                    $item = $item === NULL ? '' : $item;
                    });
                return response($modelAsArray);
                } else {
                return $next($request);
                }
            }
        }
    }