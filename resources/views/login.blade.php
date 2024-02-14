@extends('layout')

@section('css')
<style>

</style>
@endsection

@section('content')
<div class="row mt-5">
    <div class="col-md-6 offset-md-3 mt-5">
        <div class="card mx-auto align-self-center shadow">
            <div class="card-title text-center border-bottom">
                <h2 class="p-3">LOGIN</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('/auth') }}" method="post" id="form-data">

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="text" name="User" id="username" class="form-control" placeholder="Username" />
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" name="Password" id="password" class="form-control" placeholder="Password" />
                    </div>

                    <div class="form-outline mb-4">
                        <small class="text-danger" data-target="error"></small>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary w-100 rounded-pill btn-block mb-4">LOGIN</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>
    const getCookie = (key) => {
        const name = key + "=";
        const decode = decodeURIComponent(document.cookie); //to be careful
        const arrResult = decode.split('; ');
        let result;

        arrResult.forEach(val => {
            if (val.indexOf(name) === 0) result = val.substring(name.length);
        })

        return result;
    }

    $('#form-data').submit(function(e) {
        e.preventDefault();

        let data = new FormData(this);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: this.method,
            url: this.action,
            processData: false,
            contentType: false,
            data: data,
            // dataType: "dataType",
            success: function(res) {
                window.location.replace("{{ url('/') }}");
            },
            error: function(xhr, msg, error) {
                if (xhr.status == 404) {
                    $(`small[data-target="error"]`).text(xhr.responseJSON.message);
                } else {
                    alert('An error occured. Try again later')
                }
            }
        });
    });
</script>
@endsection