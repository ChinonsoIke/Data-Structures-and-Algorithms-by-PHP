<?php

namespace Src\Tree;

class TreeNode
{
    public $data= null;
    public $children= [];

    public function __construct($data=null)
    {
        $this->data= $data;
    }

    public function addChild(TreeNode $node)
    {
        $this->children[]= $node;
    }
}