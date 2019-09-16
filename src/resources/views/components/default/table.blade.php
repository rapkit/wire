@if(!$data->isEmpty())
    <table class="table table-borderless px-3">
        <thead class="bg-light">
        <tr class="px-3">
            @foreach($fields as $header_key => $header_value)
                @if(@$header_value['available_in'] && in_array('index', $header_value['available_in'], true))
                    <th class="px-4 py-3">
                        <span class="text-uppercase text-dark">{{ str_replace("_", " ", $header_key) }}</span>
                    </th>
                @endif
            @endforeach
            <th class="text-center" style="width: 116px">
                <span class="text-uppercase text-dark">
                    {{ trans('wire::button_input.actions') }}
                </span>
            </th>
        </tr>
        </thead>

        <tbody>

        @foreach($data as $record)
            <tr>
                @foreach($fields as $key => $value)
                    @if(@$value['available_in'] && in_array('index', $value['available_in'], true))
                        <td class="px-4 py-3">
                            @component('wire.views.components.default.table.'.$value['type'],
                                [
                                    'record' => $record,
                                    'parameters' => $value,
                                    'key' => $key,
                                    'model' => $model
                                ])
                            @endcomponent
                        </td>
                    @endif
                @endforeach
                <td class="d-flex justify-content-between py-3">
                    @if(@$custom_slot == true)
                        <a href="{{ route('wire.restore', ['identifier' => $model, 'id' => $record['id']]) }}"
                           class="btn mr-2 btn-sm btn-outline-success btn-lg"
                           role="button" aria-pressed="true">
                            <i class="fas fa-leaf"></i>
                        </a>
                        <form class="d-inline" action="{{route('wire.destroy',['identifier' => $model, 'id' => $record['id']])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input hidden name="force_delete" value="true">
                            <button class="btn mr-2 btn-sm btn-outline-danger btn-lg" type="submit">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('wire.edit', ['identifier' => $model, 'id' => $record['id']]) }}"
                           class="text-indigo-900 text-decoration-none crud_action_button text-sm text-capitalize svg_button"
                           role="button" aria-pressed="true">
                            <svg class="button_svg_icon" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 325.174 325.174" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 325.174 325.174">
                                <path d="M292.047,88.799L76.43,304.415l-55.758-55.758L236.289,33.041L292.047,88.799z"></path>
                                <polygon points="72.499,308.344 0.084,325.174 16.741,252.588  "></polygon>
                                <path d="m268.75,.579c-2.896,1.753-6.383,4.736-9.907,8.124l-5.435-5.435c-3.606-3.606-12.065-0.991-18.896,5.84l-95.858,95.858c-6.832,6.832-9.447,15.291-5.841,18.896l.144,.144c0.986-1.384 2.137-2.753 3.447-4.063l95.858-95.858c6.325-6.325 14.039-9.026 18.01-6.529-5.594,6.117-9.883,11.382-9.883,11.382l55.759,55.758c0,0 21.73-12.915 28.36-28.36s-45.375-62.042-55.758-55.757z"></path>
                            </svg>
                        </a>

                        <a href="{{ route('wire.show', ['identifier' => $model, 'id' => $record['id']]) }}"
                           class="text-indigo-900 text-decoration-none crud_action_button text-sm text-capitalize svg_button"
                           role="button" aria-pressed="true">
                            <svg class="button_svg_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M.2 10a11 11 0 0 1 19.6 0A11 11 0 0 1 .2 10zm9.8 4a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0-2a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"></path>
                            </svg>
                        </a>

                        <form class="d-inline" action="{{route('wire.destroy',['identifier' => $model, 'id' => $record['id']])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="transparent_button text-indigo-900 text-decoration-none crud_action_button text-sm text-capitalize svg_button" type="submit">
                                <svg class="button_svg_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"></path>
                                </svg>
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div class="p-2">
        <div class="text-center p-5 bg-light border rounded text-info h6 mb-0">
            <i class="far fa-folder-open mr-2"></i> {{ trans('wire::wire.nothing_to_show') }}
        </div>
    </div>
@endif
