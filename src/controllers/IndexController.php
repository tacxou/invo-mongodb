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

use Phalcon\Mvc\Controller;

/**
 * Class IndexController
 *
 * @package InvoMongodb\Controllers
 */
class IndexController extends Controller
{
    public function indexAction(): array
    {
        return ['status' => 0];
    }
}