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
                <form action="<?php echo $action; ?>&mode=edit_module" method="post">
                    <div class="form-group">
                        <label for="position">Position</label>
                        <select class="form-control" id="position" name="position">
                            <?php if ($module[0]['position'] == 'header_notice') { ?>
                            <option value="header_notice" selected="selected">Header notice</option>
                            <?php } else { ?>
                            <option value="header_notice">Header notice</option>
                            <?php } ?>
                            <?php if ($module[0]['position'] == 'slideshow') { ?>
                            <option value="slideshow" selected="selected">Slideshow</option>
                            <?php } else { ?>
                            <option value="slideshow">Slideshow</option>
                            <?php } ?>
                            <?php if ($module[0]['position'] == 'preface_left') { ?>
                            <option value="preface_left" selected="selected">Preface left</option>
                            <?php } else { ?>
                            <option value="preface_left">Preface left</option>
                            <?php } ?>
                            <?php if ($module[0]['position'] == 'preface_right') { ?>
                            <option value="preface_right" selected="selected">Preface right</option>
                            <?php } else { ?>
                            <option value="preface_right">Preface right</option>
                            <?php } ?>
                            <?php if ($module[0]['position'] == 'preface_fullwidth') { ?>
                            <option value="preface_fullwidth" selected="selected">Preface fullwidth</option>
                            <?php } else { ?>
                            <option value="preface_fullwidth">Preface fullwidth</option>
                            <?php } ?>
                            <?php if ($module[0]['position'] == 'column_left') { ?>
                            <option value="column_left" selected="selected">Column left</option>
                            <?php } else { ?>
                            <option value="column_left">Column left</option>
                            <?php } ?>
                            <?php if ($module[0]['position'] == 'content_big_column') { ?>
                            <option value="content_big_column" selected="selected">Content big column</option>
                            <?php } else { ?>
                            <option value="content_big_column">Content big column</option>
                            <?php } ?>
                            <?php if ($module[0]['position'] == 'content_top') { ?>
                            <option value="content_top" selected="selected">Content top</option>
                            <?php } else { ?>
                            <option value="content_top">Content top</option>
                            <?php } ?>
                            <?php if ($module[0]['position'] == 'product_custom_block') { ?>
                            <option value="product_custom_block" selected="selected">Product Custom Block</option>
                            <?php } else { ?>
                            <option value="product_custom_block">Product Custom Block</option>
                            <?php } ?>
                            <?php if ($module[0]['position'] == 'column_right') { ?>
                            <option value="column_right" selected="selected">Column right</option>
                            <?php } else { ?>
                            <option value="column_right">Column right</option>
                            <?php } ?>
                            <?php if ($module[0]['position'] == 'content_bottom') { ?>
                            <option value="content_bottom" selected="selected">Content bottom</option>
                            <?php } else { ?>
                            <option value="content_bottom">Content bottom</option>
                            <?php } ?>
                            <?php if ($module[0]['position'] == 'customfooter_top') { ?>
                            <option value="customfooter_top" selected="selected">CustomFooter Top</option>
                            <?php } else { ?>
                            <option value="customfooter_top">CustomFooter Top</option>
                            <?php } ?>

                            <?php if ($module[0]['position'] == 'customfooter') { ?>
                            <option value="customfooter" selected="selected">CustomFooter</option>
                            <?php } else { ?>
                            <option value="customfooter">CustomFooter</option>
                            <?php } ?>

                            <?php if ($module[0]['position'] == 'customfooter_bottom') { ?>
                            <option value="customfooter_bottom" selected="selected">CustomFooter Bottom</option>
                            <?php } else { ?>
                            <option value="customfooter_bottom">CustomFooter Bottom</option>
                            <?php } ?>
                            <?php if ($module[0]['position'] == 'footer_top') { ?>
                            <option value="footer_top" selected="selected">Footer top</option>
                            <?php } else { ?>
                            <option value="footer_top">Footer top</option>
                            <?php } ?>
                            <?php if ($module[0]['position'] == 'footer') { ?>
                            <option value="footer" selected="selected">Footer</option>
                            <?php } else { ?>
                            <option value="footer">Footer</option>
                            <?php } ?>
                            <?php if ($module[0]['position'] == 'footer_bottom') { ?>
                            <option value="footer_bottom" selected="selected">Footer bottom</option>
                            <?php } else { ?>
                            <option value="footer_bottom">Footer bottom</option>
                            <?php } ?>
                            <?php if ($module[0]['position'] == 'bottom') { ?>
                            <option value="bottom" selected="selected">Bottom</option>
                            <?php } else { ?>
                            <option value="bottom">Bottom</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="layout_id">Layout</label>
                        <select class="form-control" id="layout_id" name="layout_id">
                            <?php if (99999 == $module[0]['layout_id']) { ?>
                            <option value="99999" selected="selected">All pages</option>
                            <?php } else { ?>
                            <option value="99999">All pages</option>
                            <?php foreach($stores as $store) { ?>
                            <?php if ('99999' . $store['store_id'] == $module[0]['layout_id']) { ?>
                            <option value="99999<?php echo $store['store_id']; ?>" selected="selected">All pages - Store <?php echo $store['name']; ?></option>
                            <?php } else { ?>
                            <option value="99999<?php echo $store['store_id']; ?>">All pages - Store <?php echo $store['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                            <?php } ?>
                            <?php foreach ($layouts as $layout) { ?>
                            <?php if ($layout['layout_id'] == $module[0]['layout_id']) { ?>
                            <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sort_order"><?php echo $entry_sort_order; ?></label>
                        <input type="number" class="form-control" id="sort_order" placeholder="Sort Order" min="0" name="sort_order" value="<?php echo $module[0]['sort_order']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="column_class"><?php echo $entry_column_class; ?></label>
                        <select class="form-control" id="column_class" name="column_class">
                            <option value="col-md-12"<?php if($module[0]['column_class'] == 'col-md-12') echo ' selected="selected"'; ?>>1</option>
                            <option value="col-md-6"<?php if($module[0]['column_class'] == 'col-md-6') echo ' selected="selected"'; ?>>2</option>
                            <option value="col-md-4"<?php if($module[0]['column_class'] == 'col-md-4') echo ' selected="selected"'; ?>>3</option>
                            <option value="col-md-3"<?php if($module[0]['column_class'] == 'col-md-3') echo ' selected="selected"'; ?>>4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="show_item"><?php echo $entry_show_item; ?></label>
                        <input type="number" class="form-control" id="show_item" placeholder="Show" min="0" name="show_item" value="<?php echo $module[0]['show_item']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="status"><?php echo $entry_status; ?></label>
                        <select class="form-control" id="status" name="status">
                            <option value="1"<?php if($module[0]['status'] == 1) echo ' selected="selected"'; ?>>Enabled</option>
                            <option value="0"<?php if($module[0]['status'] == 0) echo ' selected="selected"'; ?>>Disabled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>