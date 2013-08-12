<!DOCTYPE html>
<html>
<!--
   This is a jQuery Tools standalone demo. Feel free to copy/paste.
   http://flowplayer.org/tools/demos/

   Do *not* reference CSS files and images from flowplayer.org when in
   production Enjoy!
-->
<head>
  <title>jQuery Tools standalone demo</title>

    <!-- include the Tools -->
  <script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
  
  <!-- standalone page styling (can be removed) -->
  <link rel="shortcut icon" href="http://jquerytools.org/media/img/favicon.ico">

<style>
.scrollable {
  /* required settings */
  position:relative;
  overflow:hidden;
  width: 660px;
  height:90px;
}
.scrollable .items {
  /* this cannot be too large */
  width:20000em;
  position:absolute;
}
.items div {
  float:left;
}

.scrollable img {
  width:100px;
  margin:20px 5px 20px 21px;
}

.scrollable img.hover {
  background-color:#123;
}

</style>
</head>
<body>
<!-- wrapper for navigator elements -->
<div class="navi"></div>

<div style="margin:0 auto; width: 634px; height:120px;">
<!-- "previous page" action -->
<a class="prev browse left"></a>

<!-- root element for scrollable -->
<div class="scrollable" id="chained">

  <!-- root element for the items -->
  <div class="items">

    <!-- 1-5 -->
    <div>
      <img src="http://farm1.static.flickr.com/143/321464099_a7cfcb95cf_t.jpg" />
      <img src="http://farm4.static.flickr.com/3089/2796719087_c3ee89a730_t.jpg" />
      <img src="http://farm1.static.flickr.com/79/244441862_08ec9b6b49_t.jpg" />
      <img src="http://farm1.static.flickr.com/28/66523124_b468cf4978_t.jpg" />
    </div>

    <!-- 5-10 -->
    <div>
      <img src="http://farm1.static.flickr.com/163/399223609_db47d35b7c_t.jpg" />
      <img src="http://farm1.static.flickr.com/135/321464104_c010dbf34c_t.jpg" />
      <img src="http://farm1.static.flickr.com/40/117346184_9760f3aabc_t.jpg" />
      <img src="http://farm1.static.flickr.com/153/399232237_6928a527c1_t.jpg" />
    </div>

    <!-- 10-15 -->
    <div>
      <img src="http://farm4.static.flickr.com/3629/3323896446_3b87a8bf75_t.jpg" />
      <img src="http://farm4.static.flickr.com/3023/3323897466_e61624f6de_t.jpg" />
      <img src="http://farm4.static.flickr.com/3650/3323058611_d35c894fab_t.jpg" />
      <img src="http://farm4.static.flickr.com/3635/3323893254_3183671257_t.jpg" />
    </div>

  </div>

</div>

<!-- "next page" action -->
<a class="next browse right">next</a>
</div>
<br clear="all" />

<!-- javascript coding -->
<script>
$(document).ready(function() {
// heeeeeeeeeeere we go.
$("#chained").scrollable({circular: true, mousewheel: true}).navigator().autoscroll({
  interval: 3000
});
});
</script>
</body>
</html>