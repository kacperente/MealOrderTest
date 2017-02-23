<?php

namespace Eden\MealOrder\Tools;

class SQLLogger implements \Doctrine\DBAL\Logging\SQLLogger
{
    protected $logger;

    public function __construct($logger = false)
    {
        $this->logger = $logger;
    }

    protected function log($msg)
    {
        if ($this->logger) {
            return $this->logger->debug($msg);
        }
        echo $msg.PHP_EOL;
    }

    /**
     * {@inheritdoc}
     */
    public function startQuery($sql, array $params = null, array $types = null)
    {
        $sql = str_replace(array('%', '?'), array('%%', '\'%s\''), $sql);
        $sql = vsprintf(
            $sql,
            array_map(
                function ($i) {
                    if ($i instanceof \DateTime) {
                        return $i->format('c');
                    }

                    return $i;
                },
                $params ? $params : []
            )
        );

        $this->log("[SQL Query] ".$sql);
    }

    /**
     * {@inheritdoc}
     */
    public function stopQuery()
    {
    }
}
