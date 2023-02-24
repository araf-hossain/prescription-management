@extends('layouts.admin-master')

@section('content')
<div class="container" id="parentcontainer">
  <div class="row">
            <table>
                <thead>
                    <tr>
                        <th colspan="7">Doctor List</th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Speciality</th>
                        <th>Email</th>
                        <th>contact</th>
                        <th>Year Of Exp.</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if( $targets->isNotEmpty())
                    @foreach( $targets as $target )
                    <tr>
                        <td>{{ $target->name}}</td>
                        <td>{{ $target->speciality}}</td>
                        <td>{{ $target->email}}</td>
                        <td>{{ $target->contact}}</td>
                        <td>{{ $target->yrs_of_exp}}</td>
                        <td>{{ $target->status == '1' ? 'Active': 'Inactive'}}</td>
                        <td>
                        <form  action="{{ route('admin.doctor.status') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$target->id}}">
                                @if( $target->status == '1')
                                <button type="submit" name="status" value="0" class="btn btn-danger" style="background-color: red;">Inactive</button>
                                @else
                                <button type="submit" name="status" value="1" class="btn btn-info">Active</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            {{ $targets->links() }}
    </div>
</div>
@endsection
