<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    //
    public function setUp(): void
    {
        parent::setUp();
        DB::delete('delete from hasils');
        DB::delete('delete from vektor');
        DB::delete('delete from jawabans');
        DB::delete('delete from users');
        DB::delete('delete from alternatives');
        DB::delete('delete from kriterias');
        DB::delete('delete from bobots');
    }
}
