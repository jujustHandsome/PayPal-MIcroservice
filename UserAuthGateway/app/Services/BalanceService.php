<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;


class BalanceService
{
    use ConsumesExternalService;


    public $baseUri;

    public $secret;

    public function __construct()
    {
        $this->baseUri = config("services.balance.base_uri");
        $this->secret = config("services.balance.secret");

    }

    public function balance($data){
        return $this->performRequest("POST", '/api/balance', $data);
    }

}