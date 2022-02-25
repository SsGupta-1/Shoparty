@extends('admin.layouts.admin_master_after_login')
@section('content')
<div class="brandblk toppading">
    <div class="brandleft">
        <h1>CMS Management</h1>
    </div>
</div>

<div class="datablk">
    <table>
        <tr>
            <th class="sn">S.N.</th>

            <th>Used In Application</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </tr>

        @foreach($list as $key => $row)
            <tr>
                <td class="sn">{{ $key+1 }}</td>
                <td>{{ Config::get('constants.static.'.$row['type']) }}</td>
                <td>{{ $row['title'] }}</td>
                <td>{{ $row['description'] }}</td>

                <td class="act">
                    <span><a href="{{ url('admin/cms/edit/'.$row['id']) }}"><img src="{{asset('assets/img/icon-material-edit.png')}}" alt="Edit"></a></span>
                </td>
            </tr>
        @endforeach

    </table>

</div>
@endsection