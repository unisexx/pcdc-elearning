<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Laravel Pdf',
	'display_mode'          => 'fullpage',
	'tempDir'               => storage_path('app/temp/'),
	'font_path'  			=> public_path('fonts'),
	'font_data'  			=> [
								'thsarabun' => [
									'R' => 'THSarabunNew.ttf',    // regular font
									'B' => 'THSarabunNew Bold.ttf',       // optional: bold font
									'I' => 'THSarabunNew Italic.ttf',     // optional: italic font
									'BI' => 'THSarabunNew Bold Italic.ttf' // optional: bold-italic font
								],
							],
	'pdf_a'                 => false,
	'pdf_a_auto'            => false,
	'icc_profile_path'      => ''
];
