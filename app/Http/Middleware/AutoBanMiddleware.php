<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AutoBanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (checkPostBodyAndTitle()) {
            makeBan();
            return redirect('/services/bancheck');
        }

        return $next($request);
    }

    /**
     *  Some bulletin boards have a "meta" board where
     *  ban appeals may be appealed. 
     */

    private $exceptionBoard;

    public function getExceptionBoard () {
        return $this->exceptionBoard;
    }

    // Maybe this should be in the global admin's configuration controller.. this is geting confusing.
    // public function setExceptionBoard (string $newboard) { 
    //     $this->exceptionBoard = $newBoard;
    // }

    /**
     *  Automatically issues a global ban
     */

    public function makeBan ($message, $endsAt, $userId) {
        // use Eloquent to send a ban to the database
        // we may want to make a BanModel for that

        // each autoban database row should have a ban_message,
        // ban_duration, etc.
    }


    /**
     *  Regex compares the string with a banned words database
     *  table. If any record match, return true.
     */

    public function stringHasBannedtext (string $string): bool {
        $bannedStrings = [];
        // fetch banned words with a model, insert in $bannedStrings

        foreach ($bannedStrings as $bannedString) {
        }
    }


    /**
     *  Returns true if both the post body and title
     *  doesn't have a banned string.
     */

    private function checkPostBodyAndTitle (Request $request) {
        $bodyIsValid = stringHasBannedtext($request->input('body'));
        $titleIsValid = stringHasBannedtext($request->input('title'));
        if ($bodyIsValid && $titleIsValid) {
            return true;
        }
        return false;
    }
}
