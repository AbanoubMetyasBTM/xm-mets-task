<?php

namespace App\Adapters;

interface IHistoricalData
{

    public function getCompanyHistoricalData(string $companySymbol): array;

}
