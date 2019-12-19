<?php

namespace LaravelEnso\Companies\app\Tables\Builders;

use Illuminate\Database\Eloquent\Builder;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Tables\app\Contracts\Table;

class CompanyTable implements Table
{
    protected const TemplatePath = __DIR__.'/../Templates/companies.json';

    public function query(): Builder
    {
        return Company::selectRaw('
            companies.id, 
            companies.name, 
            companies.fiscal_code, 
            people.name as mandatary,
            companies.email, 
            companies.bank, 
            companies.pays_vat, 
            companies.phone, 
            companies.status,
            companies.status as statusValue, 
            companies.is_tenant, 
            companies.created_at
        ')->leftJoin('company_person', fn ($join) => (
            $join->on('companies.id', '=', 'company_person.company_id')
                ->where('company_person.is_mandatary', true)
        ))->leftJoin('people', 'company_person.person_id', '=', 'people.id');
    }

    public function templatePath(): string
    {
        return static::TemplatePath;
    }
}
