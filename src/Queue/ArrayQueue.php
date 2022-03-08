<?php

namespace Src\Queue;

use OverflowException;
use UnderflowException;

class ArrayQueue implements QueueInterface
{
    private $queue;
    private $limit;

    public function __construct(int $limit=20)
    {
        $this->queue= [];
        $this->limit= $limit;
    }

    public function enqueue(string $data)
    {
        if(count($this->queue) < $this->limit){
            array_push($this->queue, $data);
        }else{
            throw new OverflowException('Queue is full');
        }  
    }

    public function dequeue()
    {
        if($this->isEmpty()){
            throw new UnderflowException('Queue is empty');
        }else{
            return array_shift($this->queue);
        }
    }

    public function peek()
    {
        return current($this->queue);
    }

    public function isEmpty()
    {
        return empty($this->queue);
    }
}