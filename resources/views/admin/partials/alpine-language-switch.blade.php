<select class="form-control" x-model="editingLang">
    @foreach(languages() as $lang)
    <option value="{{$lang->code}}">{{$lang->name}}</option>
    @endforeach
</select>
