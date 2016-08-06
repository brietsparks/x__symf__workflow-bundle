<?php

namespace Bsapaka\WorkflowBundle;

use Bsapaka\WorkflowBundle\Exception\RuntimeException;

class Workflow extends WorkflowNode
{

    const INDEX_BASE = 1;

    /**
     * @var array
     */
    protected $children;

    /**
     * @param WorkflowNode $child
     * 
     * @return $this
     */
    public function add(WorkflowNode $child)
    {
        // TODO: check if child with name exists
        $child->setParent($this);
        $child->getConfig()->resolveOptions();
        $this->children[] = $child;
        $this->reindexChildren();

        return $this;
    }


    /**
     * Recursively search down the tree for a step by its name
     *
     * @param string $name
     *
     * @return Step
     */
    public function findStepRecursively($name)
    {
        /** @var WorkflowNode $child */
        foreach ((array) $this->children as $child) {
            if ($child instanceof Step && $child->getConfig()->getName() === $name) {
                return $child;
            }
        }

        foreach ((array) $this->children as $child) {
            if ($child instanceof Workflow) {
                return $child->findStepRecursively($name);
            }
        }
    }

    /**
     * @param $name
     * @param bool $deep
     * @throws RuntimeException
     * @return Step|WorkflowNode
     */
    public function getStepByName($name, $deep = true)
    {
        if ($deep) {
            $step = $this->findStepRecursively($name);
            if (!$step) {
                throw new RuntimeException("Step with name '{$name}' does not exist in Workflow tree named '{$this->getName()}'.");
            }
        } else {
            $step = $this->getChildByName($name);
        }

        return $step;
    }

    /**
     * @param string $name
     * @throws RuntimeException
     * @return WorkflowNode
     */
    public function getChildByName($name)
    {
        $namedChild = null;

        /** @var WorkflowNode $child */
        foreach ($this->children as $child) {
            if ($child->getConfig()->getName() === $name) {
                $namedChild = $child;
            }
        }

        if(!$namedChild) {
            throw new RuntimeException("There is no child WorkflowNode named '{$name}' in Workflow named '{$this->getName()}'.");
        }

        return $namedChild;
    }

    /**
     * @param $index
     * @throws RuntimeException
     * @return WorkflowNode
     */
    public function getChildByIndex($index)
    {
        if(!is_numeric($index)) {
            throw new RuntimeException("Method 'getChildByIndex' is expecting an integer, '{$index}' given, in Workflow named '{$this->getName()}'.");
        }

        $index = intval($index);

        if (!$this->hasIndex($index)) {
            throw new RuntimeException("There is no child WorkflowNode with an index of {$index} in Workflow named '{$this->getName()}'.");
        }

        return $this->children[$index];
    }

    /**
     * @param $index
     * @return bool
     */
    public function hasIndex($index)
    {
        return array_key_exists($index, $this->children);
    }

    /**
     * Remove all children indexing gaps and set each child's Index property
     * to its new index in the array.
     *
     * This is needed in case the array has insertions or removals.
     *
     * @return void
     */
    protected function reindexChildren()
    {
        $children = $this->children;
        $firstChild = reset($children);
        $newChildren = [self::INDEX_BASE => $firstChild];

        foreach (array_slice($this->children, 1) as $child) {
            $newChildren[] = $child;
        }

        /** @var WorkflowNode $child */
        foreach ($newChildren as $index => $child) {
            $child->setIndex($index);
        }

        $this->children = $newChildren;
    }

    /**
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }


}