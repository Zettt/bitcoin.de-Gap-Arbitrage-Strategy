# Bitcoin.de Gap Arbitrage Strategy

A Python-based trading strategy that identifies and exploits price gaps between different payment methods on Bitcoin.de, one of Europe's leading cryptocurrency exchanges.

## Overview

This project implements an arbitrage strategy that:

- Monitors price differences between Bitcoin.de and another spot exchange, such as Binance.
- It is meant to be executed regularly. No websocket.
- Identifies profitable arbitrage opportunities when gaps exceed transaction costs.
- Executes trades automatically when conditions are met.
- Manages risk through position sizing and execution timing.

The strategy takes advantage of price discrepancies that occur due to different payment methods having varying levels of convenience, speed, and user preference. For example, SEPA instant transfers might trade at a premium compared to regular SEPA transfers due to faster settlement times.

At the moment only *buying on Bitcoin.de* is implemented. But it's easy to see how selling would work. Note that in a "true" arbitrage strategy, for example pairs trading, you'd place an equivalent *short* on the opposing exchange, and constantly monitor the price difference. When the gap is closed, you can also close your positions to book the profit.

## Features

- Price monitoring via Bitcoin.de API
- Automated gap detection and analysis
- Risk management and position sizing
- Trade execution through official Bitcoin.de Trading API v4
- Detailed logging and performance tracking

## Requirements

- Python 3.8+
- Bitcoin.de API credentials with trading permissions
- Sufficient EUR (and maybe BTC) balance for trading

## Installation

1. Clone the repository
2. Install required dependencies:
```bash
pip install -r requirements.txt
```
3. Configure your API credentials in the `.env` file

## Configuration

Create a `.env` file with your Bitcoin.de API credentials:
```
BITCOINDE_API_KEY=your_api_key
BITCOINDE_API_SECRET=your_api_secret
```

## Usage

1. Run the strategy:
```bash
python strategy.py
```

## Strategy Parameters

Key parameters can be configured in `strategy.py`:
- Minimum gap size for trade execution
- Maximum position size
- Risk limits
- Trading pairs (currently BTC-EUR only)
- Supported payment methods

## Disclaimer

This is an experimental trading strategy. Use at your own risk. Make sure to:
- Start with small amounts to test the strategy
- Monitor the trades regularly
- Understand the risks involved in automated trading
- Comply with all relevant regulations and Bitcoin.de's terms of service

The strategy hasn't thouroughly tested because to test, we'd need to have larger gaps between the various exchanges. Backtesting also turned out to be too difficult because there's no historic data available from Bitcoin.de. That is all to say: read the disclaimer again. Do not lose what you can't afford.
