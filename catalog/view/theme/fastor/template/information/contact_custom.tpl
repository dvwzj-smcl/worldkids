<?php echo $header;
$theme_options = $this->registry->get('theme_options');
$config = $this->registry->get('config'); 
include('catalog/view/theme/' . $config->get('config_template') . '/template/new_elements/wrapper_top.tpl'); ?>

<div class="row">
	<div class="col-sm-<?php if($theme_options->get( 'custom_block', 'contact_page', $config->get( 'config_language_id' ), 'status' ) == 1) { echo 9; } else { echo 12; } ?>">
        <div class="row">
            <div class="col-md-4">
                <h3><?php echo $text_location; ?></h3>
                <div class="row">
                    <div class="col-md-12">
                      <strong><?php echo $store; ?></strong><br />
                      <address>
                        <?php echo $address; ?>
                      </address>
                      <?php if ($geocode) { ?>
                      <a href="https://maps.google.com/maps?q=<?php echo urlencode($geocode); ?>&hl=en&t=m&z=15" target="_blank" class="btn btn-info"><i class="fa fa-map-marker"></i> <?php echo $button_map; ?></a>
                      <?php } ?>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <strong><?php echo $text_telephone; ?></strong><br>
                    <?php echo $telephone; ?><br />
                    <br />
                    <?php if ($fax) { ?>
                    <strong><?php echo $text_fax; ?></strong><br>
                    <?php echo $fax; ?>
                    <?php } ?>
                  </div>
                </div>
              <div class="row">
                <div class="col-md-12">
                  <?php if ($open) { ?>
                  <strong><?php echo $text_open; ?></strong><br />
                  <?php echo $open; ?><br />
                  <br />
                  <?php } ?>
                  <?php if ($comment) { ?>
                  <strong><?php echo $text_comment; ?></strong><br />
                  <?php echo $comment; ?>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="col-md-8">
                <h3><?php echo $text_contact; ?></h3>
                <div class="row">
                    <div class="col-md-12">
                      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <fieldset>
                          <div class="form-group required">
                            <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                              <input type="text" name="name" value="<?php echo $name; ?>" id="input-name" class="form-control" />
                              <?php if ($error_name) { ?>
                              <div class="text-danger"><?php echo $error_name; ?></div>
                              <?php } ?>
                          </div>
                          <div class="form-group required">
                            <label class="control-label" for="input-email"><?php echo $entry_email; ?></label>
                              <input type="text" name="email" value="<?php echo $email; ?>" id="input-email" class="form-control" />
                              <?php if ($error_email) { ?>
                              <div class="text-danger"><?php echo $error_email; ?></div>
                              <?php } ?>
                          </div>
                          <div class="form-group required">
                            <label class="control-label" for="input-enquiry"><?php echo $entry_enquiry; ?></label>
                              <textarea name="enquiry" rows="10" id="input-enquiry" class="form-control"><?php echo $enquiry; ?></textarea>
                              <?php if ($error_enquiry) { ?>
                              <div class="text-danger"><?php echo $error_enquiry; ?></div>
                              <?php } ?>
                          </div>
                          <?php echo $captcha; ?>
                        </fieldset>
                        <div class="buttons">
                            <input class="btn btn-primary" type="submit" value="<?php echo $button_submit; ?>" />
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>



	
  </div>
  	

</div>
  
<?php include('catalog/view/theme/' . $config->get('config_template') . '/template/new_elements/wrapper_bottom.tpl'); ?>
<?php echo $footer; ?>