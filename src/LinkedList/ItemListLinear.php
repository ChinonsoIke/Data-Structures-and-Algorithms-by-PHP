<?php
namespace Src\LinkedList;

use Src\LinkedList\ItemNode;

class ItemListLinear extends Base
{
    public function insert(string $data=null)
    {
        $newNode= new ItemNode($data);
        // check if first node is null
        if($this->firstNode === null){
            $this->firstNode= &$newNode;
        }else{
            // list is not empty
            $currentNode= $this->firstNode;
            while($currentNode->next !== null){
                $currentNode= $currentNode->next;
            }
            // set new node as next property of last node in the list
            $currentNode->next= $newNode;
        }
        $this->totalNodes++;
        return true;
    }

    public function insertWithPriority(string $data=null, int $priority=null)
    {
        $newNode= new ItemNode($data, $priority);
        // check if first node is null
        if($this->firstNode === null){
            $this->firstNode= &$newNode;
        }else{
            // list is not empty
            $previous= $this->firstNode;
            $currentNode= $this->firstNode;
            while($currentNode !== null){
                if($currentNode->priority < $priority){
                    if($currentNode === $this->firstNode){
                        $previous= $this->firstNode;
                        $this->firstNode= &$newNode;
                        $newNode->next= $previous;
                        return;
                    }else{
                        $newNode->next= $currentNode;
                        $previous->next= $newNode;
                        return;
                    }
                }
                $previous= $currentNode;
                $currentNode= $currentNode->next;
            }
        }
        $this->totalNodes++;
        return true;
    }

    public function insertAtFirst(string $data=null)
    {
        $newNode= new ItemNode($data);
        // check if first node is empty
        if($this->firstNode === null){
            $this->firstNode = &$newNode;
        }else{
            // list is not empty, replace first node with new one
            $currentFirstNode= $this->firstNode;
            $this->firstNode= &$newNode;
            $newNode->next= $currentFirstNode;
        }
        $this->totalNodes++;
        return true;
    }

    public function insertBefore(string $data=null, string $query=null)
    {
        $newNode= new ItemNode($data);

        // make sure list is not empty
        if($this->firstNode){
            $previousNode= null;
            $currentNode= $this->firstNode;
            // search for target node
            while($currentNode !== null){
                if($currentNode->data === $query){
                    $newNode->next= $currentNode;
                    $previousNode ? $previousNode->next= $newNode: $this->firstNode->next= $newNode;
                    $this->totalNodes++;
                    break;
                }
                $previousNode= $currentNode;
                $currentNode= $currentNode->next;
            }
        }
    }

    public function insertAfter(string $data=null, string $query=null)
    {
        $newNode= new ItemNode($data);
        // make sure list is not empty
        if($this->firstNode){
            $currentNode= $this->firstNode;
            // search for target node
            while($currentNode !== null){
                if($currentNode->data === $query){
                    $nextNode= $currentNode->next;
                    $currentNode->next= $newNode;
                    $newNode->next= $nextNode;
                    $this->totalNodes++;
                    break;
                }
                $currentNode= $currentNode->next;
            }
        }
    }

    public function deleteFirst()
    {
        // make sure list is not empty
        if($this->firstNode){
            $this->firstNode= $this->firstNode->next;
            $this->totalNodes--;
            return true;
        }
        return false;
    }

    public function deleteLast()
    {
        // make sure list is not empty
        if($this->firstNode !== null){
            $currentNode= $this->firstNode;

            // check if first node is only node
            if($currentNode->next === null){
                $this->firstNode= null;
                $this->totalNodes--;
                return true;
            }else{
                $previousNode= null;
                // iterate through list until last node, while tracking previous node
                while($currentNode->next !== null){
                    $previousNode= $currentNode;
                    $currentNode= $currentNode->next;
                }
                $previousNode->next= null;
                $this->totalNodes--;
                return true;
            }
        }
        return false;
    }

    public function delete(string $query)
    {
        // make sure list is not empty
        if($this->firstNode !== null){
            $currentNode= $this->firstNode;
            $previousNode= null;
            // search for target node
            while($currentNode !== null){
                if($currentNode->data === $query){
                    $previousNode? $previousNode->next= $currentNode->next: $this->firstNode= null;
                    $this->totalNodes--;
                    return true;
                }
                $previousNode= $currentNode;
                $currentNode= $currentNode->next;
            }
        }
        return false;
    }

    public function getNthNode(int $n)
    {
        $count= 1;

        // make sure list is not empty
        if($this->firstNode !== null){
            $currentNode= $this->firstNode;
            while($currentNode !== null){
                if($count === $n){
                    // echo "\nNth Node Search Result: {$currentNode->data}\n";
                    return $currentNode;
                }
                $count++;
                $currentNode= $currentNode->next;
            }
        }
        return false;
    }

    public function display()
    {
        echo "Total Book Titles: {$this->totalNodes}\n";
        $currentNode= $this->firstNode;
        while($currentNode !== null){
            echo "{$currentNode->data}\n";
            $currentNode= $currentNode->next;
        }
    }

    public function reverse()
    {
        // make sure list is not empty
        if($this->firstNode !== null){
            // make sure list contains more than one node
            if($this->firstNode->next !== null){
                $currentNode= $this->firstNode;
                $previousNode= null;
                $nextNode= null;

                // iterate through the nodes and change next to previous,
                // previous to current, and current to next
                while($currentNode !== null){
                    $nextNode= $currentNode->next;
                    $currentNode->next= $previousNode;
                    $previousNode= $currentNode;
                    $currentNode= $nextNode;
                }
                $this->firstNode= $previousNode;
            }
        }
    }

    public function search(string $data=null)
    {
        // check if list is not empty
        if($this->totalNodes){
            $currentNode= $this->firstNode;
            while($currentNode->next !== null){
                if($currentNode->data === $data){
                    echo "\nSearch Result: {$currentNode->data}";
                    return true;
                }
                $currentNode= $currentNode->next;
            }
        }
        return false;
    }

    public function getSize() : int
    {
        $count= 0;
        $currentNode= $this->firstNode;

        while(!is_null($currentNode)){
            $count++;
            $currentNode= $currentNode->next;
        }
        return $count;
    }
}