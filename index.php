<?php

	class JaccardDistance {

		private function buffer($str){

			$str = mb_strtolower($str, 'UTF-8');

			$str = str_replace(
				array('ı', 'ş', 'ü', 'ğ', 'ç', 'ö'),
				array('i', 's', 'u', 'g', 'c', 'o'),
				$str
			);

			$str = preg_replace('/[^a-z0-9]/', '-', $str);
			$str = preg_replace('/-+/', '-', $str);

			$str = trim($str, '-');

			return $str;

		}

		public function calculateDistance($text1, $text2){

			$text1 = explode('-', $this->buffer($text1));
			$text2 = explode('-', $this->buffer($text2));

			$shared = array_intersect($text1, $text2);
			$unique = array_unique(array_merge($text1, $text2));

			return 1 - ( count($shared) / count($unique) );

		}

	}

	$jaccardDistance = new JaccardDistance();

	## Birebir aynı metinler arasındaki uzaklık 0 olmalıdır.

	$text1 = 'Kayseri çok güzel bir şehirdir.';
	$text2 = 'Kayseri çok güzel bir şehirdir.';

	echo $jaccardDistance->calculateDistance($text1, $text2);

	## Birbirinden alakasız metinler arasındaki uzaklık 1 olmalıdır.

	$text1 = 'Kayseri çok güzel bir şehirdir.';
	$text2 = 'Arabaların tekerlekleri vardır.';

	echo $jaccardDistance->calculateDistance($text1, $text2);

	## Normal metinler arası uzaklık 0 ile 1 arasında olmalıdır.

	$text1 = 'Çanakkale bölgesinde sütlü dondurma yemeyi çok severim.';
	$text2 = 'Akdeniz bölgesinde çok muzlu dondurma olur.';

	echo $jaccardDistance->calculateDistance($text1, $text2);

?>