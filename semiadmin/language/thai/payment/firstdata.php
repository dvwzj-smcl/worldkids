<?php
// Heading
$_['heading_title']					 = 'First Data EMEA Connect (3DSecure enabled)';

// Text
$_['text_payment']					 = 'การชำระเงิน';
$_['text_success']					 = 'สำเร็จ: You have modified First Data account details!';
$_['text_edit']                      = 'Edit First Data EMEA Connect (3DSecure enabled)';
$_['text_notification_url']			 = 'Notification URL';
$_['text_live']						 = 'สด';
$_['text_demo']						 = 'Demo';
$_['text_enabled']					 = 'Enabled';
$_['text_merchant_id']				 = 'รหัสร้านค้า';
$_['text_secret']					 = 'Shared secret';
$_['text_capture_ok']				 = 'การจับสำเร็จ';
$_['text_capture_ok_order']			 = 'Capture was successful, order status updated to success - settled';
$_['text_void_ok']					 = 'Void was successful, order status updated to voided';
$_['text_settle_auto']				 = 'การขาย';
$_['text_settle_delayed']			 = 'Pre auth';
$_['text_success_void']				 = 'Transaction has been voided';
$_['text_success_capture']			 = 'Transaction has been captured';
$_['text_firstdata']				 = '<img src="view/image/payment/firstdata.png" alt="First Data" title="First Data" style="border: 1px solid #EEEEEE;" />';
$_['text_payment_info']				 = 'ข้อมูลการชำระเงิน';
$_['text_capture_status']			 = 'ได้รับการชำระเงินแล้ว';
$_['text_void_status']				 = 'Payment voided';
$_['text_order_ref']				 = 'อ้างอิงการสั่งซื้อ';
$_['text_order_total']				 = 'Total authorised';
$_['text_total_captured']			 = 'ทั้งหมดที่ได้รับ';
$_['text_transactions']				 = 'การทำธุรกรรม';
$_['text_column_amount']			 = 'จำนวน';
$_['text_column_type']				 = 'ประเภท';
$_['text_column_date_added']		 = 'สร้างแล้ว';
$_['text_confirm_void']				 = 'Are you sure you want to void the payment?';
$_['text_confirm_capture']			 = 'คุณแน่ใจหรือไม่ที่จะจับการชำระเงิน?';

// Entry
$_['entry_merchant_id']				 = 'รหัสร้านค้า';
$_['entry_secret']					 = 'Shared secret';
$_['entry_total']					 = 'ทั้งหมด';
$_['entry_sort_order']				 = 'Sort order';
$_['entry_geo_zone']				 = 'Geo zone';
$_['entry_status']					 = 'สถานะ';
$_['entry_debug']					 = 'บันทึกดีบัก';
$_['entry_live_demo']				 = 'Live / Demo';
$_['entry_auto_settle']			  	 = 'Settlement type';
$_['entry_card_select']				 = 'Select card';
$_['entry_tss_check']				 = 'TSS checks';
$_['entry_live_url']				 = 'Live connection URL';
$_['entry_demo_url']				 = 'Demo connection URL';
$_['entry_status_success_settled']	 = 'Success - settled';
$_['entry_status_success_unsettled'] = 'Success - not settled';
$_['entry_status_decline']		 	 = 'Decline';
$_['entry_status_void']				 = 'Voided';
$_['entry_enable_card_store']		 = 'Enable card storage tokens';

// Help
$_['help_total']					 = 'ยอดทั้งหมดของการสั่งซื้อต้องถึงจำนวนก่อนที่การชำระเงินวิธีนี้จะเปิดใช้งาน';
$_['help_notification']				 = 'You need to supply this URL to First Data to get payment notifications';
$_['help_debug']					 = 'Enabling debug will write sensitive data to a log file. You should always disable unless instructed otherwise';
$_['help_settle']					 = 'If you use pre-auth you must complete a post-auth action within 3-5 days otherwise your transaction will be dropped'; 

// Tab
$_['tab_account']					 = 'API info';
$_['tab_order_status']				 = 'สถานะการสั่งซื้อ';
$_['tab_payment']					 = 'Payment settings';
$_['tab_advanced']					 = 'Advanced';

// Button
$_['button_capture']				 = 'จับข้อมูล';
$_['button_void']					 = 'โมฆะ';

// Error
$_['error_merchant_id']				 = 'ต้องการ รหัสร้านค้า';
$_['error_secret']					 = 'ต้องการ Shared secret';
$_['error_live_url']				 = 'ต้องการ Live URL';
$_['error_demo_url']				 = 'ต้องการ Demo URL';
$_['error_data_missing']			 = 'Data missing';
$_['error_void_error']				 = 'Unable to void transaction';
$_['error_capture_error']			 = 'Unable to capture transaction';