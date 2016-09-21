<?php

namespace Tests\Console;

use Tests\BaseTest;

class PublishProvidedRoutesCommandTest extends BaseTest
{

    public function testCommand()
    {
        $this->artisan('dynamic-route:provided:publish');
        $this->assertTrue(true);
    }

}
