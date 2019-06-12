# Jaccard Distance PHP

Gives the number of times whether two sentences are similar or not.

[Related document](https://github.com/ugurdalkiran/Jaccard-Distance-PHP/blob/master/jaccardDistance.pdf)

```php
public function calculateDistance($text1, $text2){

	$text1 = explode('-', $this->buffer($text1));
	$text2 = explode('-', $this->buffer($text2));

	$shared = array_intersect($text1, $text2);
	$unique = array_unique(array_merge($text1, $text2));

	return 1 - ( count($shared) / count($unique) );

}
```

All values ​​are between 0 and 1.
