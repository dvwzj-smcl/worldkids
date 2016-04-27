<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
		<div class="">
          <div class="row">
            <div class="col-sm-6">
			  <div class="form-group">
                <label class="control-label" for="input-name"><?php echo $entry_store; ?></label>
                <select class="form-control" name="filter_store">
				 <option value="0"><?php echo $text_default; ?></option>
				 <?php foreach($stores as $store){ ?>	
					<option value="<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></option>
				  <?php } ?>
				</select>
              </div>
			  <div class="form-group">
                <label class="control-label" for="input-language"><?php echo $entry_language; ?></label>
                <select class="form-control" name="filter_language_id">
				 <?php foreach($languages as $language){ ?>
					<option value="<?php echo $language['language_id']; ?>"><?php echo $language['name']; ?></option>
				  <?php } ?>
				</select>
              </div>
			  <div class="form-group">
                <label style="width:100%;" class="control-label" for="input-price"><?php echo $entry_pricerange; ?></label>
                   <input style="display:inline-block; width:47%;"; type="text" name="filter_price_to" value="<?php echo $filter_price; ?>" placeholder="To" id="input-price" class="form-control" /> - <input style="display:inline-block; width:47%;"; type="text" name="filter_price_form" value="<?php echo $filter_price; ?>" placeholder="From" id="input-price" class="form-control"/>
              </div>
			  <div class="form-group">
                <label style="width:100%;" class="control-label" for="input-quantity"><?php echo $entry_quantityrange; ?></label>
                   <input style="display:inline-block; width:47%;"; type="text" name="filter_quantity_to" value="<?php echo $filter_price; ?>" placeholder="To" id="input-price" class="form-control" /> - <input style="display:inline-block; width:47%;"; type="text" name="filter_quantity_form" value="<?php echo $filter_quantity; ?>" placeholder="From" id="input-quantity" class="form-control"/>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-quantity"><?php echo $entry_stock_status; ?></label>
				<select name="filter_stock_status" id="input-status" class="form-control">
					<option value="*"></option>
					<?php foreach($stock_statuses as $stock){ ?>
					<option value="<?php echo $stock['stock_status_id']; ?>"><?php echo $stock['name']; ?></option>
					<?php } ?>
				</select>
              </div>
			  <div class="form-group">
				<label style="width:100%;" class="control-label" for="input-limit"><?php echo $entry_limit; ?> (Note:Export Data limit)</label>
				<input style="display:inline-block; width:47%;"; type="text" name="filter_start" value="0" placeholder="Start" id="input-start" class="form-control" />
				-
				<input style="display:inline-block; width:47%;"; type="text" name="filter_limit" value="<?php echo $filter_limit; ?>" placeholder="<?php echo $entry_limit; ?>" id="input-limit" class="form-control" />
			 </div>
            </div>
			<div class="col-sm-6">
			 <div class="form-group">
                <label class="control-label" for="input-name"><?php echo $entry_categories; ?></label>
                <select name="filter_categories" id="input-categories" class="form-control">
					<option value="*"></option>
					<?php foreach($categories as $category){ ?>
					<option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
					<?php } ?>
				</select>
              </div>
			  <div class="form-group">
                <label class="control-label" for="input-name"><?php echo $entry_manufacturer; ?></label>
                <select name="filter_manufacturer" id="input-categories" class="form-control">
					<option value="*"></option>
					<?php foreach($manufacturers as $manufacturer){ ?>
					<option value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></option>
					<?php } ?>
				</select>
              </div>
			  <div class="form-group">
                <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                <input type="text" name="filter_name" value="<?php echo $filter_name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-model"><?php echo $entry_model; ?></label>
                <input type="text" name="filter_model" value="<?php echo $filter_model; ?>" placeholder="<?php echo $entry_model; ?>" id="input-model" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
                <select name="filter_status" id="input-status" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <?php } ?>
                  <?php if (!$filter_status && !is_null($filter_status)) { ?>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </div>
			  <div class="form-group">
				<label class="control-label" for="input-status"></label>
				<button style="width:100%; margin-top:23px;" type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-download"></i> <?php echo $button_export; ?></button>
			  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 </div>
</div>
<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	var url = 'index.php?route=tool/product_export/export&token=<?php echo $token; ?>';

	var filter_name = $('input[name=\'filter_name\']').val();

	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}

	var filter_model = $('input[name=\'filter_model\']').val();

	if (filter_model) {
		url += '&filter_model=' + encodeURIComponent(filter_model);
	}

	var filter_price_to = $('input[name=\'filter_price_to\']').val();

	if (filter_price_to) {
		url += '&filter_price_to=' + encodeURIComponent(filter_price_to);
	}
	
	var filter_price_form = $('input[name=\'filter_price_form\']').val();

	if (filter_price_form) {
		url += '&filter_price_form=' + encodeURIComponent(filter_price_form);
	}

	var filter_quantity_to = $('input[name=\'filter_quantity_to\']').val();

	if (filter_quantity_to) {
		url += '&filter_quantity_to=' + encodeURIComponent(filter_quantity_to);
	}
	
	var filter_quantity_form = $('input[name=\'filter_quantity_form\']').val();

	if (filter_quantity_form) {
		url += '&filter_quantity_form=' + encodeURIComponent(filter_quantity_form);
	}

	var filter_status = $('select[name=\'filter_status\']').val();

	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}
	
	var filter_store = $('select[name=\'filter_store\']').val();

	if (filter_store != '*') {
		url += '&filter_store=' + encodeURIComponent(filter_store);
	}
	
	var filter_language_id = $('select[name=\'filter_language_id\']').val();

	if (filter_language_id != '*') {
		url += '&filter_language=' + encodeURIComponent(filter_language_id);
	}
	
	var filter_stock_status = $('select[name=\'filter_stock_status\']').val();

	if (filter_stock_status != '*') {
		url += '&filter_stock_status=' + encodeURIComponent(filter_stock_status);
	}
	
	var filter_start = $('input[name=\'filter_start\']').val();

	if(filter_start != '*'){
		url += '&filter_start=' + encodeURIComponent(filter_start);
	}
	
	var filter_limit = $('input[name=\'filter_limit\']').val();

	if (filter_limit != '*') {
		url += '&filter_limit=' + encodeURIComponent(filter_limit);
	}
	
	var filter_categories = $('select[name=\'filter_categories\']').val();

	if(filter_categories != '*'){
		url += '&filter_categories=' + encodeURIComponent(filter_categories);
	}
	
	var filter_manufacturer = $('select[name=\'filter_manufacturer\']').val();

	if (filter_manufacturer != '*') {
		url += '&filter_manufacturer=' + encodeURIComponent(filter_manufacturer);
	}
	
	location = url;
});
//--></script>
<script type="text/javascript"><!--
$('input[name=\'filter_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_name\']').val(item['label']);
	}
});

$('input[name=\'filter_model\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_model=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['model'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_model\']').val(item['label']);
	}
});
//--></script>
<?php echo $footer; ?>