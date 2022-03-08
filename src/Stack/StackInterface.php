<?php

namespace Src\Stack;

interface StackInterface
{
    public function push(string $data);

    public function pop();

    public function top();

    public function isEmpty();
}