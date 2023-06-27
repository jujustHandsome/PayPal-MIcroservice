<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; //Handling http request from lumen
use App\Traits\ApiResponser; //Standard API response
use App\Models\Money;
use Illuminate\Http\Response;
use App\Traits\ConsumesExternalService; //Standard API response


Class DepositController extends Controller {
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

    public function deposit(Request $request)
    {
        $depositamount = request('amount');

        $response = [
            'deposit' => [
                'money' => 'PHP'.' '.$depositamount,
            ],
            'service' => 'deposit'
        ];
            return $this->successResponse($response);
    }
}