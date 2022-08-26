<?php

// Exercise 1
function fibonacci($numFib){
  
  $num1 = 0;
  $num2 = 1;
  $count = 0;
  
  echo 'Fibonacci de '.$numFib.':';
  
  while ($count <= $numFib){
    
      echo ' '.$num1;
      
      $num3 = $num2 + $num1;
      $num1 = $num2;
      $num2 = $num3;
      
      $count = $count + 1;
  }
}

// Exercise 2
function invertString($string){

  $position = 0;
  $reverse = '';
  $notEmpty = true;
  
  while($notEmpty){ 
    
    $reverse = $string[$position].$reverse; 
    $position++;
    
    if(empty($string[$position])){
      $notEmpty = false;
    }
  }
  
  echo 'Inverso de '.$string.': '.$reverse;
  
}

// Exercise 3
function multiply($num1, $num2){
  
  $accumulator = 0;
  $count = 0;
  
  while ($count < $num2){
      
      $accumulator = $accumulator + $num1;
      $count = $count + 1;

  }
      echo 'Multiplicación de '.$num1.'x'.$num2.': '.$accumulator;
}

// Exercise 4
function sumPrimeNumbers($arr){
  
  $accumulator = 0;
  $lengthArr = count($arr);
  $position = 0;
  
  while($position < $lengthArr){
    
    if(isPrime($arr[$position]) == true){
      
      $accumulator = $accumulator + $arr[$position];
    }
    
    $position = $position + 1;
    
  }
  
  
  echo 'Suma de Primos: '.$accumulator."\n";  
  
}

function isPrime($num){
  
  $count = 0;  
  
  for ($i=1; $i <= $num; $i++){ 
    
    if (($num % $i)==0){  
      $count++;  
    }  
  }
  
  if ($count <= 2){  
    return true;  
  }
  else{
    return false; 
  }
  
}

function jump(){
  
  echo "\n";
  echo "\n";
}

  
function main(){
  
  //Exercise 1
  echo 'Ejercicio 1'."\n";
  
  $n = 13;
  fibonacci($n);

  jump();
  
  //Exercise 2
  echo 'Ejercicio 2'."\n";
  
  $string = "Hola JC";
  invertString($string);
  
  jump();
  
  //Exercise 3
  echo 'Ejercicio 3'."\n";
  
  $n1 = 4;
  $n2 = 6;
  multiply($n1, $n2);
  
  jump();
  
  //Exercise 4
  echo 'Ejercicio 4'."\n";
  
  $arr = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100);
  sumPrimeNumbers($arr);
  
}

main();

?>
