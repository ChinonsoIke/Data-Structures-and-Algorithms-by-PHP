<?php

namespace Src\LinkedList;


class ItemListCircular
{
    private $firstNode= null;
    private $totalNodes= 0;

    public function insert(string $data=null)
    {
        $newNode= new ItemNode($data);

        // check if first node is empty
        if($this->firstNode === null){
            $this->firstNode= &$newNode;
        }else{
            $currentNode= $this->firstNode;
            // iterate till end of list
            while($currentNode->next !== $this->firstNode){
                $currentNode= $currentNode->next;
            }
            // change last node next link from first node to the new node
            $currentNode->next= $newNode;
        }
        $newNode->next= $this->firstNode;
        $this->totalNodes++;
        return true;
    }

    public function display()
    {
        echo "Total Books: {$this->totalNodes}\n";
        $currentNode= $this->firstNode;
        while($currentNode->next !== $this->firstNode){
            echo "{$currentNode->data}\n";
            $currentNode= $currentNode->next;
        }
        if($currentNode){
            echo "{$currentNode->data}\n";
        }
    }
}