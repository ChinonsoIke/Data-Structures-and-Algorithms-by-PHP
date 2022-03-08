<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Src\Database;
use Src\LinkedList\ItemListLinear;
use Src\LinkedList\ItemListCircular;
use Src\LinkedList\ItemListDouble;
use Src\Queue\ArrayQueue;
use Src\Queue\LinkedListQueue;
use Src\Stack\ArrayStack;
use Src\Stack\LinkedListStack;

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


echo "\n-------------------ARRAY STACK-------------------\n";
try{
    $crates= new ArrayStack();
    $crates->push('Coca-Cola');
    $crates->push('Pepsi');
    $crates->push('Heineken');
    echo $crates->pop() ."\n";
    echo $crates->pop() ."\n";
    echo $crates->pop() ."\n";
    echo $crates->pop() ."\n";
    echo $crates->top() ."\n";
}catch(Exception $e){
    echo $e->getMessage();
}


echo "\n-------------------LINKED LIST STACK-------------------\n";
try{
    $currencies= new LinkedListStack();
    $currencies->push('Euro');
    $currencies->push('Won');
    $currencies->push('Dollar');
    $currencies->push('Cedi');
    echo $currencies->pop() ."\n";
    echo $currencies->pop() ."\n";
    echo $currencies->top() ."\n";
}catch(Exception $e){
    echo $e->getMessage();
}


echo "\n-------------------SPL STACK-------------------\n";
$shoes= new SplStack();
$shoes->push('Nike');
$shoes->push('Puma');
$shoes->push('Addidas');
echo $shoes->top() ."\n";
echo $shoes->pop() ."\n";

echo "\n-------------------STACK EXAMPLE - EXPRESSION CHECKER-------------------\n";
function checkExp(string $expression) : bool
{
    $valid= true;
    $stack= new SplStack();
    $characters= str_split($expression);
    // var_dump($characters);exit;

    foreach($characters as $char){
        switch($char){
            case '(':
            case '[':
            case '{':
                $stack->push($char);
                break;
            case ')':
            case ']':
            case '}':
                if($stack->isEmpty()){
                    $valid= false;
                }
                else{
                    $last= $stack->pop();
                    if(($char === ")" && $last !== "(")
                        || ($char === "]" && $last !== "[")
                        || ($char === "}" && $last !== "{")){
                            $valid= false;
                        }
                }
                break;
        }

        //if(!$valid) break;
    }

    if(!$stack->isEmpty()) $valid= false;

    return $valid;
}

$expressions = [];
$expressions[] = "8 * (9 -2) + { (4 * 5) / ( 2 * 2) }";
$expressions[] = "([5 * 8 * 9] / ( 3 * 2 ) )";
$expressions[] = "[{ (2 * 7) + ( 15 - 3) ]"; 

foreach($expressions as $exp){
    $valid= checkExp($exp);

    if($valid) echo "Expression is valid \n";
    else{
        echo "Invalid expression \n";
    }
}

echo "\n-------------------ARRAY QUEUE-------------------\n";
try{
    $atmQueue= new ArrayQueue();

    $atmQueue->enqueue('Emeka');
    $atmQueue->enqueue('Tunde');
    $atmQueue->enqueue('Kamaru');
    $atmQueue->enqueue('MF Jones');
    $atmQueue->enqueue('Burna Boy');

    echo "It is now {$atmQueue->dequeue()}'s turn. \n";
    echo "It is now {$atmQueue->dequeue()}'s turn. \n";

    echo "{$atmQueue->peek()} is next in line. \n";
}catch(Exception $e){
    echo $e->getMessage();
}

echo "\n-------------------LINKED LIST QUEUE-------------------\n";

try{
    $shinobiQueue= new LinkedListQueue();

    $shinobiQueue->enqueue('Tsunade');
    $shinobiQueue->enqueue('Orochimaru');
    $shinobiQueue->enqueue('Jiraiya');

    echo "It is now {$shinobiQueue->dequeue()}'s turn. \n";
    echo "It is now {$shinobiQueue->dequeue()}'s turn. \n";

    echo "{$shinobiQueue->peek()} is next in line. \n";
}catch(Exception $e){
    echo $e->getMessage();
}

echo "\n-------------------SPL QUEUE-------------------\n";

$visaQueue= new SplQueue();

$visaQueue->enqueue('Lana');
$visaQueue->enqueue('Frank');
$visaQueue->enqueue('Otunba');

echo "It is now {$visaQueue->dequeue()}'s turn. \n";
echo "It is now {$visaQueue->dequeue()}'s turn. \n";

echo "{$visaQueue->bottom()} is next in line. \n";

echo "\n-------------------PRIORITY QUEUE-------------------\n";

try{
    $uclWinners= new LinkedListQueue();

    $uclWinners->enqueue('Arsenal', 0);
    $uclWinners->enqueue('Everyone else', 1);
    $uclWinners->enqueue('Bayern Munich', 2);
    $uclWinners->enqueue('Chelsea', 3);
    $uclWinners->enqueue('Man City', 2);

    echo "{$uclWinners->dequeue()} will win the UCL this year. \n";

    echo "{$uclWinners->peek()} is next in line to win the UCL. \n";
}catch(Exception $e){
    echo $e->getMessage();
}

echo "\n-------------------UNDERSTANDING RECURSIVE ALGORITHMS-------------------\n";

function factorial(int $n)
{
    if($n===0)
        return 1;
    return $n * factorial($n-1);
}

// echo factorial(10) .PHP_EOL;

function fibonacci(int $n)
{
    if($n === 0) return 1;
    elseif($n === 1) return 1;
    else{
        return fibonacci($n-1) + fibonacci($n-2);
    }
}

// echo fibonacci(4) .PHP_EOL;

function gcd(int $a, int $b) : int
{
    if($b == 0) return $a;
    else return gcd($b, $a % $b);
}

echo gcd(7, 155) .PHP_EOL;

echo "\n-------------------BUILDING AND N-LEVEL CATEGORY TREE USING RECURSION-------------------\n";

$db= new Database();
$db->createCategoriesTable();

$categs= [
    "('First', 0, 0)",
    "('Second', 1, 0)",
    "('Third', 1, 1)",
    "('Fourth', 3, 0)",
    "('Fifth', 4, 0)",
    "('Sixth', 5, 0)",
    "('Seventh', 6, 0)",
    "('Eighth', 7, 0)",
    "('Ninth', 1,0)",
    "('Tenth', 2, 1)"
];

// echo $db->insertCategories($categs);

$result = $db->pdo->query("Select * from categories order by parentCategory asc,
sortInd asc", PDO::FETCH_OBJ);
// var_dump($result);

$categories = [];
foreach($result as $row) {
 $categories[$row->parentCategory][] = $row;
}
// var_dump($categories);exit;

function showCategoryTree(array $categories, int $n)
{
    if(isset($categories[$n])){
        foreach($categories[$n] as $category){
            echo str_repeat('-', $n) . "" . $category->categoryName . PHP_EOL;
            showCategoryTree($categories, $category->id);
        }
    }

    return;
}

showCategoryTree($categories, 0);

// $db->createCommentsTable();

$inserts= [
    "('First comment', 'Emeka', 0, 1)",
    "('First reply', 'Chuks', 1, 1)",
    "('Reply of first reply', 'Khabib', 2, 1)",
    "('Reply of reply of first reply', 'Kratos', 3, 1)",
    "('Reply of reply of reply of first reply', 'James', 4, 1)",
    "('Second comment', 'MF Jones', 0, 1)",
    "('First comment of second post', 'Emeka', 0, 2)",
    "('Third comment', 'Musa', 0, 1)",
    "('Second comment of second post', 'Janet', 0, 2)",
    "('Reply of second comment of second post', 'Andrew', 9, 2)"
];

// echo $db->insertComments($inserts);

$sql = "Select * from comments where postID = :postID order by parentID asc,
created_at asc";
$stmt = $db->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute(array(':postID' => 1));
$result = $stmt->fetchAll(); 

// var_dump($result);

$comments= [];

foreach($result as $row){
    $comments[$row->parentId][]= $row;
}

function showCommentTree(array $comments, int $n)
{
    if(isset($comments[$n])){
        $str = "<ul>"; 
        foreach($comments[$n] as $comment){
            $str .= "<li><div class='comment'><span class='pic'>
                {$comment->username}</span>";
            $str .= "<span class='datetime'>{$comment->created_at}</span>";
            $str .= "<span class='commenttext'>" . $comment->comments . "
                </span></div>";

            $str .= showCommentTree($comments, $comment->id);
            $str .= "</li>";
        }
        $str .= "</ul>";
        return $str;
    }

    return '';
}

echo showCommentTree($comments, 0);

echo "\n-------------------FINDING FILES AND DIRECTORIES USING RECURSION-------------------\n";

function showFiles(string $dirName, array &$allFiles)
{
    $files= scandir($dirName);

    foreach($files as $key=>$value){
        $path= realpath($dirName . "/" . $value);

        if(!is_dir($path)){
            $allFiles[]= $path;
        }elseif($value != '.' && $value != '..'){
            $allFiles[]= $path;
            showFiles($path, $allFiles);
        }
    }

    return;
}

$files= [];

showFiles('../', $files);

foreach($files as $file){
    echo $file . PHP_EOL;
}

