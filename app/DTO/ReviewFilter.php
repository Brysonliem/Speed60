<?php

namespace App\DTO;

class ReviewFilter
{
    public ?int $page = null;
    public ?string $buyer_name = null;
    public ?string $start_date = null;
    public ?string $end_date = null;

    public function __construct(
        ?int $page = null,
        ?string $buyer_name = null,
        ?string $start_date = null,
        ?string $end_date = null
    ) {
        $this->page = $page;
        $this->buyer_name = $buyer_name;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    
}
