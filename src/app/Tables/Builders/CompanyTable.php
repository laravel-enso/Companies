<?php

namespace LaravelEnso\Companies\app\Tables\Builders;

use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\VueDatatable\app\Classes\Table;

class CompanyTable extends Table
{
    protected $templatePath = __DIR__.'/../Templates/companies.json';

    public function query()
    {
        return Company::select(\DB::raw(
                'companies.*, companies.id as "dtRowId", people.name as mandatary'
            ))->leftJoin('people', 'companies.mandatary_id', '=', 'people.id');
    }
}
