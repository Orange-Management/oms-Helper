<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Helper\tests\Models;

use Modules\Admin\Models\NullAccount;
use Modules\Helper\Models\HelperStatus;
use Modules\Helper\Models\NullTemplate;
use Modules\Helper\Models\Report;
use Modules\Media\Models\NullCollection;

/**
 * @testdox Modules\tests\Helper\Models\ReportTest: Report model
 *
 * @internal
 */
class ReportTest extends \PHPUnit\Framework\TestCase
{
    protected Report $report;

    protected function setUp() : void
    {
        $this->report = new Report();
    }

    /**
     * @testdox The model has the expected default values after initialization
     * @covers Modules\Helper\Models\Report
     * @group module
     */
    public function testDefault() : void
    {
        self::assertEquals(0, $this->report->getId());
        self::assertEquals(0, $this->report->createdBy->getId());
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $this->report->createdAt->format('Y-m-d'));
        self::assertEquals('', $this->report->title);
        self::assertEquals(HelperStatus::INACTIVE, $this->report->getStatus());
        self::assertEquals('', $this->report->description);
        self::assertEquals('', $this->report->descriptionRaw);
        self::assertEquals(0, $this->report->getTemplate()->getId());
        self::assertEquals(0, $this->report->getSource()->getId());
    }

    /**
     * @testdox The creator can be set and returned correctly
     * @covers Modules\Helper\Models\Report
     * @group module
     */
    public function testCreatedByInputOutput() : void
    {
        $this->report->createdBy = new NullAccount(1);
        self::assertEquals(1, $this->report->createdBy->getId());
    }

    /**
     * @testdox The title can be set and returned correctly
     * @covers Modules\Helper\Models\Report
     * @group module
     */
    public function testTitleInputOutput() : void
    {
        $this->report->title = 'Title';
        self::assertEquals('Title', $this->report->title);
    }

    /**
     * @testdox The status can be set and returned correctly
     * @covers Modules\Helper\Models\Report
     * @group module
     */
    public function testStatusInputOutput() : void
    {
        $this->report->setStatus(HelperStatus::ACTIVE);
        self::assertEquals(HelperStatus::ACTIVE, $this->report->getStatus());
    }

    /**
     * @testdox The description can be set and returned correctly
     * @covers Modules\Helper\Models\Report
     * @group module
     */
    public function testDescriptionInputOutput() : void
    {
        $this->report->description = 'Description';
        self::assertEquals('Description', $this->report->description);
    }

    /**
     * @testdox The raw description can be set and returned correctly
     * @covers Modules\Helper\Models\Report
     * @group module
     */
    public function testDescriptionRawInputOutput() : void
    {
        $this->report->descriptionRaw = 'DescriptionRaw';
        self::assertEquals('DescriptionRaw', $this->report->descriptionRaw);
    }

    /**
     * @testdox The template can be set and returned correctly
     * @covers Modules\Helper\Models\Report
     * @group module
     */
    public function testTemplateInputOutput() : void
    {
        $this->report->setTemplate(new NullTemplate(11));
        self::assertEquals(11, $this->report->getTemplate()->getId());
    }

    /**
     * @testdox The source can be set and returned correctly
     * @covers Modules\Helper\Models\Report
     * @group module
     */
    public function testSourceInputOutput() : void
    {
        $this->report->setSource(new NullCollection(4));
        self::assertEquals(4, $this->report->getSource()->getId());
    }

    /**
     * @testdox Report data can be turned into an array
     * @covers Modules\Helper\Models\Report
     * @group module
     */
    public function testToArray() : void
    {
        $this->report->setTemplate(new NullTemplate(11));
        $this->report->title          = 'testTitle';
        $this->report->description    = 'testDescription';
        $this->report->descriptionRaw = 'testDescriptionRaw';

        $array    = $this->report->toArray();
        $expected = [
            'id'             => 0,
            'name'           => 'testTitle',
            'description'    => 'testDescription',
            'descriptionRaw' => 'testDescriptionRaw',
            'status'         => HelperStatus::INACTIVE,
        ];

        foreach ($expected as $key => $e) {
            if (!isset($array[$key]) || $array[$key] !== $e) {
                self::assertTrue(false);
            }
        }

        self::assertTrue(true);
    }

    /**
     * @testdox Report data can be json serialized
     * @covers Modules\Helper\Models\Report
     * @group module
     */
    public function testJsonSerialize() : void
    {
        $this->report->setTemplate(new NullTemplate(11));
        $this->report->title          = 'testTitle';
        $this->report->description    = 'testDescription';
        $this->report->descriptionRaw = 'testDescriptionRaw';

        $array    = $this->report->jsonSerialize();
        $expected = [
            'id'             => 0,
            'name'           => 'testTitle',
            'description'    => 'testDescription',
            'descriptionRaw' => 'testDescriptionRaw',
            'status'         => HelperStatus::INACTIVE,
        ];

        foreach ($expected as $key => $e) {
            if (!isset($array[$key]) || $array[$key] !== $e) {
                self::assertTrue(false);
            }
        }

        self::assertTrue(true);
    }
}
