<?php

namespace App\Repositories\Contracts;

interface InfoRepository
{
    public function get($sInfoName);
    public function updateInfoPage($sInfoContent);
}
