<?php

namespace App\Types;

class ResponseCompanyRow
{

    private string $companyName;
    private string $financialStatue;
    private string $marketCategory;
    private int    $roundLotSize;
    private string $securityName;
    private string $symbol;
    private string $testIssue;


    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function getFinancialStatue(): string
    {
        return $this->financialStatue;
    }

    public function getMarketCategory(): string
    {
        return $this->marketCategory;
    }

    public function getRoundLotSize(): int
    {
        return $this->roundLotSize;
    }

    public function getSecurityName(): string
    {
        return $this->securityName;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getTestIssue(): string
    {
        return $this->testIssue;
    }


    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;
        return $this;
    }

    public function setFinancialStatue(string $financialStatue): self
    {
        $this->financialStatue = $financialStatue;
        return $this;
    }

    public function setMarketCategory(string $marketCategory): self
    {
        $this->marketCategory = $marketCategory;
        return $this;
    }

    public function setRoundLotSize(int $roundLotSize): self
    {
        $this->roundLotSize = $roundLotSize;
        return $this;
    }

    public function setSecurityName(string $securityName): self
    {
        $this->securityName = $securityName;
        return $this;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }

    public function setTestIssue(string $testIssue): self
    {
        $this->testIssue = $testIssue;
        return $this;
    }


}
