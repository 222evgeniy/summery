<?php

namespace common\modules\summery\modules\cabinet\services;

/**
 * Class SummeryService
 * @package common\modules\summery\modules\cabinet\services
 */
class SummeryService
{
    /** @var SummeryProvider */
    protected $provider;

    /**
     * SummeryService constructor.
     * @param SummeryProvider $provider
     */
    public function __construct(SummeryProvider $provider)
    {
        $this->provider = $provider;
    }

}