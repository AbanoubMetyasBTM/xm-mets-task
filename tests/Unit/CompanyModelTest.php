<?php

namespace Tests\Unit;

use App\Adapters\Implementation\CompaniesList\Datahub;
use App\Adapters\Implementation\HistoricalData\Rapidapi;
use App\Models\CompanyModel;
use App\Types\ResponseCompanyRow;
use Tests\TestCase;

class CompanyModelTest extends TestCase
{

    public function test_saveRowSuccessScenario()
    {

        $companyRow = new ResponseCompanyRow();
        $companyRow = $companyRow->
        setCompanyName("test company")->
        setFinancialStatue("N")->
        setMarketCategory("G")->
        setRoundLotSize(100)->
        setSecurityName("test sec")->
        setSymbol("AAAA")->
        setTestIssue("N");

        $insertedObj = CompanyModel::createCompany($companyRow);

        $this->assertTrue(is_object($insertedObj));

        $insertedObj->delete();

    }

    public function test_saveRowCheckDuplicateScenario()
    {
        $companyRow = new ResponseCompanyRow();
        $companyRow = $companyRow->
        setCompanyName("test company")->
        setFinancialStatue("N")->
        setMarketCategory("G")->
        setRoundLotSize(100)->
        setSecurityName("test sec")->
        setSymbol("AAAA")->
        setTestIssue("N");

        $insertedObj  = CompanyModel::createCompany($companyRow);
        $insertedObj2 = CompanyModel::createCompany($companyRow);
        $this->assertTrue(!is_object($insertedObj2));

        $insertedObj->delete();
    }

    public function test_getRow()
    {
        $companyRow = new ResponseCompanyRow();
        $companyRow = $companyRow->
        setCompanyName("test company")->
        setFinancialStatue("N")->
        setMarketCategory("G")->
        setRoundLotSize(100)->
        setSecurityName("test sec")->
        setSymbol("AAAA")->
        setTestIssue("N");

        $insertedObj = CompanyModel::createCompany($companyRow);
        $checkRow    = CompanyModel::getCompanyBySymbol("AAAA");
        $this->assertTrue(is_object($checkRow));

        $insertedObj->delete();
    }


}
