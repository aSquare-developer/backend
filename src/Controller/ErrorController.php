<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * Error Handling Controller
 * * See kontroller haldab vigu (nt 404, 500) ja tagastab need JSON-ina.
 */
class ErrorController extends AppController
{
    /**
     * initialize meetod.
     * Me kutsume parent::initialize(), et laadida AppControlleris seatud JSON-sund.
     */
    public function initialize(): void
    {
        parent::initialize();
    }

    /**
     * beforeRender käivitub vahetult enne vea väljastamist.
     *
     * @param \Cake\Event\EventInterface<\Cake\Controller\Controller> $event Event.
     * @return void
     */
    public function beforeRender(EventInterface $event): void
    {
        parent::beforeRender($event);

        /*
         * Headless API spetsiifika:
         * Kuna meil pole templates/Error/ kausta, siis eemaldame templatePath seade.
         * Nii ei hakka CakePHP otsima puuduvaid .php faile ja väljastab vea JSON-ina.
         */
        $this->viewBuilder()->setTemplatePath(null);
    }
}
