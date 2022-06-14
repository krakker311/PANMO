@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Review</h1>
    </div>    

    @if(session()->has('success'))
      <div class="alert alert-success col-lg-8" role="alert">
        {{ session('success') }}
      </div>
    @endif

    <div class="table-responsive col-lg-8">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Rating</th>
              <th scope="col">Review</th>
              <th scope="col">Reviewer</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($reviews as $review)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>   
                        @while($review->rating>0)
                            @if($review->rating >0.5)
                                <i class="fa fa-star"></i>
                            @else
                                <i class="fa fa-star-half"></i>
                            @endif
                            @php $review->rating--; @endphp
                        @endwhile
                    </td>
                    <td>{{ $review->comment }}</td>
                    <td>{{ $review->user->name}}</td>
                </tr>
            @endforeach
           
          </tbody>
        </table>
      </div>

<script>
    $(document).ready(function(){
        $('#input-3').rating({displayOnly: true, step: 0.5});
    });
</script>
@endsection
