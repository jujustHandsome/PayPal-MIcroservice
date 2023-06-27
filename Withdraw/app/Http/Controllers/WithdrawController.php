<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; //Handling http request from lumen
use App\Traits\ApiResponser; //Standard API response
use App\Models\Money;
use Illuminate\Http\Response;
use App\Traits\ConsumesExternalService; //Standard API response


Class WithdrawController extends Controller {
    use ApiResponser;
    use ConsumesExternalService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function withdraw(Request $request)
    {
        $withdrawnamount = request('amount');

        $response = [
            'withdraw' => [
                'money' => 'PHP'.' '.$withdrawnamount,
            ],
            'service' => 'withdraw'
        ];
            return $this->successResponse($response);
    }
}