@extends('layout.template')
@section('title', 'Employee')
@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
    <div class="mb-1 w-full">
        <div class="mb-4">
            <nav class="flex mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="#" class="text-gray-700 hover:text-gray-900 inline-flex items-center">
                            <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="#" class="text-gray-700 hover:text-gray-900 ml-1 md:ml-2 text-sm font-medium">Employee</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-400 ml-1 md:ml-2 text-sm font-medium" aria-current="page">List</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">Data Karyawan</h1>
        </div>
        <div class="sm:flex">
            <div class="flex items-center space-x-2 sm:space-x-3 ml-auto">
                <button type="button" id="addModal" data-modal-toggle="add-user-modal" class="w-1/2 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center sm:w-auto">
                    <svg class="-ml-1 mr-2 h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Tambah Karyawan
                </button>

            </div>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-error" role="alert">
            {{ session('error') }}
        </div>
        @endif
    </div>
</div>
<div class="flex flex-col p-4">
    <div class="overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden">
                <table class="table-fixed min-w-full divide-y divide-gray-200" id="tbl_list">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-all" aria-describedby="checkbox-1" type="checkbox" class="bg-gray-50 border-gray-300 focus:ring-3 focus:ring-cyan-200 h-4 w-4 rounded">
                                    <label for="checkbox-all" class="sr-only">checkbox</label>
                                </div>
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                Nama Lengkap
                            </th>

                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                Unit
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                Jabatan
                            </th>
                            <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                                Tanggal Bergabung
                            </th>
                            <th scope="col" class="p-4">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                       @foreach($employe as $emp)
                        @php
                            $position = \App\Models\Jabatan::whereIn('id', json_decode($emp->position_id))->select('position_name')->get();
                            $count = count($position);

                        @endphp
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$emp->employee_name}}</td>
                            <td>{{$emp->unit->unit_name}}</td>
                            <td>
                                @foreach($position as $in => $pos)
                                    {{$pos->position_name}},
                                @endforeach
                            </td>
                            <td>{{date('d-M-Y', strtotime($emp->date_join))}}</td>
                            <td class="p-4 whitespace-nowrap space-x-2">
                                <button type="button" data-modal-toggle="edit-unit-modal" onclick="EditEmp({{$emp->id}})" id="editModal" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center">
                                    <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                                    </svg>
                                    Edit
                                </button>
                                <button type="button" data-modal-toggle="delete-unit-modal" onclick="DeleteEmp({{$emp->id}})" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center">
                                    <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.employee.modal.add')
@include('admin.employee.modal.edit')
@include('admin.employee.modal.delete')


@endsection

@push('scripts')

<script>
    function get_position(id, edit){
        var url_position = "{{route('employee.position')}}"
        $.ajax({
            url: url_position,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'uid' : id
            },
            success: function(res){
                if(res.success){
                    var pos = (edit == true) ? $('#pos_edit') : $('#pos');
                    pos.html(new Option('Pilih Jabatan', ''));
                    new_data = res.data;
                    var o; 

                    $.each(new_data, function(i, val){
                            o = new Option(val.position_name, val.id);
                            pos.append(o);
                    });
                    
                } else {

                    console.log(res);
                }
            }
        })
    }

    function EditEmp(id){
        var url_edit = "{{route('employee.edit')}}";
        var new_pos =  new Array();
        $.ajax({
            url: url_edit,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'id' : id
            },
            success: function(res){
                if(res.success){
                    new_data = res.data;
                    var pos = $.parseJSON(new_data.position_id);
                    $("#uid").val(new_data.id);
                    $('#unit_edit').val(new_data.unit_id);
                    $('#unit_edit').trigger('change');
                    get_position(new_data.unit_id, true);
                    
                    $('#pos_edit').val(pos);
                    $('#pos_edit').trigger('change');
                  
                    $('#name_edit').val(new_data.employee_name);
                    $('#date_join_edit').val(new_data.date_join);
                    $('#editEmployee').removeClass('invisible');
                } else {
                    console.log(res);
                }
            }
        })
    }

    function DeleteEmp(id){
        $('#uid_del').val(id);
        $('#delEmployee').removeClass('invisible');

    }

    

    $(document).ready(function() {
        $('.pos').select2();
        $('.pos_edit').select2();
        $('.unit').select2();

        $('.unit').on('change', function(){
            var id = $(this).val();
            get_position(id, false);
        })

        
       
        $('#tbl_list').DataTable();
        $('#addModal').on('click', function(e) {
            $('#addEmploye').removeClass('invisible');
        });

        

        $('.closeModal').on('click', function(e) {
            $('#addEmploye').addClass('invisible');
            $('#delEmployee').addClass('invisible');
            $('#editEmployee').addClass('invisible');
        });
    })
</script>
@endpush