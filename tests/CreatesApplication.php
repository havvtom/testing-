<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    protected $user;

    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function signIn($user = null){

        if(! $user){

           $user = factory(\App\User::class)->create();
        }
        $this->user = $user;

        $this->actingAs($this->user);

        return $this;
    }
}
