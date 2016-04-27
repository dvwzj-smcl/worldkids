<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content"><div class="container-fluid">
        <div class="page-header">
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>

        <link href='https://fonts.googleapis.com/css?family=Poppins:700,600,500,400,300' rel='stylesheet' type='text/css'>
        <script type="text/javascript">
            $.fn.tabs = function() {
                var selector = this;

                this.each(function() {
                    var obj = $(this);

                    $(obj.attr('href')).hide();

                    $(obj).click(function() {
                        $(selector).removeClass('selected');

                        $(selector).each(function(i, element) {
                            $($(element).attr('href')).hide();
                        });

                        $(this).addClass('selected');

                        $($(this).attr('href')).show();

                        return false;
                    });
                });

                $(this).show();

                $(this).first().click();
            };
        </script>

        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } elseif ($success) {  ?>
        <div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>

        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
            <div class="set-size" id="blog_latest">
                <div class="content">
                    <div>
                        <div class="tabs clearfix">
                            <!-- Tabs module -->
                            <div id="tabs" class="htabs main-tabs">
                                <?php $module_row = 1; ?>
                                <?php foreach ($modules as $module) { ?>
                                <a href="#tab-module-<?php echo $module_row; ?>" id="module-<?php echo $module_row; ?>">Module <?php echo $module_row; ?> &nbsp;<img src="view/image/module_template/delete-slider.png"  alt="" onclick="$('.vtabs a:first').trigger('click'); $('#module-<?php echo $module_row; ?>').remove(); $('#tab-module-<?php echo $module_row; ?>').remove(); return false;" /></a>
                                <?php $module_row++; ?>
                                <?php } ?>
                                <span id="module-add" onclick="addModule();" ><img src="view/image/module_template/add.png" alt="" />Add<br> Module</span>
                            </div>

                            <?php $module_row = 1; ?>
                            <?php foreach ($modules as $module) { ?>
                            <div id="tab-module-<?php echo $module_row; ?>" class="tab-content">
                                <div id="language-<?php echo $module_row; ?>" class="htabs">
                                    <?php foreach ($languages as $language) { ?>
                                    <a href="#tab-language-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                                    <?php } ?>
                                </div>
                                <?php foreach ($languages as $language) { ?>
                                <div id="tab-language-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>">
                                    <div class="block<?php echo $module_row; ?>">
                                        <table class="form">
                                            <tr>
                                                <td><?php echo $entry_company_name; ?>:</td>
                                                <td>
                                                    <input type="text" name="semi_footer_module[<?php echo $module_row; ?>][company_name][<?php echo $language['language_id']; ?>]" style="width:250px" value="<?php echo isset($module['company_name'][$language['language_id']]) ? $module['company_name'][$language['language_id']] : ''; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $entry_address; ?>:</td>
                                                <td>
                                                    <textarea name="semi_footer_module[<?php echo $module_row; ?>][address][<?php echo $language['language_id']; ?>]" style="width:600px; height: 200px;"><?php echo isset($module['address'][$language['language_id']]) ? $module['address'][$language['language_id']] : ''; ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $entry_operation_time; ?>:</td>
                                                <td><input type="text" name="semi_footer_module[<?php echo $module_row; ?>][operation_time][<?php echo $language['language_id']; ?>]" value="<?php echo isset($module['operation_time'][$language['language_id']]) ? $module['operation_time'][$language['language_id']] : ''; ?>" /></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $entry_email_title; ?>:</td>
                                                <td><input type="text" name="semi_footer_module[<?php echo $module_row; ?>][email_title][<?php echo $language['language_id']; ?>]" value="<?php echo isset($module['email_title'][$language['language_id']]) ? $module['email_title'][$language['language_id']] : ''; ?>" /></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $entry_copyright; ?>:</td>
                                                <td><input type="text" name="semi_footer_module[<?php echo $module_row; ?>][copyright][<?php echo $language['language_id']; ?>]" value="<?php echo isset($module['copyright'][$language['language_id']]) ? $module['copyright'][$language['language_id']] : ''; ?>" /></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <?php } ?>
                                <hr/>
                                <table class="form">
                                    <input type="hidden" name="semi_footer_module[<?php echo $module_row; ?>][position]" value="footer" />
                                    <input type="hidden" name="semi_footer_module[<?php echo $module_row; ?>][layout_id]" value="99999" />
                                    <tr>
                                        <td><?php echo $entry_logo_image; ?>:</td>
                                        <td>
                                            <?php if ($module['logo_image']) { ?>
                                            <a href="" id="thumb-<?php echo $module_row; ?>" class="img-thumbnail img-edit" data-toggle="image"><img src="../image/<?php echo $module['logo_image']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                            <?php } else { ?>
                                            <a href="" id="thumb-<?php echo $module_row; ?>" class="img-thumbnail img-edit" data-toggle="image"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                            <?php } ?>
                                            <input type="hidden" name="semi_footer_module[<?php echo $module_row; ?>][logo_image]" value="<?php echo $module['logo_image']; ?>" id="input-<?php echo $module_row; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $entry_email; ?>:</td>
                                        <td><input type="text" name="semi_footer_module[<?php echo $module_row; ?>][email]" value="<?php echo $module['email']; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $entry_phone1; ?>:</td>
                                        <td><input type="text" name="semi_footer_module[<?php echo $module_row; ?>][phone1]" value="<?php echo $module['phone1']; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $entry_phone2; ?>:</td>
                                        <td><input type="text" name="semi_footer_module[<?php echo $module_row; ?>][phone2]" value="<?php echo $module['phone2']; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $entry_fax; ?>:</td>
                                        <td><input type="text" name="semi_footer_module[<?php echo $module_row; ?>][fax]" value="<?php echo $module['fax']; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $entry_facebook; ?>:</td>
                                        <td><input type="text" name="semi_footer_module[<?php echo $module_row; ?>][facebook]" value="<?php echo $module['facebook']; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $entry_line; ?>:</td>
                                        <td><input type="text" name="semi_footer_module[<?php echo $module_row; ?>][line]" value="<?php echo $module['line']; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $entry_instagram; ?>:</td>
                                        <td><input type="text" name="semi_footer_module[<?php echo $module_row; ?>][instagram]" value="<?php echo $module['instagram']; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $entry_youtube; ?>:</td>
                                        <td><input type="text" name="semi_footer_module[<?php echo $module_row; ?>][youtube]" value="<?php echo $module['youtube']; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $entry_sort_order; ?>:</td>
                                        <td><input type="number" name="semi_footer_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" min="0" /></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $entry_contact_button; ?>:</td>
                                        <td><input type="checkbox" name="semi_footer_module[<?php echo $module_row; ?>][contact_button]" value="<?php echo $module['contact_button']?'1':''; ?>"<?php echo isset($module['contact_button'])?' checked="checked"':''; ?> /></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $entry_status; ?>:</td>
                                        <td>
                                            <select name="semi_footer_module[<?php echo $module_row; ?>][status]">
                                                <option value="1"<?php if($module['status'] == 1) echo ' selected="selected"'; ?>>Enabled</option>
                                                <option value="0"<?php if($module['status'] == 0) echo ' selected="selected"'; ?>>Disabled</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php $module_row++; ?>
                            <?php } ?>
                        </div>

                    <!-- Buttons -->
                    <div class="buttons"><input type="submit" name="button-save" class="button-save" value=""></div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript"><!--
    $('.main-tabs a').tabs();
    //--></script>

<script type="text/javascript"><!--
    <?php $module_row = 1; ?>
    <?php foreach ($modules as $module) { ?>
        $('#language-<?php echo $module_row; ?> a').tabs();
    <?php $module_row++; ?>
    <?php } ?>
    //--></script>

<script type="text/javascript"><!--
    <?php $module_row = 1; ?>
    <?php foreach ($modules as $module) { ?>
    <?php $module_row++; ?>
    <?php } ?>
    //--></script>

<script type="text/javascript"><!--
    var module_row = <?php echo $module_row; ?>;

    function addModule() {
        html  = '<div id="tab-module-' + module_row + '" class="tab-content">';

        html += '  <div id="language-' + module_row + '" class="htabs">';
    <?php foreach ($languages as $language) { ?>
            html += '    <a href="#tab-language-'+ module_row + '-<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>';
        <?php } ?>
        html += '  </div>';

    <?php foreach ($languages as $language) { ?>
            html += '    <div id="tab-language-'+ module_row + '-<?php echo $language['language_id']; ?>">';

            html += '	 <div class="block' + module_row + '">';
            html += '       <table class="form">';
            html += '           <tr>';
            html += '               <td><?php echo $entry_company_name; ?>:</td>';
            html += '               <td>';
            html += '                   <input type="text" name="semi_footer_module[' + module_row + '][company_name][<?php echo $language['language_id']; ?>]" style="width:250px" value="" />';
            html += '               </td>';
            html += '           </tr>';
            html += '           <tr>';
            html += '               <td><?php echo $entry_address; ?>:</td>';
            html += '               <td>';
            html += '                   <textarea name="semi_footer_module[' + module_row + '][address][<?php echo $language['language_id']; ?>]" style="width:600px; height: 200px;"></textarea>';
            html += '               </td>';
            html += '           </tr>';
            html += '           <tr>';
            html += '               <td><?php echo $entry_operation_time; ?>:</td>';
            html += '               <td>';
            html += '                   <input type="text" name="semi_footer_module[' + module_row + '][operation_time][<?php echo $language['language_id']; ?>]" style="width:250px" value="" />';
            html += '               </td>';
            html += '           </tr>';
            html += '           <tr>';
            html += '               <td><?php echo $entry_email_title; ?>:</td>';
            html += '               <td>';
            html += '                   <input type="text" name="semi_footer_module[' + module_row + '][email_title][<?php echo $language['language_id']; ?>]" style="width:250px" value="" />';
            html += '               </td>';
            html += '           </tr>';
            html += '           <tr>';
            html += '               <td><?php echo $entry_copyright; ?>:</td>';
            html += '               <td>';
            html += '                   <input type="text" name="semi_footer_module[' + module_row + '][copyright][<?php echo $language['language_id']; ?>]" style="width:250px" value="" />';
            html += '               </td>';
            html += '           </tr>';
            html += '       </table>';
            html += '	 </div>';
            html += '    </div>';
        <?php } ?>

        html += '<hr/>';

        html += '<table class="form">';
        html += '   <input type="hidden" name="semi_footer_module[' + module_row + '][position]" value="footer" />';
        html += '   <input type="hidden" name="semi_footer_module[' + module_row + '][layout_id]" value="99999" />';
        html += '<tr>';
        html += '<td><?php echo $entry_logo_image; ?>:</td>';
        html += '<td>';
        html += '<a href="" id="thumb-' + module_row + '" class="img-thumbnail img-edit" data-toggle="image"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>';
        html += '<input type="hidden" name="semi_footer_module[' + module_row + '][logo_image]" value="" id="input-' + module_row + '" />';
        html += '</td>';
        html += '</tr>';
        html += '   <tr>';
        html += '       <td><?php echo $entry_email; ?>:</td>';
        html += '       <td><input type="text" name="semi_footer_module[' + module_row + '][email]" value="" /></td>';
        html += '   </tr>';
        html += '   <tr>';
        html += '       <td><?php echo $entry_phone1; ?>:</td>';
        html += '       <td><input type="text" name="semi_footer_module[' + module_row + '][phone1]" value="" /></td>';
        html += '   </tr>';
        html += '   <tr>';
        html += '       <td><?php echo $entry_phone2; ?>:</td>';
        html += '       <td><input type="text" name="semi_footer_module[' + module_row + '][phone2]" value="" /></td>';
        html += '   </tr>';
        html += '   <tr>';
        html += '       <td><?php echo $entry_fax; ?>:</td>';
        html += '       <td><input type="text" name="semi_footer_module[' + module_row + '][fax]" value="" /></td>';
        html += '   </tr>';
        html += '   <tr>';
        html += '       <td><?php echo $entry_facebook; ?>:</td>';
        html += '       <td><input type="text" name="semi_footer_module[' + module_row + '][facebook]" value="" /></td>';
        html += '   </tr>';
        html += '   <tr>';
        html += '       <td><?php echo $entry_line; ?>:</td>';
        html += '       <td><input type="text" name="semi_footer_module[' + module_row + '][line]" value="" /></td>';
        html += '   </tr>';
        html += '   <tr>';
        html += '       <td><?php echo $entry_instagram; ?>:</td>';
        html += '       <td><input type="text" name="semi_footer_module[' + module_row + '][instagram]" value="" /></td>';
        html += '   </tr>';
        html += '   <tr>';
        html += '       <td><?php echo $entry_youtube; ?>:</td>';
        html += '       <td><input type="text" name="semi_footer_module[' + module_row + '][youtube]" value="" /></td>';
        html += '   </tr>';
        html += '   <tr>';
        html += '       <td><?php echo $entry_sort_order; ?>:</td>';
        html += '       <td><input type="number" name="semi_footer_module[' + module_row + '][sort_order]" value="" min="0" /></td>';
        html += '   </tr>';
        html += '   <tr>';
        html += '       <td><?php echo $entry_contact_button; ?>:</td>';
        html += '       <td><input type="number" name="semi_footer_module[' + module_row + '][contact_button]" value="" min="0" /></td>';
        html += '   </tr>';
        html += '   <tr>';
        html += '       <td><?php echo $entry_status; ?>:</td>';
        html += '       <td>';
        html += '           <select name="semi_footer_module[' + module_row + '][status]">';
        html += '               <option value="1">Enabled</option>';
        html += '               <option value="0">Disabled</option>';
        html += '           </select>';
        html += '       </td>';
        html += '   </tr>';
        html += '</table>';
        html += '</div>';

        $('.tabs').append(html);

        $('#language-' + module_row + ' a').tabs();

        $('#module-add').before('<a href="#tab-module-' + module_row + '" id="module-' + module_row + '">Module ' + module_row + ' &nbsp;<img src="view/image/module_template/delete-slider.png" alt="" onclick="$(\'.vtabs a:first\').trigger(\'click\'); $(\'#module-' + module_row + '\').remove(); $(\'#tab-module-' + module_row + '\').remove(); return false;" /></a>');

        $('.main-tabs a').tabs();

        $('#module-' + module_row).trigger('click');

    <?php foreach ($languages as $language) { ?>
            $('#html-' + module_row + '-<?php echo $language['language_id']; ?>, #block-content-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>').summernote({
                height: 300
            });
        <?php } ?>

        module_row++;
    }
    //--></script>
<?php echo $footer; ?>