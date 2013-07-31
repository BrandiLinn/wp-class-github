<?php

/*
Plugin Name: Class AddThis with options
Description: Modification of the Smart Layers plugin from AddThis.com.
*/

function addthis_script() {
	wp_enqueue_script(
		'addthis-script', //script id
		'//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-51f6d46a734d459a' //script url
	);
}

add_action( 'wp_enqueue_scripts', 'addthis_script' ); //adds the script


//Settings converted into PHP? Stored? 
//Don't know how to tell the thing where to look for its settings.
//Can't get share tool to even appear, but enqueue is working. 
//Tool seems to appear in the loaded HTML, but does not display.


/*
<!-- AddThis Smart Layers BEGIN -->
<!-- Go to http://www.addthis.com/get/smart-layers to customize
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-51f6d46a734d459a">//switch for enqueue as soon as I can find an explanation that makes any sense to me
</script> -->
<!--<script type="text/javascript">
  addthis.layers({
    'theme' : 'transparent',
    'share' : {
      'position' : 'left',
      'numPreferredServices' : 5
      //admin panel needs to be able to change 'position' and 'numPreferredServices'
    }   
  });
</script>-->
<!-- AddThis Smart Layers END -->
*/