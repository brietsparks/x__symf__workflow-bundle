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
        $child->setParent($this);
        $this->children[] = $child;
        $this->reindexChildren();

        return $this;
    }

    /**
     * @param string $name
     * @return WorkflowNode
     */
    public function getChildByName($name)
    {
        /** @var WorkflowNode $child */
        foreach ($this->children as $child) {
            if ($child->getConfig()->getName() === $name) {
                return $child;
            }
        }
    }


    public function getChildByIndex($index)
    {
        if(!is_numeric($index)) {
            throw new RuntimeException("Method 'getChildByIndex' is expecting an integer, '{$index}' given, in Workflow named '{$this->getName()}'.");
        }

        $index = intval($index);

        if (!$this->hasIndex($index)) {
            throw new RuntimeException("WorkflowNode at index {$index} does not exist in Workflow named '{$this->getName()}'.");
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