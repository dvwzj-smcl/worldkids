<div class="box-links">
    <div class="row">
        <?php foreach($links as $link){ ?>
        <?php if($link['status']==1){ ?>
        <div class="<?php echo $column_class; ?>">
            <div class="box-link-download">
            <a href="<?php echo $link['link_download']; ?>">
                <img src="image/<?php echo $link['thumbnail_image']; ?>">
            </a>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
    </div>
</div>