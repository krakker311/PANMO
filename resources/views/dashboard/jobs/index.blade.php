@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Job</h1>
    </div>    

    @if(session()->has('success'))
      <div class="alert alert-success col-lg-8" role="alert">
        {{ session('success') }}
      </div>
    @endif

    <div class="table-responsive col-lg-8">
        <a href="/dashboard/jobs/create" class="btn btn-primary mb-3">Create new job</a>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Job Title</th>
              <th scope="col">Job Desc</th>
              <th scope="col">Price</th>
              <th scope="col">Province</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($jobs as $job)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $job->job_title }}</td>
                    <td>{{ $job->job_desc }}</td>
                    <td>{{ $job->job_desc }}</td>
                    <td>{{ $job->price }}</td>
                    <td>{{ $job->province->name }}</td>
                    <td>
                        <a href="/dashboard/jobs/{{ $job->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
                        <a href="/dashboard/jobs/{{ $job->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span> </a>
                        <form action="/dashboard/jobs/{{ $job->id }}" method="post" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
           
          </tbody>
        </table>
      </div>
@endsection
