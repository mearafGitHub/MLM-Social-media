@extends('layouts.master')


@section('content')
    @include('includes.message-block')
    <section class="col user">
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="nav" id="bs-example-navbar-collapse-1">
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->

        <div class="row">
            <div class="col-sm-3 col-md-offset-0">
            <button type="button" class="btn btn-warning"><a href="{{ route('account') }}" role ="button">Profile</a></button> 
            <button type="button" class="btn btn-info"><a href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a> </button>
            </div>

            <div>
       
            </div>

            <div class="col-sm-5 col-md-offset-1">
            <div class="profilePic" >
            <img style="with:90px; height:90px;  border-radius: 50%; float: left; " src="{{ route('account.image', ['filename' => Auth::user()->full_name . '-' . Auth::user()->id . '.jpg']) }}" alt="" class="img-responsive">
            <h4 style="color: green; text-align: left;">{{Auth::user()->full_name}}</h4> 
        </div>
    
        </div>
        </div>
    </section>

    <section class="col-lg-7 col-lg-offset-3">
    <section class="row new-post">
    
        <div class="col">
            <form action="{{ route('post.create') }}" method="post">
                <div class="form-group">
                <header align-center id="conference"><h1>Conference</h1></header>
                    <textarea class="form-control" name="post_body" id="post_body" rows="5" placeholder="What do you want to share?"></textarea>
                    <label for="image">add photo (only .jpg)</label>
                    <input id="imgButton" type="file" name="image" class="form-control" id="image">
                </div>
                <button type="submit" class="btn btn-success">Create Post</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
    <section class="row posts" >
        <div class="col">
            <header><h2 >Recent Posts</h2></header>
            @foreach($posts as $post)
                <article class="post" data-postid="{{ $post->id }}">
                    <div class="info">
                    <h4 style="color: light-orange; text-align: left;">{{ $post->user->full_name }} </h4>
                        <h5>{{ $post->created_at }}</h5>
                        
                    </div>
                    <h5>{{ $post->post_body }}</h5> 
                    
                                                            
                    <div class="interaction">
                        <a  class="like-icon"><i class="fa fa-thumbs-up">  Like</i> </a> 
                        <a class="dislike-icon" ><i class="fa fa-thumbs-down">  Dislike</i> </a>
                        @if(Auth::user() == $post->user)
                            |
                            <a href="#" class="edit">Edit</a> 
                            |
                            <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
                        @endif
                    </div>
                </article>
               
            @endforeach
        </div>
    </section>
    </section>

    

    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="post_body">Edit this Post</label>
                            <textarea class="form-control" name="post_body" id="post_body" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="modal-save">Save Changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        var token = '{{ Session::token() }}';
        var urlEdit = '{{ route("edit") }}';
        var urlLike = '{{ route("like") }}';
    </script>
@endsection