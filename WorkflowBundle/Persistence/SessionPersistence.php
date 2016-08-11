<?php

namespace Bsapaka\WorkflowBundle\Persistence;

use Symfony\Component\HttpFoundation\Session\Session;

class SessionPersistence extends AbstractPersistenceStrategy
{

    /**
     * @var Session
     */
    protected $session;

    /**
     * SessionPersistence constructor.
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param mixed $data
     */
    public function persist($data = null)
    {
        // TODO: where data is saved in the session array
        $this->session->set('bsapaka_workflow_' . $this->step->getPath(), $data);
    }

    /**
     * @return mixed
     */
    public function getPersistedData()
    {
        if ($this->session->has($this->getKey())) {
            return $this->session->get($this->getKey());
        }
    }



}