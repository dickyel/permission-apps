<div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button"
        class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
        aria-expanded="false">
        Action
    </button>
    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
        @foreach($actions as $key => $item)
            <li><a class="dropdown-item" href="{{ $item }}">{{ $key }}</a></li>
        @endforeach
       
       
    </ul>
</div>