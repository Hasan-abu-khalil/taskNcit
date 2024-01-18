@extends('layout_admin.admin_master')


@section('title', 'admin | User')


@section('content')


<style>
    .modal-backdrop {
        position: inherit;

    }

    .modal-backdrop .show {
        opacity: 1;
    }

    .modal.show .modal-content {
        box-shadow: 0px 20px 25px rgba(0, 0, 0, 0.3);
    }
</style>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>


        <div class="row col-lg-12 mb-3">

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#setMarkModal">
                Set Mark
            </button>
            <div class="modal fade" id="setMarkModal" tabindex="-1" role="dialog" aria-labelledby="setMarkModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="setMarkModalLabel">Set Mark</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('set-mark') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="user_id">Select User</label>
                                    <select name="user_id" class="form-control">
                                        @foreach ($adminUser as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="subject_id">Select Subject</label>
                                    <select name="subject_id" class="form-control">
                                        @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="mark">Mark</label>
                                    <input type="number" class="form-control @error('mark') is-invalid @enderror"
                                        id="mark" name="mark" value="{{ old('mark') }}" max="100" min="0">
                                    @error('mark')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Add Mark</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-success mx-2" data-toggle="modal" data-target="#assignSubjectModal">
                Assign Subject
            </button>

            <!-- Modal -->
            <div class="modal fade" id="assignSubjectModal" tabindex="-1" role="dialog"
                aria-labelledby="assignSubjectModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="assignSubjectModalLabel">Assign Subject</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Assignment Form -->
                            <form method="POST" action="{{ route('assign.subject') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="user_id">Select User</label>
                                    <select name="user_id" class="form-control">
                                        @foreach ($adminUser as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="subject_id">Select Subject</label>
                                    <select name="subject_id" class="form-control">
                                        @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Assign Subject</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <button type="button" class="btn btn-success mx-2" data-toggle="modal" data-target="#subjectModal">
                Create Subject
            </button>

            <div class="modal" id="subjectModal" role="dialog" aria-labelledby="subjectModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="subjectModalLabel">Create Subject</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" action="{{ route('subject.create') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="name">subject name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="minimun_mark">Minimum Mark</label>
                                    <input type="number"
                                        class="form-control @error('minimun_mark') is-invalid @enderror"
                                        id="minimun_mark" name="minimun_mark" value="{{ old('minimun_mark') }}"
                                        max="100" min="0">
                                    @error('minimun_mark')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Add Subject</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-success mx-2" data-toggle="modal" data-target="#registerUserModal">
                Register User
            </button>

            <div class="modal" id="registerUserModal" role="dialog" aria-labelledby="registerUserModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="registerUserModalLabel">Register User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" action="{{ route('admin_user.creat_user') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation">
                                </div>

                                <button type="submit" class="btn btn-primary">Register</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>




        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <div class="card">
                    <div class="card-header d-flex justify-content-between m-2">
                        <h4>User</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Access</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($adminUser as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>


                                        <td>
                                            @if ($user->has_access)
                                            <span class="badge badge-success">Access Granted</span>
                                            @else
                                            <span class="badge badge-danger">No Access</span>
                                            @endif
                                        </td>
                                        <td class="d-flex flex-row align-items-center">
                                            <form
                                                action="{{ route('admin_user.destroy', ['admin_user' => $user->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border:none; outline:none; "
                                                    data-toggle="tooltip" title="Delete"
                                                    onclick="return confirm('Are You Sure? This action cannot be undone. Do you want to continue?')">
                                                    <a class="btn btn-danger btn-action mr-1">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </button>
                                            </form>


                                            <button type="button" class="btn btn-primary btn-action mr-1"
                                                data-toggle="modal" data-target="#editUserModal{{ $user->id }} ">
                                                <i class="fas fa-solid fa-pen-to-square"></i>
                                            </button>


                                            <div class="modal mt-5 " id="editUserModal{{ $user->id }}" role="dialog"
                                                aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                                                <div class="modal-dialog " role="document">
                                                    <div class="modal-content ">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editUserModalLabel{{ $user->id }}">Edit User</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body col-lg-12">

                                                            <form method="POST"
                                                                action="{{ route('admin_user.update', ['id' => $user->id]) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input type="text"
                                                                        class="form-control @error('name') is-invalid @enderror"
                                                                        id="name" name="name" value="{{ $user->name}}">
                                                                    @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror
                                                                </div>



                                                                <div class="form-group">
                                                                    <label for="name">Name</label>
                                                                    <input type="text"
                                                                        class="form-control @error('email') is-invalid @enderror"
                                                                        id="name" name="email"
                                                                        value="{{ $user->email}}">
                                                                    @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror
                                                                </div>

                                                                <button type="submit" class="btn btn-primary">Save
                                                                    Changes</button>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('admin_user.toggleAccess', ['id' => $user->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" style="border:none; outline:none; "
                                                    data-toggle="tooltip" title="Toggle Access">
                                                    <a class="btn btn-primary btn-action mr-1">
                                                        @if ($user->has_access)
                                                        Revoke Access
                                                        @else
                                                        Grant Access
                                                        @endif
                                                    </a>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>
</div>

<!-- <script>
    function openAssignSubjectModal(userId) {
        document.getElementById('user_id').value = userId;
    }
</script> -->


@endsection