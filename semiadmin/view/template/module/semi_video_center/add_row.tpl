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
                <form action="<?php echo $action; ?>&mode=add_row" method="post">
                    <div class="form-group">
                        <label for="link_video">Link Download</label>
                        <input type="text" id="link_video" name="link_video" class="form-control" placeholder="Link Video">
                    </div>
                    <div class="form-group">
                        <label for="sort_order"><?php echo $entry_sort_order; ?></label>
                        <input type="number" class="form-control" id="sort_order" placeholder="Sort Order" min="0" name="sort_order">
                    </div>
                    <div class="form-group">
                        <label for="status"><?php echo $entry_status; ?></label>
                        <select class="form-control" id="status" name="status">
                            <option value="1">Enabled</option>
                            <option value="0">Disabled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>