@extends('layouts.master')


@section('content')
    @include('includes.message-block')
    <section>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="nav" id="bs-example-navbar-collapse-1">
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->

        <div class="col-lg-10 col-lg-offset-1">
       <button class="btn btn-warning"> <a  href="{{ route('account') }}" role ="button">Profile</a></button> 
        <button class="btn btn-info"> <a href="{{ route('logout') }}">Log Out</a> </button>
        </div>
        <div>
        <div class="col-sm-5 ">
            <div class="profilePic">
            <h4>Profile Picture and name</h4>  
            </div>
        </div>
        </div>
    </section>
    <section class="row new-post">
    <header align-center id="conference"><h1>Conference</h1></header>
        <div class="col-md-6 col-md-offset-3">
            
           
            <form action="{{ route('post.create') }}" method="post">
                <div class="form-group">
                    <textarea class="form-control" name="post_body" id="post_body" rows="5" placeholder="What do you want to share?"></textarea>
                    <label for="image">add photo (only .jpg)</label>
                    <input id="imgButton" type="file" name="image" class="form-control" id="image">
                </div>
                <button type="submit" class="btn btn-success">Create Post</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h2>Recent Posts</h2></header>
            @foreach($posts as $post)
                <article class="post" data-postid="{{ $post->id }}">
                    <div class="info">
                    <h4> Posted by: {{ $post->user->full_name }} </h4>
                        <h5>{{ $post->created_at }}</h5>
                        
                    </div>
                    <h5>{{ $post->post_body }}</h5>  
                                                            
                    <div class="interaction">
                        <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
                        <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a>
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