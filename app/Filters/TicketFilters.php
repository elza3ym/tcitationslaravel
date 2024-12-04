<?php

namespace App\Filters;

use App\Filters\Filters;

class TicketFilters extends Filters
{
    protected $filters = ['name', 'status', 'attorney_id', 'company_id', 'court_date'];

    protected function name($name) {
        if ($name) {
            return $this->builder->whereLike('name', "%$name%");
        }
    }
    protected function status($status) {
        if (!is_null($status)) {
            return $this->builder->where('status', '=', $status);
        }
    }
    protected function court_date($courtDate) {
        if (!empty($courtDate)) {
            $dates = explode(' to ', $courtDate);
            $startDate = date($dates[0]);
            $endDate = date($dates[1]);
            return $this->builder->whereBetween('court_date', [$startDate, $endDate]);
        }
    }
    protected function company_id($company_id) {
        if ($company_id) {
            return $this->builder->where('company_id', $company_id);
        }
    }
    protected function attorney_id($attorney_id) {
        if ($attorney_id) {
            return $this->builder->where('attorney_id', $attorney_id);
        }
    }
}
