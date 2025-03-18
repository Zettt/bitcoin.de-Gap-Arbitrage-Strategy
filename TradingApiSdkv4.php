<?php

namespace BitcoinDe\TradingApi\Sdk\v4;
/**
 * Class TradingApiSdkV4
 * Date: 2019-09-30
 *
 * @package BitcoinDe\TradingApi\Sdk\v4
 */
class TradingApiSdkV4
{
    public const HTTP_METHOD_GET    = 'GET';
    public const HTTP_METHOD_POST   = 'POST';
    public const HTTP_METHOD_DELETE = 'DELETE';

    // Current api version
    public const API_VERSION = '4';

    // Request
    public const ERROR_CODE_MISSING_HEADER                    = 1;
    public const ERROR_CODE_INACTIVE_API_KEY                  = 2;
    public const ERROR_CODE_INVALID_API_KEY                   = 3;
    public const ERROR_CODE_INVALID_NONCE                     = 4;
    public const ERROR_CODE_INVALID_SIGNATURE                 = 5;
    public const ERROR_CODE_INSUFFICIENT_CREDITS              = 6;
    public const ERROR_CODE_INVALID_ROUTE                     = 7;
    public const ERROR_CODE_UNKOWN_API_ACTION                 = 8;
    public const ERROR_CODE_ADDITIONAL_AGREEMENT_NOT_ACCEPTED = 9;
    public const ERROR_CODE_API_KEY_BANNED                    = 32;
    public const ERROR_CODE_IP_BANNED                         = 33;
    public const ERROR_CODE_IP_ACCESS_RESTRICTED              = 94;

    public const ERROR_CODE_NO_2_FACTOR_AUTHENTICATION               = 10;
    public const ERROR_CODE_NO_BETA_GROUP_USER                       = 11;
    public const ERROR_CODE_TECHNICAL_REASON                         = 12;
    public const ERROR_CODE_TRADING_API_CURRENTLY_UNAVAILABLE        = 13;
    public const ERROR_CODE_NO_ACTION_PERMISSION_FOR_API_KEY         = 14;
    public const ERROR_CODE_MISSING_POST_PARAMETER                   = 15;
    public const ERROR_CODE_MISSING_GET_PARAMETER                    = 16;
    public const ERROR_CODE_INVALID_NUMBER                           = 17;
    public const ERROR_CODE_NUMBER_TOO_LOW                           = 18;
    public const ERROR_CODE_NUMBER_TOO_BIG                           = 19;
    public const ERROR_CODE_TOO_MANY_DECIMAL_PLACES                  = 20;
    public const ERROR_CODE_INVALID_BOOLEAN_VALUE                    = 21;
    public const ERROR_CODE_FORBIDDEN_PARAMETER_VALUE                = 22;
    public const ERROR_CODE_INVALID_MIN_AMOUNT                       = 23;
    public const ERROR_CODE_INVALID_DATETIME_FORMAT                  = 24;
    public const ERROR_CODE_DATE_LOWER_THAN_MIN_DATE                 = 25;
    public const ERROR_CODE_INVALID_VALUE                            = 26;
    public const ERROR_CODE_FORBIDDEN_VALUE_FOR_GET_PARAMETER        = 27;
    public const ERROR_CODE_FORBIDDEN_VALUE_FOR_POST_PARAMETER       = 28;
    public const ERROR_CODE_EXPRESS_TRADE_TEMPORARILY_NOT_AVAILABLE  = 29;
    public const ERROR_CODE_END_DATETIME_YOUNGER_THAN_START_DATETIME = 30;
    public const ERROR_CODE_PAGE_GREATER_THAN_LAST_PAGE              = 31;
    public const ERROR_CODE_INVALID_TRADING_PAIR                     = 34;
    public const ERROR_CODE_INVALID_CURRENCY                         = 35;
    public const ERROR_CODE_FORBIDDEN_VALUE_FOR_QUERY_PARAMETER      = 36;
    public const ERROR_CODE_TOO_MANY_CHARACTERS                      = 37;
    public const ERROR_CODE_NO_KYC_FULL                              = 44;
    public const ERROR_CODE_OPERATION_CURRENTLY_NOT_POSSIBLE         = 45;
    public const ERROR_CODE_HAS_TO_ACCEPT_ADDITIONAL_AGREEMENT       = 46;
    public const ERROR_CODE_NOT_PART_OF_BETA_GROUP_FOR_API_VERSION   = 47;
    public const ERROR_CODE_FUTURUM_NOT_POSSIBLE                     = 113;
    public const ERROR_CODE_FUTURUM_OUTSIDE_BUSINESS_HOURS           = 114;
    public const ERROR_CODE_TRADING_PAIR_IS_DELISTED                 = 116;
    public const ERROR_CODE_CURRENCY_IS_DELISTED                     = 117;

    // Order
    public const ERROR_CODE_ORDER_NOT_FOUND                                = 50;
    public const ERROR_CODE_ORDER_NOT_POSSIBLE                             = 51;
    public const ERROR_CODE_INVALID_ORDER_TYPE                             = 52;
    public const ERROR_CODE_PAYMENT_OPTION_NOT_ALLOWED_FOR_TYPE_BUY        = 53;
    public const ERROR_CODE_CANCELLATION_NOT_ALLOWED                       = 54;
    public const ERROR_CODE_TRADING_SUSPENDED                              = 55;
    public const ERROR_CODE_EXPRESS_TRADE_NOT_POSSIBLE                     = 56;
    public const ERROR_CODE_SEPA_TRADE_NOT_POSSIBLE                        = 106;
    public const ERROR_CODE_NO_BANK_ACCOUNT                                = 57;
    public const ERROR_CODE_ORDER_NOT_POSSIBLE_FOR_TRADING_PAIR            = 58;
    public const ERROR_CODE_ORDER_NOT_POSSIBLE_DUE_SUPPLEMENTARY_AGREEMENT = 59;
    public const ERROR_CODE_SEPA_INSTANT_NOT_ALLOWED_FOR_TYPE_BUY          = 107;
    public const ERROR_CODE_SEPA_INSTANT_NOT_ALLOWED_FOR_PAYMENT_OPTION    = 108;
    public const ERROR_CODE_SEPA_INSTANT_ORDER_NOT_POSSIBLE                = 109;

    // Trade
    public const ERROR_CODE_NO_ACTIVE_RESERVATION                                  = 70;
    public const ERROR_CODE_EXPRESS_TRADE_NOT_ALLOWED                              = 71;
    public const ERROR_CODE_EXPRESS_TRADE_FAILURE_TEMPORARY                        = 72;
    public const ERROR_CODE_EXPRESS_TRADE_FAILURE                                  = 73;
    public const ERROR_CODE_INVALID_TRADE_STATE                                    = 74;
    public const ERROR_CODE_TRADE_NOT_FOUND                                        = 75;
    public const ERROR_CODE_RESERVATION_AMOUNT_INSUFFICIENT                        = 76;
    public const ERROR_CODE_VOLUME_CURRENCY_TO_PAY_AFTER_FEE_DEVIATES              = 77;
    public const ERROR_CODE_ALREADY_MARKED_AS_PAID                                 = 78;
    public const ERROR_CODE_PAYMENT_ALREADY_MARKED_AS_RECEIVED                     = 79;
    public const ERROR_CODE_TRADE_ALREADY_RATED                                    = 100;
    public const ERROR_CODE_TRADE_NOT_POSSIBLE_FOR_TRADING_PAIR                    = 101;
    public const ERROR_CODE_ALREADY_MARKED_AS_TRANSFERRED                          = 103;
    public const ERROR_CODE_COINS_ALREADY_MARKED_AS_RECEIVED                       = 104;
    public const ERROR_CODE_SEPA_INSTANT_TRADE_NOT_POSSIBLE                        = 110;
    public const ERROR_CODE_CONFIRMATION_OF_PAYMENT_RECEIPT_CURRENTLY_NOT_POSSIBLE = 115;

    // Withdrawal
    public const ERROR_CODE_WITHDRAWAL_NOT_FOUND                    = 80;
    public const ERROR_CODE_WITHDRAWAL_CANCELLATION_NOT_ALLOWED     = 81;
    public const ERROR_CODE_WITHDRAWAL_CONDITIONS_HAVE_NOT_ACCEPTED = 82;
    public const ERROR_CODE_WITHDRAWALS_DISABLED                    = 83;
    public const ERROR_CODE_WITHDRAWALS_INVALID_RECIPIENT_PURPOSE   = 111;
    public const ERROR_CODE_WITHDRAWAL_TAPI_NOT_POSSIBLE            = 120;
    public const ERROR_CODE_WITHDRAWAL_MISSING_INFORMATION          = 130;

    public const ERROR_CODE_WITHDRAWAL_RECIPIENT_ADDRESS_NOT_WHITELISTED = 118;

    // Deposit
    public const ERROR_CODE_REQUESTING_DEPOSIT_ADDRESS_CURRENTY_NOT_POSSIBLE          = 90;
    public const ERROR_CODE_DEPOSIT_NOT_FOUND                                         = 91;
    public const ERROR_CODE_INVALID_ADDRESS                                           = 92;
    public const ERROR_CODE_COMMENTS_ONLY_ALLOWED_FOR_NEWLY_CREATED_DEPOSIT_ADDRESSES = 93;
    public const ERROR_CODE_WATCHING_DEPOSITS_CURRENTLY_NOT_POSSIBLE                  = 112;

    // Crypto (Marketplace Wallet) - to - Crypto (External Customer Wallet)
    public const ERROR_CODE_NO_ADDRESS_AVAILABLE                        = 95;
    public const ERROR_CODE_ADDRESS_NOT_VALID                           = 96;
    public const ERROR_CODE_ADDRESS_CAN_NOT_BE_USED                     = 97;
    public const ERROR_CODE_ADDRESS_IS_USED_IN_ANOTHER_TRADE            = 98;
    public const ERROR_CODE_ADDRESS_NOT_FOUND                           = 99;
    public const ERROR_CODE_NO_ADDRESS_FOR_REMAINING_ORDER_AVAILABLE    = 102;
    public const ERROR_CODE_AMOUNT_CURRENCY_TO_TRADE_AFTER_FEE_DEVIATES = 105;


    public const METHOD_SHOW_ORDERBOOK                  = 'showOrderbook';
    public const METHOD_SHOW_ORDER_DETAILS              = 'showOrderDetails';
    public const METHOD_CREATE_ORDER                    = 'createOrder';
    public const METHOD_DELETE_ORDER                    = 'deleteOrder';
    public const METHOD_SHOW_MY_ORDERS                  = 'showMyOrders';
    public const METHOD_SHOW_MY_ORDER_DETAILS           = 'showMyOrderDetails';
    public const METHOD_EXECUTE_TRADE                   = 'executeTrade';
    public const METHOD_SHOW_MY_TRADES                  = 'showMyTrades';
    public const METHOD_SHOW_MY_TRADE_DETAILS           = 'showMyTradeDetails';
    public const METHOD_SHOW_ACCOUNT_INFO               = 'showAccountInfo';
    public const METHOD_SHOW_ACCOUNT_LEDGER             = 'showAccountLedger';
    public const METHOD_CREATE_WITHDRAWAL               = 'createWithdrawal';
    public const METHOD_DELETE_WITHDRAWAL               = 'deleteWithdrawal';
    public const METHOD_SHOW_WITHDRAWAL                 = 'showWithdrawal';
    public const METHOD_SHOW_WITHDRAWALS                = 'showWithdrawals';
    public const METHOD_SHOW_WITHDRAWAL_MIN_NETWORK_FEE = 'showWithdrawalMinNetworkFee';
    public const METHOD_REQUEST_DEPOSIT_ADDRESS         = 'requestDepositAddress';
    public const METHOD_SHOW_DEPOSIT                    = 'showDeposit';
    public const METHOD_SHOW_DEPOSITS                   = 'showDeposits';
    public const METHOD_MARK_TRADE_AS_PAID              = 'markTradeAsPaid';
    public const METHOD_MARK_TRADE_AS_PAYMENT_RECEIVED  = 'markTradeAsPaymentReceived';
    public const METHOD_ADD_TRADE_RATING                = 'addTradeRating';
    public const METHOD_ADD_TO_ADDRESS_POOL             = 'addToAddressPool';
    public const METHOD_REMOVE_FROM_ADDRESS_POOL        = 'removeFromAddressPool';
    public const METHOD_LIST_ADDRESS_POOL               = 'listAddressPool';
    public const METHOD_MARK_COINS_AS_TRANSFERRED       = 'markCoinsAsTransferred';
    public const METHOD_MARK_COINS_AS_RECEIVED          = 'markCoinsAsReceived';
    public const METHOD_SHOW_PERMISSIONS                = 'showPermissions';

    public const METHOD_CREATE_OUTGOING_ADDRESS = 'createOutgoingAddress';
    public const METHOD_DELETE_OUTGOING_ADDRESS = 'deleteOutgoingAddress';
    public const METHOD_SHOW_OUTGOING_ADDRESSES = 'showOutgoingAddresses';



    // LEGACY API-METHODS
    public const METHOD_SHOW_PUBLIC_TRADE_HISTORY = 'showPublicTradeHistory';
    public const METHOD_SHOW_ORDERBOOK_COMPACT    = 'showOrderbookCompact';
    public const METHOD_SHOW_RATES                = 'showRates';

    public const HEADER_X_NONCE         = 'X-API-NONCE';
    public const HEADER_X_API_KEY       = 'X-API-KEY';
    public const HEADER_X_API_SIGNATURE = 'X-API-SIGNATURE';

    public const ORDER_TYPE_BUY  = 'buy';
    public const ORDER_TYPE_SELL = 'sell';

    // Mandatory parameters for searching the orderbook
    public const SHOW_ORDERBOOK_PARAMETER_TYPE         = 'type'; // string (buy|sell)
    public const SHOW_ORDERBOOK_PARAMETER_PRICE        = 'price'; // float
    public const SHOW_ORDERBOOK_PARAMETER_TRADING_PAIR = 'trading_pair'; // string

    // Optional parameters for searching the orderbook
    public const SHOW_ORDERBOOK_PARAMETER_AMOUNT_CURRENCY_TO_TRADE      = 'amount_currency_to_trade'; // float
    public const SHOW_ORDERBOOK_PARAMETER_ORDER_REQUIREMENTS_FULLFILLED = 'order_requirements_fullfilled'; // boolean (default: false)
    public const SHOW_ORDERBOOK_PARAMETER_ONLY_KYC_FULL                 = 'only_kyc_full'; // boolean (default: false)
    public const SHOW_ORDERBOOK_PARAMETER_ONLY_EXPRESS_ORDERS           = 'only_express_orders'; // boolean (default: false)
    public const SHOW_ORDERBOOK_PARAMETER_PAYMENT_OPTION                = 'payment_option'; // integer (1|2|3)
    public const SHOW_ORDERBOOK_PARAMETER_ONLY_SAME_BANKGROUP           = 'only_same_bankgroup'; // boolean (default: false)
    public const SHOW_ORDERBOOK_PARAMETER_ONLY_SAME_BIC                 = 'only_same_bic'; // boolean (default: false)
    public const SHOW_ORDERBOOK_PARAMETER_SEAT_OF_BANK                  = 'seat_of_bank'; // array (default: all possible countries)
    public const SHOW_ORDERBOOK_PARAMETER_SEPA_OPTION                   = 'sepa_option'; // integer (0|1)
    public const SHOW_ORDERBOOK_PARAMETER_PAGE_SIZE                     = 'page_size'; // string (small|medium|large)
    public const SHOW_ORDERBOOK_PARAMETER_SHOW_FUTURUM_ORDERS           = 'show_futurum_orders'; //  boolean (default: false)

    // Mandatory parameters for show order details
    public const SHOW_ORDER_DETAILS_PARAMETER_ORDER_ID     = 'order_id'; // string
    public const SHOW_ORDER_DETAILS_PARAMETER_TRADING_PAIR = 'trading_pair'; // string

    // Mandatory parameters for create new order
    public const CREATE_ORDER_PARAMETER_TYPE                         = 'type'; // string (buy|sell)
    public const CREATE_ORDER_PARAMETER_TRADING_PAIR                 = 'trading_pair'; // string
    public const CREATE_ORDER_PARAMETER_MAX_AMOUNT_CURRENCY_TO_TRADE = 'max_amount_currency_to_trade'; // float
    public const CREATE_ORDER_PARAMETER_PRICE                        = 'price'; // float

    // Optional parameters for create new order
    public const CREATE_ORDER_PARAMETER_MIN_AMOUNT_CURRENCY_TO_TRADE   = 'min_amount_currency_to_trade'; // float (default: max_amount/2)
    public const CREATE_ORDER_PARAMETER_END_DATETIME                   = 'end_datetime'; // string (format: RFC 3339, default: current date + 5 days)
    public const CREATE_ORDER_PARAMETER_NEW_ORDER_FOR_REMAINING_AMOUNT = 'new_order_for_remaining_amount'; // boolean ( default: false)
    public const CREATE_ORDER_PARAMETER_MIN_TRUST_LEVEL                = 'min_trust_level'; // string (bronze|silver|gold, default: default setting user account)
    public const CREATE_ORDER_PARAMETER_ONLY_KYC_FULL                  = 'only_kyc_full'; // boolean (default: false)
    public const CREATE_ORDER_PARAMETER_PAYMENT_OPTION                 = 'payment_option'; // integer (1|2|3)
    public const CREATE_ORDER_PARAMETER_SEPA_OPTION                    = 'sepa_option'; // integer (0|1)
    public const CREATE_ORDER_PARAMETER_SEAT_OF_BANK                   = 'seat_of_bank'; // array (default: all possible countries)
    public const CREATE_ORDER_PARAMETER_IS_FUTURUM_ORDER               = 'is_futurum_order'; // boolean (default: false)

    // Optional parameters for create new order Crypto/CryptoWalletless CREATE_ORDER_PARAMETER_SEAT_OF_BANK
    public const CREATE_ORDER_PARAMETER_ADDRESS = 'address'; // array (default: all possible countries)

    // Mandatory parameters for delete order
    public const DELETE_ORDER_PARAMETER_ORDER_ID     = 'order_id'; // string
    public const DELETE_ORDER_PARAMETER_TRADING_PAIR = 'trading_pair'; // string

    // Optional parameters for my orders list
    public const SHOW_MY_ORDERS_PARAMETER_TYPE                = 'type'; // string (buy|sell)
    public const SHOW_MY_ORDERS_PARAMETER_TRADING_PAIR        = 'trading_pair'; // string
    public const SHOW_MY_ORDERS_PARAMETER_STATE               = 'state'; // integer (-2, -1, 0 | default: 0)
    public const SHOW_MY_ORDERS_PARAMETER_DATE_START          = 'date_start'; // string
    public const SHOW_MY_ORDERS_PARAMETER_DATE_END            = 'date_end'; // string
    public const SHOW_MY_ORDERS_PARAMETER_PAGE                = 'page'; // string
    public const SHOW_MY_ORDERS_PARAMETER_SINCE_ORDER_ID      = 'since_order_id'; // string
    public const SHOW_MY_ORDERS_PARAMETER_SHOW_FUTURUM_ORDERS = 'show_futurum_orders'; //  boolean (default: false)

    // Mandatory parameters for my order details
    public const SHOW_MY_ORDER_DETAILS_PARAMETER_ORDER_ID     = 'order_id'; // string
    public const SHOW_MY_ORDER_DETAILS_PARAMETER_TRADING_PAIR = 'trading_pair'; // string

    // Mandatory parameters for execute trade
    public const EXECUTE_TRADE_PARAMETER_TYPE                     = 'type'; // string (buy|sell)
    public const EXECUTE_TRADE_PARAMETER_ORDER_ID                 = 'order_id'; // string
    public const EXECUTE_TRADE_PARAMETER_AMOUNT_CURRENCY_TO_TRADE = 'amount_currency_to_trade'; // string
    public const EXECUTE_TRADE_PARAMETER_TRADING_PAIR             = 'trading_pair'; // string

    // Optional parameters for execute trade
    public const EXECUTE_TRADE_PARAMETER_PAYMENT_OPTION = 'payment_option'; // integer(1,2)
    public const EXECUTE_TRADE_PARAMETER_ADDRESS        = 'address'; // string

    // Optional parameters for my trade list
    public const SHOW_MY_TRADES_PARAMETER_TYPE                                                     = 'type'; // string (buy|sell)
    public const SHOW_MY_TRADES_PARAMETER_TRADING_PAIR                                             = 'trading_pair'; // string
    public const SHOW_MY_TRADES_PARAMETER_STATE                                                    = 'state'; // integer (-2, -1, 0 | default: 0)
    public const SHOW_MY_TRADES_PARAMETER_PAYMENT_METHOD                                           = 'payment_method'; // integer (1, 2)
    public const SHOW_MY_TRADES_PARAMETER_DATE_START                                               = 'date_start'; // string
    public const SHOW_MY_TRADES_PARAMETER_DATE_END                                                 = 'date_end'; // string
    public const SHOW_MY_TRADES_PARAMETER_PAGE                                                     = 'page'; // string
    public const SHOW_MY_TRADES_PARAMETER_SINCE_TRADE_ID                                           = 'since_trade_id'; // string
    public const SHOW_MY_TRADES_PARAMETER_ONLY_TRADES_WITH_ACTION_FOR_PAYMENT_OR_TRANSFER_REQUIRED = 'only_trades_with_action_for_payment_or_transfer_required'; // string

    // Mandatory parameters for my trade details
    public const SHOW_MY_TRADE_DETAILS_PARAMETER_TRADE_ID     = 'trade_id'; // string
    public const SHOW_MY_TRADE_DETAILS_PARAMETER_TRADING_PAIR = 'trading_pair'; // string

    // Mandatory parameters for mark trade as paid
    public const MARK_TRADE_AS_PAID_PARAMETER_TRADE_ID                         = 'trade_id'; // string
    public const MARK_TRADE_AS_PAID_PARAMETER_VOLUME_CURRENCY_TO_PAY_AFTER_FEE = 'volume_currency_to_pay_after_fee'; // string
    public const MARK_TRADE_AS_PAID_PARAMETER_TRADING_PAIR                     = 'trading_pair'; // string

    // Mandatory parameters for mark trade as payment received
    public const MARK_TRADE_AS_PAYMENT_RECEIVED_PARAMETER_TRADE_ID                          = 'trade_id'; // string
    public const MARK_TRADE_AS_PAYMENT_RECEIVED_PARAMETER_VOLUME_CURRENCY_TO_PAY_AFTER_FEE  = 'volume_currency_to_pay_after_fee'; // string
    public const MARK_TRADE_AS_PAYMENT_RECEIVED_PARAMETER_TRADING_PAIR                      = 'trading_pair'; // string
    public const MARK_TRADE_AS_PAYMENT_RECEIVED_PARAMETER_IS_PAID_FROM_CORRECT_BANK_ACCOUNT = 'is_paid_from_correct_bank_account'; // boolean
    public const MARK_TRADE_AS_PAYMENT_RECEIVED_PARAMETER_RATING                            = 'rating'; // string

    // Mandatory parameters for add trade rating
    public const ADD_TRADE_RATING_PARAMETER_TRADE_ID     = 'trade_id'; // string
    public const ADD_TRADE_RATING_PARAMETER_TRADING_PAIR = 'trading_pair'; // string
    public const ADD_TRADE_RATING_PARAMETER_RATING       = 'rating'; // string (positive|neutral|negative)

    // Optional parameters for public trade history
    public const SHOW_PUBLIC_TRADE_HISTORY_PARAMETER_SINCE_TID    = 'since_tid'; // integer
    public const SHOW_PUBLIC_TRADE_HISTORY_PARAMETER_TRADING_PAIR = 'trading_pair'; // string

    // Optional parameters for show account statement
    public const SHOW_ACCOUNT_LEDGER_PARAMETER_TYPE           = 'type'; // string
    public const SHOW_ACCOUNT_LEDGER_PARAMETER_DATETIME_START = 'datetime_start'; // string
    public const SHOW_ACCOUNT_LEDGER_PARAMETER_DATETIME_END   = 'datetime_end'; // string
    public const SHOW_ACCOUNT_LEDGER_PARAMETER_PAGE           = 'page'; // string
    public const SHOW_ACCOUNT_LEDGER_PARAMETER_CURRENCY       = 'currency'; // string

    // Mandatory parameters for show orderbook compact.
    public const SHOW_ORDER_BOOK_COMPACT_PARAMETER_TRADING_PAIR = 'trading_pair'; // string

    // Mandatory parameters for show rates.
    public const SHOW_RATES_PARAMETER_TRADING_PAIR = 'trading_pair'; // string

    // Mandatory parameters for create new withdrawal
    public const CREATE_WITHDRAWAL_PARAMETER_ADDRESS     = 'address'; // string
    public const CREATE_WITHDRAWAL_PARAMETER_AMOUNT      = 'amount'; // float
    public const CREATE_WITHDRAWAL_PARAMETER_NETWORK_FEE = 'network_fee'; // float
    public const CREATE_WITHDRAWAL_PARAMETER_CURRENCY    = 'currency'; // string

    // Optional parameters for create new withdrawal
    public const CREATE_WITHDRAWAL_PARAMETER_COMMENT = 'comment'; // string
    public const CREATE_WITHDRAWAL_PARAMETER_RECIPIENT_PURPOSE = 'recipient_purpose'; // string

    // Mandatory parameters for delete withdrawal
    public const DELETE_WITHDRAWAL_PARAMETER_WITHDRAWAL_ID = 'withdrawal_id'; // integer
    public const DELETE_WITHDRAWAL_PARAMETER_CURRENCY      = 'currency'; // string

    // Mandatory parameters for show withdrawal
    public const SHOW_WITHDRAWAL_PARAMETER_WITHDRAWAL_ID = 'withdrawal_id'; // integer
    public const SHOW_WITHDRAWAL_PARAMETER_CURRENCY      = 'currency'; // string

    // Mandatory parameters for show withdrawals
    public const SHOW_WITHDRAWALS_PARAMETER_CURRENCY = 'currency'; // string

    // Optional parameters for show withdrawals
    public const SHOW_WITHDRAWALS_PARAMETER_PAGE    = 'page'; // integer
    public const SHOW_WITHDRAWALS_PARAMETER_ADDRESS = 'address'; // integer

    // Mandatory parameters for show withdrawal min network fee
    public const SHOW_WITHDRAWAL_PARAMETER_MIN_NETWORK_FEE_CURRENCY = 'currency'; // string

    // Mandatory parameters for create new outgoing_address
    public const CREATE_OUTGOING_ADDRESS_PARAMETER_RECIPIENT_ADDRESS = 'recipient_address'; // string
    public const CREATE_OUTGOING_ADDRESS_PARAMETER_CURRENCY          = 'currency';          // string

    // Optional parameters for create new withdrawal
    public const CREATE_OUTGOING_ADDRESS_PARAMETER_RECIPIENT_PURPOSE = 'recipient_purpose'; // string
    public const CREATE_OUTGOING_ADDRESS_PARAMETER_COMMENT           = 'comment';           // string
    // Mandatory parameters for delete outgoing address
    public const DELETE_OUTGOING_ADDRESS_PARAMETER_ADDRESS_ID = 'address_id'; // integer
    public const DELETE_OUTGOING_ADDRESS_PARAMETER_CURRENCY   = 'currency';   // string

    // Mandatory parameters for show outgoing address
    public const SHOW_OUTGOING_ADDRESS_PARAMETER_CURRENCY = 'currency';     // string

    // Optional parameters for show outgoing address
    public const SHOW_OUTGOING_ADDRESS_PARAMETER_PAGE     = 'page';     // string


    // Mandatory parameters for request deposit address
    public const REQUEST_DEPOSIT_ADDRESS_PARAMETER_CURRENCY = 'currency'; // string
    public const REQUEST_DEPOSIT_ADDRESS_PARAMETER_COMMENT  = 'comment'; // string

    // Mandatory parameters for show deposit
    public const SHOW_DEPOSIT_PARAMETER_CURRENCY   = 'currency'; // string
    public const SHOW_DEPOSIT_PARAMETER_DEPOSIT_ID = 'deposit_id'; // integer

    // Mandatory parameters for show deposits
    public const SHOW_DEPOSITS_PARAMETER_CURRENCY = 'currency'; // string

    // Optional parameters for show deposits
    public const SHOW_DEPOSITS_PARAMETER_PAGE    = 'page'; // integer
    public const SHOW_DEPOSITS_PARAMETER_ADDRESS = 'address'; // integer

    // Mandatory parameters for add to address pool
    public const ADD_TO_ADDRESS_POOL_PARAMETER_CURRENCY      = 'currency'; // string
    public const ADD_TO_ADDRESS_POOL_PARAMETER_ADDRESS       = 'address'; // string
    public const ADD_TO_ADDRESS_POOL_PARAMETER_AMOUNT_USAGES = 'amount_usages'; // integer

    // Optional parameters for add to address pool
    public const ADD_TO_ADDRESS_POOL_PARAMETER_COMMENT = 'comment'; // string

    // Mandatory parameters for remove from address pool
    public const REMOVE_FROM_ADDRESS_POOL_PARAMETER_CURRENCY = 'currency'; // string
    public const REMOVE_FROM_ADDRESS_POOL_PARAMETER_ADDRESS  = 'address'; // string

    // Mandatory parameters for list address pool
    public const LIST_ADDRESS_POOL_PARAMETER_CURRENCY = 'currency'; // string

    // Optional parameters for list address pool
    public const LIST_ADDRESS_POOL_PARAMETER_USABLE  = 'usable'; // integer (0, 1, 2 | default: 0)
    public const LIST_ADDRESS_POOL_PARAMETER_COMMENT = 'comment'; // string
    public const LIST_ADDRESS_POOL_PARAMETER_PAGE    = 'page'; // integer (default: 1)

    // Mandatory parameters for mark coins as transferred
    public const MARK_COINS_AS_TRANSFERRED_PARAMETER_TRADE_ID                           = 'trade_id'; // string
    public const MARK_COINS_AS_TRANSFERRED_PARAMETER_AMOUNT_CURRENCY_TO_TRADE_AFTER_FEE = 'amount_currency_to_trade_after_fee'; // string
    public const MARK_COINS_AS_TRANSFERRED_PARAMETER_TRADING_PAIR                       = 'trading_pair'; // string

    // Mandatory parameters for mark coins as received
    public const MARK_COINS_AS_RECEIVED_PARAMETER_TRADE_ID                           = 'trade_id'; // string
    public const MARK_COINS_AS_RECEIVED_PARAMETER_AMOUNT_CURRENCY_TO_TRADE_AFTER_FEE = 'amount_currency_to_trade_after_fee'; // string
    public const MARK_COINS_AS_RECEIVED_PARAMETER_TRADING_PAIR                       = 'trading_pair'; // string
    public const MARK_COINS_AS_RECEIVED_PARAMETER_RATING                             = 'rating'; // string


    public const ORDER_STATE_EXPIRED   = -2;
    public const ORDER_STATE_CANCELLED = -1;
    public const ORDER_STATE_PENDING   = 0;

    public const TRADE_STATE_CANCELLED  = -1;
    public const TRADE_STATE_PENDING    = 0;
    public const TRADE_STATE_SUCCESSFUL = 1;

    public const TRADE_PAYMENT_METHOD_SEPA         = 1;
    public const TRADE_PAYMENT_METHOD_EXPRESS      = 2;
    public const TRADE_PAYMENT_METHOD_SEPA_INSTANT = 3;

    public const ORDER_PAYMENT_OPTION_ONLY_EXPRESS   = 1;
    public const ORDER_PAYMENT_OPION_ONLY_SEPA       = 2;
    public const ORDER_PAYMENT_OPION_EXPRESS_OR_SEPA = 3;

    public const ORDER_SEPA_OPTION_NONE         = 0;
    public const ORDER_SEPA_OPTION_SEPA_INSTANT = 1;

    public const SHOW_ORDERBOOK_PARAMETER_PAYMENT_OPTION_ONLY_EXPRESS    = 1;
    public const SHOW_ORDERBOOK_PARAMETER_PAYMENT_OPTION_ONLY_SEPA       = 2;
    public const SHOW_ORDERBOOK_PARAMETER_PAYMENT_OPTION_EXPRESS_OR_SEPA = 3;

    public const SHOW_ORDERBOOK_PARAMETER_SEPA_OPTION_NONE         = 0;
    public const SHOW_ORDERBOOK_PARAMETER_SEPA_OPTION_SEPA_INSTANT = 1;

    public const SHOW_ORDERBOOK_PARAMETER_PAGE_SIZE_OPTION_SMALL  = 'small';
    public const SHOW_ORDERBOOK_PARAMETER_PAGE_SIZE_OPTION_MEDIUM = 'medium';
    public const SHOW_ORDERBOOK_PARAMETER_PAGE_SIZE_OPTION_LARGE  = 'large';

    public const TRADE_PAYMENT_OPTION_EXPRESS_BUY_OR_SELL = 1;
    public const TRADE_PAYMENT_OPTION_SEPA_BUY            = 2;
    public const TRADE_PAYMENT_OPTION_SEPA_INSTANT_BUY    = 3;

    public const MIN_TRUST_LEVEL_BRONZE = 'bronze';
    public const MIN_TRUST_LEVEL_SILVER = 'silver';
    public const MIN_TRUST_LEVEL_GOLD   = 'gold';
    public const MIN_TRUST_LEVEL_PLATIN = 'platin';

    public const RATING_PENDING  = 'pending';
    public const RATING_NEGATIVE = 'negative';
    public const RATING_NEUTRAL  = 'neutral';
    public const RATING_POSITIVE = 'positive';

    public const WITHDRAWAL_STATE_CANCELLED   = -1;
    public const WITHDRAWAL_STATE_PENDING     = 0;
    public const WITHDRAWAL_STATE_TRANSFERRED = 1;

    public const DEPOSIT_STATE_UNCONFIRMED         = 0;
    public const DEPOSIT_STATE_PARTIALLY_CONFIRMED = 1;
    public const DEPOSIT_STATE_FULLY_CONFIRMED     = 2;
    public const DEPOSIT_STATE_INVALID             = -1;

    public const ACCOUNT_LEDGER_TYPE_ALL                    = 'all';
    public const ACCOUNT_LEDGER_TYPE_BUY                    = 'buy';
    public const ACCOUNT_LEDGER_TYPE_SELL                   = 'sell';
    public const ACCOUNT_LEDGER_TYPE_INPAYMENT              = 'inpayment';
    public const ACCOUNT_LEDGER_TYPE_PAYOUT                 = 'payout';
    public const ACCOUNT_LEDGER_TYPE_AFFILIATE              = 'affiliate';
    public const ACCOUNT_LEDGER_TYPE_BUY_YUBIKEY            = 'buy_yubikey';
    public const ACCOUNT_LEDGER_TYPE_BUY_GOLDSHOP           = 'buy_goldshop';
    public const ACCOUNT_LEDGER_TYPE_BUY_DIAMONDSHOP        = 'buy_diamondshop';
    public const ACCOUNT_LEDGER_TYPE_KICKBACK               = 'kickback';
    public const ACCOUNT_LEDGER_TYPE_OUTGOING_FEE_VOLUNTARY = 'outgoing_fee_voluntary';
    public const ACCOUNT_LEDGER_TYPE_BUY_C2CW               = 'buy_c2cw';
    public const ACCOUNT_LEDGER_TYPE_SELL_C2CW              = 'sell_c2cw';

    public const TRADING_PAIR_BTCEUR  = 'btceur';
    public const TRADING_PAIR_BCHEUR  = 'bcheur';
    public const TRADING_PAIR_BTGEUR  = 'btgeur';
    public const TRADING_PAIR_BSVEUR  = 'bsveur';
    public const TRADING_PAIR_ETHEUR  = 'etheur';
    public const TRADING_PAIR_LTCEUR  = 'ltceur';
    public const TRADING_PAIR_XRPEUR  = 'xrpeur';
    public const TRADING_PAIR_DOGEEUR = 'dogeeur';
    public const TRADING_PAIR_DASHBTC = 'dashbtc';
    public const TRADING_PAIR_GNTBTC  = 'gntbtc';
    public const TRADING_PAIR_LTCBTC  = 'ltcbtc';
    public const TRADING_PAIR_IOTABTC = 'iotabtc';
    public const TRADING_PAIR_ETHBTC  = 'ethbtc';
    public const TRADING_PAIR_XRPBTC  = 'xrpbtc';
    public const TRADING_PAIR_DOGEBTC = 'dogebtc';
    public const TRADING_PAIR_BSVBTC  = 'bsvbtc';

    public const CURRENCY_BTC  = 'btc';
    public const CURRENCY_BCH  = 'bch';
    public const CURRENCY_BTG  = 'btg';
    public const CURRENCY_BSV  = 'bsv';
    public const CURRENCY_ETH  = 'eth';
    public const CURRENCY_DASH = 'dash';
    public const CURRENCY_GNT  = 'gnt';
    public const CURRENCY_LTC  = 'ltc';
    public const CURRENCY_IOTA = 'iota';
    public const CURRENCY_XRP  = 'xrp';
    public const CURRENCY_DOGE = 'doge';

    public const ADDRESS_ALL        = 0;
    public const ADDRESS_USABLE     = 1;
    public const ADDRESS_NOT_USABLE = 2;

    public const TRADING_PAIR = 'trading_pair';
    public const CURRENCY     = 'currency';
    protected $curl_handle;

    protected static $method_settings = [
        self::METHOD_SHOW_ORDERBOOK     => [
            'http_method'      => self::HTTP_METHOD_GET,
            'entity'           => 'orderbook',
            self::TRADING_PAIR => self::SHOW_ORDERBOOK_PARAMETER_TRADING_PAIR,
            'parameters'       => [
                self::SHOW_ORDERBOOK_PARAMETER_TYPE
            ],
        ],
        self::METHOD_SHOW_ORDER_DETAILS => [
            'http_method'      => self::HTTP_METHOD_GET,
            'entity'           => 'orders/public/details',
            self::TRADING_PAIR => self::SHOW_ORDER_DETAILS_PARAMETER_TRADING_PAIR,
            'id'               => 'order_id',
            'parameters'       => [
                self::SHOW_ORDER_DETAILS_PARAMETER_ORDER_ID
            ],
        ],
        self::METHOD_CREATE_ORDER       => [
            'http_method'      => self::HTTP_METHOD_POST,
            'entity'           => 'orders',
            self::TRADING_PAIR => self::CREATE_ORDER_PARAMETER_TRADING_PAIR,
            'parameters'       => [
                self::CREATE_ORDER_PARAMETER_TYPE,
                self::CREATE_ORDER_PARAMETER_PRICE,
                self::CREATE_ORDER_PARAMETER_MAX_AMOUNT_CURRENCY_TO_TRADE,
            ],
        ],
        self::METHOD_DELETE_ORDER       => [
            'http_method'      => self::HTTP_METHOD_DELETE,
            'entity'           => 'orders',
            self::TRADING_PAIR => self::DELETE_ORDER_PARAMETER_TRADING_PAIR,
            'id'               => self::DELETE_ORDER_PARAMETER_ORDER_ID,
        ],
        self::METHOD_SHOW_MY_ORDERS     => [
            'http_method' => self::HTTP_METHOD_GET,
            'entity'      => 'orders',
            'parameters'  => [],
        ],

        self::METHOD_SHOW_MY_ORDER_DETAILS => [
            'http_method'      => self::HTTP_METHOD_GET,
            'entity'           => 'orders',
            self::TRADING_PAIR => self::SHOW_MY_ORDER_DETAILS_PARAMETER_TRADING_PAIR,
            'id'               => 'order_id',
        ],
        self::METHOD_EXECUTE_TRADE         => [
            'http_method'      => self::HTTP_METHOD_POST,
            'entity'           => 'trades',
            self::TRADING_PAIR => self::EXECUTE_TRADE_PARAMETER_TRADING_PAIR,
            'id'               => self::EXECUTE_TRADE_PARAMETER_ORDER_ID,
            'parameters'       => [
                self::EXECUTE_TRADE_PARAMETER_TYPE,
                self::EXECUTE_TRADE_PARAMETER_AMOUNT_CURRENCY_TO_TRADE,
            ],
        ],

        self::METHOD_SHOW_MY_TRADES                  => [
            'http_method' => self::HTTP_METHOD_GET,
            'entity'      => 'trades',
            'parameters'  => [],
        ],
        self::METHOD_SHOW_MY_TRADE_DETAILS           => [
            'http_method'      => self::HTTP_METHOD_GET,
            'entity'           => 'trades',
            self::TRADING_PAIR => self::SHOW_MY_TRADE_DETAILS_PARAMETER_TRADING_PAIR,
            'id'               => self::SHOW_MY_TRADE_DETAILS_PARAMETER_TRADE_ID
        ],
        self::METHOD_MARK_TRADE_AS_PAID              => [
            'http_method'      => self::HTTP_METHOD_POST,
            'entity'           => 'trades',
            'subentity'        => 'mark_trade_as_paid',
            self::TRADING_PAIR => self::MARK_TRADE_AS_PAID_PARAMETER_TRADING_PAIR,
            'id'               => self::MARK_TRADE_AS_PAID_PARAMETER_TRADE_ID,
            'parameters'       => [
                self::MARK_TRADE_AS_PAID_PARAMETER_VOLUME_CURRENCY_TO_PAY_AFTER_FEE
            ],
        ],
        self::METHOD_MARK_TRADE_AS_PAYMENT_RECEIVED  => [
            'http_method'      => self::HTTP_METHOD_POST,
            'entity'           => 'trades',
            'subentity'        => 'mark_trade_as_payment_received',
            self::TRADING_PAIR => self::MARK_TRADE_AS_PAYMENT_RECEIVED_PARAMETER_TRADING_PAIR,
            'id'               => self::MARK_TRADE_AS_PAYMENT_RECEIVED_PARAMETER_TRADE_ID,
            'parameters'       => [
                self::MARK_TRADE_AS_PAYMENT_RECEIVED_PARAMETER_VOLUME_CURRENCY_TO_PAY_AFTER_FEE,
                self::MARK_TRADE_AS_PAYMENT_RECEIVED_PARAMETER_RATING,
                self::MARK_TRADE_AS_PAYMENT_RECEIVED_PARAMETER_IS_PAID_FROM_CORRECT_BANK_ACCOUNT,
            ],
        ],
        self::METHOD_ADD_TRADE_RATING                => [
            'http_method'      => self::HTTP_METHOD_POST,
            'entity'           => 'trades',
            'subentity'        => 'add_trade_rating',
            self::TRADING_PAIR => self::ADD_TRADE_RATING_PARAMETER_TRADING_PAIR,
            'id'               => self::ADD_TRADE_RATING_PARAMETER_TRADE_ID,
            'parameters'       => [
                self::ADD_TRADE_RATING_PARAMETER_RATING,
            ],
        ],
        self::METHOD_SHOW_ACCOUNT_INFO               => [
            'http_method' => self::HTTP_METHOD_GET,
            'entity'      => 'account',
        ],
        self::METHOD_CREATE_WITHDRAWAL               => [
            'http_method'  => self::HTTP_METHOD_POST,
            'entity'       => 'withdrawals',
            self::CURRENCY => self::CREATE_WITHDRAWAL_PARAMETER_CURRENCY,
            'parameters'   => [
                self::CREATE_WITHDRAWAL_PARAMETER_ADDRESS,
                self::CREATE_WITHDRAWAL_PARAMETER_AMOUNT,
                self::CREATE_WITHDRAWAL_PARAMETER_NETWORK_FEE,
            ],
        ],
        self::METHOD_DELETE_WITHDRAWAL               => [
            'http_method'  => self::HTTP_METHOD_DELETE,
            'entity'       => 'withdrawals',
            self::CURRENCY => self::DELETE_WITHDRAWAL_PARAMETER_CURRENCY,
            'id'           => self::DELETE_WITHDRAWAL_PARAMETER_WITHDRAWAL_ID,
        ],
        self::METHOD_SHOW_WITHDRAWAL                 => [
            'http_method'  => self::HTTP_METHOD_GET,
            'entity'       => 'withdrawals',
            self::CURRENCY => self::SHOW_WITHDRAWAL_PARAMETER_CURRENCY,
            'id'           => self::SHOW_WITHDRAWAL_PARAMETER_WITHDRAWAL_ID,
        ],
        self::METHOD_SHOW_WITHDRAWALS                => [
            'http_method'  => self::HTTP_METHOD_GET,
            'entity'       => 'withdrawals',
            self::CURRENCY => self::SHOW_WITHDRAWALS_PARAMETER_CURRENCY,
        ],
        self::METHOD_SHOW_WITHDRAWAL_MIN_NETWORK_FEE => [
            'http_method'  => self::HTTP_METHOD_GET,
            'entity'       => 'withdrawals',
            'subentity'    => 'min_network_fee',
            self::CURRENCY => self::SHOW_WITHDRAWAL_PARAMETER_MIN_NETWORK_FEE_CURRENCY,
        ],
        self::METHOD_REQUEST_DEPOSIT_ADDRESS         => [
            'http_method'  => self::HTTP_METHOD_POST,
            'entity'       => 'deposits',
            'subentity'    => 'new_address',
            self::CURRENCY => self::REQUEST_DEPOSIT_ADDRESS_PARAMETER_CURRENCY,
        ],
        self::METHOD_SHOW_DEPOSIT                    => [
            'http_method'  => self::HTTP_METHOD_GET,
            'entity'       => 'deposits',
            self::CURRENCY => self::SHOW_DEPOSIT_PARAMETER_CURRENCY,
            'id'           => self::SHOW_DEPOSIT_PARAMETER_DEPOSIT_ID,
        ],
        self::METHOD_SHOW_DEPOSITS                   => [
            'http_method'  => self::HTTP_METHOD_GET,
            'entity'       => 'deposits',
            self::CURRENCY => self::SHOW_DEPOSITS_PARAMETER_CURRENCY,
        ],
        self::METHOD_CREATE_OUTGOING_ADDRESS => [
            'http_method'  => self::HTTP_METHOD_POST,
            'entity'       => 'outgoing_address',
            self::CURRENCY => self::CREATE_OUTGOING_ADDRESS_PARAMETER_CURRENCY,
            'parameters'   => [
                self::CREATE_OUTGOING_ADDRESS_PARAMETER_RECIPIENT_ADDRESS,
                self::CREATE_OUTGOING_ADDRESS_PARAMETER_RECIPIENT_PURPOSE,
                self::CREATE_OUTGOING_ADDRESS_PARAMETER_COMMENT
            ],
        ],
        self::METHOD_DELETE_OUTGOING_ADDRESS => [
            'http_method'  => self::HTTP_METHOD_DELETE,
            'entity'       => 'outgoing_address',
            self::CURRENCY => self::DELETE_OUTGOING_ADDRESS_PARAMETER_CURRENCY,
            'id'           => self::DELETE_OUTGOING_ADDRESS_PARAMETER_ADDRESS_ID,
        ],
        self::METHOD_SHOW_OUTGOING_ADDRESSES => [
            'http_method'  => self::HTTP_METHOD_GET,
            'entity'       => 'outgoing_address',
            self::CURRENCY => self::SHOW_OUTGOING_ADDRESS_PARAMETER_CURRENCY,
        ],

        // LEGACY API
        self::METHOD_SHOW_PUBLIC_TRADE_HISTORY       => [
            'http_method'      => self::HTTP_METHOD_GET,
            'entity'           => 'trades',
            'subentity'        => 'history',
            self::TRADING_PAIR => self::SHOW_PUBLIC_TRADE_HISTORY_PARAMETER_TRADING_PAIR,
        ],
        self::METHOD_SHOW_ORDERBOOK_COMPACT          => [
            'http_method'      => self::HTTP_METHOD_GET,
            'entity'           => 'orderbook',
            'subentity'        => 'compact',
            self::TRADING_PAIR => self::SHOW_ORDER_BOOK_COMPACT_PARAMETER_TRADING_PAIR,
        ],
        self::METHOD_SHOW_RATES                      => [
            'http_method'      => self::HTTP_METHOD_GET,
            'entity'           => 'rates',
            self::TRADING_PAIR => self::SHOW_RATES_PARAMETER_TRADING_PAIR,
        ],
        self::METHOD_SHOW_ACCOUNT_LEDGER             => [
            'http_method'  => self::HTTP_METHOD_GET,
            'entity'       => 'account',
            'subentity'    => 'ledger',
            self::CURRENCY => self::SHOW_ACCOUNT_LEDGER_PARAMETER_CURRENCY,
        ],
        self::METHOD_ADD_TO_ADDRESS_POOL             => [
            'http_method'  => self::HTTP_METHOD_POST,
            'entity'       => 'address',
            self::CURRENCY => self::ADD_TO_ADDRESS_POOL_PARAMETER_CURRENCY,
            'parameters'   => [
                self::ADD_TO_ADDRESS_POOL_PARAMETER_ADDRESS,
            ],
        ],
        self::METHOD_REMOVE_FROM_ADDRESS_POOL        => [
            'http_method'  => self::HTTP_METHOD_DELETE,
            'entity'       => 'address',
            self::CURRENCY => self::REMOVE_FROM_ADDRESS_POOL_PARAMETER_CURRENCY,
            'id'           => self::REMOVE_FROM_ADDRESS_POOL_PARAMETER_ADDRESS,
        ],
        self::METHOD_LIST_ADDRESS_POOL               => [
            'http_method'  => self::HTTP_METHOD_GET,
            'entity'       => 'address',
            self::CURRENCY => self::LIST_ADDRESS_POOL_PARAMETER_CURRENCY,
        ],
        self::METHOD_MARK_COINS_AS_TRANSFERRED       => [
            'http_method'      => self::HTTP_METHOD_POST,
            'entity'           => 'trades',
            'subentity'        => 'mark_coins_as_transferred',
            self::TRADING_PAIR => self::MARK_COINS_AS_TRANSFERRED_PARAMETER_TRADING_PAIR,
            'id'               => self::MARK_COINS_AS_TRANSFERRED_PARAMETER_TRADE_ID,
            'parameters'       => [
                self::MARK_COINS_AS_TRANSFERRED_PARAMETER_AMOUNT_CURRENCY_TO_TRADE_AFTER_FEE
            ],
        ],
        self::METHOD_MARK_COINS_AS_RECEIVED          => [
            'http_method'      => self::HTTP_METHOD_POST,
            'entity'           => 'trades',
            'subentity'        => 'mark_coins_as_received',
            self::TRADING_PAIR => self::MARK_COINS_AS_RECEIVED_PARAMETER_TRADING_PAIR,
            'id'               => self::MARK_COINS_AS_RECEIVED_PARAMETER_TRADE_ID,
            'parameters'       => [
                self::MARK_COINS_AS_RECEIVED_PARAMETER_AMOUNT_CURRENCY_TO_TRADE_AFTER_FEE,
                self::MARK_COINS_AS_RECEIVED_PARAMETER_RATING,
            ],
        ],
        self::METHOD_SHOW_PERMISSIONS                => [
            'http_method' => self::HTTP_METHOD_GET,
            'entity'      => 'permissions',
        ],
    ];

    protected $options = [
        'uri'             => 'https://api.bitcoin.de/',
        'verify_ssl_peer' => TRUE,
        'api_version'     => self::API_VERSION,
    ];

    /**
     * Constructor
     *
     * @access public
     *
     * @param string $api_key API-Key
     * @param string $secret  API-Secret
     * @param array  $options Options
     */
    public function __construct(
        protected string $api_key,
        protected string $secret,
        array $options = []
    )
    {
        $this->options     = array_replace($this->options, $options);
        $this->curl_handle = curl_init();

        curl_setopt_array($this->curl_handle, [
            CURLOPT_SSL_VERIFYPEER => $this->options['verify_ssl_peer'],
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_USERAGENT      => 'Bitcoin.de Trading-API',
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HEADER         => TRUE,
        ]);
    }

    /**
     * Destructor
     *
     * @access public
     */
    public function __destruct()
    {
        curl_close($this->curl_handle);
    }

    /**
     * Executes an api-request
     *
     * The returning array contains the following items:
     *  - successful (request has succeeded)
     *  - errors (an array of errors, which only contains errors, if "successful" is FALSE)
     *  - credits (remaining credits)
     *  - headers (array of response-headers)
     *  - status-code (http-status-code)
     *  - maintenance (just in case if any planned maintenance is coming up)
     * and any api-method specific response-data
     *
     * @access public
     *
     * @param string $api_method API-Method
     * @param array  $parameters GET-/POST-Parameters
     *
     * @return array
     *
     * @throws \Exception
     */
    public function doRequest(string $api_method, array $parameters = []): array
    {
        // Check if the method exists
        if (FALSE === isset(static::$method_settings[$api_method]))
        {
            throw new \Exception('API-Method >>' . $api_method . '<< doesn´t exists');
        }

        // Are all mandatory parameters given?
        if (TRUE === isset(static::$method_settings[$api_method]['parameters']))
        {
            foreach (static::$method_settings[$api_method]['parameters'] as $mandatory_parameter)
            {
                if (FALSE === isset($parameters[$mandatory_parameter]))
                {
                    throw new \Exception('Value for mandatory ' . static::$method_settings[$api_method]['http_method'] . '-parameter "' . $mandatory_parameter . '" is missing');
                }
            }
        }

        foreach (['id', static::TRADING_PAIR, static::CURRENCY] AS $index)
        {
            if (TRUE === isset(static::$method_settings[$api_method][$index])
                && FALSE === isset($parameters[static::$method_settings[$api_method][$index]]))
            {
                throw new \Exception('Value for mandatory GET-parameter "' . static::$method_settings[$api_method][$index] . '" is missing');
            }
        }

        // Prepare the nonce
        $nonce = explode(' ', microtime());
        $nonce = $nonce[1] . str_pad(substr($nonce[0], 2, 6), 6, '0');

        $id           = '';
        $trading_pair = '';
        $currency     = '';
        $subentity    = '';

        if (TRUE === isset(static::$method_settings[$api_method]['id'])
            && TRUE === isset($parameters[static::$method_settings[$api_method]['id']]))
        {
            $id = '/' . $parameters[static::$method_settings[$api_method]['id']];
            unset($parameters[static::$method_settings[$api_method]['id']]);
        }

        if (TRUE === isset($parameters[self::TRADING_PAIR]))
        {
            $trading_pair = '/' . $parameters[self::TRADING_PAIR];
            unset($parameters[self::TRADING_PAIR]);
        }

        if (TRUE === isset($parameters[self::CURRENCY])
            &&
            (
                TRUE === isset(static::$method_settings[$api_method][self::CURRENCY])
                ||
                (
                    TRUE === isset(static::$method_settings[$api_method]['parameters'])
                    &&
                    TRUE === in_array(self::CURRENCY, static::$method_settings[$api_method]['parameters'])
                )
            )
        )
        {
            $currency = '/' . $parameters[self::CURRENCY];
            unset($parameters[self::CURRENCY]);
        }

        if (TRUE === isset(static::$method_settings[$api_method]['subentity']))
        {
            $subentity = '/' . static::$method_settings[$api_method]['subentity'];
        }

        $post_parameters = (self::HTTP_METHOD_POST === static::$method_settings[$api_method]['http_method']) ? $parameters : [];
        $post_parameters = $this->ksort_recursive($post_parameters);

        $prepared_post_parameters      = ([] !== $post_parameters) ? (http_build_query($post_parameters, '', '&')) : '';
        $prepared_post_parameters_hash = md5($prepared_post_parameters);

        $get_parameters          = (self::HTTP_METHOD_GET === static::$method_settings[$api_method]['http_method']) ? $parameters : [];
        $prepared_get_parameters = ([] !== $get_parameters) ? ('?' . http_build_query($get_parameters, '', '&')) : '';

        $http_method                             = static::$method_settings[$api_method]['http_method'];
        $uri                                     = $this->options['uri'] . 'v' . $this->options['api_version'] . $trading_pair . $currency . '/' . static::$method_settings[$api_method]['entity'] . $id . $subentity . $prepared_get_parameters;
        $request_headers                         = [];
        $request_headers[self::HEADER_X_API_KEY] = $this->api_key;
        $request_headers[self::HEADER_X_NONCE]   = $nonce;

        $hmac_data = implode('#', [$http_method, $uri, $this->api_key, $nonce, $prepared_post_parameters_hash]);
        $s_hmac    = hash_hmac(
            'sha256',
            $hmac_data,
            $this->secret
        );

        $request_headers[self::HEADER_X_API_SIGNATURE] = $s_hmac;

        foreach ($request_headers as $s_name => &$m_value)
        {
            $m_value = $s_name . ': ' . $m_value;
        }

        curl_setopt($this->curl_handle, CURLOPT_URL, $uri);
        curl_setopt($this->curl_handle, CURLOPT_CUSTOMREQUEST, $http_method);
        curl_setopt($this->curl_handle, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($this->curl_handle, CURLOPT_FORBID_REUSE, TRUE);

        if ([] !== $post_parameters)
        {
            curl_setopt($this->curl_handle, CURLOPT_POSTFIELDS, $prepared_post_parameters);
        }

        $result = curl_exec($this->curl_handle);

        if (FALSE === $result)
        {
            throw new \Exception('CURL error: ' . curl_error($this->curl_handle));
        }

        $curl_info         = curl_getinfo($this->curl_handle);
        $curl_error        = curl_error($this->curl_handle);
        $curl_error_number = curl_errno($this->curl_handle);
        $http_code         = $curl_info['http_code'];
        $header_size       = $curl_info['header_size'];

        $response_headers = substr((string) $result, 0, $header_size);
        $body             = substr((string) $result, $header_size);

        $prepared_reponse_headers = self::parseHttpHeaders($response_headers);

        $result          = json_decode($body, TRUE);
        $json_last_error = json_last_error();

        if (JSON_ERROR_NONE !== $json_last_error)
        {
            throw new \Exception(json_last_error_msg() . "\n\n" . $body);
        }

        if (TRUE === is_array($result))
        {
            $result['successful']  = (200 === $http_code || 201 === $http_code);
            $result['headers']     = $prepared_reponse_headers;
            $result['status_code'] = $http_code;
        }

        return $result;
    }

    /**
     * Helper method for obtaining the response-headers
     *
     * @static
     * @access public
     *
     * @param string $header Headers in type of a string
     *
     * @return array
     */
    public static function parseHttpHeaders(string $header): array
    {
        $retVal = [];
        $fields = explode("\r\n", (string) preg_replace('/\x0D\x0A[\x09\x20]+/', ' ', $header));

        foreach ($fields as $field)
        {
            if (preg_match('/([^:]+): (.+)/m', $field, $match))
            {
                $match[1] = preg_replace_callback(
                    '/(?<=^|[\x09\x20\x2D])./',
                    fn(array $matches) => strtoupper((string) $matches[0]),
                    strtolower(trim((string) $match[1]))
                );

                if (isset($retVal[$match[1]]))
                {
                    if (FALSE === is_array($retVal[$match[1]]))
                    {
                        $retVal[$match[1]] = [$retVal[$match[1]]];
                    }
                    $retVal[$match[1]][] = $match[2];
                }
                else
                {
                    $retVal[$match[1]] = trim((string) $match[2]);
                }
            }
        }

        return $retVal;
    }

    /**
     * Recursively sorts an array by it´s keys
     *
     * @param array $values Array to sort
     *
     * @return array
     */
    public function ksort_recursive(array $values = []): array
    {
        foreach ($values as $index => $value)
        {
            if (TRUE === \is_array($value))
            {
                $value          = $this->ksort_recursive($value);
                $values[$index] = $value;
            }
        }

        ksort($values);

        return $values;
    }
}