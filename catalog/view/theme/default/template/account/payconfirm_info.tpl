<?php
// My Edit
echo $header;
$theme_options = $this->registry->get('theme_options');
$config = $this->registry->get('config');
include('catalog/view/theme/' . $config->get('config_template') . '/template/new_elements/wrapper_top.tpl'); ?>

  <h1><?php echo $heading_title; ?></h1>
  <?php if ($orders) { ?>
  <p><?php echo $text_description; ?></p>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
    <fieldset>
      <legend><?php echo $text_contact; ?></legend>
      <div class="form-group required">
        <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
        <div class="col-sm-10">
          <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
          <?php if ($error_name) { ?>
          <div class="text-danger"><?php echo $error_name; ?></div>
          <?php } ?>
        </div>
      </div>
      <div class="form-group required">
        <label class="col-sm-2 control-label" for="input-lastname"><?php echo $entry_lastname; ?></label>
        <div class="col-sm-10">
          <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="<?php echo $entry_lastname; ?>" id="input-lastname" class="form-control" />
          <?php if ($error_lastname) { ?>
          <div class="text-danger"><?php echo $error_lastname; ?></div>
          <?php } ?>
        </div>
      </div>
      <div class="form-group required">
        <label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email; ?></label>
        <div class="col-sm-10">
          <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
          <?php if ($error_email) { ?>
          <div class="text-danger"><?php echo $error_email; ?></div>
          <?php } ?>
        </div>
      </div>
      <div class="form-group required">
        <label class="col-sm-2 control-label" for="input-telephone"><?php echo $entry_telephone; ?></label>
        <div class="col-sm-10">
          <input type="text" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $entry_telephone; ?>" id="input-telephone" class="form-control" />
          <?php if ($error_telephone) { ?>
          <div class="text-danger"><?php echo $error_telephone; ?></div>
          <?php } ?>
        </div>
      </div>
    </fieldset>
    <fieldset>
      <legend><?php echo $text_payment; ?></legend>
      <div class="form-group required">
        <label class="col-sm-2 control-label" for="input-sender"><?php echo $entry_sender; ?></label>
        <div class="col-sm-10">
          <input type="text" name="sender" value="<?php echo $sender; ?>" placeholder="<?php echo $entry_sender; ?>" id="input-sender" class="form-control" />
          <?php if ($error_sender) { ?>
          <div class="text-danger"><?php echo $error_sender; ?></div>
          <?php } ?>
        </div>
      </div>
      <div class="form-group required">
        <label class="col-sm-2 control-label" for="input-date-transfer"><?php echo $entry_date_transfer; ?></label>
        <div class="col-sm-3">
          <div class="input-group date"><input type="text" name="date_transfer" value="<?php echo $date_transfer; ?>" placeholder="<?php echo $entry_date_transfer; ?>" data-date-format="YYYY-MM-DD" id="input-date-transfer" class="form-control" /><span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
          <?php if ($error_date_transfer) { ?>
          <div class="text-danger"><?php echo $error_date_transfer; ?></div>
          <?php } ?>
        </div>
      </div>
      <?php if ($total_destination) { ?>
      <div class="form-group required">
        <label class="col-sm-2 control-label"><?php echo $entry_destination; ?></label>
        <div class="col-sm-10">
          <?php foreach ($payconfirm_destinations as $payconfirm_destination) { ?>
          <?php if ($payconfirm_destination['payconfirm_destination_id'] == $payconfirm_destination_id) { ?>
          <div class="radio">
            <label>
              <input type="radio" name="payconfirm_destination_id" value="<?php echo $payconfirm_destination['payconfirm_destination_id']; ?>" checked="checked" />
              <?php echo $payconfirm_destination['name']; ?></label>
          </div>
          <?php } else { ?>
          <div class="radio">
            <label>
              <input type="radio" name="payconfirm_destination_id" value="<?php echo $payconfirm_destination['payconfirm_destination_id']; ?>" />
              <?php echo $payconfirm_destination['name']; ?></label>
          </div>
          <?php  } ?>
          <?php  } ?>
          <?php if ($error_destination) { ?>
          <div class="text-danger"><?php echo $error_destination; ?></div>
          <?php } ?>
        </div>
      </div>
      <?php } ?>
      <?php if ($total_method) { ?>
      <div class="form-group required">
        <label class="col-sm-2 control-label"><?php echo $entry_transfer_method; ?></label>
        <div class="col-sm-10">
          <?php foreach ($payconfirm_methods as $payconfirm_method) { ?>
          <?php if ($payconfirm_method['payconfirm_method_id'] == $payconfirm_method_id) { ?>
          <div class="radio">
            <label>
              <input type="radio" name="payconfirm_method_id" value="<?php echo $payconfirm_method['payconfirm_method_id']; ?>" checked="checked" />
              <?php echo $payconfirm_method['name']; ?></label>
          </div>
          <?php } else { ?>
          <div class="radio">
            <label>
              <input type="radio" name="payconfirm_method_id" value="<?php echo $payconfirm_method['payconfirm_method_id']; ?>" />
              <?php echo $payconfirm_method['name']; ?></label>
          </div>
          <?php  } ?>
          <?php  } ?>
          <?php if ($error_transfer_method) { ?>
          <div class="text-danger"><?php echo $error_transfer_method; ?></div>
          <?php } ?>
        </div>
      </div>
      <?php } ?>
      <div class="form-group required">
        <label class="col-sm-2 control-label" for="input-amount"><?php echo $entry_amount; ?></label>
        <div class="col-sm-10">
          <input type="text" name="amount" value="<?php echo $amount; ?>" placeholder="<?php echo $entry_amount; ?>" id="input-amount" class="form-control" />
          <?php if ($error_amount) { ?>
          <div class="text-danger"><?php echo $error_amount; ?></div>
          <?php } ?>
        </div>
      </div>
      <div class="form-group<?php echo ($slip_required ? ' required' : ''); ?>">
        <label class="col-sm-2 control-label" for="input-filename"><?php echo $entry_filename; ?></label>
        <div class="col-sm-6">
          <div class="input-group">
            <input type="text" name="filename" value="<?php echo $filename; ?>" placeholder="<?php echo $entry_filename; ?>" id="input-filename" class="form-control" readonly/>
                <span class="input-group-btn">
                <button type="button" id="button-upload" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
                </span>
          </div>
          <div class="input-group">
            <input type="hidden" name="code" value="<?php echo $code; ?>" id="input-code" class="form-control"/>
          </div>
          <?php if ($slip_required && $error_slip) { ?>
          <div class="text-danger"><?php echo $error_slip; ?></div>
          <?php } ?>
        </div>
      </div>
      <div class="form-group required">
        <label class="col-sm-2 control-label" for="input-confirm-order"><span data-toggle="tooltip" title="<?php echo $help_confirm_order; ?>"><?php echo $entry_confirm_order; ?></span></label>
        <div class="col-sm-10">
          <div class="well well-sm">
            <?php foreach ($orders as $order) { ?>
            <?php if (in_array($order['order_id'], $sum_confirm_order)) { ?>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="sum_confirm_order[]" value="<?php echo $order['order_id']; ?>" checked="checked" />
                <b><?php echo $order['order_id']; ?></b>
                <?php echo $text_open_brackets; ?>
                <?php echo $text_status; ?>
                <?php echo $order['status']; ?>
                <?php echo $text_separate; ?>
                <?php echo $text_total; ?>
                <?php echo $order['total']; ?>
                <?php echo $text_close_brackets; ?>
                <a href="<?php echo $order['href']; ?>"><?php echo $text_details; ?></a>
              </label>
            </div>
            <?php } else { ?>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="sum_confirm_order[]" value="<?php echo $order['order_id']; ?>" />
                <b><?php echo $order['order_id']; ?></b>
                <?php echo $text_open_brackets; ?>
                <?php echo $text_status; ?>
                <?php echo $order['status']; ?>
                <?php echo $text_separate; ?>
                <?php echo $text_total; ?>
                <?php echo $order['total']; ?>
                <?php echo $text_close_brackets; ?>
                <a href="<?php echo $order['href']; ?>"><?php echo $text_details; ?></a>
              </label>
            </div>
            <?php } ?>
            <?php } ?>
          </div>
          <?php if ($error_confirm_order) { ?>
          <div class="text-danger"><?php echo $error_confirm_order; ?></div>
          <?php } ?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="input-confirm-comment"><?php echo $entry_confirm_comment; ?></label>
        <div class="col-sm-10">
          <textarea name="confirm_comment" rows="10" id="input-confirm-comment" class="form-control"><?php echo $confirm_comment; ?></textarea>
        </div>
      </div>
      <?php if ($site_key) { ?>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div>
          <?php if ($error_captcha) { ?>
          <div class="text-danger"><?php echo $error_captcha; ?></div>
          <?php } ?>
        </div>
      </div>
      <?php } ?>
    </fieldset>
    <div class="buttons clearfix">
      <div class="pull-left"><a href="<?php echo $back; ?>" class="btn btn-default"><?php echo $button_back; ?></a></div>
      <div class="pull-right">
        <input type="submit" value="<?php echo $button_submit; ?>" class="btn btn-primary" />
      </div>
    </div>
  </form>
  <?php } else { ?>
  <p><?php echo $text_empty; ?></p>
  <div class="buttons clearfix">
    <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
  </div>
  <?php } ?>
  <?php echo $content_bottom; ?>

<?php include('catalog/view/theme/' . $config->get('config_template') . '/template/new_elements/wrapper_bottom.tpl'); ?>


<script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});

$('.time').datetimepicker({
	pickDate: false
});

$('button[id^=\'button-upload\']').on('click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=account/payconfirm/upload',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$('#button-upload').button('loading');
				},
				complete: function() {
					$('#button-upload').button('reset');
				},
				success: function(json) {
					if (json['error']) {
						alert(json['error']);
					}

					if (json['success']) {
						alert(json['success']);

                        $('input[name=\'code\']').attr('value', json['code']);
                        $('input[name=\'filename\']').attr('value', json['filename']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});
//--></script>
<?php echo $footer; ?>