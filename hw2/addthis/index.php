<?php

/*
Plugin Name: AddThis with options
Description: Modification of the Smart Layers plugin from AddThis.com.
*/

function my_scripts_method() {
	wp_enqueue_script(
		'addthis-script',
		'//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-51f6d46a734d459a'
	);
}

?>

<!-- AddThis Smart Layers BEGIN -->
<!-- Go to http://www.addthis.com/get/smart-layers to customize -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-51f6d46a734d459a">//switch for enqueue as soos as I can find an explanation that makes any sense to me
</script> -->
<script type="text/javascript">
  addthis.layers({
    'theme' : 'transparent',
    'share' : {
      'position' : 'left',
      'numPreferredServices' : 5
      //admin panel needs to be able to change 'position' and 'numPreferredServices'
    }   
  });
</script>
<!-- AddThis Smart Layers END -->

<?php