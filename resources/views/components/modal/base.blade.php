<div id="{{ $id ?? '' }}" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center {{ $modalSize ?? '' }}">
            <div class="modal-content">
                <form id="modal-form" method="POST">
                    @method($method ?? 'POST')
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title text-center">{{ $title ?? '' }}</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pad-20">
                        {{ $body ?? '' }}
                    </div>
                    <div class="modal-footer">
                        @isset($customModalFooter)
                            {!! $customModalFooter !!}
                        @else
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                        @endisset
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
