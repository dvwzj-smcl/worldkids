<?php
// Text
$_['text_title']				= 'ใบเรียกเก็บเงิน Klarna - ชำระภายใน 14 วัน';
$_['text_terms_fee']			= '<span id="klarna_invoice_toc"></span> (+%s)<script type="text/javascript">var terms = new Klarna.Terms.Invoice({el: \'klarna_invoice_toc\', eid: \'%s\', country: \'%s\', charge: %s});</script>';
$_['text_terms_no_fee']			= '<span id="klarna_invoice_toc"></span><script type="text/javascript">var terms = new Klarna.Terms.Invoice({el: \'klarna_invoice_toc\', eid: \'%s\', country: \'%s\'});</script>';
$_['text_additional']			= 'ใบเรียกเก็บเงิน Klarna ต้องการข้อมูลเพิ่มเติมก่อนที่จะดำเนินการรายการสั่งซื้อของคุณ.';
$_['text_male']					= 'ชาย';
$_['text_female']				= 'หญิง';
$_['text_year']					= 'ปี';
$_['text_month']				= 'เดือน';
$_['text_day']					= 'วัน';
$_['text_comment']				= 'รหัสใบเรียกเก็บเงิน Klarna\'s: %s. ' . "\n" . '%s/%s: %.4f';

// Entry
$_['entry_gender']				= 'เพศ';
$_['entry_pno']					= 'หมายเลขส่วนตัว';
$_['entry_dob']					= 'วันเกิด';
$_['entry_phone_no']			= 'หมายเลขโทรศัพท์';
$_['entry_street']				= 'ที่อยู่';
$_['entry_house_no']			= 'บ้านเลขที่.';
$_['entry_house_ext']			= 'House Ext.';
$_['entry_company']				= 'เลขทะเบียนบริษัท';

// Help
$_['help_pno']					= 'โปรดกรอกเลขประกับสังคมของคุณที่นี่.';
$_['help_phone_no']				= 'โปรดกรอกเลขโทรศัพท์ของคุณ.';
$_['help_street']				= 'โปรดทราบว่าการจัดส่งจะดำเนินการเมื่อที่อยู่ลงทะเบียนชำระเงินกับ Klarna เท่านั้น..';
$_['help_house_no']				= 'โปรดกรอกบ้านเลขที่.';
$_['help_house_ext']			= 'Please submit your house extension here. E.g. A, B, C, Red, Blue ect.';
$_['help_company']				= 'โปรดกรอกเลขทะเบียนบริษัทของคุณ';

// Error
$_['error_deu_terms']			= 'คุณต้องยอมรับนโยบายความเป็นส่วนตัวของ Klarna (Datenschutz)';
$_['error_address_match']		= 'ที่อยู่การชำระเงินและจัดส่งต้องตรงกันถ้าหากคุณจะใช้ใบเรียกเก็บเงิน Klarna';
$_['error_network']				= 'มีข้อผิดพลาดระหว่างเชื่อมต่อไปยัง Klarna. โปรดลองอีกครั้ง.';