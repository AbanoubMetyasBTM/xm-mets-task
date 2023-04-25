<?php

namespace App\Services\Implementation;

use App\Adapters\IHistoricalData;
use App\Jobs\SendSearchResultEmail;
use App\Services\IHomeService;
use App\Types\ResponsePriceRow;

class HomeService implements IHomeService
{

    /**
     * @param  $prices ResponsePriceRow[]
     */
    private function printPrices($prices)
    {

        //for testing purposes

        foreach ($prices as $item) {
            /**
             * @var $item ResponsePriceRow
             */
            dump($item->getDateFormatted());
        }

    }

    /**
     * @param  $prices ResponsePriceRow[]
     * @return ResponsePriceRow[]
     */
    private function filterPrices($startDate, $endDate, array $prices): array
    {

        $prices = collect($prices);

        $prices = $prices->filter(function (ResponsePriceRow $item) use ($startDate, $endDate) {
            if (
                $item->getDate() >= strtotime($startDate) &&
                $item->getDate() <= strtotime($endDate)
            ) {
                return $item;
            }
        });

        return $prices->all();

    }

    /**
     *
     * @param array $reqData Array containing the necessary params.
     *    $reqData = [
     *      'company_symbol'    => '',
     *      'start_date'        => '',
     *      'end_date'          => '',
     *      'email'             => '',
     *    ]
     *
     * @return ResponsePriceRow[]
     */
    public function getCompanyHistory(array $reqData): array
    {

        /**
         * @var IHistoricalData $historicalData
         */
        $historicalData = app(IHistoricalData::class);

        /**
         * @var $prices ResponsePriceRow[]
         */
        $prices = $historicalData->getCompanyHistoricalData($reqData["company_symbol"]);

        //filter based on date range
        $prices = $this->filterPrices($reqData["start_date"], $reqData["end_date"], $prices);

        //send data to email by queue job
        //of course this at live-mood will work at background
        //but let this work as SYNC now
        dispatch(new SendSearchResultEmail([
            "prices"  => $prices,
            "reqData" => $reqData,
        ]));

        return $prices;
    }

}
