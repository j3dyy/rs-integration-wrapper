<?php

namespace J3dyy\RsIntegrationWrapper\Client\WayBill;

use J3dyy\RsIntegrationWrapper\Client\QueryBuilder;

class WayBillBuilder implements QueryBuilder
{
    protected string $directive;
    protected string $query = '';

    public function __construct(string $username, string $password)
    {
        $this->query .= $this->prepend('su', $username);
        $this->query .= $this->prepend('sp', $password);

    }

    public static function for( string $username, string $password): self
    {
        return new self($username,$password);
    }

    public function status(array $statuses): self
    {
        $joinedStatuses = '';
        if ($statuses != null && count($statuses) > 0) {
            foreach ($statuses as $status) {
                $joinedStatuses .= sprintf('%s,', $status);
            }
        }

        $this->query .= $this->prepend('statuses', $joinedStatuses);
        return $this;
    }

    public function carNumber(string $carNumber): self
    {
        $this->query .= $this->prepend('car_number', $carNumber);
        return $this;
    }

    public function sellerTin(string $sellerTin): self
    {
        $this->query .= $this->prepend('seller_tin', $sellerTin);
        return $this;
    }

    public function buyerTin(string $buyerTin): self
    {
        $this->query .= $this->prepend('buyer_tin', $buyerTin);
        return $this;
    }

    public function isConfirmed(int $isConfirmed): self
    {
        $this->query .= $this->prepend('is_confirmed', $isConfirmed);
        return $this;
    }

    public function beginDateStart(string $beginDateStart): self
    {
        $this->query .= $this->prepend('begin_date_s', $this->maskDate($beginDateStart));
        return $this;
    }

    public function beginDateEnd(string $beginDateEnd): self
    {
        $this->query .= $this->prepend('begin_date_e', $this->maskDate($beginDateEnd));
        return $this;
    }

    public function createdDateStart(string $createdDateStart): self
    {
        $this->query .= $this->prepend('create_date_s', $this->maskDate($createdDateStart));
        return $this;
    }

    public function createdDateEnd(string $createdDateEnd): self
    {
        $this->query .= $this->prepend('create_date_e', $this->maskDate($createdDateEnd));
        return $this;
    }

    public function driverTin(string $driverTin): self
    {
        $this->query .= $this->prepend('driver_tin', $driverTin);
        return $this;

    }

    public function deliveryDateStart(string $deliveryDateStart): self
    {
        $this->query .= $this->prepend('delivery_date_s', $this->maskDate($deliveryDateStart));
        return $this;
    }

    public function deliveryDateEnd(string $deliveryDateEnd): self
    {
        $this->query .= $this->prepend('delivery_date_e', $this->maskDate($deliveryDateEnd));
        return $this;
    }

    public function fullAmount(float $amount): self
    {
        $this->query .= $this->prepend('full_amount', $amount);
        return $this;
    }

    public function wayBillNumber(string $wayBillNumber): self
    {
        $this->query .= $this->prepend('way_bill_number', $wayBillNumber);
        return $this;
    }

    public function closeDateStart(string $closeDateStart): self
    {
        $this->query .= $this->prepend('close_date_s', $this->maskDate($closeDateStart));
        return $this;
    }

    public function closeDateEnd(string $closeDateEnd): self
    {
        $this->query .= $this->prepend('close_date_e', $this->maskDate($closeDateEnd));
        return $this;
    }

    public function userIds(array $userIds): self
    {
        $ids = '';
        if ($userIds != null && count($userIds) > 0) {
            foreach ($userIds as $i) {
                $ids .= sprintf('%s,', $i);
            }
        }

        $this->query .= $this->prepend('s_user_ids', $ids);
        return $this;
    }

    public function comment(string $comment): self
    {
        $this->query .= $this->prepend('comment', $comment);
        return $this;
    }

    public function wayBillTypes(array $wayBillTypes): self
    {
        $joinedTypes = '';
        if ($wayBillTypes != null && count($wayBillTypes) > 0) {
            foreach ($wayBillTypes as $wayBillType) {
                $joinedTypes .= sprintf('%s,', $wayBillType);
            }
        }

        $this->query .= $this->prepend('itypes', $joinedTypes);
        return $this;
    }

    protected function maskDate(string $date): string
    {
        return \Carbon\Carbon::parse($date)->format('Y-m-d\TH:i:s\Z');
    }

    protected function prepend(string $key, $value): string
    {
        return sprintf("\n<%s>%s</%s>", $key, $value,$key);
    }

    function getQuery(): string
    {
        return $this->query;
    }
}