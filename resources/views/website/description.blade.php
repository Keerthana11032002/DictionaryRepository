
<div class="group" id="values">
    @foreach($list as $col)
        <div class="card">
            <div class="row">
                <div class="col-md-3">
                    <div class="word">
                        <div class="click" onclick="clickWord('{{$col->dictionary->dictionary_name}}')">
                            <b>{{$col->dictionary->dictionary_name}}</b>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="meaning">
                        <div class="{{$col->id}}">{{$col->description_language}}</div>
                    </div>
                </div>

                <div class="col-md-1">
                <a href="#values" data-toggle="tooltip" title="Copy!"><i class="fas fa-copy" onclick="copyToClipboard('{{$col->id}}')"></i></a>
                </div>
                
            </div>
        </div>
    @endforeach
</div>
<div class="pagin" id="pagin">
    {{ $list->links() }}
</div>