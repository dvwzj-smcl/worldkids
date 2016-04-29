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

        <table id="datatables" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th width="250">Thumbnail Image</th>
                <th>Link Download</th>
                <th width="250" class="no-sort">&nbsp;</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Thumbnail Image</th>
                <th>Link Download</th>
                <th width="250" class="no-sort">&nbsp;</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<script type="application/javascript">
    $(document).ready(function(){
        var dataSource = <?php echo json_encode($links); ?>;
        var table = $('#datatables').DataTable({
            "dom": '<"toolbar">frtip',
            "data": dataSource,
            "columns": [
                { "data": 'thumbnail_image', "title": "Thumbnail Image" },
                { "data": 'link_download', "title": "Link Download" },
                { "title": "&nbsp;" }
            ],
            "columnDefs": [ {
                "targets"  : 'no-sort',
                "orderable": false,
            },{
                "render": function ( data, type, row ) {
                    return '<img src="../image/'+data+'">';
                },
                "targets": 0
            },{
                "targets": -1,
                "data": null,
                "render": function(data, type, row) {
                    return '<a type="button" class="btn btn-info edit_row" href="<?php echo $action; ?>&mode=edit_row&uniqid='+data.uniqid+'">Edit</a> <button type="button" class="btn btn-danger remove_row" data-uniqid="'+data.uniqid+'">Remove</button>';
                }
            }]
        });
        $("div.toolbar").html('<div style="display: inline-block; margin: 0 10px;"><a id="add_row" class="btn btn-primary btn-lg" href="<?php echo $action; ?>&mode=add_row">New</a> <a id="edit_module" class="btn btn-info" href="<?php echo $action; ?>&mode=edit_module">Edit</a></div>');
        //table.buttons().container().appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
        $('.remove_row').on('click', function() {
            var uniqid = $(this).data('uniqid');
            $.post('<?php echo str_replace('&amp;','&',$action); ?>&mode=remove_row', {uniqid: uniqid}, function(res) {
                window.location.reload();
            });
        });
    });
</script>
<?php echo $footer; ?>