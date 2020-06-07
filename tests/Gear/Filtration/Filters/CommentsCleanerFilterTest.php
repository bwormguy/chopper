<?php
declare(strict_types = 1);

namespace Gear\Filtration\Filters;

use Chopper\Gear\Filtration\Filters\CommentsCleanerFilter;
use PHPUnit\Framework\TestCase;

/**
 * CommentsCleanerFilterTest
 */
class CommentsCleanerFilterTest extends TestCase
{
    private $filter;

    private $data;

    public function testHandle()
    {
        $result = $this->filter->handle($this->data);
        static::assertEmpty($result);
    }

    protected function setUp(): void
    {
        $this->filter = new CommentsCleanerFilter();
        $this->data   = file_get_contents(__DIR__.'/Templates/CommentsTemplate.txt');
    }
}
