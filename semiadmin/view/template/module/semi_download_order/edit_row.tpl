<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
    <div class="container-fluid">
        <div class="page-header">
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
        <!-- pre>
        <?php print_r($module); ?>
        </pre -->

        <a class="btn btn-default" href="<?php echo $action; ?>">Back</a>
        <br/><br/>
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="<?php echo $action; ?>&mode=edit_row" method="post">
                    <input type="hidden" name="uniqid" value="<?php echo $link['uniqid']; ?>">
                    <div class="form-group">
                        <label>Thumbnail Image</label>
                        <br/>
                        <a href="" id="thumb-0" class="img-thumbnail img-edit" data-toggle="image"><img src="../image/<?php echo $link['thumbnail_image']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                        <input type="hidden" name="thumbnail_image" value="<?php echo $link['thumbnail_image']; ?>" id="input-0" />
                    </div>
                    <div class="form-group">
                        <label for="link_download">Link Download</label>
                        <input type="text" id="link_download" name="link_download" class="form-control" placeholder="Link Download" value="<?php echo $link['link_download']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="sort_order"><?php echo $entry_sort_order; ?></label>
                        <input type="number" class="form-control" id="sort_order" placeholder="Sort Order" min="0" name="sort_order" value="<?php echo $link['sort_order']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="status"><?php echo $entry_status; ?></label>
                        <select class="form-control" id="status" name="status">
                            <option value="1"<?php echo $link['status']=='1'?' selected="selected"':''; ?>>Enabled</option>
                            <option value="0"<?php echo $link['status']=='0'?' selected="selected"':''; ?>>Disabled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>