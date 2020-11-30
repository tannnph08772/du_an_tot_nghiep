@extends('staff')
@section('title', "Danh sách chờ")
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Danh sách học viên đăng ký</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Chọn lớp
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Danh sách lớp</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <select class="custom-select mr-sm-2" name="class_id" id="inlineFormCustomSelect">
                                @foreach($filteredArray as $class)
                                <option value="{{$class['id']}}">{{$class['name_class']}}
                                    ({{ $class['schedule']['name_schedule'] }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button type="button" onclick="addUser()" class="btn btn-primary">Thêm học viên</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type="checkbox" onClick="toggle(this)"> Select all</th>
                            <th>STT</th>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>Khoá học</th>
                            <th>Chuyển</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach($waitList as $item)
                        <tr>
                            <td class=" dt-checkboxes-cell"><input class="hoc_vien_add" value="{{$item->id}}"
                                    type="checkbox" name="student[]">
                            </td>
                            <td>{{$i++}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone_number}}</td>
                            <td>{{$item->birthday}}</td>
                            <td>{{$item->sex}}</td>
                            <td>{{$item->course->name_course}}</td>
                            <td>
                                <a href="{{ route('users.getInfoHV',['id' => $item->id]) }}" class="btn">Chọn lớp <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </td>
                            <td>
                                <form action="{{ route('auth.remove',['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    <button onclick=" return confirm('Bạn có chắc thực hiện thao tác này?')"
                                        class="btn"><i class="fas fa-trash-alt text-danger"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script language="javascript">
function toggle(source) {
    checkboxes = document.getElementsByName('student[]');
    for (var i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = source.checked;
    }
}

const url_add_hoc_vien = "{{route('auth.addhocvien')}}"
const addUser = () => {
    let danh_sach_hoc_vien = document.querySelectorAll(".hoc_vien_add")
    let class_select = $("[name=class_id]").val()
    var danh_sach_hv = []
    danh_sach_hoc_vien.forEach(function(element) {
        if ($(element).prop('checked')) {
            danh_sach_hv.push($(element).val());
        }
    });
    var data = {
        'lop_id': class_select,
        'danh_sach_hv': danh_sach_hv
    }
    axios.post(url_add_hoc_vien, data)
        .then(function(response) {
            window.location.href = 'lop-hoc/chi-tiet-lop-hoc/' + class_select + ''
            Swal.fire({
                icon: 'success',
                text: 'Thêm học viên thành công!',
            })
            console.log(response);
        })
        .catch(function(error) {
            // handle error
            console.log(error);
        })
        .then(function() {
            // always executed
        });
}
</script>

@endsection