<div class="box-links">
    <div class="row">
        <?php foreach($links as $link){ ?>
        <div class="col-sm-4">
            <div class="box-link-download">
            <a href="<?php echo $link['link_download']; ?>">
                <img src="image/<?php echo $link['thumbnail_image']; ?>">
            </a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>