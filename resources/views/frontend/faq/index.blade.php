@extends('layouts.frontend')

@section('page', 'คำถามที่พบบ่อย')

@section('content')
    <!--====================================================
                            =                      CONTENT                         =
                            =====================================================-->
    <div class="container py-5 wow fadeInDown">
        <!-- <div class="title-content pb-3">คำถามที่พบบ่อย</div>-->
        <!--########### Start FAQ ###########-->
        <div class="row my-4">
            <div class="accordion accordion-style1 " id="accordionExample">
                @if (!empty(@$faqs))
                    @foreach (@$faqs as $key => $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button @if ($key != 0) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $key }}" aria-expanded="@if ($key == 0) true @else false @endif" aria-controls="collapse_{{ $key }}">
                                    {{ @$item->question }}
                                </button>
                            </h2>
                            <div id="collapse_{{ $key }}" class="accordion-collapse collapse @if ($key == 0) show @endif" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!! nl2br(e(@$item->answer)) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <!--########### End FAQ ###########-->
    </div>
    <!--=================== End Content =================-->
@endsection
