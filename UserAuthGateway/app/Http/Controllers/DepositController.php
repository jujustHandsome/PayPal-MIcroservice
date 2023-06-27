<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\DepositService;
use App\Models\Money;


class DepositController extends Controller
{
    use ApiResponser;

    public $depositservice;

    public function __construct(DepositService $depositservice)
    {
        $this->depositservice = $depositservice;
        $this->middleware('auth:api', ['except' => ['login', 'refresh', 'logout']]);
    }

    public function deposit(Request $request)
    {
        $amount = request('amount');
        $money = auth()->user()->money;

        if ($money >= 0)
        {
            Money::where('id', auth()->user()->id)->update(array("money" => $money + $amount));
            return $this->successResponse($this->depositservice->deposit($request->all()));
        }

        return $this->errorResponse("Invalid Amount", 403);
    }
}