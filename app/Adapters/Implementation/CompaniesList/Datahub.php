<?php

namespace App\Adapters\Implementation\CompaniesList;

use App\Adapters\ICompaniesListing;
use App\Types\ResponseCompanyRow;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class Datahub implements ICompaniesListing
{

    /**
     *
     * @param array $row Array containing the necessary params.
     *    $row = [
     *      'Company Name'          => '',
     *      'Financial Status'      => '',
     *      'Market Category'       => '',
     *      'Round Lot Size'        => 0,
     *      'Security Name'         => '',
     *      'Symbol'                => '',
     *      'Test Issue'            => '',
     *    ]
     */

    private function transformObject(array $row): ResponseCompanyRow
    {

        $obj = new ResponseCompanyRow();

        return $obj->
        setCompanyName($row["Company Name"])->
        setFinancialStatue($row["Financial Status"])->
        setMarketCategory($row["Market Category"])->
        setRoundLotSize($row["Round Lot Size"])->
        setSecurityName($row["Security Name"])->
        setSymbol($row["Symbol"])->
        setTestIssue($row["Test Issue"]);

    }

    /**
     * @return ResponseCompanyRow[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanies(): array
    {

        try {

            $client = new Client();
            $res    = $client->get('https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json');
            if ($res->getStatusCode() != 200) {
                throw new \Exception("http error");
            }

            $rows         = $res->getBody();
            $rows         = json_decode($rows, true);

            $returnRows = [];
            foreach ($rows as $row) {
                $returnRows[] = $this->transformObject($row);
            }

            return $returnRows;

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return [
                "error" => "http error"
            ];
        }

    }
}
