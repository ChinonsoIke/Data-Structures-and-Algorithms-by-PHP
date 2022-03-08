<?php

namespace Src\Stack;

use Src\LinkedList\ItemListLinear;
use UnderflowException;

class LinkedListStack implements StackInterface
{
    private $stack;

    public function __construct()
    {
        $this->stack= new ItemListLinear();
    }

    public function push(string $data)
    {
        $this->stack->insert($data);
    }

    public function pop()
    {
        // check if stack is empty
        if($this->isEmpty()){
            throw new UnderflowException('Stack is empty');
        }else{
            $lastNode= $this->top();
            $this->stack->deleteLast();
            return $lastNode;
        }
    }

    public function top()
    {
        if(!$this->isEmpty()){
            return $this->stack->getNthNode($this->stack->getSize())->data;
        }
    }

    public function isEmpty() : bool
    {
        return $this->stack->getSize() == 0;
    }
}