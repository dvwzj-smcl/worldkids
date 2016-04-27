<?php
// Heading
$_['heading_title']					 = 'First Data EMEA Web Service API';

// Text
$_['text_firstdata_remote']			 = '<img src="view/image/payment/firstdata.png" alt="First Data" title="First Data" style="border: 1px solid #EEEEEE;" />';
$_['text_payment']					 = 'การชำระเงิน';
$_['text_success']					 = 'สำเร็จ: You have modified First Data account details!';
$_['text_edit']                      = 'Edit First Data EMEA Web Service API';
$_['text_card_type']				 = 'ประเภทบัตร';
$_['text_enabled']					 = 'Enabled';
$_['text_merchant_id']				 = 'รหัสร้านค้า';
$_['text_subaccount']				 = 'Subaccount';
$_['text_user_id']					 = 'User ID';
$_['text_capture_ok']				 = 'การจับสำเร็จ';
$_['text_capture_ok_order']			 = 'Capture was successful, order status updated to success - settled';
$_['text_refund_ok']				 = 'Refund was successful';
$_['text_refund_ok_order']			 = 'Refund was successful, order status updated to refunded';
$_['text_void_ok']					 = 'Void was successful, order status updated to voided';
$_['text_settle_auto']				 = 'การขาย';
$_['text_settle_delayed']			 = 'Pre auth';
$_['text_mastercard']				 = 'Mastercard';
$_['text_visa']						 = 'Visa';
$_['text_diners']					 = 'Diners';
$_['text_amex']						 = 'American Express';
$_['text_maestro']					 = 'Maestro';
$_['text_payment_info']				 = 'ข้อมูลการชำระเงิน';
$_['text_capture_status']			 = 'ได้รับการชำระเงินแล้ว';
$_['text_void_status']				 = 'Payment voided';
$_['text_refund_status']			 = 'คืนเงินแล้ว';
$_['text_order_ref']				 = 'อ้างอิงการสั่งซื้อ';
$_['text_order_total']				 = 'Total authorised';
$_['text_total_captured']			 = 'ทั้งหมดที่ได้รับ';
$_['text_transactions']				 = 'การทำธุรกรรม';
$_['text_column_amount']			 = 'จำนวน';
$_['text_column_type']				 = 'ประเภท';
$_['text_column_date_added']		 = 'สร้างแล้ว';
$_['text_confirm_void']				 = 'Are you sure you want to void the payment?';
$_['text_confirm_capture']			 = 'คุณแน่ใจหรือไม่ที่จะจับการชำระเงิน?';
$_['text_confirm_refund']			 = 'คุณแน่ใจหรือไม่ที่จะจับการคืนเงิน?';

// Entry
$_['entry_certificate_path']		 = 'Certificate path';
$_['entry_certificate_key_path']	 = 'Private key path';
$_['entry_certificate_key_pw']		 = 'Private key password';
$_['entry_certificate_ca_path']		 = 'CA path';
$_['entry_merchant_id']				 = 'รหัสร้านค้า';
$_['entry_user_id']					 = 'User ID';
$_['entry_password']				 = 'รหัสผ่าน';
$_['entry_total']					 = 'ทั้งหมด';
$_['entry_sort_order']				 = 'Sort order';
$_['entry_geo_zone']				 = 'Geo zone';
$_['entry_status']					 = 'สถานะ';
$_['entry_debug']					 = 'บันทึกดีบัก';
$_['entry_auto_settle']				 = 'Settlement type';
$_['entry_status_success_settled']	 = 'Success - settled';
$_['entry_status_success_unsettled'] = 'Success - not settled';
$_['entry_status_decline']			 = 'Decline';
$_['entry_status_void']				 = 'Voided';
$_['entry_status_refund']			 = 'Refunded';
$_['entry_enable_card_store']		 = 'Enable card storage tokens';
$_['entry_cards_accepted']			 = 'Card types accepted';

// Help
$_['help_total']					 = 'ยอดทั้งหมดของการสั่งซื้อต้องถึงจำนวนก่อนที่การชำระเงินวิธีนี้จะเปิดใช้งาน';
$_['help_certificate']				 = 'Certificates and private keys should be stored outside of your public web folders';
$_['help_card_select']				 = 'Ask the user to choose thier card type before they are redirected';
$_['help_notification']				 = 'You need to supply this URL to First Data to get payment notifications';
$_['help_debug']					 = 'Enabling debug will write sensitive data to a log file. You should always disable unless instructed otherwise .';
$_['help_settle']					 = 'If you use pre-auth you must complete a post-auth action within 3-5 days otherwise your transaction will be dropped';

// Tab
$_['tab_account']					 = 'API info';
$_['tab_order_status']				 = 'สถานะการสั่งซื้อ';
$_['tab_payment']					 = 'Payment settings';

// Button
$_['button_capture']				= 'จับข้อมูล';
$_['button_refund']					= 'คืนเงิน';
$_['button_void']					= 'โมฆะ';

// Error
$_['error_merchant_id']				= 'ต้องการ รหัสร้านค้า';
$_['error_user_id']					= 'ต้องการ User ID';
$_['error_password']				= 'ต้องการรหัสผ่าน';
$_['error_certificate']				= 'ต้องการ Certificate path';
$_['error_key']						= 'ต้องการ Certificate key';
$_['error_key_pw']					= 'ต้องการ Certificate key password';
$_['error_ca']						= 'ต้องการ Certificate Authority (CA) is';