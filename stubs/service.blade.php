@php
    echo "<?php" . PHP_EOL;
@endphp

namespace App\Services;

use App\Models\{{ $model }};

class {{ $model }}Service extends BaseService
{
    public function __construct()
    {
        $this->model = {{ $model }}::class;
        // $this->columns = ['*'];
    }
}
