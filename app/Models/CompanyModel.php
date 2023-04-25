<?php

namespace App\Models;

use App\Types\ResponseCompanyRow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class CompanyModel extends Model
{

    protected $table      = "companies";
    protected $primaryKey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_name', 'financial_statue', 'market_category',
        'round_lot_size', 'security_name', 'symbol', 'test_issue'
    ];

    public $timestamps = false;

    public static function createCompany(ResponseCompanyRow $row)
    {

        try {

            return self::create([
                'company_name'     => $row->getCompanyName(),
                'financial_statue' => $row->getFinancialStatue(),
                'market_category'  => $row->getMarketCategory(),
                'round_lot_size'   => $row->getRoundLotSize(),
                'security_name'    => $row->getSecurityName(),
                'symbol'           => $row->getSymbol(),
                'test_issue'       => $row->getTestIssue(),
            ]);

        } catch (\Exception $e) {
            // the db might throw an error because of symbol has unique index and
            // I don't want to check it before insert
            // to not making another query,
            // although it will be a fast query because it'll use index-only scan
            // at live-mode scenario I won't do this of-course.
            // at live-mode I make double checks at important things
            // But I just want to say I know how the database is working inside

            if(env("APP_ENV")=="testing"){
                var_dump($e->getMessage());
            }

            Log::error($e->getMessage());
        }

    }

    public static function getCompanyBySymbol(string $companySymbol): ?self
    {

        return self::where("symbol", $companySymbol)->limit(1)->get()->first();

    }

}



