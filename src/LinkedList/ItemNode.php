<?php
namespace Src\LinkedList;

class ItemNode
{
    public $data= null;
    public $next= null;
    public $prev= null;
    public $priority= null;

    public function __construct(string $data=null, int $priority= null)
    {
        $this->data= $data;
        $this->priority= $priority;
    }
}