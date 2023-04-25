<?php

namespace App\Adapters\Implementation\HistoricalData;

use App\Adapters\IHistoricalData;
use App\Types\ResponsePriceRow;
use Illuminate\Support\Facades\Log;

class FakeRapidapi implements IHistoricalData
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

    /**
     * @return ResponsePriceRow[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyHistoricalData(string $companySymbol): array
    {

        try {

            // I work with this while i'm testing and developing the task
            // to fasten the development process, just to not wait the api call
            // and also to not consume the api quote, If there's any quote
            $rows = file_get_contents(storage_path("app/rapidApi/fake.json"));

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
