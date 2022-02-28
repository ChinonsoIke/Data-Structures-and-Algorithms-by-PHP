<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Src\LinkedList\ItemListLinear;
use Src\LinkedList\ItemListCircular;
use Src\LinkedList\ItemListDouble;

echo "\n-------------------LINEAR LINKED LIST-------------------\n";
$books= new ItemListLinear();

$books->insert('Percy Jackson: Lightening Thief');
$books->insert('Angels and Demons');
$books->insert('Twilight Eclipse');

$books->insertAtFirst('A Song of Ice and Fire');
$books->insertBefore('The Hobbit','Twilight Eclipse');
$books->insertAfter('Digital Fortress','Angels and Demons');

$books->deleteFirst();
$books->deleteLast();
$books->delete('Angels and Demons');

$books->getNthNode(2);

$books->reverse();

$books->display();

foreach($books as $book){
    echo $book . "\n";
}

for($books->rewind(); $books->valid(); $books->next()){
    echo $books->current() . "\n";
}

$books->search('Angels and Demons');


echo "\n-------------------DOUBLY LINKED LIST-------------------\n";
$booksAgain= new ItemListDouble();
$booksAgain->insertAtFirst('PHP 7 DSAs');
$booksAgain->insert('Computer Science Distilled');
$booksAgain->insert('Laravel Up and Running');
$booksAgain->insertBefore('PHP 7 DSAs', 'Laravel Up and Running');
$booksAgain->insertAfter('Headfirst PHP', 'Laravel Up and Running');

$booksAgain->search('PHP 7 DSAs');
$booksAgain->getNthNode(2);
$booksAgain->delete('Computer Science Distilled');

$booksAgain->displayBackward();

echo "\n-------------------SPL DOUBLY LINKED LIST-------------------\n";
$splBooks= new SplDoublyLinkedList();

$splBooks->push('Laravel Up and Running');
$splBooks->push('PHP 7 DSAs');
$splBooks->push('Computer Science Distilled');
$splBooks->add(2, 'PHP Pandas');

for($splBooks->rewind(); $splBooks->valid();$splBooks->next()){
    echo "{$splBooks->current()}\n";
}

echo "\n-------------------CIRCULAR LINKED LIST-------------------\n";
$countries= new ItemListCircular();

$countries->insert('Nigeria');
$countries->insert('Togo');
$countries->insert('Brazil');
$countries->insertAtFirst('Angola');
$countries->insertBefore('Mali', 'Nigeria');
$countries->insertAfter('Wales', 'Brazil');
$countries->insert('Canada');

$countries->deleteFirst();
$countries->deleteLast();
$countries->delete('Wales');

$countries->getNthNode(4);
$countries->search('Mali');

$countries->reverse();
$countries->display();