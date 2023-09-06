@extends('layouts.manage') 
@section('title', 'Mahathep || Auto')
@section('content')
<style>
    #button{
           display:block;
           margin:20px auto;
           padding:30px 30px;
           background-color:#eee;
           border:solid #ccc 1px;
           cursor: pointer;
           }
           #overlay{
           position: fixed;
           top: 0;
           z-index: 100;
           width: 100%;
           height:100%;
           display: none;
           background: rgba(0,0,0,0.6);
           }
           .cv-spinner {
           height: 100%;
           display: flex;
           justify-content: center;
           align-items: center;
           }
           .spinner {
           width: 250px;
           height: 250px;
           border: 10px #ddd solid;
           border-top: 10px #1fdab1 solid;
           border-radius: 50%;
           animation: sp-anime 0.8s infinite linear;
           }
           @keyframes sp-anime {
           100% {
               transform: rotate(390deg);
           }
           }
           .is-hide{
           display:none;
           }
</style>

<div class="tabs-animation">

        <div class="row text-center">
            <div id="overlay">
                <div class="cv-spinner">
                  <span class="spinner"></span>
                </div>
              </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                 <div class="main-card mb-3 card">
                    <div class="card-header">
                        Report check sit
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
 
                                <button type="button" class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="pe-7s-science btn-icon-wrapper"></i>Token
                                </button>
                              
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('hos.datahosauto') }}" method="POST">
                            @csrf
                            <div class="row mt-3">
                                <div class="col"></div>
                                <div class="col-md-1 text-end">วันที่</div>
                                <div class="col-md-4 text-center">
                                    <div class="input-daterange input-group" id="datepicker1" data-date-format="dd M, yyyy"
                                        data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                        <input type="text" class="form-control" name="startdate" id="datepicker" placeholder="Start Date"
                                            data-date-container='#datepicker1' data-provide="datepicker" data-date-autoclose="true"
                                            data-date-language="th-th" value="{{ $start }}" />
                                        <input type="text" class="form-control" name="enddate" placeholder="End Date" id="datepicker2"
                                            data-date-container='#datepicker1' data-provide="datepicker" data-date-autoclose="true"
                                            data-date-language="th-th" value="{{ $end }}" />
                                    </div>
                                </div>
 

                                <div class="col-md-1">
                                    <button class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-info">
                                        <i class="pe-7s-search btn-icon-wrapper"></i>ค้นหา
                                    </button>

                                </div>
                                 <div class="col"></div>
                            </div>

                        </form>
                        <div class="table-responsive mt-3">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>vn</th>
                                        <th>hn</th>
                                        <th>cid</th>
                                        <th>tel</th>
                                        <th>vstdate</th>
                                        <th>fullname</th>
                                        <th>pttype Hos</th>
                                        <th>hmain Hos</th>
                                        <th>hsub Hos</th>
                                        <th>pttype สปสช</th>
                                        <th>hmainสปสช</th>
                                        <th>hsubสปสช</th> 
                                        <th>staff</th>
                                        <th>main_dep</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $ia = 1; ?>
                                    @foreach ($data_sit as $item)
                                 
                                    @if ( $item->pttype == 'A7' && $item->subinscl == 'S1' && $item->hospmain == $item->hmain)
                                        <tr style="background-color: rgb(255, 255, 255)">
                                            <td>{{ $ia++ }}</td>
                                            <td>{{ $item->vn }}</td>
                                            <td>{{ $item->hn }}</td>
                                            <td>{{ $item->cid }}</td>
                                            <td>{{ $item->hometel }}</td>
                                            <td>{{ $item->vstdate }}</td>
                                            <td>{{ $item->ptname }}</td>
                                            <td style="background-color: rgb(255, 255, 255)">{{ $item->pttype }}</td>
                                            <td >{{ $item->hospmain }}</td>
                                            <td>{{ $item->hospsub }}</td>
                                            <td style="background-color: rgb(255, 255, 255)">{{ $item->subinscl }}</td>
                                            <td>{{ $item->hmain }}</td>
                                            <td>{{ $item->hsub }}</td>
 
                                            <td>{{ $item->staff_name }}</td>
                                            <td>{{ $item->department }}</td>
                                        </tr>
                                    @elseif( $item->pttype != $item->subinscl )

                                        <tr>
                                            <td>{{ $ia++ }}</td>
                                            <td>{{ $item->vn }}</td>
                                            <td>{{ $item->hn }}</td>
                                            <td>{{ $item->cid }}</td>
                                            <td>{{ $item->hometel }}</td>
                                            <td>{{ $item->vstdate }}</td>
                                            <td>{{ $item->ptname }}</td>
                                            <td>
                                                <?php
                                                      $pttype_hos = DB::connection('mysql')->table('pttype')->where('pttype','=',$item->pttype)->first();
                                                      $d = $pttype_hos->name;
                                                ?>
                                                <button type="button" class="btn btn-icon btn-shadow btn-dashed btn-outline-danger" data-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content=" {{$d}}">
                                                    {{ $item->pttype }}
                                                </button>
                                            </td>
                                            <td style="background-color: rgb(155, 253, 240)">{{ $item->hospmain }}</td>
                                            <td>{{ $item->hospsub }}</td>
                                            <td >
                                                <button type="button" class="btn btn-icon btn-shadow btn-dashed btn-outline-warning" data-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content=" {{$item->subinscl_name}}">
                                                    {{ $item->subinscl }}
                                                </button>
                                            </td>
                                            <td style="background-color: rgb(188, 229, 253)">{{ $item->hmain }}</td>
                                            <td>{{ $item->hsub }}</td>
                                          
                                            <td>{{ $item->staff_name }}</td>
                                            <td>{{ $item->department }}</td>
                                        </tr>
                                    @else
                                        <tr style="background-color: rgb(255, 255, 255)">
                                            <td>{{ $ia++ }}</td>
                                            <td>{{ $item->vn }}</td>
                                            <td>{{ $item->hn }}</td>
                                            <td>{{ $item->cid }}</td>
                                            <td>{{ $item->hometel }}</td>
                                            <td>{{ $item->vstdate }}</td>
                                            <td>{{ $item->ptname }}</td>

                                            <td style="background-color: rgb(255, 255, 255)">{{ $item->pttype }}</td>
                                            <td style="background-color: rgb(155, 253, 240)">{{ $item->hospmain }}</td>
                                            <td>{{ $item->hospsub }}</td>

                                            <td style="background-color: rgb(255, 255, 255)">{{ $item->subinscl }}</td>
                                            <td style="background-color: rgb(188, 229, 253)">{{ $item->hmain }}</td>
                                            <td>{{ $item->hsub }}</td>
                                           
                                            <td>{{ $item->staff_name }}</td>
                                            <td>{{ $item->department }}</td>
                                        </tr>
                                    @endif

                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</div>

 

@endsection
@section('footer')

<script>
    //  window.setTimeout(function() {
    //         window.location.reload();
    //     },500000);
    $(document).ready(function() {
        // $("#overlay").fadeIn(300);　

        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#datepicker2').datepicker({
            format: 'yyyy-mm-dd'
        });

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        $("#spinner-div").hide(); //Request is complete so hide spinner
 

        $('#TokenSave').click(function() {
                var cid = $('#cid').val();
                var token = $('#token').val();
                // alert(datepicker2);


            $.ajax({
                    url: "{{ route('hos.check_sit_token') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        cid,
                        token
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            Swal.fire({
                                title: 'เพิ่มข้อมูลสำเร็จ',
                                text: "You Insert data success",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#06D177',
                                confirmButtonText: 'เรียบร้อย'
                            }).then((result) => {
                                if (result
                                    .isConfirmed) {
                                    console.log(
                                        data);
                                    window.location.reload();
                                }
                            })
                        } else {
                        }
                    },
                    complete: function () {

                    }

            });



        });
    });
</script>
@endsection

