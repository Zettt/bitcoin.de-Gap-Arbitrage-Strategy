# %%
from dotenv import load_dotenv
import os
import logging
import requests
from bitcoinde_api import BitcoinDeAPI, BitcoinDeAPIError

# Load environment variables from .env file
load_dotenv()

# Configure logging
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(levelname)s - %(message)s'
)
logger = logging.getLogger(__name__)

# Get API credentials from environment variables
BITCOINDE_API_KEY = os.getenv('BITCOINDE_API_KEY')
BITCOINDE_API_SECRET = os.getenv('BITCOINDE_API_SECRET')

# Binance API endpoint
BINANCE_API_URL = "https://api.binance.com/api/v3/ticker/price"

def get_binance_price():
    """Get the current BTCEUR price from Binance."""
    try:
        response = requests.get(BINANCE_API_URL, params={"symbol": "BTCEUR"})
        response.raise_for_status()
        return float(response.json()["price"])
    except requests.RequestException as e:
        logger.error(f"Binance API Error: {e}")
        return None


# %%
if __name__ == "__main__":
    if not BITCOINDE_API_KEY or not BITCOINDE_API_SECRET:
        logger.error("API credentials not found in environment variables")
        exit(1)
        
    try:
        api = BitcoinDeAPI(BITCOINDE_API_KEY, BITCOINDE_API_SECRET)
        
        # '''
        # Analyze BTC-EUR market
        analysis = api.analyze_orderbook(BitcoinDeAPI.TRADING_PAIR_BTCEUR)
        bitcoinde_best_buy_price = float(analysis['best_buy_price'])
        bitcoinde_best_sell_price = float(analysis['best_sell_price'])

        print("\nMarket Analysis:")
        print(f"Best Buy Price: €{bitcoinde_best_buy_price:,.2f}")
        print(f"Best Sell Price: €{bitcoinde_best_sell_price:,.2f}")
        print(f"Spread: €{analysis['spread']:,.2f} ({analysis['spread_percentage']:.2f}%)")
        print(f"Number of buy orders: {analysis['buy_orders_count']}")
        print(f"Number of sell orders: {analysis['sell_orders_count']}")
        # '''
        # analysis = {}
        # analysis['best_buy_price'] = 76555
        
        # Get Binance price and calculate difference
        binance_price = get_binance_price()
        
        if binance_price is not None:
            # Check arbitrage opportunity in both directions
            bitcoinde_buy_diff = binance_price - bitcoinde_best_sell_price
            bitcoinde_sell_diff = bitcoinde_best_buy_price - binance_price

            print("\nBinance Comparison:")
            print(f"Binance Spot Price: €{binance_price:,.2f}")
            print("\nArbitrage Opportunities:")
            print(f"Buy on Bitcoin.de -> Sell on Binance: €{bitcoinde_buy_diff:,.2f} ({(bitcoinde_buy_diff/binance_price)*100:,.2f}%)")
            print(f"Buy on Binance -> Sell on Bitcoin.de: €{bitcoinde_sell_diff:,.2f} ({(bitcoinde_sell_diff/binance_price)*100:,.2f}%)")
            
            BITCOINDE_FEE = 0.5  # 0.5% trading fee
            MIN_PROFIT_PERCENT = 1.0  # Minimum profit threshold
            TRADE_THRESHOLD = MIN_PROFIT_PERCENT + BITCOINDE_FEE  # Combined threshold
            if max(bitcoinde_buy_diff, bitcoinde_sell_diff)/binance_price * 100 < TRADE_THRESHOLD:
                print("Spread too small, no arbitrage opportunity")
            else:
                if bitcoinde_buy_diff > bitcoinde_sell_diff:
                    print("Best arbitrage opportunity: Buy on Bitcoin.de, sell on Binance")
                    
                    # Find the best sell order to buy from
                    sell_orders = api.show_orderbook(BitcoinDeAPI.TRADING_PAIR_BTCEUR, 'sell')
                    if not sell_orders:
                        logger.warning("No sell orders available")
                        
                    best_sell_order = min(sell_orders, key=lambda x: x.price)
                    
                    try:
                        # Execute trade with minimum amount
                        trade_amount = best_sell_order.min_amount_currency_to_trade
                        logger.info(f"Executing trade for {trade_amount} BTC at €{best_sell_order.price}")
                        
                        trade_result = api.execute_trade(
                            best_sell_order.order_id,
                            BitcoinDeAPI.TRADING_PAIR_BTCEUR,
                            float(trade_amount),
                            'buy'
                        )
                        logger.info(f"Trade executed successfully: {trade_result}")
                        
                    except BitcoinDeAPIError as e:
                        logger.error(f"Failed to execute trade: {e}")
                else:
                    print("Best arbitrage opportunity: Buy on Binance, sell on Bitcoin.de")
                    print("This is not implemented")

    except BitcoinDeAPIError as e:
        logger.error(f"API Error: {e}")
    except Exception as e:
        logger.error(f"Unexpected error: {e}")
