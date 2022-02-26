<?php
namespace Src\LinkedList;

class ItemNode
{
    public $data= null;
    public $next= null;
    public $prev= null;

    public function __construct(string $data=null)
    {
        $this->data= $data;
    }
}