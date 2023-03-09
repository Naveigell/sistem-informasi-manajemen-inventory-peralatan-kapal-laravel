<div class="modal fade show" tabindex="-1" role="dialog" id="modal-aggrement" style="display: none; padding-right: 16px;">
    <div class="modal-dialog modal-md" role="document">
        <form action="" method="post">
            @csrf
            @method('patch')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-shadow" id="">Iya</button>
                    <button type="button" class="btn btn-secondary" id="" data-dismiss="modal" aria-label="Close">Batalkan</button>
                </div>
            </div>
        </form>
    </div>
</div>
