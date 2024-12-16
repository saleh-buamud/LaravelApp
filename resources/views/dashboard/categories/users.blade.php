@extends('dashboard.layout')

@section('users')
    <h2>All Users</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if (auth()->user()->isSuperAdmin())
                            <!-- رابط حذف المستخدم -->
                            <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')"
                                    style="background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
