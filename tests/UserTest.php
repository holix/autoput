<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    public function testUserCreate()
    {
        $this->visit('/')
            ->see('Prijava')
            ->type('admin@admin.com', 'email')
            ->type('admin', 'password')
            ->press('Prijava')
            ->seePageIs('/mode')
            ->see('Režim rada')
            ->click('Korisnici')
            ->see('Dodaj')
            ->click('Dodaj')
            ->type('test@test.com', 'email')
            ->type('test', 'password')
            ->type('test ime', 'first_name')
            ->type('test prezime', 'last_name')
            ->press('Dodaj')
            ->see('Polje Lozinka mora sadržati najmanje 6 karaktera.');
    }
}
