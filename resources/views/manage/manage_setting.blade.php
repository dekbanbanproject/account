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
                                                <td class="p-2" width="5%">{{ $item->namept }}</td> 
                                                {{-- <td class="text-center" width="5%">{{ $item->hipdata_code }}</td>   --}}
                                                {{-- <td class="text-center" width="5%">{{ $item->code }}</td>   --}}
                                                <td class="p-2" width="10%">{{ $item->pttype_eclaim_name }}</td>  
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

            $("#spinner-div").hide(); //Request is complete so hide spinner

           
        });
    </script>
    @endsection
