<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    public function testSeeLoginForm()
    {
        $this->visit('/')
             ->see('Prijava');
    }

    public function testSeeModePicker()
    {
        $this->visit('/')
            ->see('Prijava')
            ->type('admin@admin.com', 'email')
            ->type('admin', 'password')
            ->press('Prijava')
            ->seePageIs('/mode')
            ->see('Režim rada');
    }
}
