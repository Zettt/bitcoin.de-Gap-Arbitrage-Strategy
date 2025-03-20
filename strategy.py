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
        print("\nMarket Analysis:")
        print(f"Best Buy Price: €{analysis['best_buy_price']:,.2f}")
        print(f"Best Sell Price: €{analysis['best_sell_price']:,.2f}")
        print(f"Spread: €{analysis['spread']:,.2f} ({analysis['spread_percentage']:.2f}%)")
        print(f"Number of buy orders: {analysis['buy_orders_count']}")
        print(f"Number of sell orders: {analysis['sell_orders_count']}")
        # '''
        # analysis = {}
        # analysis['best_buy_price'] = 76555
        
        # Get Binance price and calculate difference
        binance_price = get_binance_price()
        if binance_price is not None:
            bitcoinde_best_buy_price = float(analysis['best_buy_price'])
            price_diff = bitcoinde_best_buy_price - binance_price
            price_diff_percentage = (price_diff / binance_price) * 100
            print("\nBinance Comparison:")
            print(f"Binance Spot Price: €{binance_price:,.2f}")
            print(f"Price Difference: €{price_diff:,.2f}")
            print(f"Price Difference Percentage: {price_diff_percentage:,.2f}%")
            if price_diff_percentage < 1:
                print("Spread too small, no arbitrage opportunity")

    except BitcoinDeAPIError as e:
        logger.error(f"API Error: {e}")
    except Exception as e:
        logger.error(f"Unexpected error: {e}")
