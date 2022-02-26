<?php

namespace Src\LinkedList;

class ItemListDouble extends Base
{
    private $lastNode= null;

    public function insertAtFirst(string $data=null)
    {
        $newNode= new ItemNode($data);
        // check if list is empty
        if($this->firstNode === null){
            $this->firstNode= &$newNode;
            $this->lastNode= $newNode;
        }else{
            // list is not empty
            $currentFirstNode= $this->firstNode;
            $this->firstNode = &$newNode;
            $newNode->next= $currentFirstNode;
            $currentFirstNode->prev= $newNode;
        }
        $this->totalNodes++;
        return true;
    }

    public function insert(string $data=null)
    {
        $newNode= new ItemNode($data);
        // check if list is empty
        if($this->firstNode === null){
            $this->firstNode= &$newNode;
            $this->lastNode= $newNode;
        }else{
            // list is not empty
            $currentLastNode= $this->lastNode;
            $this->lastNode= $newNode;
            $newNode->prev= $currentLastNode;
            $currentLastNode->next= $newNode;
        }
        $this->totalNodes++;
        return true;
    }

    public function insertBefore(string $data=null, string $query=null)
    {
        $newNode= new ItemNode($data);
        $prev= null;
        // make sure list is not empty
        if($this->firstNode !== null){
            $currentNode= $this->firstNode;
            // iterate through list and search for target node
            while($currentNode !== null){
                if($currentNode->data === $query){
                    $prev= $currentNode->prev;
                    $prev->next= $newNode;
                    $currentNode->prev= $newNode;
                    $newNode->next= $currentNode;
                    $newNode->prev= $prev;
                    $this->totalNodes++;
                    return true;
                }
                $currentNode= $currentNode->next;
            }
            return false;
        }
    }

    public function insertAfter(string $data=null, string $query=null)
    {
        $newNode= new ItemNode($data);
        // make sure list is not empty
        if($this->firstNode !== null){
            $currentNode= $this->firstNode;
            $next= null;

            // iterate through list and search for target node
            while($currentNode !== null){
                if($currentNode->data === $query){
                    if($next === null){
                        $currentNode->next= $newNode;
                        $newNode->next= null;
                        $newNode->prev= $currentNode;
                    }else{
                        $next= $currentNode->next;
                        $next->prev= $newNode;
                        $currentNode->next= $newNode;
                        $newNode->next= $next;
                        $newNode->prev= $currentNode;
                    }

                    $this->totalNodes++;
                    return true;
                }
                $currentNode= $currentNode->next;
            }            
        }
        return false;
    }

    public function search(string $query = null)
    {
        $currentNode= $this->firstNode;

        while(!is_null($currentNode)){
            if($currentNode->data === $query){
                echo "Search Result: {$currentNode->data}\n";
                return true;
            }
            $currentNode= $currentNode->next;
        }
        return false;
    }

    public function getNthNode(int $n)
    {
        $count= 1;
        $currentNode= $this->firstNode;

        while(!is_null($currentNode)){
            if($count === $n){
                echo "Search Result: {$currentNode->data}\n";
                return true;
            }
            $currentNode= $currentNode->next;
            $count++;
        }
        return false;
    }

    public function deleteFirst()
    {
        // make sure list is not empty
        if($this->firstNode !== null){
            $this->firstNode= $this->firstNode->next;
            $this->firstNode->prev= null;

            $this->totalNodes--;
            return true;
        }
        return false;
    }

    public function deleteLast()
    {
        // make sure list is not empty
        if($this->firstNode !== null){
            $this->lastNode= $this->lastNode->prev;
            $this->lastNode->next= null;

            $this->totalNodes--;
            return true;
        }
        return false;
    }

    public function delete(string $query=null)
    {
        // make sure list is not empty
        if($this->firstNode !== null){
            $currentNode= $this->firstNode;
            // iterate through list and search for target node
            while($currentNode !== null){
                if($currentNode->data === $query){
                    $next= $currentNode->next;
                    $prev= $currentNode->prev;
                    
                    if($next === null){
                        $prev->next= null;
                    }else{
                        $prev->next= $next;
                        $next->prev= $prev;
                    }

                    $this->totalNodes--;
                    return true;
                }
                $currentNode= $currentNode->next;
            }
        }
        return false;
    }

    public function display()
    {
        echo "Total Nodes: {$this->totalNodes}\n";
        $currentNode= $this->firstNode;
        while($currentNode !== null){
            echo "{$currentNode->data}\n";
            $currentNode= $currentNode->next;
        }
    }

    public function displayBackward()
    {
        echo "Total Nodes: {$this->totalNodes}\n";
        $currentNode= $this->lastNode;
        while($currentNode !== null){
            echo "{$currentNode->data}\n";
            $currentNode= $currentNode->prev;
        }
    }
}