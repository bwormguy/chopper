<?php
declare(strict_types = 1);

namespace Chopper\Gear\Facade;

use Chopper\Curl\Request\CurlRequest;
use Chopper\Downloader\HttpDownloader;
use Chopper\Gear\Factory\Filter\IFilterFactory;
use Chopper\Gear\Filtration\Filtrator\Filtrator;
use Chopper\Logger\GlobalLogger\IGlobalLogger;

/**
 * Cleaner
 */
class Cleaner
{
    /**
     * @var IGlobalLogger
     */
    private $globalLogger;

    /**
     * Конструктор.
     *
     * @param IGlobalLogger $globalLogger
     */
    public function __construct(IGlobalLogger $globalLogger)
    {
        $this->globalLogger = $globalLogger;
    }

    /**
     * Method filts file
     *
     * @param string         $path
     * @param string         $dest
     * @param IFilterFactory $factory
     *
     * @return bool
     */
    public function filterFile(string $path, string $dest, IFilterFactory $factory): bool
    {
        $filtrator = new Filtrator($factory, $this->globalLogger->getLogger());

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            file_put_contents(
                $dest,
                $filtrator->handle(
                    (new HttpDownloader(new CurlRequest(), $this->globalLogger->getLogFilePath()))->download($path)
                        ->getBody()
                )
            );

            return true;
        }
        if (file_exists($path) && is_readable($path)) {
            file_put_contents($dest, $filtrator->handle(file_get_contents($path)));

            return true;
        }

        return false;
    }
}
