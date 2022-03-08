<?php

namespace Src\Stack;

use OverflowException;
use UnderflowException;

class ArrayStack implements StackInterface
{
    private $limit;
    private $stack;

    public function __construct(int $limit=20)
    {
        $this->limit= $limit;
        $this->stack= [];
    }

    public function push(string $data)
    {
        // check if stack is full
        if(count($this->stack) < $this->limit){
            array_push($this->stack, $data);
        }else{
            throw new OverflowException('Stack is full');
        }
    }

    public function pop()
    {
        // check if stack is empty
        if($this->isEmpty()) throw new UnderflowException('Stack is empty');
        else{
            return array_pop($this->stack);
        }
    }

    public function top() : string
    {
        return end($this->stack);
    }

    public function isEmpty() : bool
    {
        return empty($this->stack);
    }
}