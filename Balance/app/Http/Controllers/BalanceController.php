<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; //Handling http request from lumen
use App\Traits\ApiResponser; //Standard API response
use App\Models\User;
use Illuminate\Http\Response;
use App\Traits\ConsumesExternalService; //Standard API response


Class BalanceController extends Controller {
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

    public function balance(Request $request)
    {
        $email = request('email');
        $balance = User::where('email', $email)->firstOrFail()->money;

        $response = [
            'balance' => [
                'money' => 'PHP'.' '.$balance,
            ],
            'service' => 'balance'
        ];

        return $this->successResponse($response);
    }
}