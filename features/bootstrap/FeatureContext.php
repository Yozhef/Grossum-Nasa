<?php

namespace FeatureContext;

use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Session\Session;

class FeatureContext implements Context
{
    public function __construct()
    {
        // $session is your Symfony2 @session
    }
}
