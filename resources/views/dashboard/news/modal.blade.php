<div class="modal fade" id="modalData{{ $item->id }}" tabindex="-1" aria-labelledby="modalDataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyingModalLabel">Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('dashboard.news.destroy', $item->id) }} }}">
                    @csrf
                    <div id="method">
                        @method('delete')
                    </div>
                    <div class="modal-body">
                        Apakah data ingin dihapus ?
                    </div>

                    <div class="modal-footer">
                        <div class="divider"></div>
                        <div class="d-flex justify-content-between w-100">
                            <div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-danger btn-save">Delete</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
