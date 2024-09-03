<x-button
    size="sm"
    variant="success"
    class="btn-start"
    :disabled="data_get($data, 'status') == 'started'"
    data-action="{{ route('servers.start', data_get($data, 'name')) }}"
    data-loading="Loading">Start</x-button>
<x-button
    size="sm"
    variant="danger"
    class="btn-stop"
    :disabled="data_get($data, 'status') == 'stoped'"
    data-action="{{ route('servers.stop', data_get($data, 'name')) }}"
    data-loading="Loading">Stop</x-button>
<x-button
    size="sm"
    variant="warning"
    class="btn-restart"
    data-loading="Loading"
    data-action="{{ route('servers.restart', data_get($data, 'name')) }}"
    >Restart</x-button>
