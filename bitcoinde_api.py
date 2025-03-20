import requests
import hmac
import hashlib
import time
from urllib.parse import urlparse, urlencode
from dotenv import load_dotenv
import os
import json
from typing import Dict, Any, Optional, List
import logging
from dataclasses import dataclass
from decimal import Decimal

# Configure logging
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(levelname)s - %(message)s'
)
logger = logging.getLogger(__name__)

@dataclass
class Order:
    """Represents a Bitcoin.de order"""
    order_id: str
    trading_pair: str
    type: str
    price: Decimal
    max_amount_currency_to_trade: Decimal
    min_amount_currency_to_trade: Decimal
    max_volume_currency_to_pay: Decimal
    min_volume_currency_to_pay: Decimal
    is_external_wallet_order: bool
    trading_partner_information: Dict
    order_requirements: Dict
    sepa_option: int
    order_requirements_fullfilled: bool
    is_futurum_order: bool

    @classmethod
    def from_dict(cls, data: Dict) -> 'Order':
        """Create an Order instance from API response dictionary"""
        return cls(
            order_id=data['order_id'],
            trading_pair=data['trading_pair'],
            type=data['type'],
            price=Decimal(str(data['price'])),
            max_amount_currency_to_trade=Decimal(data['max_amount_currency_to_trade']),
            min_amount_currency_to_trade=Decimal(data['min_amount_currency_to_trade']),
            max_volume_currency_to_pay=Decimal(str(data['max_volume_currency_to_pay'])),
            min_volume_currency_to_pay=Decimal(str(data['min_volume_currency_to_pay'])),
            is_external_wallet_order=data['is_external_wallet_order'],
            trading_partner_information=data['trading_partner_information'],
            order_requirements=data['order_requirements'],
            sepa_option=data['sepa_option'],
            order_requirements_fullfilled=data['order_requirements_fullfilled'],
            is_futurum_order=data['is_futurum_order']
        )

class BitcoinDeAPIError(Exception):
    """Custom exception for Bitcoin.de API errors"""
    pass

class BitcoinDeAPI:
    """Bitcoin.de Trading API v4 Client"""
    
    API_VERSION = '4'
    BASE_URL = 'https://api.bitcoin.de/'
    
    # HTTP Methods
    HTTP_GET = 'GET'
    HTTP_POST = 'POST'
    HTTP_DELETE = 'DELETE'
    
    # Trading pairs
    TRADING_PAIR_BTCEUR = 'btceur'
    TRADING_PAIR_BCHEUR = 'bcheur'
    TRADING_PAIR_ETHEUR = 'etheur'
    
    def __init__(self, api_key: str, api_secret: str):
        """Initialize the API client
        
        Args:
            api_key: Your Bitcoin.de API key
            api_secret: Your Bitcoin.de API secret
        """
        if not api_key or not api_secret:
            raise ValueError("API key and secret are required")
            
        self.api_key = api_key
        self.api_secret = api_secret.encode('utf-8')  # Convert to bytes for HMAC
        logger.info("Bitcoin.de API client initialized")
        
    def _generate_nonce(self) -> str:
        """Generate a unique nonce for API requests"""
        nonce = str(int(time.time() * 1000000))  # Microsecond precision
        return nonce
        
    def _generate_signature(self, method: str, url: str, nonce: str, post_params: str = '') -> str:
        """Generate the HMAC signature for API authentication
        
        Args:
            method: HTTP method (GET, POST, DELETE)
            url: Full request URL including query parameters
            nonce: Unique nonce
            post_params: POST parameters if any, as MD5 hash
            
        Returns:
            HMAC signature as hex string
        """
        # Create signature data in format: method#url#api_key#nonce#post_params_md5
        hmac_data = '#'.join([method, url, self.api_key, nonce, post_params])
        
        # Generate HMAC-SHA256
        signature = hmac.new(self.api_secret, 
                           hmac_data.encode('utf-8'),
                           hashlib.sha256).hexdigest()
        
        return signature
    
    def _request(self, method: str, endpoint: str, params: Optional[Dict[str, Any]] = None) -> Dict[str, Any]:
        """Make an authenticated request to the Bitcoin.de API
        
        Args:
            method: HTTP method (GET, POST, DELETE)
            endpoint: API endpoint (e.g. 'orders', 'trades')
            params: Optional query parameters for GET or data for POST
            
        Returns:
            API response as dictionary
        """
        # Build URL
        url = f"{self.BASE_URL}v{self.API_VERSION}/{endpoint}"
        
        # Add query parameters to URL for GET requests
        if method == self.HTTP_GET and params:
            url += '?' + urlencode(params)
            post_params = ''
        else:
            post_params = urlencode(params) if params else ''
        
        # Generate request headers
        nonce = self._generate_nonce()
        post_params_md5 = hashlib.md5(post_params.encode('utf-8')).hexdigest()
        signature = self._generate_signature(method, url, nonce, post_params_md5)
        
        headers = {
            'X-API-KEY': self.api_key,
            'X-API-NONCE': nonce,
            'X-API-SIGNATURE': signature
        }
        
        try:
            # Make request
            response = requests.request(
                method=method,
                url=url,
                headers=headers,
                data=params if method == self.HTTP_POST else None
            )
            
            # Handle response
            response.raise_for_status()
            data = response.json()
            
            if not data.get('successful', True):  # Some endpoints don't return 'successful'
                errors = data.get('errors', [])
                raise BitcoinDeAPIError(f"API request failed: {errors}")
                
            return data
            
        except requests.exceptions.RequestException as e:
            logger.error(f"Request failed: {e}")
            raise BitcoinDeAPIError(f"Request failed: {e}")
    
    def show_orderbook(self, trading_pair: str, order_type: Optional[str] = None, **kwargs) -> List[Order]:
        """Get the orderbook for a trading pair
        
        Args:
            trading_pair: Trading pair (e.g. 'btceur')
            order_type: Optional order type ('buy' or 'sell'). If None, returns both.
            **kwargs: Optional parameters like price, amount_currency_to_trade, etc.
            
        Returns:
            List of Order objects
        """
        params = {
            'trading_pair': trading_pair,
            **kwargs
        }
        if order_type:
            params['type'] = order_type
        
        response = self._request(self.HTTP_GET, f"{trading_pair}/orderbook", params)
        orders = response.get('orders', [])
        return [Order.from_dict(order) for order in orders]
    
    def show_my_orders(self, **kwargs) -> Dict[str, Any]:
        """Get list of your orders
        
        Args:
            **kwargs: Optional filter parameters
            
        Returns:
            List of orders
        """
        return self._request(self.HTTP_GET, "orders", kwargs)
    
    def show_my_order_details(self, order_id: str, trading_pair: str) -> Dict[str, Any]:
        """Get details of a specific order
        
        Args:
            order_id: Order ID
            trading_pair: Trading pair of the order
            
        Returns:
            Order details
        """
        params = {
            'order_id': order_id,
            'trading_pair': trading_pair
        }
        return self._request(self.HTTP_GET, f"orders/{order_id}", params)

    def analyze_orderbook(self, trading_pair: str) -> Dict[str, Any]:
        """Analyze the orderbook for a trading pair
        
        Args:
            trading_pair: Trading pair to analyze (e.g. 'btceur')
            
        Returns:
            Dictionary containing analysis results
        """
        # Get buy and sell orders
        buy_orders = self.show_orderbook(trading_pair, 'buy')
        sell_orders = self.show_orderbook(trading_pair, 'sell')
        
        # Calculate spread
        if buy_orders and sell_orders:
            best_buy = max(buy_orders, key=lambda x: x.price)
            best_sell = min(sell_orders, key=lambda x: x.price)
            spread = best_buy.price - best_sell.price
            spread_percentage = (spread / best_buy.price) * 100
        else:
            spread = Decimal('0')
            spread_percentage = Decimal('0')
            
        return {
            'best_buy_price': best_buy.price if buy_orders else None,
            'best_sell_price': best_sell.price if sell_orders else None,
            'spread': spread,
            'spread_percentage': spread_percentage,
            'buy_orders_count': len(buy_orders),
            'sell_orders_count': len(sell_orders),
            'timestamp': time.time()
        }

    def execute_trade(self, order_id: str, trading_pair: str, amount: float, trade_type: str) -> Dict[str, Any]:
        """Execute a trade for a specific order
        
        Args:
            order_id: ID of the order to trade
            trading_pair: Trading pair of the order (e.g. 'btceur')
            amount: Amount of cryptocurrency to trade
            trade_type: Type of trade ('buy' or 'sell')
            
        Returns:
            Trade details
        """
        if trade_type not in ['buy', 'sell']:
            raise ValueError("trade_type must be either 'buy' or 'sell'")
            
        params = {
            'type': trade_type,
            'amount': str(amount)  # API expects string
        }
        
        return self._request(self.HTTP_POST, f"{trading_pair}/trades/{order_id}", params)