@extends('layouts.main')

@section('container')

<section class="h-100">
  <div class="container py-4 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-12 col-xl-7">
        <div class="card">
          <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
              <img src="{{ asset('storage/' . $post->image) }}" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
              <button type="button" class="btn btn-outline-primary" style="z-index: 1;">
                Book Now
              </button>
            </div>
            <div class="ms-3" style="margin-top: 130px;">
              <h5>{{ $post->name }}</h5>
              <p>New York</p>
            </div>
          </div>
          <div class="p-4 text-black" style="background-color: #f8f9fa;">
            <div class="d-flex justify-content-end text-center py-1">
              {{-- <div>
                <p class="mb-1 h5">253</p>
                <p class="small text-muted mb-0">Photos</p>
              </div>
              <div class="px-3">
                <p class="mb-1 h5">1026</p>
                <p class="small text-muted mb-0">Followers</p>
              </div>
              <div>
                <p class="mb-1 h5">478</p>
                <p class="small text-muted mb-0">Following</p>
              </div> --}}
            </div>
          </div>
          <label for="id-of-input" class="form-check">
            <input type="checkbox" id="id-of-input">
            <i class="glyphicon glyphicon-star-empty"></i>
            <i class="glyphicon glyphicon-star"></i>
            <span>Favorite</span>
          </label>
          <div class="card-body p-4 text-black">
            <div class="mb-5">
              <p class="lead fw-normal mb-1 mt-4">About Me</p>
              <div class="p-4" style="background-color: #f8f9fa;">
                <p class="font-italic mb-1"></p>
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="lead fw-normal mb-0">Portofolio</p>
            </div>
            <div class="row g-2">
                <div style="max-height: 350px; overflow:hidden;">
                  <img src=""  class="img-fluid"> 
                </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

   

@endsection


<script>
    export default {
        props: ['post', 'favorited'],

        data: function() {
            return {
                isFavorited: '',
            }
        },

        mounted() {
            this.isFavorited = this.isFavorite ? true : false;
        },

        computed: {
            isFavorite() {
                return this.favorited;
            },
        },

        methods: {
            favorite(post) {
                axios.post('/favorite/'+post)
                    .then(response => this.isFavorited = true)
                    .catch(response => console.log(response.data));
            },

            unFavorite(post) {
                axios.post('/unfavorite/'+post)
                    .then(response => this.isFavorited = false)
                    .catch(response => console.log(response.data));
            }
        }
    }
</script>
