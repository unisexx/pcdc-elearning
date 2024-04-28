<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        @page {
            margin: 0px;
        }

        body {
            margin: 0px;
            font-family: "THSarabunNew";
            font-size: 13px;
        }

        .tbContent {
            border-spacing: 0px;
            border: 1px solid #555555;
        }

        .tbContent td:nth-child(3),
        .tbContent td:nth-child(4) {
            padding: 0 5px 0 0;
        }

        .tbContent2 {
            border-spacing: 0px;
        }

        .tbContent tr {
            line-height: 12.5px;
        }

        .tbContent th,
        .tbContent td {
            border: none;
            padding: 0px;
            height: 10px;
        }

        .tbContent .border1 {
            border-left: 1px solid #555555;
            border-bottom: 1px solid #555555;
            width: 70px;
        }

        .tbContent .border2 {
            border-left: 1px solid #555555;
            border-bottom: 1px solid #999999;
            width: 70px;
        }

        .tbContent .border3 {
            border-top: 1px solid #000000;
            border-left: 1px solid #555555;
            border-bottom: 1px solid #000000;
            width: 70px;
        }

        .lineHeight {
            line-height: 12.5px;
        }

        .borderHeadLeft {
            border-top: 1px solid #000000;
            border-bottom: 1px solid #000000;
            border-left: 1px solid #000000;
            border-right: 1px solid #000000;
        }

        .borderHeadCenter {
            border-top: 1px solid #000000;
            border-bottom: 1px solid #000000;
            border-right: 1px solid #000000;
        }

        u {
            border-bottom: 1px dotted #000;
            text-decoration: none;
            padding: 0px 35px;
        }
    </style>
</head>

<body>


    <table style="width: 100%; padding:10px 0;">
        <tr>
            <td width="50%" style="padding: 0 5px;">
                <center>
                    <div class="lineHeight"><b>สำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด{{ @get_province_name($rs->province_id) }}</b></div>
                    <div class="lineHeight"><b>รายงานการรับ - จ่ายเงินกองทุนคุ้มครองเด็ก</b></div>
                    <div class="lineHeight"><b>ประจำเดือน{{ @get_month_name($rs->month_id) }} {{ @$rs->budget_year_id + 543 }}</b></div>
                </center>
                <table class="tbContent" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th class="border1">{{ get_month_name($rs->month_id) }}</th>
                            <th class="border1">รวมตั้งแต่ต้นปี</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td><b>ยอดยกมา</b></td>
                            <td align='right' class="border2">
                                @if ($rs->total_from_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->total_from_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->total_from_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->total_from_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><b>บวก</b></td>
                            <td><u><b>รับโอนจากส่วนกลาง</b></u></td>
                            <td align='right' class="border2">-</td>
                            <td align='right' class="border2">-</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าสงเคราะห์รายบุคคล</td>
                            <td align='right' class="border2">
                                @if ($rs->p_individual_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_individual_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_individual_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_individual_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าสนับสนุนโครงการ 3 องค์กร 3 โครงการ</td>
                            <td align='right' class="border2">
                                @if ($rs->p_project_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_project_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_project_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_project_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าใช้จ่ายในการดำเนินงานของผู้คุ้มครองสวัสดิภาพเด็ก</td>
                            <td align='right' class="border2">
                                @if ($rs->p_child_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_child_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_child_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_child_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าเบี้ยประชุม</td>
                            <td align='right' class="border2">
                                @if ($rs->p_meeting_allow_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_meeting_allow_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_meeting_allow_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_meeting_allow_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าใช้จ่ายในการประชุม</td>
                            <td align='right' class="border2">
                                @if ($rs->p_meeting_expense_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_meeting_expense_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_meeting_expense_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_meeting_expense_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าใช้จ่ายอื่นๆ</td>
                            <td align='right' class="border2">
                                @if ($rs->p_other_expense_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_other_expense_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_other_expense_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_other_expense_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าธรรมเนียมธนาคาร</td>
                            <td align='right' class="border2">
                                @if ($rs->p_bank_fee_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_bank_fee_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_bank_fee_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_bank_fee_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><u><b>รับรายได้</b></u></td>
                            <td align='right' class="border2">-</td>
                            <td align='right' class="border2">-</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- รายได้ดอกเบี้ย</td>
                            <td align='right' class="border2">
                                @if ($rs->p_interest_income_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_interest_income_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_interest_income_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_interest_income_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td> - รายได้จากการรับบริจาค</td>
                            <td align='right' class="border2">
                                @if ($rs->p_donation_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_donation_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_donation_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_donation_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td> - รายได้ค่าปรับ</td>
                            <td align='right' class="border2">
                                @if ($rs->p_fines_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_fines_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_fines_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_fines_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- รายได้อื่น</td>
                            <td align='right' class="border2">
                                @if ($rs->p_other_income_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_other_income_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_other_income_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_other_income_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- รายได้รับคืนเงินสงเคราะห์</td>
                            <td align='right' class="border2">
                                @if ($rs->p_refund_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_refund_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_refund_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_refund_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- รายได้รับคืนเงินสนับสนุนโครงการฯ</td>
                            <td align='right' class="border2">
                                @if ($rs->p_support_project_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_support_project_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_support_project_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_support_project_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><u><b>รับคืน</b></u></td>
                            <td align='right' class="border2">-</td>
                            <td align='right' class="border2">-</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าใช้จ่ายสงเคราะห์รายบุคคล</td>
                            <td align='right' class="border2">
                                @if ($rs->p_back_individual_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_back_individual_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_back_individual_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_back_individual_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าใช้จ่ายสนับสนุนโครงการ</td>
                            <td align='right' class="border2">
                                @if ($rs->p_back_project_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_back_project_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_back_project_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_back_project_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าใช้จ่ายในการดำเนินงานของผู้คุ้มครองสวัสดิภาพเด็ก</td>
                            <td align='right' class="border2">
                                @if ($rs->p_back_child_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_back_child_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_back_child_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_back_child_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าเบี้ยประชุม</td>
                            <td align='right' class="border2">
                                @if ($rs->p_back_meeting_allow_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_back_meeting_allow_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_back_meeting_allow_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_back_meeting_allow_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าใช้จ่ายในการประชุม</td>
                            <td align='right' class="border2">
                                @if ($rs->p_back_meeting_expense_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_back_meeting_expense_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_back_meeting_expense_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_back_meeting_expense_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าใช้จ่ายอื่น</td>
                            <td align='right' class="border2">
                                @if ($rs->p_back_other_expense_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_back_other_expense_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_back_other_expense_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_back_other_expense_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าธรรมเนียมธนาคาร</td>
                            <td align='right' class="border2">
                                @if ($rs->p_back_bank_fee_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_back_bank_fee_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_back_bank_fee_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_back_bank_fee_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td> - ลูกหนี้เงินยืมกองทุนคุ้มครองเด็ก</td>
                            <td align='right' class="border2">
                                @if ($rs->p_back_deptor_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_back_deptor_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->p_back_deptor_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->p_back_deptor_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>รวมรายรับ</b></td>
                            <td align='right' class="border3">
                                @if ($rs->total_income_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->total_income_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border3">
                                @if ($rs->total_income_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->total_income_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td height="25" align="center"></td>
                            <td></td>
                            <td align='right' class="border2">-</td>
                            <td align='right' class="border2">-</td>
                        </tr>
                        <tr>
                            <td height="25" align="center"><b>หัก</b></td>
                            <td><u><b>โอนกลับส่วนกลาง</b></u></td>
                            <td align='right' class="border2">-</td>
                            <td align='right' class="border2">-</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td> - รายได้ดอกเบี้ย</td>
                            <td align='right' class="border2">
                                @if ($rs->m_income_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_income_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_income_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_income_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td> - ค่าใช้จ่ายบริหาร</td>
                            <td align='right' class="border2">
                                @if ($rs->m_admin_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_admin_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_admin_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_admin_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td> - รายได้จากการรับบริจาค</td>
                            <td align='right' class="border2">
                                @if ($rs->m_donation_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_donation_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_donation_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_donation_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- รายได้ค่าปรับ</td>
                            <td align='right' class="border2">
                                @if ($rs->m_fines_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_fines_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_fines_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_fines_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- รายได้อื่น</td>
                            <td align='right' class="border2">
                                @if ($rs->m_other_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_other_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_other_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_other_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- รายได้รับคืนเงินสงเคราะห์รายบุคคล</td>
                            <td align='right' class="border2">
                                @if ($rs->m_receive_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_receive_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_receive_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_receive_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าใช้จ่ายสงเคราะห์รายบุคคล</td>
                            <td align='right' class="border2">
                                @if ($rs->m_support_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_support_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_support_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_support_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าใช้จ่ายสนับสนุนโครงการ</td>
                            <td align='right' class="border2">
                                @if ($rs->m_project_expense_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_project_expense_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_project_expense_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_project_expense_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าใช้จ่ายในการดำเนินงานของผู้คุ้มครองสวัสดิภาพเด็ก</td>
                            <td align='right' class="border2">
                                @if ($rs->m_operating_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_operating_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_operating_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_operating_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าเบี้ยประชุม</td>
                            <td align='right' class="border2">
                                @if ($rs->m_meeting_allowance_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_meeting_allowance_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_meeting_allowance_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_meeting_allowance_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าใช้จ่ายในการประชุม</td>
                            <td align='right' class="border2">
                                @if ($rs->m_meeting_expense_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_meeting_expense_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_meeting_expense_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_meeting_expense_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าใช้จ่ายอื่น</td>
                            <td align='right' class="border2">
                                @if ($rs->m_other_expense_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_other_expense_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_other_expense_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_other_expense_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าธรรมเนียมธนาคาร</td>
                            <td align='right' class="border2">
                                @if ($rs->m_bank_fee_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_bank_fee_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_bank_fee_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_bank_fee_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><u><b>จ่ายค่าใช้จ่าย</b></u></td>
                            <td align='right' class="border2">-</td>
                            <td align='right' class="border2">-</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าใช้จ่ายสงเคราะห์รายบุคคล</td>
                            <td align='right' class="border2">
                                @if ($rs->m_pay_individual_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_pay_individual_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_pay_individual_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_pay_individual_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าสนับสนุนโครงการ 3 องค์กร 3 โครงการ</td>
                            <td align='right' class="border2">
                                @if ($rs->m_pay_project_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_pay_project_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_pay_project_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_pay_project_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าใช้จ่ายในการดำเนินงานของผู้คุ้มครองสวัสดิภาพเด็ก</td>
                            <td align='right' class="border2">
                                @if ($rs->m_pay_child_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_pay_child_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_pay_child_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_pay_child_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td> - ค่าเบี้ยประชุม</td>
                            <td align='right' class="border2">
                                @if ($rs->m_pay_meeting_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_pay_meeting_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_pay_meeting_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_pay_meeting_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าใช้จ่ายในการประชุม</td>
                            <td align='right' class="border2">
                                @if ($rs->m_pay_meeting_expense_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_pay_meeting_expense_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_pay_meeting_expense_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_pay_meeting_expense_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าใช้จ่ายอื่น</td>
                            <td align='right' class="border2">
                                @if ($rs->m_pay_other_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_pay_other_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_pay_other_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_pay_other_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>- ค่าธรรมเนียมธนาคาร</td>
                            <td align='right' class="border2">
                                @if ($rs->m_pay_bank_fee_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_pay_bank_fee_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_pay_bank_fee_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_pay_bank_fee_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td> - ลูกหนี้เงินยืมกองทุนคุ้มครองเด็ก</td>
                            <td align='right' class="border2">
                                @if ($rs->m_pay_deptor_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_pay_deptor_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border2">
                                @if ($rs->m_pay_deptor_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->m_pay_deptor_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>รวมรายจ่าย</b></td>
                            <td align='right' class="border3">
                                @if ($rs->total_expenses_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->total_expenses_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border3">
                                @if ($rs->total_expenses_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->total_expenses_2, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>ยอดยกไป</b></td>
                            <td align='right' class="border3">
                                @if ($rs->total_carry_1 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->total_carry_1, 2) }}
                                @endif
                            </td>
                            <td align='right' class="border3">
                                @if ($rs->total_carry_2 == '0.00')
                                    -
                                @else
                                    {{ number_format($rs->total_carry_2, 2) }}
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td width="50%" style="vertical-align:top; padding:0 5px;">
                <center>
                    <div class="lineHeight"><b>งบพิสูจน์ยอดเงินฝากธนาคารกองทุนคุ้มครองเด็ก</b></div>
                    <div class="lineHeight"><b>สำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด{{ get_province_name($rs->province_id) }}</b></div>
                    <div class="lineHeight"><b>ธนาคารกรุงไทย จำกัด (มหาชน) บัญชีเลขที่<span class="mask-bank-number">{{ @$rs->bank_number }}</span></b></div>
                    <div class="lineHeight"><b>ณ วันที่ {{ @DB2Date(@$rs->bank_deposit_date) }}</b></div>
                </center>
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <table width="100%" class='tbContent2'>
                                <tr>
                                    <td>ยอดคงเหลือตามสมุดบัญชีเงินฝากธนาคาร</td>
                                    <td width="70" align="right">
                                        @if ($rs->balance_book_bank == '0.00' || empty($rs->balance_book_bank))
                                            -
                                        @else
                                            {{ number_format($rs->balance_book_bank, 2) }}
                                        @endif&nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><b>หัก</b></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เช็คที่สั่งจ่ายยังไม่มีผู้นำไปขึ้นเงิน</td>
                                    <td align="right">
                                        @if ($rs->cd_amount_total == '0.00' || empty($rs->cd_amount_total))
                                            -
                                        @else
                                            {{ number_format($rs->cd_amount_total, 2) }}
                                        @endif&nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td>ยอดคงเหลือตามรายงานรับ-จ่ายเงินประจำเดือน{{ @get_month_name($rs->month_id) }}</td>
                                    <td align="right" style="border-top: 1px solid #000000; border-bottom: 2px solid #000000;">
                                        @if ($rs->balance_result == '0.00' || empty($rs->balance_result))
                                            -
                                        @else
                                            {{ number_format($rs->balance_result, 2) }}
                                        @endif&nbsp;
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <div><b>รายละเอียดเช็คที่สั่งจ่ายแล้วผู้รับยังไม่นำไปขึ้นเงิน</b></div>
                            <table width="100%" class="tbContent2 lineHeight" style="border-collapse: collapse;">
                                <tr>
                                    <td align="center" class="borderHeadLeft">วดป.ที่จ่าย</td>
                                    <td align="center" class="borderHeadCenter">เลขที่เช็ค</td>
                                    <td align="center" class="borderHeadCenter">จ่ายให้</td>
                                    <td align="center" class="borderHeadCenter">รายการ</td>
                                    <td align="center" class="borderHeadCenter">จำนวนเงิน</td>
                                    <td align="center" class="borderHeadCenter">หมายเหตุ</td>
                                </tr>
                                @if (@$rs->CheckDetail)
                                    @foreach (@$rs->CheckDetail as $check_detail)
                                        <tr>
                                            <td align="center" class="borderHeadLeft">{{ @DB2Date(@$check_detail->date) }}</td>
                                            <td align="center" class="borderHeadCenter">{{ @$check_detail->check_number }}</td>
                                            <td align="center" class="borderHeadCenter">{{ @$check_detail->pay_for }}</td>
                                            <td align="center" class="borderHeadCenter">{{ @$check_detail->detail }}</td>
                                            <td align="right" class="borderHeadCenter">{{ number_format(@$check_detail->amount, 2) }}&nbsp;</td>
                                            <td align="center" class="borderHeadCenter">{{ @$check_detail->note }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr height="25"style="border-left-color:#FFF; border-bottom-color:#FFF; border-right-color:#FFF">
                                    <td colspan="4" style="border-right-color:#000"><strong>รวมเช็คที่สั่งจ่ายแล้วแต่ยังไม่มีผู้นำไปขึ้นเงิน</strong></td>
                                    <td align="right" style="border-right:1px solid #000000; border-bottom:1px solid #000000; border-left:1px solid #000000;">
                                        @if ($rs->chk_amount_total == '0.00' || empty($rs->chk_amount_total))
                                            -
                                        @else
                                            {{ number_format($rs->chk_amount_total, 2) }}&nbsp;
                                        @endif
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="25"style="border-left-color:#FFF; border-bottom-color:#FFF; border-right-color:#FFF">
                                    <td colspan="4">&nbsp;</td>
                                    <td align="right">&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="25"style="border-left-color:#FFF; border-bottom-color:#FFF; border-right-color:#FFF">
                                    <td colspan="6"><strong>รายละเอียดเงินคงเหลือตามรายงานรับ - จ่ายเงินประจำเดือนประกอบด้วย</strong></td>
                                </tr>
                                <tr height="25"style="border-left-color:#FFF; border-bottom-color:#FFF; border-right-color:#FFF">
                                    <td colspan="4">ค่าใช้จ่ายสงเคราะห์รายบุคคล</td>
                                    <td align="right">
                                        @if ($rs->bm_person == '0.00' || empty($rs->bm_person))
                                            -
                                        @else
                                            {{ number_format($rs->bm_person, 2) }}
                                        @endif&nbsp;
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="25"style="border-left-color:#FFF; border-bottom-color:#FFF; border-right-color:#FFF">
                                    <td colspan="4">ค่าใช้จ่ายสนับสนุนโครงการ</td>
                                    <td align="right">
                                        @if ($rs->bm_project == '0.00' || empty($rs->bm_project))
                                            -
                                        @else
                                            {{ number_format($rs->bm_project, 2) }}
                                        @endif&nbsp;
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="25"style="border-left-color:#FFF; border-bottom-color:#FFF; border-right-color:#FFF">
                                    <td colspan="4">ค่าใช้จ่ายในการดำเนินงานของผู้คุ้มครองสวัสดิภาพเด็ก</td>
                                    <td align="right">
                                        @if ($rs->bm_child == '0.00' || empty($rs->bm_child))
                                            -
                                        @else
                                            {{ number_format($rs->bm_child, 2) }}
                                        @endif&nbsp;
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="25"style="border-left-color:#FFF; border-bottom-color:#FFF; border-right-color:#FFF">
                                    <td colspan="4">ค่าใช้จ่ายดำเนินการบริหารกองทุน</td>
                                    <td align="right">
                                        @if ($rs->bm_fund == '0.00' || empty($rs->bm_fund))
                                            -
                                        @else
                                            {{ number_format($rs->bm_fund, 2) }}
                                        @endif&nbsp;
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="25"style="border-left-color:#FFF; border-bottom-color:#FFF; border-right-color:#FFF">
                                    <td colspan="4">รายได้ดอกเบี้ย</td>
                                    <td align="right">
                                        @if ($rs->bm_interest == '0.00' || empty($rs->bm_interest))
                                            -
                                        @else
                                            {{ number_format($rs->bm_interest, 2) }}
                                        @endif&nbsp;
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="25"style="border-left-color:#FFF; border-bottom-color:#FFF; border-right-color:#FFF">
                                    <td colspan="4">รายได้ค่าปรับ</td>
                                    <td align="right">
                                        @if ($rs->bm_fine == '0.00' || empty($rs->bm_fine))
                                            -
                                        @else
                                            {{ number_format($rs->bm_fine, 2) }}
                                        @endif&nbsp;
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="25"style="border-left-color:#FFF; border-bottom-color:#FFF; border-right-color:#FFF">
                                    <td colspan="4">ค่าใช้จ่ายอื่น(ค่าธรรมเนียม)</td>
                                    <td align="right">
                                        @if ($rs->bm_fee == '0.00' || empty($rs->bm_fee))
                                            -
                                        @else
                                            {{ number_format($rs->bm_fee, 2) }}
                                        @endif&nbsp;
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="25"style="border-left-color:#FFF; border-bottom-color:#FFF; border-right-color:#FFF">
                                    <td colspan="4">อื่นๆ</td>
                                    <td align="right" style="border-bottom-color:#000;">
                                        @if ($rs->bm_other == '0.00' || empty($rs->bm_other))
                                            -
                                        @else
                                            {{ number_format($rs->bm_other, 2) }}
                                        @endif&nbsp;
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="25"style="border-left-color:#FFF; border-bottom-color:#FFF; border-right-color:#FFF">
                                    <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รวม</td>
                                    <td align="right" style="border-bottom: 2px solid #000000;">
                                        @if ($rs->bm_total == '0.00' || empty($rs->bm_total))
                                            -
                                        @else
                                            {{ number_format($rs->bm_total, 2) }}
                                        @endif&nbsp;
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="25"style="border-left-color:#FFF; border-bottom-color:#FFF; border-right-color:#FFF;">
                                    <td height="70" colspan="6">&nbsp;</td>
                                </tr>
                                <tr height="25"style="border-left-color:#FFF; border-bottom-color:#FFF; border-right-color:#FFF;">
                                    <td colspan="6" align="right">ลงชื่อ <u>{{ Auth::user()->name }}</u> ผู้รายงาน&nbsp;&nbsp;</td>
                                </tr>
                                <tr height="25"style="border-left-color:#FFF; border-bottom-color:#FFF; border-right-color:#FFF;">
                                    <td colspan="6" align="right">ตำแหน่ง <u>{{ Auth::user()->position }}&nbsp;&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
