<?php

namespace Bsapaka\WorkflowBundle;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class SubmitHandler extends AbstractSubmitHandler
{

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var Request
     */
    protected $request;

    /**
     * SubmitHandler constructor.
     * @param Session $session
     */
    public function __construct(Session $session, Request $request)
    {
        $this->session = $session;
        $this->request = $request;
    }

    public function handle()
    {
        $form = $this->workflowController->getCurrentForm();
        $form->handleRequest($this->request);

//        $persistenceHandler = how is this passed in
    }

    public function getNextStepName()
    {
    }


}
