<?

function translate_and_space_rep($str) {
    return space_replace(translate($str));
}

echo translate_and_space_rep('Мама МыЛа Раму!');









function translate($str) {

    $alfabet = [
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya'
        ];
    
        $result = '';
    
        for ($i = 0; $i < mb_strlen($str); $i++) {
    
            $letter = mb_substr($str, $i, 1);
    
            if (!isset($alfabet[$letter])){
                $letter = mb_strtolower($letter);
                $cap = true;
            } 
    
            $translated = str_replace(
                $letter, 1, $alfabet[$letter]
            );
            
            $replace = $alfabet[$letter];
    
            if ($replace) {
    
                if($cap) {
                    $replace = mb_strtoupper($replace);
                    $cap = false;
                }
        
                $result .= str_replace(
                    $letter, 1, $replace
                );        
    
            } else {
                $result .= $letter;
            }
    
        }
               
        return $result;
}


function space_replace($str) {
    return str_replace(' ', '_', $str);
}