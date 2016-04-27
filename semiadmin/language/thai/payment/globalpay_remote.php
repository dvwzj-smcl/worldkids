<?php
// Heading
$_['heading_title']					= 'Globalpay Remote';

// Text
$_['text_payment']					= 'การชำระเงิน';
$_['text_success']					= 'สำเร็จ: You have modified Globalpay account details!';
$_['text_edit']                     = 'Edit Globalpay Remote';
$_['text_card_type']				= 'ประเภทบัตร';
$_['text_enabled']					= 'Enabled';
$_['text_use_default']				= 'Use default';
$_['text_merchant_id']				= 'รหัสผู้ค้า';
$_['text_subaccount']				= 'Sub Account';
$_['text_secret']					= 'Shared secret';
$_['text_card_visa']				= 'Visa';
$_['text_card_master']				= 'Mastercard';
$_['text_card_amex']				= 'American Express';
$_['text_card_switch']				= 'Switch/Maestro';
$_['text_card_laser']				= 'Laser';
$_['text_card_diners']				= 'Diners';
$_['text_capture_ok']				= 'การจับสำเร็จ';
$_['text_capture_ok_order']			= 'Capture was successful, order status updated to success - settled';
$_['text_rebate_ok']				= 'Rebate was successful';
$_['text_rebate_ok_order']			= 'Rebate was successful, order status updated to rebated';
$_['text_void_ok']					= 'Void was successful, order status updated to voided';
$_['text_settle_auto']				= 'Auto';
$_['text_settle_delayed']			= 'Delayed';
$_['text_settle_multi']				= 'Multi';
$_['text_ip_message']				= 'You must supply your server IP address to your Globalpay account manager before going live';
$_['text_payment_info']				= 'ข้อมูลการชำระเงิน';
$_['text_capture_status']			= 'ได้รับการชำระเงินแล้ว';
$_['text_void_status']				= 'Payment voided';
$_['text_rebate_status']			= 'Payment rebated';
$_['text_order_ref']				= 'อ้างอิงการสั่งซื้อ';
$_['text_order_total']				= 'Total authorised';
$_['text_total_captured']			= 'ทั้งหมดที่ได้รับ';
$_['text_transactions']				= 'การทำธุรกรรม';
$_['text_confirm_void']				= 'Are you sure you want to void the payment?';
$_['text_confirm_capture']			= 'คุณแน่ใจหรือไม่ที่จะจับการชำระเงิน?';
$_['text_confirm_rebate']			= 'Are you sure you want to rebate the payment?';
$_['text_globalpay_remote']			= '<a target="_blank" href="https://resourcecentre.globaliris.com/getting-started.php?id=OpenCart"><img src="view/image/payment/globalpay.png" alt="Globalpay" title="Globalpay" style="border: 1px solid #EEEEEE;" /></a>';

// Column
$_['text_column_amount']			= 'จำนวน';
$_['text_column_type']				= 'ประเภท';
$_['text_column_date_added']		= 'สร้างแล้ว';

// Entry
$_['entry_merchant_id']				= 'รหัสผู้ค้า';
$_['entry_secret']					= 'Shared secret';
$_['entry_rebate_password']			= 'Rebate password';
$_['entry_total']					= 'ทั้งหมด';
$_['entry_sort_order']				= 'Sort order';
$_['entry_geo_zone']				= 'Geo zone';
$_['entry_status']					= 'สถานะ';
$_['entry_debug']					= 'บันทึกดีบัก';
$_['entry_auto_settle']				= 'Settlement type';
$_['entry_tss_check']				= 'TSS checks';
$_['entry_card_data_status']		= 'Card info logging';
$_['entry_3d']						= 'Enable 3D secure';
$_['entry_liability_shift']			= 'Accept non-liability shifting scenarios';
$_['entry_status_success_settled']	= 'Success - settled';
$_['entry_status_success_unsettled'] = 'Success - not settled';
$_['entry_status_decline']			= 'Decline';
$_['entry_status_decline_pending']	= 'Decline - offline auth';
$_['entry_status_decline_stolen']	= 'Decline - lost or stolen card';
$_['entry_status_decline_bank']		= 'Decline - bank error';
$_['entry_status_void']				= 'Voided';
$_['entry_status_rebate']			= 'Rebated';

// Help
$_['help_total']					= 'ยอดทั้งหมดของการสั่งซื้อต้องถึงจำนวนก่อนที่การชำระเงินวิธีนี้จะเปิดใช้งาน';
$_['help_card_select']				= 'Ask the user to choose thier card type before they are redirected';
$_['help_notification']				= 'You need to supply this URL to Globalpay to get payment notifications';
$_['help_debug']					= 'Enabling debug will write sensitive data to a log file. You should always disable unless instructed otherwise.';
$_['help_liability']				= 'Accepting liability means you will still accept payments when a user fails 3D secure.';
$_['help_card_data_status']			= 'Logs last 4 cards digits, expire, name, type and issuing bank information';

// Tab
$_['tab_api']					    = 'รายละเอียด API';
$_['tab_account']				    = 'Accounts';
$_['tab_order_status']				= 'สถานะการสั่งซื้อ';
$_['tab_payment']					= 'Payment Settings';

// Button
$_['button_capture']				= 'จับข้อมูล';
$_['button_rebate']					= 'Rebate / refund';
$_['button_void']					= 'โมฆะ';

// Error
$_['error_merchant_id']				= 'ต้องการ Merchant ID';
$_['error_secret']					= 'ต้องการ Shared secret';