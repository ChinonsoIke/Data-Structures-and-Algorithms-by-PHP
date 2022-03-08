<?php

namespace Src\Queue;

use OverflowException;
use Src\LinkedList\ItemListDouble;
use Src\LinkedList\ItemListLinear;
use UnderflowException;

class LinkedListQueue implements QueueInterface
{
    private $limit;
    private $queue;

    public function __construct(int $limit=20)
    {
        $this->limit= $limit;
        $this->queue= new ItemListLinear();
    }

    public function enqueue(string $data, int $priority=null)
    {
        if($this->queue->getSize() < $this->limit){
            if(!is_null($priority)){
                $this->queue->insertWithPriority($data, $priority);
            }else{
                $this->queue->insert($data);
            }
        }else{
            throw new OverflowException('Queue is full');
        }
    }

    public function dequeue()
    {
        if($this->isEmpty()){
            throw new UnderflowException('Queue is empty');
        }else{
            $first= $this->peek();
            $this->queue->deleteFirst();
            return $first;
        }
    }

    public function peek()
    {
        return $this->queue->getNthNode(1)->data;
    }

    public function isEmpty()
    {
        return $this->queue->getSize() == 0;
    }
}