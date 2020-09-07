@php
    $relationshipField = $row->field;
    $options->pivot_extra_fields = [];
    foreach($options->pivot_datas as $pivot_datas){
      array_push($options->pivot_extra_fields, $pivot_datas[0]);
    }
    $selected_values = isset($dataTypeContent) ? $dataTypeContent->belongsToMany($options->model, $options->pivot_table, $options->foreign_pivot_key ?? null, $options->related_pivot_key ?? null, $options->parent_key ?? null, $options->key)->withPivot($options->pivot_extra_fields)->get()->map(function ($item, $key) use ($options) {
        $array_pivot = [];
        foreach($options->pivot_extra_fields as $pivot_col_name){
          array_push($array_pivot, $item->pivot->$pivot_col_name);
        }
        return array('id' => $item->{$options->key}, 'extra_pivot' => $array_pivot);

    })->all() : array();

    $relationshipOptions = app($options->model)->all();
    $selected_values = old($relationshipField, $selected_values);
    if(count($selected_values) == null){
      $selected_values[0] = 0;
    }
@endphp
@foreach($selected_values as $cpt => $selected_value)
<div class="panel-body" id="{{ $relationshipField }}" style="background-color:#f2f2f2">
  <div id="{{ $relationshipField.'-num'.$cpt }}">

    <label class="control-label" for="name">{{ $row->getTranslatedAttribute('display_name') }}</label>
    <select
        class="form-control"
        onchange="hideAlreadySelectedOptions(this)"
        name="{{ $relationshipField }}[]"
        data-get-items-route="{{route('voyager.' . $dataType->slug.'.relation')}}"
        data-get-items-field="{{$row->field}}"
        @if(!is_null($dataTypeContent->getKey())) data-id="{{$dataTypeContent->getKey()}}" @endif
        data-method="{{ !is_null($dataTypeContent->getKey()) ? 'edit' : 'add' }}"
        @if(isset($options->taggable) && $options->taggable === 'on')
            data-route="{{ route('voyager.'.\Illuminate\Support\Str::slug($options->table).'.store') }}"
            data-label="{{$options->label}}"
            data-error-message="{{__('voyager::bread.error_tagging')}}"
        @endif
    >

        @if(!$row->required)
            <option value="">{{__('voyager::generic.none')}}</option>
        @endif

        @foreach($relationshipOptions as $relationshipOption)
            <option value="{{ $relationshipOption->{$options->key} }}" @if($relationshipOption->{$options->key} == $selected_value['id']) selected="selected" @endif>{{ $relationshipOption->{$options->label} }}</option>
        @endforeach

    </select>
    @foreach($row->details->pivot_datas as $key => $pivot_datas)

        <label for="{{ $relationshipField.'-'.$pivot_datas[0] }}">{{ $pivot_datas[1] }}</label>
        <input type="text" class="form-control pivot" id="{{ $relationshipField.'-'.$pivot_datas[0] }}" name="{{ $relationshipField.'-'.$pivot_datas[0].'[]' }}" placeholder="{{ $pivot_datas[1] }}"
               value="{{$selected_value['extra_pivot'][$key]}}">

    @endforeach
    <hr style="height:1px;border-width:0;color:gray;background-color:gray">
  </div>
  @if(count($relationshipOptions) > 1)
  <a class="addEntry" style="cursor: pointer;" data-relationshipField="{{ $relationshipField }}" data-nbOfRelationshipOptions="{{ count($relationshipOptions) }}"><span class="voyager-plus">Ajouter une entrée</span></a>
  <a class="delEntry" style="cursor: pointer; display: none;" data-relationshipField="{{ $relationshipField }}" data-nbOfRelationshipOptions="{{ count($relationshipOptions) }}"><span class="voyager-trash">Supprimer une entrée</span></a>
  @endif
</div>
@endforeach