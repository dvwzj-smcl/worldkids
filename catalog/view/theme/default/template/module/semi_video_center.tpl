<div class="box-links">

    <div class="row">
        <?php
            $link = array_shift($links);
        ?>
        <div class="col-md-12" style="margin-bottom: 20px;">
            <iframe width="848" height="478" src="<?php echo str_replace('watch?v=', 'embed/', $link['link_video']); ?>" frameborder="0" allowfullscreen=""></iframe>
        </div>
        <?php foreach($links as $link){ ?>
        <?php if($link['status']==1){ ?>
        <div class="<?php echo $column_class; ?>">
            <div class="box-link-download">
            <a href="<?php echo $link['link_video']; ?>">
                <iframe width="262" height="148" src="<?php echo str_replace('watch?v=', 'embed/', $link['link_video']); ?>" frameborder="0" allowfullscreen=""></iframe>
            </a>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
    </div>
</div>