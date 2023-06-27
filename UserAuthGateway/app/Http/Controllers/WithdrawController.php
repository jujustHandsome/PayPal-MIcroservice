<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\WithdrawService;
use App\Models\Money;


class WithdrawController extends Controller
{
    use ApiResponser;

    public $withdrawservice;

    public function __construct(WithdrawService $withdrawservice)
    {
        $this->withdrawservice = $withdrawservice;
        $this->middleware('auth:api', ['except' => ['login', 'refresh', 'logout']]);
    }

    public function withdraw(Request $request)
    {
        $amount = request('amount');
        $money = auth()->user()->money;

        if ($money > 0)
        {
            Money::where('id', auth()->user()->id)->update(array("money" => $money - $amount));
            return $this->successResponse($this->withdrawservice->withdraw($request->all()));
        }

        return $this->errorResponse("Invalid Amount", 403);
    }
}