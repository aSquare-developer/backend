<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/5/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        /*
         * Headless seadistus:
         * Sunnime rakenduse kasutama JsonView klassi, et vältida templates/ kausta kasutamist.
         */
        $this->viewBuilder()->setClassName('Json');
    }

    /**
     * beforeRender meetod käivitub vahetult enne vastuse saatmist.
     * Siin automatiseerime andmete JSON-iks muutmise.
     *
     * @param \Cake\Event\EventInterface $event Event.
     * @return void
     */
    public function beforeRender(EventInterface $event)
    {
        parent::beforeRender($event);

        /*
         * See rida ütleb CakePHP-le, et kõik kontrolleris set() meetodiga
         * määratud muutujad tuleb automaatselt JSON-vastusesse lisada.
         */
        $this->viewBuilder()->setOption('serialize', true);
    }
}