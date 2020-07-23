<?php
declare(strict_types=1);

/**
 * This file is part of the Invo.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace InvoMongodb\Collections;

use InvoMongodb\Collections\Parts\PersonPart;
use Phalcon\Incubator\Mvc\Collection;
use function Phalcon\Incubator\jsonSerializeGenerator;

/**
 * Class Booknote
 *
 * @package InvoMongodb\Collections
 */
class Booknote extends Collection
{
    protected static $typeMap = [
        'fieldPaths' => [
            'student' => PersonPart::class,
            'teacher' => PersonPart::class
        ]
    ];

    public function initialize()
    {
        // TODO not functionnal
        $this->setSource('booknotes');
    }

    /**
     * @var PersonPart|null $student
     */
    public $student;

    public $message;

    public $teacher;

    public $readFlags;
}