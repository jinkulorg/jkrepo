<?php

define('PROMOTE_ENABLED',true);
define('PROMOTE_PAYMENT_ENABLED',true);
define('AFFILIATE_ENABLED',false);
define('VALID_CASTES'," Panchal,Luhar,Lohar,Suthar,Mistry,Gajjar,Vishwakarma"); // Space before Panchal is must. So do not remove space.

// define('CALLBACK_URL_P',"http://localhost:8000/paymentresponse");
define('CALLBACK_URL_P',"https://panchalconnect.com/paymentresponse");

// define('CALLBACK_URL_FP',"http://localhost:8000/FPpaymentresponse");
define('CALLBACK_URL_FP',"https://panchalconnect.com/FPpaymentresponse");

define('AMOUNT',351);

define('OFFER_FREE',"FREE");

define('OFFER_AMOUNT',99); // Make it null to remove offer and when enabled do not forget to change the offer end date.
define('OFFER_END_DATE',"15th April 2020");

/**
 * Promotion plan Amount
 */
define('PLAN1_AMOUNT',500);
define('PLAN2_AMOUNT',1000);
define('PLAN3_AMOUNT',1500);

define('MAX_REQUEST_SENT',1);

/**
 * Boys
 */
define('MAX_FREE_PROFILE_FOR_BOYS',50);


/**
 * Girls
 */
define('MAX_FREE_PROFILE_FOR_GIRLS',50);



?>
