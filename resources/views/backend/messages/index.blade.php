@extends('backend.layout.app')

@section('title')
    {{$pageTitle}}
@endsection

@section('content')
    @component('backend.layout.header')
        @slot('nav_title')
            {{$pageTitle}}
        @endslot
    @endcomponent

    @component('backend.shared.table',['pageTitle'=>$pageTitle,'pageDes'=>$pageDes])
        @slot('addButton')

        @endslot
        <table class="table table-hover">
            <thead class="">
            <th>
                ID
            </th>
            <th>
                Name
            </th>
            <th>
                Email
            </th>
            <th class="text-right">
                Control
            </th>
            </thead>
            <tbody>
            @foreach ($rows as $row)
                <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->email}}</td>
                    <td class="td-actions text-right">
                        @include('backend.shared.buttons.edit')
                        @include('backend.shared.buttons.delete')
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
        {!! $rows->links() !!}
    @endcomponent
@endsection
