@php
    echo "<?php" . PHP_EOL;
@endphp

namespace {{ $service['namespace'] }};

use {{ $service['model_namespace'] }}\{{ $service['model'] }};

class {{ $service['model'] }}Service extends BaseService
{
    public function __construct()
    {
        $this->model = {{ $service['model'] }}::class;
        // $this->columns = ['*'];
    }
}
