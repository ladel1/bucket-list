<?php

namespace App\Service;

use Symfony\Component\Validator\Constraints\Length;

class Censurator{

    public function purify($string){
        $bad_words = array(
            "/con/",
            "/idiot/",
            "/débile/",
            "/bête/"
        );
        // $my_str = explode(" ",$string);
        //$filtered=str_ireplace($bad_words,"***",$my_str);
        // return implode(" ", $filtered);
        $old = $string;
        foreach($bad_words as $bad_word){
            preg_match($bad_word,$string,$matches,PREG_OFFSET_CAPTURE);
            if(count($matches)>0){                
                $word = $matches[0][0];
                $index = $matches[0][1]; 
                $lastIndex = $index+strlen($word); 

                if( $old[$lastIndex]==" "){///<------------
                    dump("aaa");
                    for($i = $index;$i<$lastIndex;$i++){
                        if($old[$i]==" "){
                            break;
                        }
                        $old[$i]="*";
                    }            
                }  
            }
        }
        // $old=str_ireplace($bad_word,str_repeat("*", strlen($word)),$old);
        return  $old;
    }

}