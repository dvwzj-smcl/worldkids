<?php
if($this->registry->has('theme_options') == false) { 
 header("location: themeinstall/index.php"); 
 exit; 
}
$theme_options = $this->registry->get('theme_options');
?>
<div class="box blog-module box-no-advanced">
    <div class="box-heading"><?php echo $heading_title; ?></div>
    <div class="strip-line"></div>
    <div class="box-content">
        <?php if(!empty($articles)):?> 
        <div class="cameras-news row">
            <?php foreach($articles as $article):?>
            <div class="col-sm-6 col-xs-12">
                <div class="media clearfix">
                        <?php if($article['thumb']):?>
                        <div  class="thumb-holder">
                             <div class="tags">
                                  <?php $s = 0; foreach($article['tags'] as $tag): ?>
                                       <?php if($s < 2): ?><a href="<?php echo $tag['href']; ?>"><?php echo $tag['tag']; ?></a><?php endif; ?>
                                  <?php $s++; endforeach; ?>
                             </div>
                             
                            <a href="<?php echo $article['href']; ?>"><img alt="" src="<?php echo $article['thumb'] ?>"></a>
                        </div>
                        <?php endif; ?>
                        
                        <div class="media-body">
                             <div class="bottom">
                                 <div class="date-published"><?php echo date('d.m.Y', strtotime($article['date_published'])) ?></div>
                                 <div class="post-title"><a href="<?php echo $article['href']; ?>"><?php echo $article['title'] ?></a></div>
                             </div>
                        </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>