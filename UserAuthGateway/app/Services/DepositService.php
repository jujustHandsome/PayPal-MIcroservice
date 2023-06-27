<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;


class DepositService
{
    use ConsumesExternalService;


    public $baseUri;

    public $secret;

    public function __construct()
    {
        $this->baseUri = config("services.deposit.base_uri");
        $this->secret = config("services.deposit.secret");

    }

    public function deposit($data){
        return $this->performRequest("POST", '/api/deposit', $data);
    }

}