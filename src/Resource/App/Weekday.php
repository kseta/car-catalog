<?php
namespace KSeta\CarCatalog\Resource\App;

use BEAR\Resource\ResourceObject;
use KSeta\CarCatalog\Annotation\BenchMark;
use Psr\Log\LoggerInterface;

class Weekday extends ResourceObject
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Weekday constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @BenchMark
     *
     * @param int $year
     * @param int $month
     * @param int $day
     *
     * @return ResourceObject
     */
    public function onGet(int $year, int $month, int $day) : ResourceObject
    {
        $weekday = \DateTime::createFromFormat('Y-m-d', "$year-$month-$day")->format('D');
        $this->body = [
            'weekday' => $weekday,
        ];
        $this->logger->info("$year-$month-$day {$weekday}");

        return $this;
    }
}
