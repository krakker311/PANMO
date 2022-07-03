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

    <a href="/dashboard/jobs/create" class="btn btn-dark mb-3"><i class="bi bi-plus-circle" style="margin-right: 10px;"></i>Create new job</a>
            @foreach ($jobs as $job)
            <div class="card" style="width: 40rem; margin-bottom: 10px;">
              <div class="card-body">
                <h5 class="card-title">{{ $job->job_title }}</h5>
                <h6 class="card-subtitle ">Category: {{ $job->category->name }}</p>
                  <hr>
                <h6 class="card-text">Description: {{ $job->job_desc }}</h6>
                <h6 class="card-text ">Price: IDR {{ number_format($job->price,2,',','.') }}</p>
                <a type="button" class="btn btn-dark" href="/dashboard/jobs/{{ $job->id }}" style="float: right; margin-left: 10px;">Details</a>  
                <form action="/dashboard/jobs/{{ $job->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-dark" onclick="return confirm('Are you sure?')" style="float: right; margin-left: 10px;">Delete</button>
                </form>
                <a type="button" class="btn btn-dark" href="/dashboard/jobs/{{ $job->id }}/edit" style="float: right; margin-left: 10px;">Update</a>
              </div>
            </div>
            @endforeach
           
          </tbody>
        </table>
      </div>
@endsection
