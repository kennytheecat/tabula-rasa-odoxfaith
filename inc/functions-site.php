<?php
/*****SHORTCODES******/
// Scripture Bubble 
function scrip( $atts, $content = null ) {  
    extract(shortcode_atts(array(  
        "ref" => ''  
    ), $atts)); 
	return '
	<div class="scrip_container_wrap">
	<div class="scrip_container">
		<div class="top_ref"> ' . $ref . '</div>
		<div class="scrip_bubble bubble">'.$content.'</div>
	</div>
			<span class="shadow-left"></span><span class="shadow-right"></span>
	</div>';  
}
add_shortcode("scrip", "scrip");

function qt( $atts, $content = null ) {   
	return '
	<div class="quote_container">
		<div class="quote_bubble">'.$content.'</div>
	</div>';  
}
add_shortcode("qt", "qt");

function amazon( $atts ) {  
    extract(shortcode_atts(array(  
        "isbn" => ''  
    ), $atts)); 
	return '</pre>
"<script type=\'text/javascript\'>
<!--
var amzn_wdgt={widget:\'MyFavorites\'};
amzn_wdgt.tag=\'rv0f-20\';
amzn_wdgt.columns=\'1\';
amzn_wdgt.rows=\'3\';
amzn_wdgt.title=\'Henri-Cartier-Bresson: Photographer Extraordinaire\';
amzn_wdgt.width=\'250\';
amzn_wdgt.ASIN=\'' . $isbn . '\';
amzn_wdgt.showImage=\'True\';
amzn_wdgt.showPrice=\'True\';
amzn_wdgt.showRating=\'True\';
amzn_wdgt.design=\'2\';
amzn_wdgt.colorTheme=\'Orange\';
amzn_wdgt.headerTextColor=\'#FFFFFF\';
amzn_wdgt.marketPlace=\'US\';
</script>"
"<script type=\'text/javascript\' src=\'http://wms.assoc-amazon.com/20070822/US/js/AmazonWidgets.js\'>
</script>//-->"
<pre>';
}
add_shortcode("amazon", "amazon");
?>