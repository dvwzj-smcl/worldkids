<?php
// Heading
$_['heading_title']			= 'Authorize.Net (SIM)';

// Text
$_['text_payment']			= 'การชำระเงิน';
$_['text_success']			= 'สำเร็จ: You have modified Authorize.Net (SIM) account details!';
$_['text_edit']             = 'Edit Authorize.Net (SIM)';
$_['text_authorizenet_sim']	= '<a onclick="window.open(\'http://reseller.authorize.net/application/?id=5561142\');"><img src="view/image/payment/authorizenet.png" alt="Authorize.Net" title="Authorize.Net" style="border: 1px solid #EEEEEE;" /></a>';

// Entry
$_['entry_merchant']		= 'รหัสผู้ค้า';
$_['entry_key']				= 'Transaction Key';
$_['entry_callback']		= 'Relay Response URL';
$_['entry_md5']				= 'MD5 Hash Value';
$_['entry_test']			= 'โหมดทดสอบ';
$_['entry_total']			= 'ทั้งหมด';
$_['entry_order_status']	= 'สถานะการสั่งซื้อ';
$_['entry_geo_zone']		= 'โซนภูมิภาค';
$_['entry_status']			= 'สถานะ';
$_['entry_sort_order']		= 'เรียงลำดับ';

// Help
$_['help_callback']			= 'Please login and set this at <a href="https://secure.authorize.net" target="_blank" class="txtLink">https://secure.authorize.net</a>.';
$_['help_md5']				= 'The MD5 Hash feature enables you to authenticate that a transaction response is securely received from Authorize.Net.Please login and set this at <a href="https://secure.authorize.net" target="_blank" class="txtLink">https://secure.authorize.net</a>.(Optional)';
$_['help_total']			= 'ยอดทั้งหมดของการสั่งซื้อต้องถึงจำนวนก่อนที่การชำระเงินวิธีนี้จะเปิดใช้งาน.';

// Error
$_['error_permission']		= 'คำเตือน: คุณไม่ได้รับอนุญาตให้ปรับปรุง payment Authorize.Net (SIM)!';
$_['error_merchant']		= 'ต้องการ Merchant ID!';
$_['error_key']				= 'ต้องการ Transaction Key!';