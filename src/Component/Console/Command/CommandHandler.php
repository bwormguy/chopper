<?php
declare(strict_types = 1);

namespace Chopper\Component\Console\Command;

use Chopper\Component\Console\ColoredConsole\Console;
use Chopper\Component\Console\Command\CommandTraits\CleanerCommandTrait;
use Chopper\Component\Console\Command\CommandTraits\DownloadCommandTrait;
use Chopper\Component\Traits\ClosedConstructorTrait;

/**
 * Easy console commands functional realization
 */
class CommandHandler
{
    use CleanerCommandTrait;
    use ClosedConstructorTrait;
    use DownloadCommandTrait;

    /**
     * Command start method
     */
    public static function main(): void
    {
        (new static)->handle($_SERVER['argv']);
    }

    /**
     * Method handles input args
     *
     * @param      $argv
     */
    private function handle(array $argv): void
    {
        try {
            $method = $argv[1] ?? 'error';
            $this->$method($argv[2] ?? null, $argv[3] ?? null, $argv[4] ?? null);
            Console::out()->color(Console::GREEN)->writeln('Done');
        } catch (\Error $error) {
            $this->error();
            Console::out()->color(Console::RED)->writeln($error->getMessage());
        } catch (\Exception $exception) {
            $this->error();
            Console::out()->color(Console::RED)->writeln($exception->getMessage());
        }
    }

    /**
     * Standard console error handler
     */
    private function error(): void
    {
        Console::out()->color(Console::RED)->writeln("Concole command handler error!");
    }
}