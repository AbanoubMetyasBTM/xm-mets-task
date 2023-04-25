<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomepageTest extends TestCase
{

    public function test_getHomepage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_homepage_validation_error()
    {
        $params = [
            "submit" => "submit",
        ];

        $response   = $this->get('/?' . http_build_query($params));
        $resContent = $response->getContent();

        $this->assertStringContainsString("The company symbol field is required", $resContent);
        $this->assertStringContainsString("The start date field is required", $resContent);
        $this->assertStringContainsString("The end date field is required", $resContent);
        $this->assertStringContainsString("The email field is required", $resContent);
    }

    public function test_get_homepage_validation_error_2()
    {
        $params = [
            "submit"         => "submit",
            "company_symbol" => "dasaaadaad",
            "start_date"     => "2023-03-24",
            "end_date"       => "2023-01-24",
            "email"          => "dasada"
        ];

        $response   = $this->get('/?' . http_build_query($params));
        $resContent = $response->getContent();

        $this->assertStringContainsString("The selected company symbol is invalid", $resContent);
        $this->assertStringContainsString("The email must be a valid email address", $resContent);
        $this->assertStringContainsString("The start date must be a date before", $resContent);
    }

    public function test_get_homepage_validation_error_future_dates()
    {
        $params = [
            "submit"         => "submit",
            "company_symbol" => "ACAD",
            "start_date"     => "2023-05-24",
            "end_date"       => "2023-04-24",
            "email"          => "dasada"
        ];

        $response   = $this->get('/?' . http_build_query($params));
        $resContent = $response->getContent();

        $this->assertStringContainsString("The email must be a valid email address", $resContent);
        $this->assertStringContainsString("The start date must be a date before", $resContent);
    }

    public function test_get_homepage_success()
    {
        $params = [
            "submit"         => "submit",
            "company_symbol" => "ACAD",
            "start_date"     => "2023-01-24",
            "end_date"       => "2023-03-24",
            "email"          => "a@a.com"
        ];

        $response   = $this->get('/?' . http_build_query($params));
        $resContent = $response->getContent();

        $this->assertStringNotContainsString("The company symbol field is required", $resContent);
        $this->assertStringNotContainsString("The start date field is required", $resContent);
        $this->assertStringNotContainsString("The end date field is required", $resContent);
        $this->assertStringNotContainsString("The email field is required", $resContent);

        $this->assertStringNotContainsString("The selected company symbol is invalid", $resContent);
        $this->assertStringNotContainsString("The email must be a valid email address", $resContent);
        $this->assertStringNotContainsString("The start date must be a date before", $resContent);
    }


}
