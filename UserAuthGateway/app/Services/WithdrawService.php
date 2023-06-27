<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;


class WithdrawService
{
    use ConsumesExternalService;


    public $baseUri;

    public $secret;

    public function __construct()
    {
        $this->baseUri = config("services.withdraw.base_uri");
        $this->secret = config("services.withdraw.secret");

    }

    public function withdraw($data){
        return $this->performRequest("POST", '/api/withdraw', $data);
    }

}