@if($hasChoice)
    <?php $theChoice = \macrominds\laravel\choice\Choice::get($choice); ?>
    <div id="modal">
        <div class="modal-dialog modal-content">
            <div class="modal-header">
                @if($theChoice->hasTitle())<h4 class="modal-title">{{ $theChoice->title() }}</h4>@endif
            </div>
            <div class="modal-body">
                {!! $theChoice->message() !!}
            </div>
            <div class="modal-footer">
                @foreach($theChoice->options() as $option)
                    {!! $option !!}
                @endforeach
            </div>
        </div>
    </div>
@endif