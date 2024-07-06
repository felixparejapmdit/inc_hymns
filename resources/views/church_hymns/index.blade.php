<!-- resources/views/permissions/index.blade.php -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<!-- Include Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery before Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center my-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Church Hymns Management') }}
            </h2>
            <div>
                 <a href="{{ route('admin.settings') }}" class="btn btn-secondary">Back</a>
                
                <button class="btn btn-primary ml-1" data-toggle="modal" data-target="#addHymnModal">
                    <i class="fas fa-plus"></i> Church Hymn
                </button>

                
            </div>
        </div>
    </x-slot>


    <div class="py-12 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif


    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center" style="width: 5%;">#</th>
                <th>Name</th>
                <th style="width: 10%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hymns as $hymn)
            <tr>
            <td class="text-center" style="width: 5%;">{{ $loop->iteration }}</td>
            <td>{{ $hymn->name }}</td>
            <td style="width: 10%;">
                <button class="btn btn-secondary" data-toggle="modal" data-target="#editHymnModal{{ $hymn->id }}">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-secondary" data-toggle="modal" data-target="#deleteHymnModal{{ $hymn->id }}">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>

        <!-- Edit Hymn Modal -->
        <div class="modal fade" id="editHymnModal{{ $hymn->id }}" tabindex="-1" role="dialog" aria-labelledby="editHymnModalLabel{{ $hymn->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editHymnModalLabel{{ $hymn->id }}">Edit Church Hymn</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('church_hymns.update', $hymn->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="edit_name_{{ $hymn->id }}">Name</label>
                                <input type="text" name="name" class="form-control" id="edit_name_{{ $hymn->id }}" value="{{ old('name', $hymn->name) }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                <!-- Delete Hymn Modal -->
                <div class="modal fade" id="deleteHymnModal{{ $hymn->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteHymnModalLabel{{ $hymn->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteHymnModalLabel{{ $hymn->id }}">Delete Church Hymn</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this church hymn?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('church_hymns.destroy', $hymn->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Hymn Modal -->
<div class="modal fade" id="addHymnModal" tabindex="-1" role="dialog" aria-labelledby="addHymnModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addHymnModalLabel">Add Church Hymn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('church_hymns.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Church Hymn</button>
                </div>
            </form>
        </div>
    </div>
      





                </div>
            </div>
        </div>
    </div>
</x-app-layout>


