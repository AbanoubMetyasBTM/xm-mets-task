<?php

namespace App\Types;

class ResponsePriceRow
{

    public int    $date;
    public string $dateFormatted;
    public float  $open;
    public float  $high;
    public float  $low;
    public float  $close;
    public int    $volume;
    public float  $adjclose;

    public function getDate(): string
    {
        return $this->date;
    }

    public function getDateFormatted(): string
    {
        return $this->dateFormatted;
    }

    public function getOpen(): float
    {
        return $this->open;
    }

    public function getHigh(): float
    {
        return $this->high;
    }

    public function getLow(): float
    {
        return $this->low;
    }

    public function getClose(): float
    {
        return $this->close;
    }

    public function getVolume(): int
    {
        return $this->volume;
    }

    public function getAdjclose(): float
    {
        return $this->adjclose;
    }


    public function setDate(int $date): self
    {
        $this->date          = $date;
        $this->dateFormatted = date("Y-m-d", $this->date);
        return $this;
    }

    public function setOpen(float $open): self
    {
        $this->open = $open;
        return $this;
    }

    public function setHigh(float $high): self
    {
        $this->high = $high;
        return $this;
    }

    public function setLow(float $low): self
    {
        $this->low = $low;
        return $this;
    }

    public function setClose(float $close): self
    {
        $this->close = $close;
        return $this;
    }

    public function setVolume(int $volume): self
    {
        $this->volume = $volume;
        return $this;
    }

    public function setAdjclose(float $adjclose): self
    {
        $this->adjclose = $adjclose;
        return $this;
    }


}
