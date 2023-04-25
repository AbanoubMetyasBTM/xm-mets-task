<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetCompanyHistoryRequest;
use App\Services\IHomeService;

class HomeController extends Controller
{

    /**
     * @var IHomeService $homeService
     */
    public $homeService;

    public function __construct(IHomeService $homeService)
    {
        $this->homeService = $homeService;
    }


    public function getCompanyHistory(GetCompanyHistoryRequest $request)
    {

        $data            = [];

        if (isset($request->validator) && $request->validator->fails()) {
            $data["reqErrors"] = $request->validator->errors()->messages();
        }

        $data["reqData"] = (object)$request->all();

        if ($request->has('submit') && !$request->validator->fails()) {
            $data["prices"] = $this->homeService->getCompanyHistory($request->validated());
        }

        return view("get_company_history", $data);

    }


}
