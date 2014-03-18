<?
	//print_r($_DATA);
	
	$this->layout->info('js', 'hot-or-not.js');
?>


<?  
	echo $this->layout->common('zoopla-search-menu', $_DATA);
	echo $this->layout->common('hot-or-not/board', $_DATA); 
?>
