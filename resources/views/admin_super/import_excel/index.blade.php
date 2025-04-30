@extends('admin_super.layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Import Data Excel</h5>

        {{-- Form Import Excel Divisi --}}
        <form action="{{ route('admin_super.divisions.import') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <input type="file" name="file" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success">Import Excel</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
