<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Lizhichao\Word\VicWord;
use TeamTNT\TNTSearch\Support\TokenizerInterface;

/**
 * 名词分词器
 * 
 */
class NameTokenizer implements TokenizerInterface
{
    private $word;

    public function __construct()
    {
        $this->word = new VicWord('json');
    }

    public function tokenize($text, $stopwords = null)
    {
        $words = $this->word->getAutoWord($text);
        return array_column($words, 0);
    }
}

/**
 * 号码分词器
 * 
 */
class NumberTokenizer implements TokenizerInterface
{
    public function tokenize($text, $stopwords = null)
    {
        $count = preg_match_all('/\d/u', $text, $matches);
        $items = $matches[0];
        $words = [];
        for ($i = 1; $i <= $count; ++$i) {
            $end = $count - $i;
            for ($j = 0; $j <= $end; ++$j) {
                $word = array_slice($items, $j, $i);
                $words[] = join($word);
            }
        }
        return $words;
    }
}
