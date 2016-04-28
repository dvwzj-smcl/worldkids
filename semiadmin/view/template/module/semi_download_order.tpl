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

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">New Link Download</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                    <input type="hidden" name="semi_download_order_module[0][position]" value="<?php echo $module[0]['position']; ?>">
                    <input type="hidden" name="semi_download_order_module[0][layout_id]" value="<?php echo $module[0]['layout_id']; ?>">
                    <input type="hidden" name="semi_download_order_module[0][status]" value="<?php echo $module[0]['status']; ?>">
                    <input type="hidden" name="semi_download_order_module[0][sort_order]" value="<?php echo $module[0]['sort_order']; ?>">
                    <?php foreach($module[0]['links'] as $i => $link){ ?>
                    <input type="hidden" name="semi_download_order_module[0][links][<?php echo $i; ?>][thumbnail_image]" value="<?php echo $link['thumbnail_image']; ?>">
                    <input type="hidden" name="semi_download_order_module[0][links][<?php echo $i; ?>][link_download]" value="<?php echo $link['link_download']; ?>">
                    <?php } ?>
                    <div class="form-group">
                        <a href="" id="thumb-<?php echo count($module[0]['links']); ?>" class="img-thumbnail img-edit" data-toggle="image"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                        <input type="hidden" name="semi_download_order_module[0][links][<?php echo count($module[0]['links']); ?>][thumbnail_image]" value=""  id="input-<?php echo count($module[0]['links']); ?>" />
                    </div>
                    <div class="form-group">
                        <label for="link_download">Link Download</label>
                        <input type="text" class="form-control" id="link_download" name="semi_download_order_module[0][links][<?php echo count($module[0]['links']); ?>][link_download]" placeholder="Link Download">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="250">Thumbnail Image</th>
                    <th>Link Download</th>
                    <th width="100">Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($module[0]['links'] as $i => $link){ ?>
                <tr>
                    <td><img src="../image/<?php echo $link['thumbnail_image']; ?>"></td>
                    <td><?php echo $link['link_download']; ?></td>
                    <td>
                        <form action="<?php echo $action; ?>" method="post" id="form">
                            <input type="hidden" name="mode" value="remove">
                            <input type="hidden" name="index" value="<?php echo $i; ?>">
                        <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php echo $footer; ?>