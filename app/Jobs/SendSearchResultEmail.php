<?php

namespace App\Jobs;

use App\Models\CompanyModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendSearchResultEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $params;

    public function __construct($params)
    {
        $this->params = $params;
    }


    public function handle()
    {

        $companySymbol = $this->params["reqData"]["company_symbol"];
        $companyObj    = CompanyModel::getCompanyBySymbol($companySymbol);
        if(!is_object($companyObj)){
            return;
        }

        $userEmail     = $this->params["reqData"]["email"];
        $subject       = "Company Symbol = ${companySymbol} Company’s Name=".$companyObj->company_name;

        Mail::send("emails.send_report", $this->params, function ($message) use (
            $userEmail, $subject
        ) {
            $message->to($userEmail)->subject($subject);
        });


    }
}
