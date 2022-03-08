<?php

namespace Src\Tree;

class Tree
{
    public $root= null;

    public function __construct(TreeNode $node)
    {
        $this->root= $node;
    }

    public function traverse(TreeNode $node, $level=0)
    {
        if($node){
            echo str_repeat('-', $level);
            echo $node->data. PHP_EOL;

            foreach($node->children as $child){
                $this->traverse($child, $level+1);
            }
        }
    }
}