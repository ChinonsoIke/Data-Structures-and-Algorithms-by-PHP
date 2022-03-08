<?php

namespace Src\Queue;

interface QueueInterface
{
    public function enqueue(string $data);

    public function dequeue();

    public function peek();

    public function isEmpty();
}