<?php

$players = [];
$players[] = ["Name" => "Ronaldo", "Age" => 31, "Country" => "Portugal", "Team"
=> "Real Madrid"];
$players[] = ["Name" => "Messi", "Age" => 27, "Country" => "Argentina", "Team" =>
"Barcelona"];
$players[] = ["Name" => "Neymar", "Age" => 24, "Country" => "Brazil", "Team" =>
"Barcelona"];
$players[] = ["Name" => "Rooney", "Age" => 30, "Country" => "England", "Team" =>
"Man United"];

foreach($players as $player){
    foreach($player as $key=>$value){
        echo "{$key}: {$value}\n"; 
    }
    echo "\n";
}

//

$start= memory_get_usage();
$graph = [];
$nodes = ['A', 'B', 'C', 'D', 'E'];

foreach($nodes as $xNode){
    foreach($nodes as $yNode){
        $graph[$xNode][$yNode]= 0;
    }
}

foreach($nodes as $xNode){
    foreach($nodes as $yNode){
        echo $graph[$xNode][$yNode] . "\t";
    }
    echo "\n";
}

$end= memory_get_usage();
echo "{$start} and {$end} \n";
echo $end-$start . "\n";

//

$start= memory_get_usage();
$arr= new SplFixedArray(1000);
for($i=0; $i<count($arr); $i++){
    $arr[$i]= $i;
}
$end= memory_get_usage();
echo ceil(($end-$start) / (1024*1024)) . "MB\n";

//

$array =[1 => 10, 2 => 100, 'emeka' => 1000, 4 => 10000];
print_r($array);
$splArr= SplFixedArray::fromArray($array, false);
$splArr->setSize(10);
$splArr[8]= 1290;
print_r($splArr);

$newArr= $splArr->toArray();
print_r($newArr);

$arr= new SplFixedArray(10);
for($i=0; $i<count($arr); $i++){
    $arr[$i]= new SplFixedArray(30);
    for($j=0; $j<count($arr[$i]); $j++){
        $arr[$i][$j]= $j;
    }
}

print_r($arr);