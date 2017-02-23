<?php

namespace Eden\MealOrder\Services;


use Psr\Log\LoggerInterface;

class DemoService
{
    /** @var  LoggerInterface */
    private $logger;

    /**
     * DemoService constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function doSth($parameter)
    {
        $this->logger->debug($parameter);
        $this->logger->info($parameter);
        $this->logger->notice($parameter);
        $this->logger->warning($parameter);
        $this->logger->error($parameter);
        $this->logger->alert($parameter);
        $this->logger->critical($parameter);
        $this->logger->emergency($parameter);

        return $parameter;
    }
}