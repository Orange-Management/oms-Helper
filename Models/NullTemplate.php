<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   Modules\Helper\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Helper\Models;

/**
 * Report model.
 *
 * @package Modules\Helper\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class NullTemplate extends Template
{
    /**
     * Constructor
     *
     * @param int $id Model id
     *
     * @since 1.0.0
     */
    public function __construct(int $id = 0)
    {
        $this->id = $id;
        parent::__construct();
    }
}
