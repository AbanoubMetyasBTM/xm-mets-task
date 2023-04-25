<?php

namespace App\Adapters;

use App\Types\ResponseCompanyRow;

interface ICompaniesListing
{

    /**
     * @return ResponseCompanyRow[]
     */
    public function getCompanies(): array;

}
