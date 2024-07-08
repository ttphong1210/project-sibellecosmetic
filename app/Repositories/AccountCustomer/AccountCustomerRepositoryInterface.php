<?php

namespace App\Repositories\AccountCustomer;

interface AccountCustomerRepositoryInterface {
    public function getLoginCustomer();
    public function getRegisterCustomer();
    public function postRegisterCustomer(array $data);
}