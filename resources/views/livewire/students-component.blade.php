<div>
    <x-style.loading />
    <div wire:loading>
        <div class="full_layar">
            <div style="color: #f6d860; margin-bottom: 30px;" class="la-pacman la-2x">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header justify-content-between">
                        <h6 style="float: left"><strong>All students</strong></h6>
                        <button data-bs-toggle="modal" data-bs-target="#addStudentModal" class="btn btn-primary btn-sm"
                            style="float:right">Create</button>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                        <table class="table table-striped|sm|bordered|hover|inverse table-inverse table-responsive">
                            <thead class="thead-inverse|thead-default">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $std)
                                    <tr>
                                        <td scope="row">{{ $std->id }}</td>
                                        <td>{{ $std->name }}</td>
                                        <td>{{ $std->phone }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning"
                                                wire:click='editStudent({{ $std->id }})'>Edit</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No data</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal add-->
    <div wire:ignore.self class="modal fade" id="addStudentModal" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ADD</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeStudentData">
                        <div class="form-group row">
                            <label for="student_id">student_id</label>
                            <div>
                                <input type="text" id="student_id" class="form-control" wire:model='student_id'>
                                @error('student_id')
                                    <span class="blockquote-footer text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name">name</label>
                            <div>
                                <input type="text" id="name" class="form-control" wire:model='name'>
                                @error('name')
                                    <span class="blockquote-footer text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone">phone</label>
                            <div>
                                <input type="text" id="phone" class="form-control" wire:model='phone'>
                                @error('phone')
                                    <span class="blockquote-footer text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col">
                                <button type="submit" class="btn btn-primary btn-sm">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edit-->
    <div wire:ignore.self class="modal fade" id="editStudentModal" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">EDIT STUDENT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click='resetInput'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateStudent">
                        <div class="form-group row">
                            <label for="student_id">student_id</label>
                            <div>
                                <input type="text" id="student_id" class="form-control" wire:model='student_id'>
                                @error('student_id')
                                    <span class="blockquote-footer text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name">name</label>
                            <div>
                                <input type="text" id="name" class="form-control" wire:model='name'>
                                @error('name')
                                    <span class="blockquote-footer text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone">phone</label>
                            <div>
                                <input type="text" id="phone" class="form-control" wire:model='phone'>
                                @error('phone')
                                    <span class="blockquote-footer text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('modal-close', event => {
            $('#addStudentModal').modal('hide');
            $('#editStudentModal').modal('hide');
        });
        window.addEventListener('show-edit-modal', event => {
            $('#editStudentModal').modal('show');
        });
    </script>
@endpush
