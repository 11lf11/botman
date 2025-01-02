<?php

namespace lf11\BotMan\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface VerifiesService
{
    public function verifyRequest(Request $request);
}
