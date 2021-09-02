<?php

namespace App\Service;

use Symfony\Component\Validator\Constraints\Length;

class Censurator{

    public function purify($string){
        // la liste des insultes
        $bad_words = array(
            "/con(ne)?/",
            "/(l')?idiot(e)?/",
            "/débile/",
            "/bête/"
        );
        // old c'est une variable temp
        $old = $string;
        // la taille de la chaine de car
        $size_str = strlen($old);
        // parcourir la liste des insultes
        foreach($bad_words as $bad_word){
            // checker chaque insulte si sa se trouve dans la chaine et 
            // elle envoie la liste des corsspendance avec l'index de mot dans la chaine
            if(preg_match_all($bad_word,$string,$matches,PREG_OFFSET_CAPTURE)){
                // parcourir la liste des corspendance
                foreach($matches[0] as $val){
                    // le mot dans la chaine qui corspend à m'insulte 
                    $word = $val[0];
                    // l'indice de l'insulte dans la chaine 
                    $index = $val[1];
                    // l'indice de derniere lettre de mot + 1
                    $lastIndex = $index + strlen($word);     
                    // la condition avant de remplacer l'insulte avec des "*"               
                    if(
                        ( $index==0 || $old[$index-1]==" ") 
                        &&
                        ( 
                           $lastIndex == $size_str || 
                          (
                              $lastIndex < $size_str && $old[$lastIndex]== " " 
                          )  
                        )
                    ){
                        // parcourir l'insulte dans la chaine et remplacer par "*"
                        for($i=$index;$i<$lastIndex;$i++){
                            $old[$i]="*";
                        }
                    }
                }
            }           
        }
        
        return  $old;
    }

}