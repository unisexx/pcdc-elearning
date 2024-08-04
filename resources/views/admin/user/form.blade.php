@component('components.card.form')
    @slot('cardHeaderText')
        ผู้ใช้งาน
    @endslot

    @slot('form')
        <div class="row mt-3">
            <div class="col-12">
                {{ Form::bsText('name', 'ชื่อ') }}
            </div>
            <div class="col-12">
                {{ Form::bsText('email', 'อีเมล์') }}
            </div>
            <div class="col-12">
                {{ Form::bsPassword('password', 'รหัสผ่าน') }}
            </div>
            <div class="col-12">
                {{ Form::bsPassword('password_confirmation', 'ยืนยันรหัสผ่าน') }}
            </div>
            <div class="col-12">
                {{ Form::bsSwitch('is_admin', 'แอดมิน', @$rs->is_admin, '1', '0') }}
            </div>
        </div>

        @if ($rs)
            @php
                $exam_history = \App\Models\UserCurriculumExamHistory::where('user_id', $rs->id)                    
                    ->orderBy('created_at', 'desc')
                    ->get();
            @endphp
            <div class="d-flex align-items-center">
                <h5 class="font-weight-bolder">ประวัติการเรียน</h5>
            </div>
            <table class="history-table table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="50">ลำดับ</th>
                        <th>หลักสูตร</th>
                        <th width="150">สถานะ</th>
                        <th width="200">วันที่ผ่านการทดสอบ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($exam_history as $key=>$item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->curriculum->name }}</td>
                            <td class="text-center">
                                @if (!$item->post_date_finished)
                                    <span class="text-default">ยังไม่จบบทเรียน</span>
                                @elseif($item->post_pass_status == 'y')
                                    <span class="text-success">ผ่าน</span>
                                @else
                                    <span class="text-danger">ไม่ผ่าน</span>
                                @endif
                            </td>
                            <td>
                                {{ DbToDate($item->post_date_finished, true, true) }}
                            </td>
                            <td class="text-center">
                                @if ($item->post_pass_status == 'y')
                                    <a href="{{ url('admin/certificate/pdf/'.$rs->id .'/'. $item->curriculum_id) }}" class="btn btn-success" target="_blank"><i
                                            class="fa fa-download"></i> ดาวน์โหลดใบประกาศ</a>                                
                                @endif
                            </td>
                        </tr>
                    @empty
                    @endempty
            </tbody>
        </table>
    @endif

    <div class="col-auto mt-3 float-end">
        {{ link_to_route('admin.user.index', 'ย้อนกลับ', $parameters = [], $attributes = ['class' => 'btn btn-lg btn-light px-4']) }}
        {{ Form::submit('บันทึก', ['class' => 'btn btn-lg bg-gradient-primary']) }}
    </div>
@endslot
@endcomponent
