<?php
class StringUntils
{
    public $string;

    public function __construct($str)
    {
        $this->string = $str;
    }

    # oneTwoThreeFour => ['one','Two','Three','Four']
    public static function explodeCamelcase($string)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $string, $matches);
        return $matches[0];
    }

    # 'one-two-three-four', 'one_two_three_four' => 'OneTwoThreeFour'
    public static function toCamelCase($string)
    {
        # dashes
        $string = str_replace('-', ' ', $string);
        # undescore
        $string = str_replace('_', ' ', $string);

        return str_replace(' ', '', ucwords($string));
    }

    public static function camelCaseToUnderscore($string)
    {
        $arr = StringUntils::explodeCamelcase($string);
        foreach ($arr as &$word)
            $word = strtolower($word);

        return implode('_',$arr);
    }

    # "spec/models/users_test.php" => UsersTest
    # "spec/models/UsersTest.php" => UsersTest
    public static function fileNameFormPathToClass($string)
    {
        $file_name = pathinfo($string)['filename'];
        return StringUntils::toCamelCase($file_name);
    }

    public function isInclude($text)
    {
        if (strpos($this->string, $text) !== false) {
            return true;
        }
        return false;
    }

    # „UTASZ-SPEED” Sp. z o.o. => utaszspeedspzoo
    public static function transliterate($string)
    {
        $transliterator = Transliterator::createFromRules(':: Any-Latin; :: Latin-ASCII; :: [:Punctuation:] Remove;');
        $normalized = $transliterator->transliterate($string);
        $normalized = strtolower($normalized);
        $normalized = preg_replace('/[^a-z0-9_]/', '', $normalized);
        return $normalized;
    }

    public static function getRandomString($length)
    {
        // start with an empty random string
        $random_string = "";
        $valid_chars = 'qwertyuiopasdfghjklzxcvbnm'; 
        // count the number of chars in the valid chars string so we know how many choices we have
        $num_valid_chars = strlen($valid_chars);

        // repeat the steps until we've created a string of the right length
        for ($i = 0; $i < $length; $i++)
        {
            // pick a random number from 1 up to the number of valid chars
            $random_pick = mt_rand(1, $num_valid_chars);

            // take the random character out of the string of valid chars
            // subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
            $random_char = $valid_chars[$random_pick-1];

            // add the randomly-chosen char onto the end of our string so far
            $random_string .= $random_char;
        }

        // return our finished random string
        return $random_string;
    }

    public static function getRandomNumber($length)
    {
        // start with an empty random string
        $random_number = "";
        $valid_chars = '1234567890'; 
        // count the number of chars in the valid chars string so we know how many choices we have
        $num_valid_chars = strlen($valid_chars);

        // repeat the steps until we've created a string of the right length
        for ($i = 0; $i < $length; $i++)
        {
            // pick a random number from 1 up to the number of valid chars
            $random_pick = mt_rand(1, $num_valid_chars);

            // take the random character out of the string of valid chars
            // subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
            $random_char = $valid_chars[$random_pick-1];

            // add the randomly-chosen char onto the end of our string so far
            $random_number .= $random_char;
        }

        // return our finished random string
        return $random_number;
    }

    public static function replacePolishChars($string)
    {
        $polish_chars = array( 'Ę', 'Ó', 'Ą', 'Ś', 'Ł', 'Ż', 'Ź', 'Ć', 'Ń', 'ę', 'ó', 'ą', 
                'ś', 'ł', 'ż', 'ź', 'ć', 'ń' );
        $replacePolishChars = array( 'E', 'O', 'A', 'S', 'L', 'Z', 'Z', 'C', 'N', 'e', 'o', 'a', 
                's', 'l', 'z', 'z', 'c', 'n' );

        $string = str_replace($polish_chars, $replacePolishChars, $string);

        return $string;
    }

    public static function replaceSpecialChars($string)
    {
        $string = preg_replace("/[^A-Za-z0-9 ]/", '', $string);
        return $string;
    }

    public static function truncate($string, $lenght)
    {
        $string = $string." ";
        $string = substr($string, 0, $lenght);
        if (strlen($string) == $lenght) {
            $string = $string."...";
        }
        $string = nl2br($string);
        return $string;
    }

    public static function truncateAfterLines($string, $lines)
    {
        $string_arr = explode("\n", $string);

        if (count($string_arr) >= $lines) {

            $string = "";
            for ($i=0; $i < $lines; $i++) { 

                if ($i == $lines - 1) {
                    $string = $string.rtrim($string_arr[$i]);
                    $string = $string."...";
                } else {
                    $string = $string.$string_arr[$i];
                }
            }
        }
        $string = nl2br($string);

        return $string;
    }
}
