<?php

class Combinations
{
    private $string;
    private $length;
    private $combinationsCount;
    public function __construct($string, $length)
    {
        $this->string = $string;
        $this->length = $length;
        $this->combinationsCount = 0;
        try{
            $this->comb($this->string, $this->length, '', 0);
            //if($this->length > 1){
            //    $this->comb(strrev($this->string), $this->length, '');
            //}
            $this->check();
        } catch (\Exception $e){
            echo $e->getMessage();
            exit;
        }
        
        
    }

    private function comb($string, $count, $combination, $digitNumber){
        if($count > strlen($string) or $count < 0){
            throw new \Exception('false length');
        }

        if($count == 0){
            echo $combination . PHP_EOL;
            $this->combinationsCount++;
            return;
        }
    
        $digit = $string[$digitNumber];
        if($digitNumber < strlen($string) - 1){
            $this->comb($string, $count, $combination, $digitNumber + 1);
        }
        $string = substr_replace($string, '', $digitNumber, 1);
        $combination .= $digit;
        $this->comb($string, $count - 1, $combination, 0);
    }

    private function check()
    {
        $strLength = strlen($this->string);
        echo ($this->fact($strLength) / ($this->fact($strLength - $this->length))). PHP_EOL;
        if($this->combinationsCount != $this->fact($strLength) / ($this->fact($strLength - $this->length))){
            throw new \Exception('bad calculating');
        }

    }

    private function fact($number)
    {
        return $number ? $number * $this->fact($number - 1) : 1;
    }
}

new Combinations($argv[1], $argv[2]);