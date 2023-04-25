<?php

namespace App\Adapters\Implementation\HistoricalData;

use App\Adapters\IHistoricalData;
use App\Types\ResponsePriceRow;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class Rapidapi implements IHistoricalData
{

    /**
     *
     * @param array $row Array containing the necessary params.
     *    $row = [
     *      'date'        => int,
     *      'open'        => float,
     *      'high'        => float,
     *      'low'         => float,
     *      'close'       => float,
     *      'volume'      => int,
     *      'adjclose'    => float,
     *    ]
     */

    private function transformObject(array $row): ResponsePriceRow
    {

        $obj = new ResponsePriceRow();

        return $obj->
        setDate($row["date"])->
        setOpen($row["open"])->
        setHigh($row["high"])->
        setLow($row["low"])->
        setClose($row["close"])->
        setVolume($row["volume"])->
        setAdjclose($row["adjclose"]);

    }


    public function getCompanyHistoricalData(string $companySymbol): array
    {

        try {

            $client = new Client();
            $res    = $client->get("https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data?symbol=${companySymbol}&region=US", [
                "headers" => [
                    'X-RapidAPI-Host' => 'yh-finance.p.rapidapi.com',
                    'X-RapidAPI-Key'  => '8927ecd21bmshddd8b29c520811bp125be4jsna1557b7860d0'
                ]
            ]);

            if ($res->getStatusCode() != 200) {
                throw new \Exception("http error");
            }

            $rows = $res->getBody();

            $rows = json_decode($rows, true);

            $rows = $rows["prices"];

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
