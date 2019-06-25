<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\OrderContainer;
use Illuminate\Container\Container;

class PartnersController extends Controller
{
    /**
     * @var \App\Partner
     */
    private $partner;


    public function __construct()
    {
        $this->partner = Container::getInstance()
            ->make(OrderContainer::class)->getPartner();
    }

    public function getPartnersList()
    {
        return response()->json($this->partner->get());
    }

}
