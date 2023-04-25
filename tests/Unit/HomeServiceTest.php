<?php

namespace Tests\Unit;

use App\Adapters\Implementation\CompaniesList\Datahub;
use App\Adapters\Implementation\HistoricalData\Rapidapi;
use App\Models\CompanyModel;
use App\Services\Implementation\HomeService;
use App\Types\ResponseCompanyRow;
use Tests\TestCase;

class HomeServiceTest extends TestCase
{

    public function test_saveRowSuccessScenario()
    {

        $serviceObj = new HomeService();

        //just check if there's no error here
        try {
            $serviceObj->getCompanyHistory([
                'company_symbol' => 'ACAD',
                'start_date'     => '2010-12-0',
                'end_date'       => '2023-04-25',
                'email'          => 'harugyli@mailinator.com',
            ]);

            $this->assertTrue(true);

        } catch (\Exception $exception) {
            $this->assertTrue(false);
        }

    }


}
