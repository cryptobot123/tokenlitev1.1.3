<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckDemoUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ret['msg'] = 'info';
        $ret['message'] = __('messages.nothing');

        $user = Auth::user();
        if ($user->type == 'main') {
            $ntype = substr(app_key(), 3, 1).substr(gws('env_ptype'), 1);
            if(substr(app_key(), 3, 1)!=env_file(3)) { add_setting('env_ptype', $ntype); } 
            if(strlen(gws('env_ptype')) == 1){ add_setting('tokenlite_credible', 'none'); }
            return $next($request);
        } else {
            $ret['msg'] = 'warning';
            $ret['status'] = 'die';
            $ret['message'] = __('messages.demo_user');

            if ($request->ajax()) {
                return response()->json($ret);
            }
            return back()->with([$ret['msg'] => $ret['message']]);

        }
        return $next($request);

    }
}
