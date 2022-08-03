@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 pt-1">
                            <h4>{{ __('Enroll Listing') }}</h4>
                        </div>
                        <div class="col-6 text-end pt-1">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#student-modal"> ADD </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">Student</th>
                                <th scope="col">Class</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($enroll->count() > 0)
                            @foreach($enroll as $en)
                            <tr>
                                <th scope="row">{{$en->id}}</th>
                                <td>{{$en->student->name}}</td>
                                <td>{{$en->class->name}}</td>
                                <td>
                                    <a href="#" data-id="{{route('enroll.delete', [$en->id])}}" class="action-alert"> Remove </a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <th colspan="4">No Record Found</th>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>



<!-- SignIn modal content -->
<div id="student-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="margin-top: 8rem;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-2 mb-2">
                    <h4> Assign Class </h4>
                </div>

                <form action="{{route('enroll.save')}}" id="enroll-save" class="px-3" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="student">Select Student</label>
                        <select name="student_id" id="" class="form-control">
                            @foreach($student as $std)
                            <option value="{{$std->id}}"> {{$std->name}} - AGE : {{$std->age}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="student">Available Classes</label>
                        <select name="class_id" id="" class="form-control">
                            @foreach($classes as $cls)
                            @if($cls->seats > $cls->enroll_count)
                            <option value="{{$cls->id}}"> {{$cls->name}} </option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group text-center mt-3">
                        <button class="btn btn-rounded btn-primary" type="submit">Submit</button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@endsection

@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on('submit', '#enroll-save', function(e) {

        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {

                console.log(data);
                data = $.parseJSON(data);
                if (data.status == 'success') {
                    location.reload();
                } else {

                    Swal.fire({
                        icon: 'error',
                        title: 'Sorry',
                        text: data.message,
                    })

                }

            },
            error: function(data) {

                console.log(data);
                $.each(data.responseJSON.errors, function(i, n) {
                    $('.' + i + '-Cls').html(n);
                });
            }
        });
    });

    $('body').on('click', '.action-alert', function(e) {

        var url_id = $(this).attr('data-id');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this action!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, do it!"
        }).then(function(result) {
            if (result.value) {
                console.log(url_id);
                window.location.replace(url_id);
            }
        });

    });
</script>

@endsection