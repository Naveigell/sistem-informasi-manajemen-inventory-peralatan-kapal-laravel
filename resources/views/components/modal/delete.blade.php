<div class="modal fade show" tabindex="-1" role="dialog" id="modal--delete" style="display: none; padding-right: 16px;">
    <div class="modal-dialog modal-md" role="document">
        <form action="" method="post">
            @csrf
            @method('delete')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus {{ $name ?? '' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">Data tidak akan bisa dikembalikan</div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-shadow" id="">Iya</button>
                    <button type="button" class="btn btn-secondary" id="" data-dismiss="modal" aria-label="Close">Batalkan</button>
                </div>
            </div>
        </form>
    </div>
</div>
