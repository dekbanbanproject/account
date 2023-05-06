@extends('layouts.manage')
@section('title', 'DTAD-ACCOUNT || ACCOUNT')
 
@section('content')
    <script>
        function TypeAdmin() {
            window.location.href = '{{ route('wel.index') }}';
        }
       

       
    </script>
    <?php
    if (Auth::check()) {
        $type = Auth::user()->type;
        $iduser = Auth::user()->id;
    } else {
        echo "<body onload=\"TypeAdmin()\"></body>";
        exit();
    }
    $url = Request::url();
    $pos = strrpos($url, '/') + 1;
    ?>
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
     
    <div class="container-fluid">
          <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                
            </div>
        </div>
    </div>
       
        <div class="row mt-3 text-center">  
            <div id="overlay">
                <div class="cv-spinner">
                  <span class="spinner"></span>
                </div>
              </div>
        </div> 
        <div class="row mt-3">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body shadow-lg">
                      
                        <div class="row">
                            <div class="col-md-4">
                                <h4 class="card-title">Detail Pang</h4>
                                <p class="card-title-desc">รายละเอียดตั้งลูกหนี้</p>
                            </div>
                            <div class="col"></div>
                            <div class="col-md-1">
                                {{-- <button type="button" class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-info" id="Pull_pttype"> 
                                    <i class="fa-regular fa-square-plus"></i> 
                                </button> --}}
                            </div>
                        </div>

                        <p class="mb-0">
                            <div class="table-responsive">   <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="example">
                                    <thead>
                                        <tr>
                                          
                                            <th width="5%" class="text-center">ลำดับ</th>  
                                            <th class="text-center" width="5%">pttype</th> 
                                            <th class="text-center">name</th>
                                            {{-- <th class="text-center" >hipdata_code</th> --}}
                                            {{-- <th class="text-center" >pttype_eclaim_id</th> --}}
                                            <th class="text-center">pttype_acc_name</th> 
                                            {{-- <th class="text-center">ตั้งค่าผัง</th>  --}}
                                            <th class="text-center">ar_opd</th> 
                                            <th class="text-center">ar_ipd</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($data as $item) 
                                            <tr id="tr_{{$item->pttype_acc_id}}">                                                  
                                                <td class="text-center" width="5%">{{ $i++ }}</td>   
                                                <td class="text-center" width="5%">{{ $item->pttype_acc_code }}</td> 
                                                <td class="p-2">{{ $item->pttype_acc_name }}</td> 
                                                {{-- <td class="text-center" width="5%">{{ $item->hipdata_code }}</td>   --}}
                                                {{-- <td class="text-center" width="5%">{{ $item->code }}</td>   --}}
                                                <td class="p-2">{{ $item->pttype_eclaim_name }}</td> 
                                                {{-- <td class="p-2" width="10%">
                                                    @if ($item->pttype_acc_eclaimid == '')
                                                    <button type="button" class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-success edit_data" value="{{ $item->pttype_acc_id }}">
                                                      
                                                        <i class="fa-regular fa-square-plus"></i>
                                                    </button>
                                                    @else                                                   
                                                        <button type="button" class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-warning insert_data"> 
                                                                <i class="fa-solid fa-pen-to-square"></i> 
                                                        </button>
                                                    @endif                                                      
                                                </td>   --}}
                                                <td class="p-2" width="20%">
                                                    <button type="button" class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-success edit_data" value="{{ $item->pttype_acc_id }}">
                                                      
                                                        <i class="fa-regular fa-square-plus me-2"></i>
                                                        {{ $item->ar_opd }}
                                                    </button>
                                                  
                                                </td>  
                                                <td class="p-2" width="20%">{{ $item->ar_ipd }}</td>  
                                            </tr>
 
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
 
    </div>
    </div>

     <!--  Modal content Update -->
     <div class="modal fade" id="updteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header"> 
                    <h5 class="modal-title" id="invenModalLabel">กำหนดผังบัญชี</h5> 
                </div>
                <div class="modal-body"> 
                    <input id="editpttype" name="pttype" type="text" class="form-control form-control-sm">
                    <div class="row">    
                        <div class="col-md-4">
                        </div>                      
                        <div class="col-md-3">
                            <label for="">รหัสผังบัญชี (OPD)</label>
                            <div class="form-group"> 
                                <select id="ar_opd" name="ar_opd" class="form-select form-select-lg show_opd" style="width: 100%">  
                                    <option value="">--เลือก--</option>
                                    @foreach ($aropd as $items)  
                                        <option value="{{ $items->code }}"> {{ $items->ar_opd }} </option> 
                                    @endforeach    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-3">
                            <label for="">รหัสผังบัญชี (IPD)</label>
                            <div class="form-group">                               
                                <select id="ar_ipd" name="ar_ipd" class="form-select form-select-lg show_ipd" style="width: 100%">
                                    <option value="">--เลือก--</option>  
                                    @foreach ($aripd as $items)  
                                        <option value="{{ $items->code }}"> {{ $items->ar_ipd }} </option> 
                                    @endforeach    
                                </select>
                            </div>
                        </div> 
                               
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">ชื่อผังบัญชี</label>
                            <div class="form-group">
                                <input id="CODE_NAME" name="CODE_NAME" type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="">ถ้าไม่มีให้เพิ่ม ***(รหัสผังบัญชี OPD)</label>
                            <div class="form-group">
                                <input id="ADDOPD" name="ADDOPD" type="text" class="form-control form-control-sm">                               
                            </div>
                        </div>
                        <div class="col-md-1">
                            <br>
                            <button type="button" class="btn-icon btn-shadow btn-dashed btn btn-outline-success" onclick="Addopd();">
                                <i class="fa-regular fa-square-plus"></i>
                            </button>
                        </div> 
                        {{-- <div class="col-md-3">
                            <label for="">ถ้าไม่มีให้เพิ่ม ***(รหัสผังบัญชี IPD)</label>
                            <div class="form-group">
                                <input id="ADDIPD" name="ADDIPD" type="text" class="form-control form-control-sm">                               
                            </div>
                        </div>
                        <div class="col-md-1"> <br>
                            <button type="button" onclick="addpangipd();" class="mb-2 me-2 mt-2 btn-icon btn-shadow btn-dashed btn btn-outline-success">
                                <i class="fa-regular fa-square-plus"></i>
                            </button>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12 text-end">
                        <div class="form-group">
                            <button type="button" id="updateBtn" class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-primary">
                                <i class="fa-solid fa-floppy-disk me-2"></i>
                                กำหนดผังบัญชี
                            </button>
                            <button type="button" class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-danger" data-bs-dismiss="modal"><i
                                    class="fa-solid fa-xmark me-2"></i>
                                    Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

    @endsection
    @section('footer')
    
    <script>
            
        $(document).ready(function() {
            $('#example').DataTable();
            $('#example2').DataTable();
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#datepicker2').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('#stamp').on('click', function(e) {
            if($(this).is(':checked',true))  
            {
                $(".sub_chk").prop('checked', true);  
            } else {  
                $(".sub_chk").prop('checked',false);  
            }  
            }); 
           
            $('#ar_opd').select2({
                    dropdownParent: $('#updteModal')
            });
            $('#ar_ipd').select2({
                    dropdownParent: $('#updteModal')
            });

            $("#spinner-div").hide(); //Request is complete so hide spinner
            $(document).on('click', '.edit_data', function() {
                var pt = $(this).val();
                alert(pt);
                $('#updteModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "{{ url('manage_setting_edit') }}" + '/' + pt,
                    success: function(data) {
                        // console.log(data.type.name);
                        // $('#editname').val(data.type.name)
                        // $('#editaropd').val(data.type.ar_opd)
                        // $('#editaripd').val(data.type.ar_ipd)
                        $('#editpttype').val(data.type.pttype_acc_id)
                        // $('#editcode').val(data.type.code)
                    },
                });
            });
            $('#updateBtn').click(function() {
                var ar_opd = $('#ar_opd').val();
                var ar_ipd = $('#ar_ipd').val();
                var code_name = $('#CODE_NAME').val();
                var acc_id = $('#editpttype').val();
                alert(ar_opd);
                $.ajax({
                    url: "{{ route('manage.manage_setting_update') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        ar_opd,ar_ipd,code_name,acc_id 
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            Swal.fire({
                                title: 'กำหนดผังบัญชีสำเร็จ',
                                text: "You Setting data success",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#06D177',
                                confirmButtonText: 'เรียบร้อย'
                            }).then((result) => {
                                if (result
                                    .isConfirmed) {
                                    console.log(
                                        data);
                                    window.location
                                        .reload();
                                }
                            })
                        } else {

                        }

                    },
                });
            });

            $('#Pull_pttype').click(function() {
                // var datestart = $('#datepicker').val(); 
                // var dateend = $('#datepicker2').val();  
                // alert(datepicker2);
               
                    Swal.fire({
                        title: 'ต้องการดึงข้อมูลสิทธิ์ใช่ไหม ?',
                        text: "You won't pull Data!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, pull it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#overlay").fadeIn(300);　
                                $("#spinner-div").show(); //Load button clicked show spinner 
                                $.ajax({
                                        url: "{{ route('manage.manage_pull_pttype') }}",
                                        type: "POST",
                                        dataType: 'json',
                                        data: {
                                            // datestart,
                                            // dateend                      
                                        },
                                        success: function(data) {
                                            if (data.status == 200) {
                                                Swal.fire({
                                                    title: 'ดึงข้อมูลสำเร็จ',
                                                    text: "You Pull data success",
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
                                                        $('#spinner-div').hide();//Request is complete so hide spinner
                                                        setTimeout(function(){
                                                            $("#overlay").fadeOut(300);
                                                        },500);
                                                    }
                                                })
                                            } else {                                                
                                            }
                                        },
                                        complete: function () {
                                            // $('#spinner-div').hide();//Request is complete so hide spinner
                                        }
                                  
                                });
 
                            }
                        })
                
            });
 
        });
    </script>
    @endsection
