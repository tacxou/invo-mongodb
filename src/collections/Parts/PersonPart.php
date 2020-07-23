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

namespace InvoMongodb\Collections\Parts;

use MongoDB\BSON\Persistable;
use Phalcon\Incubator\Mvc\Collection\Document;

/**
 * Class PersonPart
 *
 * @package InvoMongodb\Collections\Parts
 */
class PersonPart extends Document implements Persistable
{
    public $id;

    public $name;

    public $type;

    public function bsonSerialize()
    {
        return $this->toArray();
    }

    public function bsonUnserialize(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}