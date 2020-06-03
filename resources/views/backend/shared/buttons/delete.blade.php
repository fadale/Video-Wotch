<form action="{{route($routeName.'.destroy',[$row->id])}}" method="post">
    {{ csrf_field() }}
    @method('delete')
    <button type="submit" rel="tooltip" title="" class="btn btn-white btn-link btn-sm">
        <i class="material-icons">close</i>
    </button>
</form>
