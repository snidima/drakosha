@extends('admin/layouts/main')

@section('content')

    <div class="container">

        @if ( Session::get('page-edit') )
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Страница успешно сохранена!
            </div>
        @endif

        <ul class="nav nav-tabs" role="tablist">
            @foreach( $pages as $key => $page )
                @if( $key == 0 ) <?php $class = 'class=active' ?> @endif
                <li role="presentation" {{ $class  }}><a href="#page-{{$page['id']}}" aria-controls="page-{{$page['id']}}" role="tab" data-toggle="tab">{{$page['name']}}</a></li>
            @endforeach
        </ul>

        <br>


        <div class="tab-content">
            @foreach( $pages as $key => $page )
                @if( $key == 0 ) <?php $class = 'active'; ?> @endif
                <div role="tabpanel" class="tab-pane {{ $class }}" id="page-{{$page['id']}}">
                    <p></p>
                    <form method="post" action="{{route('save-page')}}">
                        {{ csrf_field() }}
                        <textarea name="html" id="editor-{{$page['id']}}" rows="10" cols="80">{{ $page['html'] }}</textarea>
                        <br>
                        <input type="hidden" value="{{$page['id']}}" name="id">
                        <input type="submit" value="Сохранить" class="btn btn-default">
                        <script>
                            CKEDITOR.replace( 'editor-{{$page['id']}}' );
                        </script>
                    </form>
                </div>
            @endforeach

        </div>

    </div>

@endsection