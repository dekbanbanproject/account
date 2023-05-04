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
                                            <th class="text-center">pttype_eclaim_name</th> 
                                            <th class="text-center">ตั้งค่าผัง</th> 
                                            <th class="text-center">ar_opd</th> 
                                            <th class="text-center">ar_ipd</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($data as $item) 
                                            <tr id="tr_{{$item->pttype}}">                                                  
                                                <td class="text-center" width="5%">{{ $i++ }}</td>   
                                                <td class="text-center" width="5%">{{ $item->pttype }}</td> 
                                                <td class="p-2">{{ $item->namept }}</td> 
                                                {{-- <td class="text-center" width="5%">{{ $item->hipdata_code }}</td>   --}}
                                                {{-- <td class="text-center" width="5%">{{ $item->code }}</td>   --}}
                                                <td class="p-2">{{ $item->pttype_eclaim_name }}</td> 
                                                <td class="p-2" width="10%">
                                                    @if ($item->pttype_eclaim_id == '')
                                                    <button type="button" class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-success edit_data" value="{{ $item->pttype }}">
                                                      
                                                        <i class="fa-regular fa-square-plus"></i>
                                                    </button>
                                                    @else
                                                    {{-- <button type="button" class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-success insert_data">  --}}
                                                        <button type="button" class="mb-2 me-2 btn-icon btn-shadow btn-dashed btn btn-outline-warning insert_data"> 
                                                            <i class="fa-solid fa-pen-to-square"></i> 
                                                    </button>
                                                    @endif
                                                      
                                                </td>  
                                                <td class="p-2" width="10%">{{ $item->ar_opd }}</td>  
                                                <td class="p-2" width="10%">{{ $item->ar_ipd }}</td>  
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <input id="editpttype" name="pttype" type="hidden" class="form-control form-control-sm"> --}}
                    <input id="editcode" name="code" type="hidden" class="form-control form-control-sm">
                    
                    <div class="row">
                        <div class="col-md-1">
                            <label for="">Pttype</label>
                            <div class="form-group">
                                <input id="editpttype" name="pttype" type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">Pttype Name</label>
                            <div class="form-group">
                                <input id="editname" name="name" type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="">รหัสผังบัญชี (OPD)</label>
                            <div class="form-group">
                                {{-- <input id="editaropd" name="aropd" type="text" class="form-control form-control-sm"> --}}
                                <select id="aropd" name="aropd" class="form-select form-select-lg department" style="width: 100%">  
                                    <option value="">--เลือก--</option>
                                    @foreach ($aropd as $items)  
                                        <option value="{{ $items->code }}"> {{ $items->ar_opd }} </option> 
                                    @endforeach    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="">ถ้าไม่มีให้เพิ่ม ***</label>
                            <div class="form-group">
                                <input id="ddd" name="ddd" type="text" class="form-control form-control-sm">                               
                            </div>
                        </div>
                        <div class="col-md-1">
                            <br>
                            <button type="button" id="updateBtn" class="mb-2 me-2 mt-2 btn-icon btn-shadow btn-dashed btn btn-outline-success">
                                <i class="fa-regular fa-square-plus"></i>
                            </button>
                        </div>
                        {{-- <div class="col-md-2">
                            <label for="">รหัสผังบัญชี (IPD)</label>
                            <div class="form-group">                               
                                <select id="aripd" name="aripd" class="form-select form-select-lg department" style="width: 100%">
                                    <option value="">--เลือก--</option>  
                                    @foreach ($aripd as $items)  
                                        <option value="{{ $items->code }}"> {{ $items->ar_ipd }} </option> 
                                    @endforeach    
                                </select>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-md-2">
                            <label for="">รหัสผังบัญชี (IPD)</label>
                            <div class="form-group">                               
                                <select id="aripd" name="aripd" class="form-select form-select-lg department" style="width: 100%">
                                    <option value="">--เลือก--</option>  
                                    @foreach ($aripd as $items)  
                                        <option value="{{ $items->code }}"> {{ $items->ar_ipd }} </option> 
                                    @endforeach    
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-2">
                            <label for="">ถ้าไม่มีให้เพิ่ม ***</label>
                            <div class="form-group">
                                <input id="ddd" name="ddd" type="text" class="form-control form-control-sm">                               
                            </div>
                        </div>
                        <div class="col-md-1">
                            {{-- <label for="">.</label> --}}<br>
                            <button type="button" id="updateBtn" class="mb-2 me-2 mt-2 btn-icon btn-shadow btn-dashed btn btn-outline-success">
                                <i class="fa-regular fa-square-plus"></i>
                            </button>
                        </div>
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
           
            $('#aropd').select2({
                    dropdownParent: $('#updteModal')
            });
            $('#aripd').select2({
                    dropdownParent: $('#updteModal')
            });

            $("#spinner-div").hide(); //Request is complete so hide spinner
            $(document).on('click', '.edit_data', function() {
                var pttype = $(this).val();
                // alert(pttype);
                $('#updteModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "{{ url('manage_setting_edit') }}" + '/' + pttype,
                    success: function(data) {
                        // console.log(data.type.name);
                        $('#editname').val(data.type.name)
                        $('#editaropd').val(data.type.ar_opd)
                        $('#editaripd').val(data.type.ar_ipd)
                        $('#editpttype').val(data.type.pttype)
                        $('#editcode').val(data.type.code)
                    },
                });
            });
            $('#updateBtn').click(function() {
                var ar_opd = $('#editaropd').val();
                var ar_ipd = $('#editaripd').val();
                var name = $('#editname').val();
                var pttype = $('#editpttype').val();
                $.ajax({
                    url: "{{ route('manage.manage_setting_update') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        ar_opd,ar_ipd,name,pttype
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
           
        });
    </script>
    @endsection
