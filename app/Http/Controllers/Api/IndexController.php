<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DateRequest;
use App\Http\Services\TimeHandler\TimeHandlerService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Request  $timeHandlerService
     * @return \Illuminate\Http\Response
     */
    public function __invoke(DateRequest $request,TimeHandlerService $timeHandlerService)
    {
        // get timestamp from dates
        $date1          = strtotime($request->input("date1"));
        $date2          = strtotime($request->input("date2"));
        $second         = abs($date2 - $date1);
        // preparing expressions for service
        $expressions    = explode(',',trim($request->input("exp"),','));
        // run service
        $result         = explode('|',trim($timeHandlerService->run($second,$expressions),"|"));
        // return result with Json type
        return response()->json($result);
    }
}
