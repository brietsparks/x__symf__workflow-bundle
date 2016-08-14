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
        $slug = $child->getSlug();
        if ($this->hasChildWithSlug($slug)) {
            throw new RuntimeException("Cannot add a WorkflowNode '$slug' to Workflow '{$this->getSlug()}' because the Workflow already has a child with that slug.");
        }

        $child->setParent($this);

        $this->children[] = $child;

        $this->reindexChildren();

        return $this;
    }


    /**
     * Recursively search this and descendant nodes for a step by its name
     *
     * @param string $name
     *
     * @return Step
     */
    public function findStepRecursively($name)
    {
        if ($this->hasChildWithSlug($name)) {
            return $this->getChildBySlug($name);
        }

        foreach ((array) $this->children as $child) {
            if ($child instanceof Workflow) {
                return $child->findStepRecursively($name);
            }
        }
    }

    /**
     * Get the step with the given name and throw an exception if that step does not exist
     *
     * @param $slug
     * @param bool $deep
     * @throws RuntimeException
     * @return Step|WorkflowNode
     */
    public function getStepBySlug($slug, $deep = true)
    {
        if ($deep) {
            $step = $this->findStepRecursively($slug);
            if (!$step) {
                throw new RuntimeException("Step with name '{$slug}' does not exist in Workflow '{$this->getPath()}' or its descendant Workflows.");
            }
        } else {
            $step = $this->getChildBySlug($slug);
        }

        return $step;
    }

    /**
     * Check if this Workflow has child node with a given name
     *
     * @param string $slug
     * @return bool
     */
    public function hasChildWithSlug($slug)
    {
        /** @var WorkflowNode $child */
        foreach ((array) $this->children as $child) {
            if ($child instanceof Step && $child->getConfig()->getSlug() === $slug) {
                return true;
            }
        }
    }

    public function getNodeByPath($fullName)
    {

    }

    /**
     * @param string $slug
     * @throws RuntimeException
     * @return WorkflowNode
     */
    public function getChildBySlug($slug)
    {
        $namedChild = null;

        /** @var WorkflowNode $child */
        foreach ($this->children as $child) {
            if ($child->getConfig()->getSlug() === $slug) {
                $namedChild = $child;
            }
        }

        if(!$namedChild) {
            throw new RuntimeException("There is no child WorkflowNode named '{$slug}' in Workflow '{$this->getPath()}'.");
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
            throw new RuntimeException("Method 'getChildByIndex' is expecting an integer, '{$index}' given, in Workflow '{$this->getPath()}'.");
        }

        $index = intval($index);

        if (!$this->hasIndex($index)) {
            throw new RuntimeException("There is no child WorkflowNode with an index of {$index} in Workflow '{$this->getPath()}'.");
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