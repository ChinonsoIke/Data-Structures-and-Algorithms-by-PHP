<?php

namespace Src\LinkedList;

use Iterator;

abstract class Base implements Iterator
{
    private $_currentNode= null;
    private $_currentPosition= 0;

    protected $firstNode= null;
    protected $totalNodes= 0;

    abstract public function insert(string $data=null);

    abstract public function insertAtFirst(string $data=null);

    abstract public function insertBefore(string $data=null, string $query=null);

    abstract public function insertAfter(string $data=null, string $query=null);

    abstract public function deleteFirst();

    abstract public function deleteLast();

    abstract public function delete(string $query);

    abstract public function getNthNode(int $n);
    
    abstract public function display();

    abstract public function displayBackward();

    abstract public function search(string $query=null);

    public function current()
    {
        return $this->_currentNode->data;
    }

    public function next(): void
    {
        $this->_currentPosition++;
        $this->_currentNode= $this->_currentNode->next;
    }

    public function key()
    {
        return $this->_currentPosition;
    }

    public function rewind(): void
    {
        $this->_currentPosition= 0;
        $this->_currentNode= $this->firstNode;
    }

    public function valid(): bool
    {
        return $this->_currentNode !== null;
    }
}