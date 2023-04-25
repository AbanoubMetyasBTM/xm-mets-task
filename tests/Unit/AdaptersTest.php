<?php

namespace Tests\Unit;

use App\Adapters\Implementation\CompaniesList\Datahub;
use App\Adapters\Implementation\HistoricalData\Rapidapi;
use PHPUnit\Framework\TestCase;

class AdaptersTest extends TestCase
{

    public function test_CompaniesListingDatahubAdapterIsWorking()
    {
        $companiesListing = new Datahub();
        $companies        = $companiesListing->getCompanies();

        $this->assertTrue(!isset($companies["error"]));
    }

    public function test_HistoricalDataRapidAPIAdapterIsWorking()
    {
        $obj  = new Rapidapi();
        $data = $obj->getCompanyHistoricalData("ACAD");

        $this->assertTrue(!isset($data["error"]));
    }






}
