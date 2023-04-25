<?php

namespace Database\Seeders;

use App\Adapters\ICompaniesListing;
use App\Models\CompanyModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    private function populateCompaniesTable()
    {

        /**
         * @var ICompaniesListing $listingCompanies
         */
        $listingCompanies = app(ICompaniesListing::class);
        $allCompanies     = $listingCompanies->getCompanies();

        foreach ($allCompanies as $company){
            CompanyModel::createCompany($company);
        }

    }


    public function run()
    {

        $this->populateCompaniesTable();

    }
}
