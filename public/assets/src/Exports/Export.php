<?php

namespace App\Exports;

use App\Models\ModelName;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class pluralCompactNameExport implements FromArray, WithHeadings
{
    public function headings(): array
    {
        return [
            __('dashboard.main.name_in_ar'),
            __('dashboard.main.name_in_en'),
            __('dashboard.main.description_in_ar'),
            __('dashboard.main.description_in_en'),
            __('dashboard.main.Created At'),
        ];
    }

    public function array(): array
    {
        $pluralVariable = ModelName::all();
        $data = [];

        foreach ($pluralVariable as $singularVariable) {
            $data[] = [
                __('dashboard.main.name_in_ar') => $singularVariable->getTranslation('name', 'ar'),
                __('dashboard.main.name_in_en') => $singularVariable->getTranslation('name', 'en'),
                __('dashboard.main.description_in_ar') => $singularVariable->getTranslation('description', 'ar'),
                __('dashboard.main.description_in_en') => $singularVariable->getTranslation('description', 'en'),
                __('dashboard.main.Created At') => date('Y-m-d H:i', strtotime($singularVariable->created_at))
            ];
        }

        return $data;
    }

}
