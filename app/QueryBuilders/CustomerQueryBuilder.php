<?php

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class CustomerQueryBuilder extends Builder
{
    public function wherePaymentStatusIn(array $statuses): self
    {
        if(in_array("PARTIALLY REFUNDED", $statuses))
        {
            array_push($statuses, 'PARTIAL REFUNDED');
        }
        return $this->whereIn('payment_status', str_replace(' ', '_', $statuses));
    }

    public function wherePaymentGatewayIn(array $gateways): self
    {
        return $this->whereIn('payment_gateway', $gateways);
    }

    public function wherePaymentMethodIn(array $methods): self
    {
        return $this->whereIn('payment_method', $methods);
    }

    public function whereDateFrom(string $date): self
    {
        return $this->whereDate('created_at', '>=', $date);
    }

    public function whereDateTo(string $date): self
    {
        return $this->whereDate('created_at', '<=', $date);
    }

    public function wherePaymentDateFrom(string $date): self
    {
        return $this->whereDate('paid_at', '>=', $date);
    }

    public function wherePaymentDateTo(string $date): self
    {
        return $this->whereDate('paid_at', '<=', $date);
    }

    public function wherePaymentGatewayReferenceIdIn(array $ids): self
    {
        return $this->whereIn('payment_gateway_reference_id', $ids);
    }

    public function whereIdIn(array $ids): self
    {
        return $this->whereIn('id', $ids);
    }

    public function whereMerchantCodeIn(array $codes): self
    {
        return $this->whereIn('merchant_code', $codes);
    }

    public function whereMinAmount($amount): self
    {
        return $this->where('amount', '>=', $amount);
    }

    public function whereMaxAmount($amount): self
    {
        return $this->where('amount', '<=', $amount);
    }

    public function wherePaymentLinkTypeIn(array $types): self
    {
        return $this->whereIn('payment_link_type', $types);
    }

    public function matchCustomerDetails(string $search): OrderQueryBuilder
    {
        return $this->whereRaw("MATCH(customer_name,customer_mobile,customer_email) AGAINST (? IN BOOLEAN MODE)", [
            "+$search*\""
        ]);
    }

    public function matchDescription($search): self
    {
        return $this->whereRaw("MATCH(description) AGAINST (? IN BOOLEAN MODE)", [
            "+$search*\""
        ]);
    }

}
