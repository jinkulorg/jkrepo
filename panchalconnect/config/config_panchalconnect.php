<?php

define('PROMOTE_ENABLED',false);
define('AFFILIATE_ENABLED',false);

define('CALLBACK_URL_P',"http://localhost:8000/paymentresponse");
// define('CALLBACK_URL_P',"http://panchalconnect.com/paymentresponse");

define('CALLBACK_URL_FP',"http://localhost:8000/FPpaymentresponse");
// define('CALLBACK_URL_FP',"http://panchalconnect.com/FPpaymentresponse");

define('AMOUNT',351);

define('OFFER_FREE',"FREE");

define('OFFER_AMOUNT',99); // Make it null to remove offer and when enabled do not forget to change the offer end date.
define('OFFER_END_DATE',"31st March 2020");

/**
 * Promotion plan Amount
 */
define('PLAN1_AMOUNT',500);
define('PLAN2_AMOUNT',1000);
define('PLAN3_AMOUNT',2000);

?>
