@extends('layouts.app')
@section('content')

<div class="container d-flex min-vh-100">
    <div class="row h-100 w-100 justify-content-center align-items-center align-content-center flex-column m-auto">
        <div class="col-md-8 ">
            <div class="card">
                <div class="card-header">{{ __('Upload file to import') }} - ({{ $tenantName }})</div>

                <div class="card-body">
                    
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" id="file_upload_form" action="{{ route('saveFile') }}"  enctype="multipart/form-data" x-data="fileUploadForm()" @submit.prevent="submitForm">
                        @csrf

                        <div class="row mb-3">
                            <label for="filename" class="col-md-4 col-form-label text-md-end">{{ __('File') }}</label>

                            <div class="col-md-6">
                                <input class="form-control" name="filename" type="file" id="formFile" required x-on:click="clearErrors">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<script>

    function fileUploadForm() {
        return{
            submitForm(){
                this.$dispatch('loading', true);
                document.getElementById('file_upload_form').submit();
            },
            clearErrors(){
                document.querySelectorAll(".alert").forEach(ele => {
                    ele.classList.add('d-none');
                });
            }
        }
    }

</script>

@stop

