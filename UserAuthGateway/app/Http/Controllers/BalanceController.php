<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\BalanceService;
use App\Models\Token;


class BalanceController extends Controller
{
    use ApiResponser;

    public $balanceservice;

    public function __construct(BalanceService $balanceservice)
    {
        $this->balanceservice = $balanceservice;
        $this->middleware('auth:api', ['except' => ['login', 'refresh', 'logout']]);
    }

    public function balance(Request $request)
    {
            return $this->successResponse($this->balanceservice->balance($request->all()));
    }
}