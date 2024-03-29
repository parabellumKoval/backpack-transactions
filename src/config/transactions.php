<?php

return [
  'enable_bonus_system' => true,
  'enable_referral_system' => true,
  'referral_levels' => 3,
  'referral_bonuses' => [10, 5, 2], // bonus % for each level. Last value affects all levels after it
  'enable_cashback' => true,
  'cashback_value' => 1, // cashback %

  'currency' => 'USD',

  'per_page' => 12,

  'auth_guard' => 'profile',

  'owner_model' => 'Backpack\Profile\app\Models\Profile',
  
  'transactionable_model' => 'Backpack\Store\app\Models\Product',
];
