<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Src\LinkedList\ItemListLinear;
use Src\LinkedList\ItemListCircular;
use Src\LinkedList\ItemListDouble;

$books= new ItemListLinear();
$otherBooks= new ItemListCircular();
$booksAgain= new ItemListDouble();

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

$books->displayBackward();

$books->display();

foreach($books as $book){
    echo $book . "\n";
}

for($books->rewind(); $books->valid(); $books->next()){
    echo $books->current() . "\n";
}

$books->search('Angels and Demons');

$otherBooks->insert('Think and Grow Rich');
$otherBooks->insert('Rich Dad, Poor Dad');

$otherBooks->display();

$booksAgain->insertAtFirst('PHP 7 DSAs');
$booksAgain->insert('Computer Science Distilled');
$booksAgain->insert('Laravel Up and Running');
$booksAgain->insertBefore('PHP 7 DSAs', 'Laravel Up and Running');
$booksAgain->insertAfter('Headfirst PHP', 'Laravel Up and Running');

$booksAgain->search('PHP 7 DSAs');
$booksAgain->getNthNode(2);
$booksAgain->delete('Computer Science Distilled');

$booksAgain->displayBackward();

$splBooks= new SplDoublyLinkedList();

$splBooks->push('Laravel Up and Running');
$splBooks->push('PHP 7 DSAs');
$splBooks->push('Computer Science Distilled');
$splBooks->add(2, 'PHP Pandas');

for($splBooks->rewind(); $splBooks->valid();$splBooks->next()){
    echo "{$splBooks->current()}\n";
}