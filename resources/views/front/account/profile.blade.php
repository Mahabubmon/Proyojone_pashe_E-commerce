@extends('front.layouts.app')


@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                <li class="breadcrumb-item">Settings</li>
            </ol>
        </div>
    </div>
</section>

<section class=" section-11 ">
    <div class="container  mt-5">
        <div class="row">
            <div class="col-md-12">
                @include('front.account.common.message')
            </div>
            <div class="col-md-3">
                @include('front.account.common.sidebar')

            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                    </div>
                    <form action="" name="profileForm" id="profileForm">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input value="{{$user->name}}" type="text" name="name" id="name"
                                        placeholder="Enter Your Name" class="form-control">
                                    <p></p>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input value="{{$user->email}}" type="text" name="email" id="email"
                                        placeholder="Enter Your Email" class="form-control">
                                    <p></p>

                                </div>
                                <div class="mb-3">
                                    <label for="phone">Phone</label>
                                    <input value="{{$user->phone}}" type="text" name="phone" id="phone"
                                        placeholder="Enter Your Phone" class="form-control">
                                    <p></p>

                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-dark">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="h5 mb-0 pt-2 pb-2">Address</h2>
                    </div>
                    <form action="" name="addressFrom" id="addressFrom">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name">First Name</label>
                                    <input value="{{$user->name}}" type="text" name="first_name" id="first_name"
                                        placeholder="Enter Your first name" class="form-control">
                                    <p></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name">Last Name</label>
                                    <input value="{{$user->name}}" type="text" name="last name" id="last_name"
                                        placeholder="Enter Your last_name" class="form-control">
                                    <p></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email">Email</label>
                                    <input value="{{$user->email}}" type="text" name="email" id="email"
                                        placeholder="Enter Your Email" class="form-control">
                                    <p></p>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="mobile">Mobile</label>
                                    <input value="{{$user->phone}}" type="text" name="mobile" id="mobile"
                                        placeholder="Enter Your mobile" class="form-control">
                                    <p></p>

                                </div>
                                <div class="mb-3">
                                    <label for="country">Country</label>
                                    <select name="country_id" id="country_id" class="form-control">
                                        <option value="">Select a Country</option>
                                        @if ($countries->isNotEmpty())
                                        @foreach ($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                        
                                        @endif
                                    </select>
                                    <p></p>

                                </div>
                                <div class="mb-3">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address" cols="30" rows="5" class="form-control" ></textarea>
                                    <p></p>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="apartment">Apartment</label>
                                    <input value="{{$user->phone}}" type="text" name="apartment" id="apartment"
                                        placeholder="Enter Your Apartment" class="form-control">
                                    <p></p>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="city">City</label>
                                    <input value="{{$user->phone}}" type="text" name="city" id="city"
                                        placeholder="Enter Your city" class="form-control">
                                    <p></p>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="state">State</label>
                                    <input value="{{$user->phone}}" type="text" name="state" id="state"
                                        placeholder="Enter Your State" class="form-control">
                                    <p></p>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="zip">Zip</label>
                                    <input value="{{$user->phone}}" type="text" name="zip" id="zip"
                                        placeholder="Enter Your Zip" class="form-control">
                                    <p></p>

                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-dark">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>


</script>

@endsection

@section('customJs')
<script>
    $("profileForm").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: '{{route('account.updateProfile')}}',
            type: 'post'
            data: $(this).serializeArray(),
            dataType: 'json',
            success: function (response) {
                if (response.status == true) {

                    
                    $('#name').removeClass('is-invalid').siblings('p').html(errors.name).removeClass('invalid-feedback');
                    $('#email').removeClass('is-invalid').siblings('p').html(errors.email).removeClass('invalid-feedback');
                    $('#phone').removeClass('is-invalid').siblings('p').html(errors.phone).removeClass('invalid-feedback');
                    
                    window.location.href = '{{route('account.profile')}}'


                } else {
                    var errors = response.errors;
                    //validation msg name
                    if (errors.name) {
                        $('#name').addClass('is-invalid').siblings('p').html(errors.name);
                    } else {
                        $('#name').removeClass('is-invalid').siblings('p').html(errors.name).removeClass('invalid-feedback');

                    }
                    //validation msg email

                    if (errors.email) {
                        $('#email').addClass('is-invalid').siblings('p').html(errors.email);
                    } else {
                        $('#email').removeClass('is-invalid').siblings('p').html(errors.email).removeClass('invalid-feedback');

                    }
                    //validation msg phone

                    if (errors.phone) {
                        $('#phone').addClass('is-invalid').siblings('p').html(errors.phone);
                    } else {
                        $('#phone').removeClass('is-invalid').siblings('p').html(errors.phone).removeClass('invalid-feedback');

                    }

                }

            }
        });

    });
</script>

@endsection