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

namespace InvoMongodb\Controllers;

use InvoMongodb\Collections\Booknote;
use MongoDB\BSON\ObjectId;
use Phalcon\Mvc\Controller;

/**
 * Class IndexController
 *
 * @package InvoMongodb\Controllers
 */
class BooknotesController extends Controller
{
    public function indexAction(): array
    {
        $booknotes = Booknote::find();
        return [
            'status' => 0,
            'data' => $booknotes
        ];
    }

    public function createAction(): array
    {
        $booknote = new Booknote();
        $booknote->student = [
            'id' => new ObjectId(),
            'name' => 'Henry'
        ];

        if ($booknote->save()) {
            return [
                'status' => 0
            ];
        }

        return [
            'status' => 1,
            'messages' => $booknote->getMessages()
        ];
    }
}