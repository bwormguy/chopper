<?php
declare(strict_types = 1);

namespace App\Tests\Gear\Filtration\Filters;

use App\Gear\Filtration\Filters\BodyIsolatorFilter;
use PHPUnit\Framework\TestCase;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * BodyIsolatorFilterTest
 */
class BodyIsolatorFilterTest extends TestCase
{
    private $filter;

    private $data;

    public function testHandle(): void
    {
        $result = $this->filter->handle($this->data);
        static::assertSame('<body>Content: Test </body>', $result);
    }

    protected function setUp(): void
    {
        $this->filter = new BodyIsolatorFilter();
        $this->data   = file_get_contents(__DIR__.'/Templates/BodyTemplate.txt');
    }
}
