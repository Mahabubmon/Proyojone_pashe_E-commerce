@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Coupon Code</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('categories.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">


        <form action="" method="POST" id="categoryForm" name="categoryForm">

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="code">Code</label>
                                <input type="text" name="Code" id="Code" class="form-control" placeholder="Coupon Code">
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Coupon Code name">
                                <p></p>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3"> 
                            <label for="description">Description</label>
                                <input type="text" name="description" id="description" class="form-control" placeholder="Description">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                            <label for="Max Uses">Max Uses</label>
                                <input type="number" name="max_uses" id="max_uses" class="form-control" placeholder="Max Uses">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                            <label for="Max Uses">Max Uses User</label>
                                <input type="text" name="max_uses_user" id="max_uses_user" class="form-control" placeholder="Max Uses User">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="percent">Percent</option>
                                    <option value="fixed">Fixed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                            <label for="Discount Amount">Discount Amount</label>
                                <input type="text" name="discount_amount" id="discount_amount" class="form-control" placeholder="Discount Amount">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                            <label for="Min Amount">Min Amount</label>
                                <input type="text" name="min_amount" id="min_amount" class="form-control" placeholder="Min Amount">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="showHome">Max Uses</label>
                                <select name="showHome" id="showHome" class="form-control">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{route('categories.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>

        </form>


    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('customsJs')


<script>
    $("#categoryForm").submit(function (event) {
        event.preventDefault();

        var element = $(this);

        $("button[type='submit']").prop('disabled', true);

        $.ajax({
            url: '{{route('categories.store')}}',
            type: 'POST',
            data: element.serializeArray(),
            dataType: 'json',
            success: function (response) {
                $("button[type='submit']").prop('disabled', false);

                if (response['max_uses'] == true) {
                    window.location.href = "{{route('categories.index')}}";

                    $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    $("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                } else {
                    var errors = response['errors'];

                    if (errors['name']) {
                        $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
                    } else {
                        $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                    if (errors['slug']) {
                        $("#slug").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug']);
                    } else {
                        $("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    }
                }
            },
            error: function (jqXHR, exception) {
                console.log('Something went Wrong');
            }
        });
    });

    $("#name").change(function () {
        var element = $(this);
        $("button[type='submit']").prop('disabled', true);

        $.ajax({
            url: '{{route('getSlug')}}',
            type: 'GET',
            data: { title: element.val() },
            dataType: 'json',
            success: function (response) {
                $("button[type='submit']").prop('disabled', false);

                if (response["max_uses"] == true) {
                    $("#slug").val(response["slug"]);
                }
            }
        });
    });





    Dropzone.autoDiscover = false;
    const dropzone = $("#image").dropzone({
        init: function () {
            this.on('addedfile', function (file) {
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
            });
        },
        url: "{{ route('temp-images.create') }}",
        maxFiles: 1,
        paramName: 'image',
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/gif",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, success: function (file, response) {
            $("#image_id").val(response.image_id);
            //console.log(response)
        }
    });
</script>

@endsection