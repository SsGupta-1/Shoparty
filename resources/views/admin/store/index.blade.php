@extends('admin.layouts.admin_master_after_login')
@section('content')
<div class="brandblk toppading">
    <div class="brandleft">
        <h1>Store Management</h1>
    </div>
    <div class="brandright topamr">
        <ul class="brlist">
            <li><a href="{{ url('admin/store/add') }}"> Add New Store</a></li>
        </ul>
    </div>
</div>

<div class="demo-html datablk">
    <table id="fedata" class="display" style="width:100%">
        <thead>
            <tr>
                <th class="snbrand">S.N.</th>
                <th class="">Store List</th>
                <th class="">Address</th>
                <th class="">Arabic Name</th>

                <th class="brandaction">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $key => $row)
                <tr>
                    <td class="snbrand">{{ $key+1 }}</td>
                    <td class="">{{ $row['en_store_name'] }}</td>
                    <td class="">{{ $row['en_store_address'] }}</td>
                    <td class="">{{ $row['ar_store_name'] }}</td>

                    <td class="brandaction">
                        <select class="form-control searchicon" onchange="updateStatus(this, event, '{{ $row['status_url'] }}');">
                            <option value="1" {{ ($row['status'] == 1) ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ ($row['status'] == 0) ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

</div>
@endsection