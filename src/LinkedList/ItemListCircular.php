<?php

namespace Src\LinkedList;


class ItemListCircular extends Base
{
    private $lastNode= null;

    public function insert(string $data=null)
    {
        $newNode= new ItemNode($data);

        // check if first node is empty
        if($this->firstNode === null){
            $this->firstNode= &$newNode;
            $this->lastNode= $this->firstNode;
        }else{
            $this->lastNode->next= $newNode;
            $this->lastNode= $newNode;
        }
        $this->lastNode->next= $this->firstNode;
        $this->totalNodes++;
        return true;
    }

    public function insertAtFirst(string $data = null)
    {
        $newNode= new ItemNode($data);

        // check if list is empty
        if($this->firstNode === null){
            $this->firstNode = &$newNode;
            $newNode->next= $this->firstNode;
            $this->lastNode= $this->firstNode;
        }else{
            $currentFirstNode= $this->firstNode;
            $this->firstNode = &$newNode;
            $newNode->next= $currentFirstNode;

            $this->lastNode->next= $this->firstNode;
        }
        $this->totalNodes++;
        return true;
    }

    public function insertAfter(?string $data = null, ?string $query = null)
    {
        $newNode= new ItemNode($data);

        // make sure list is not empty
        if(is_null($this->firstNode)) return false;
        else{
            $currentNode= $this->firstNode;
            while(!is_null($currentNode) && $currentNode->next !== $this->firstNode){
                if($currentNode->data === $query){
                    $next= $currentNode->next;
                    $currentNode->next= $newNode;
                    $newNode->next= $next;

                    $this->totalNodes++;
                    break;
                }
                $currentNode= $currentNode->next;
            }

            if($currentNode->next === $this->firstNode && $currentNode->data === $query){
                $currentLastNode= $this->lastNode;
                $currentLastNode->next= $newNode;
                $this->lastNode= $newNode;
                $newNode->next= $this->firstNode;

                $this->totalNodes++;
            }
            return true;
        }
    }

    public function insertBefore(?string $data = null, ?string $query = null)
    {
        $newNode= new ItemNode($data);

        // make sure list is not empty
        if(!is_null($this->firstNode)){
            $currentNode= $this->firstNode;
            $prev= null;

            while(!is_null($currentNode) && $currentNode->next !== $this->firstNode){
                // var_dump($this);exit;
                if($currentNode->data === $query){
                    if(!is_null($prev)){
                        $prev->next= $newNode;
                        $newNode->next= $currentNode;
                    }else{
                        $prev= $this->firstNode;
                        $this->firstNode= &$newNode;
                        $newNode->next= $prev;
                        $this->lastNode->next= $this->firstNode;
                    }

                    $this->totalNodes++;
                    break;
                }
                $prev= $currentNode;
                $currentNode= $currentNode->next;
            }

            if($currentNode->next === $this->firstNode && $currentNode->data === $query){
                if($currentNode === $this->firstNode){
                    $this->insertAtFirst($data);
                    // $prev->next= $newNode;
                    // $newNode->next= $currentNode;
                }else{
                    $prev->next= $newNode;
                    $newNode->next= $currentNode;

                    $this->totalNodes++;
                }
            }
            return true;
        }
    }

    public function deleteFirst()
    {
        // make sure list is not empty
        if(!is_null($this->firstNode)){
            $this->firstNode= $this->firstNode->next;
            $this->lastNode->next= $this->firstNode;

            $this->totalNodes--;
            return true;
        }
        return false;
    }

    public function deleteLast()
    {
        if(!is_null($this->firstNode)){
            $currentNode= $this->firstNode;
            $prev= null;

            while($currentNode->next !== $this->firstNode){
                $prev= $currentNode;
                $currentNode= $currentNode->next;
            }
            $prev->next= $this->firstNode;
            $this->lastNode= $prev;
            $this->totalNodes--;
            return true;
        }
        return false;
    }

    public function delete(string $query)
    {
        if(!is_null($this->firstNode)){
            $currentNode= $this->firstNode;
            $prev= null;

            while(!is_null($currentNode->next) && $currentNode->next !== $this->firstNode){
                if($currentNode->data === $query){
                    $next= $currentNode->next;
                    if(!is_null($prev)){
                        $prev->next= $next;
                    }else{
                        $this->firstNode= $currentNode->next;
                        $this->lastNode->next= $this->firstNode;
                    }

                    $this->totalNodes--;
                    return true;
                }
                $prev= $currentNode;
                $currentNode= $currentNode->next;
            }

            if($currentNode->next === $this->firstNode && $currentNode->data === $query){
                if($currentNode === $this->firstNode){
                    $this->firstNode= $this->firstNode->next;
                    $this->lastNode= $this->firstNode;
                }else{
                    $this->lastNode= $prev;
                    $this->lastNode->next= $this->firstNode;
                }
                $this->totalNodes--;
            }
        }
        return false;
    }

    public function getNthNode(int $n)
    {
        $count= 1;

        if(!is_null($this->firstNode)){
            $currentNode= $this->firstNode;
            while(!is_null($currentNode) && $currentNode->next !== $this->firstNode){
                if($count === $n){
                    echo "\nNth Node Search Result: {$currentNode->data}\n";
                    return true;
                }
                $count++;
                $currentNode= $currentNode->next;
            }

            if($count === $n){
                echo "\nNth Node Search Result: {$currentNode->data}\n";
                return true;
            }
        }
        return false;
    }

    public function display()
    {
        // var_dump($this);
        //     exit;
        echo "\nTotal Items: {$this->totalNodes}\n";
        $currentNode= $this->firstNode;

        while(!is_null($currentNode) && $currentNode->next !== $this->firstNode){
            echo "{$currentNode->data}\n";
            $currentNode= $currentNode->next;
        }
        if($currentNode){
            echo "{$currentNode->data}\n";
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
                while($currentNode->next !== $this->firstNode){
                    $nextNode= $currentNode->next;
                    $currentNode->next= $previousNode;
                    $previousNode= $currentNode;
                    $currentNode= $nextNode;
                }
                $this->firstNode= $previousNode;
            }
        }
    }

    public function search(?string $query = null)
    {
        if(!is_null($this->firstNode)){
            $currentNode= $this->firstNode;
            while(!is_null($currentNode) && $currentNode->next !== $this->firstNode){
                if($currentNode->data === $query){
                    echo "Search Result: {$currentNode->data}\n";
                    return true;
                }
                $currentNode= $currentNode->next;
            }

            if($currentNode->data === $query){
                echo "Search Result: {$currentNode->data}\n";
                return true;
            }
        }
        return false;
    }
}