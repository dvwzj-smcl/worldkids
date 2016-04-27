<?php
if($this->registry->has('theme_options') == false) { 
	header("location: themeinstall/index.php"); 
	exit; 
} 

$theme_options = $this->registry->get('theme_options');
$config = $this->registry->get('config');
$page_direction = $theme_options->get( 'page_direction' ); ?>
<div class="container">
     <div class="camera_slider">
     	<div class="camera_wrap" id="camera_wrap_<?php echo $module+20; ?>">
     		<?php foreach ($banners as $banner) { ?>
     		<?php if ($banner['link']) { ?>
     		<a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" /></a>
     		<?php } else { ?>
     		<img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" />
     		<?php } ?>
     		<?php } ?>
     	</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  var camera_slider = $("#camera_wrap_<?php echo $module+20; ?>");
    
  camera_slider.owlCarousel({
  	  slideSpeed : 300,
  	  lazyLoad : true,
      singleItem: true,
      autoPlay: 13000,
      stopOnHover: true,
      navigation: true,
      <?php if($page_direction[$config->get( 'config_language_id' )] == 'RTL'): ?>
      direction: 'rtl',
      <?php endif; ?>
        navigationText: false
   });
});
</script>