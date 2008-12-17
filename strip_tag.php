<?php
preg_match_all('/(<object.*?<\/object>)/si', '<object width="400" height="225">
    <param name="allowfullscreen" value="true" />
    <param name="allowscriptaccess" value="always" />
    <param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=1635766&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1" />
    <embed src="http://vimeo.com/moogaloop.swf?clip_id=1635766&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="400" height="225"></embed>
</object>
<br /><a href="http://vimeo.com/1635766">Twin Peaks San Francisco Sunrise (HDR time-lapse)</a> from <a href="http://vimeo.com/timetraveler">Chad Richard</a> on <a href="http://vimeo.com">Vimeo</a>.', $matches);


print_r($matches[1]);
?>

