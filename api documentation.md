Allgemeine Informationen zu dem Aufruf (API Call)
Zugangsdaten
API-Key
Der API-Key dient in Kombination mit Ihrem API-Secret zur Authentifizierung und Autorisierung gegenüber der Trading-API.

API-Secret
Ihr API-Secret ist, ähnlich wie Ihr Passwort, streng vertraulich zu behandeln, da jeder, der im Besitz Ihres API-Keys und API-Secrets ist, jede für den jeweiligen API-Key erlaubte API-Funktionalität nutzen kann.

Sofern Anhaltspunkte dafür bestehen, dass einer Ihrer API-Secrets kompromittiert wurde, sollten Sie Ihren API-Key (bzw. Ihre API-Keys) umgehend sperren. Dazu erhalten Sie von uns nach jedem API-Request, dem mindestens eine 15-minütige Pause ohne API-Request vorherging, per E-Mail einen Link zur Sperrung Ihres API-Keys, wobei immer nur der zuletzt versandte Link gültig ist. Alternativ können Sie Ihre API-Keys auch im Login-Bereich in den Einstellungen Ihres Accounts unter 'mein Bitcoin.de' -> 'Trading-API' sperren.

Sie haben die Möglichkeit diese Benachrichtigungen zu deaktivieren. Bitte Beachten Sie, dass durch das Abstellen der E-Mail-Benachrichtigungen eine Sicherheitsfunktionalität deaktiviert wird. Sollte ein Unberechtigter Zugriff auf die API-Daten oder ein Script, das diese Daten nutzt, bekommen, werden Sie nicht mehr über diese Zugriffe per E-Mail informiert.

Zugriffsbeschränkung
In gewissen Fällen ist es sinnvoll den Zugriff eines API-Keys nur für bestimmte API-Funktionalitäten zu erlauben. Möchten Sie beispielsweise nur das Orderbook abfragen, sollten Sie den Zugriff auf direkte handelsbezogene Funktionen wie das Einstellen von eigenen Angeboten oder das Kaufen/Verkaufen von eingestellten Angeboten untersagen. Ebenfalls ist eine Zugriffsbeschränkung sinnvoll, wenn Sie mit Hilfe einer Drittsoftware (z.B. einer Smartphone-APP) auf die Trading-API zugreifen und in diesem Fall aber nur Ihre eigenen Kontoinformationen auslesen möchten. Sie sollten dem entsprechenden API-Key nur so viel API-Berechtigungen wie nötig gewähren, da andernfalls die Drittsoftware in der Lage wäre, den kompletten API-Funktionsumfang nutzen zu können.

Zusätzlich können Sie den Zugriff für den entsprechenden API-Key auf bestimmte IP-Adressen (v4) beschränken, indem Sie entweder vollständige IP-Adressen (z.B. 206.30.221.95) eintragen oder mit Hilfe von Platzhaltern (*, z.B. 206.30.221.* oder 206.30.*.*) die Freigabe größerer IP-Adressräume gewähren. Erfolgt ein Zugriffsversuch außerhalb dieser Adressbeschränkung wird der Zugriff mit einem HTTP-Statuscode 403 (Forbidden) sowie dem Error-Code 94 beantwortet.

Verschlüsselung
Jeder Request benötigt die folgenden Header:

X-API-KEY
X-API-NONCE
X-API-SIGNATURE
X-API-KEY
Entspricht Ihrem API-Key.

X-API-NONCE
Ein Integer-Wert der bei jedem Request größer sein muss als beim vorherigen Request. Üblicherweise wird hierfür ein Unix-Timestamp verwendet (Vorsicht bei mehreren Abfragen innerhalb derselben Sekunde!).

X-API-SIGNATURE
Die Signatur repräsentiert eine HMAC-SHA256 verschlüsselte Nachricht, welche die HTTP-Methode, die aufzurufende URI, Ihren API-Key, das Nonce, als auch mögliche POST-Parameter beinhaltet und mit Ihrem API-Secret verschlüsselt wird. Es wird die hexadezimale Repräsentation des HMACs in Kleinschreibung benötigt!

Zum Erhalt einer validen Signatur ist es wichtig, dass Sie die Berechnung exakt wie im folgenden PHP-Codebeispiel vornehmen:

$post_parameters = array('type' => 'buy', 'amount' => 5.3);
$concatted_post_parameters = '';
$http_method = 'POST';

if (0 < count($post_parameters))
{
    ksort($post_parameters); // Sort parameters by key ascending

   // Generate URL-encoded query string
   $concatted_post_parameters = http_build_query($post_parameters, '', '&');
}

$hmac_data = implode('#', array($http_method, $uri, $api_key, $nonce, md5($concatted_post_parameters)));
$hmac = hash_hmac('sha256', $hmac_data, $secret);

Signatur-POST-Beispiel
Es soll die API-Funktion createTrade mit den folgenden Ausgangswerten durchgeführt werden:

POST-Parameter:
{
    'type'     : 'buy',
    'max_amount' : 5.3,
    'price'   : 255.50
}

api_key:     'MY_API_KEY' // Entspricht dem eigenen API-Key
nonce:       1234567 // Das für den aktuellen Request verwendete Nonce
api_secret:  'MY_API_SECRET' // Entspricht dem eigenen API-Secret
http_method: 'POST'
uri:         'https://api.bitcoin.de/v4/orders'
Schritt 1: Aufsteigendes Sortieren der POST-Parameter anhand ihres Namens¹

{
    'max_amount' : 5.3,
    'price'   : 255.50,
    'type'     : 'buy'
}
Schritt 2: Einen validen URL-encoded Query-String aus den POST-Parametern generieren¹

url_encoded_query_string = 'max_amount=5.3&price=255.5&type=buy'
Schritt 3: md5-Hash über den in Schritt 2 erstellten Query-String der POST-Parameter bilden

post_parameter_md5_hashed_url_encoded_query_string = md5(url_encoded_query_string) // Es wird der MD5-Hash in hexadezimaler Form benötigt
=> '5f4aece1d75c7adfc5ef346216e9bb11'
Schritt 4: Konkatinieren der HMAC-Eingabedaten

hmac_data = http_method+'#'+uri+'#'+api_key+'#'+nonce+'#'+post_parameter_md5_hashed_url_encoded_query_string
=> 'POST#https://api.bitcoin.de/v4/orders#MY_API_KEY#1234567#5f4aece1d75c7adfc5ef346216e9bb11'
Schritt 5: Bilden des eigentlichen sha256-HMACs

hmac = HMAC('sha256', hmac_data, api_secret)
=> ''
¹ Sofern keine POST-Parameter vorhanden sind, weil eine API-Methode einen GET- oder DELETE-Request vorschreibt, entfallen die Schritte 1 und 2. Innerhalb von Schritt 3 wird dann lediglich der md5-Hash aus einem Leerstring gebildet. Somit bleibt der md5-Hash innerhalb der Variable post_parameter_md5_hashed_url_encoded_query_string bei GET- und DELETE-Requests konstant. Als Konsequenz kann bei GET- und DELETE-Requests der md5-Hash d41d8cd98f00b204e9800998ecf8427e für Variable post_parameter_md5_hashed_url_encoded_query_string verwendet werden.

Signatur-GET-Beispiel
Es soll die API-Funktion showOrderbook mit den folgenden Ausgangswerten durchgeführt werden:

GET-Parameter:
{
    'type'    : 'buy',
    'amount'  : 5.3,
    'price'   : 255.50
}

POST-Parameter:
{
}

api_key:     'MY_API_KEY'    // Entspricht dem eigenen API-Key
nonce:       1234567         // Das für den aktuellen Request verwendete Nonce
api_secret:  'MY_API_SECRET' // Entspricht dem eigenen API-Secret
http_method: 'GET'
uri:         'https://api.bitcoin.de/v4/orders'
Schritt 1: einen validen URL-encoded Query-String aus den GET-Parametern generieren

get_parameter_url_encoded_query_string = 'type=buy&amount=5.3&price=255.5' // Die Reihenfolge der GET-Parameter ist irrelevant
Schritt 2: Erweitern der URI um GET-Parameter

uri = uri+'?'+get_parameter_url_encoded_query_string
=> 'https://api.bitcoin.de/v4/orders?type=buy&amount=5.3&price=255.5'
Schritt 3: md5-Hash der POST-Parameter für die HMAC-Daten erstellen¹

post_parameter_md5_hashed_url_encoded_query_string = md5('');
=> 'd41d8cd98f00b204e9800998ecf8427e'
Schritt 4: Konkatinieren der HMAC-Eingabedaten

hmac_data = http_method+'#'+uri+'#'+api_key+'#'+nonce+'#'+post_parameter_md5_hashed_url_encoded_query_string
=> 'GET#https://api.bitcoin.de/v4/orders?type=buy&amount=5.3&price=255.5#MY_API_KEY#1234567#d41d8cd98f00b204e9800998ecf8427e'
Schritt 5: Bilden des eigentlichen sha256-HMACs

hmac = HMAC('sha256', hmac_data, api_secret)
=> ''
Wichtig: Der zum Berechnen des HMACs genutzte API-Secret ist ähnlich wie Ihr Passwort streng vertraulich zu behandeln.

Credits
Alle API-Keys eines Bitcoin.de-Accounts teilen sich ein Credit-Kontingent, welches abhängig vom jeweiligen Trust-Level des Accounts auf ein bestimmtes Maximum gedeckelt ist.

Die API-Aufrufe kosten Credits, die sofort vom aktuellen Kontingent abgezogen werden und dieses auch ins Negative laufen lassen können. Befindet sich der User vor einem Aufruf bereits im Negativen, so verdoppeln sich die Kosten eines Aufrufs.

Das Credit-Kontingent wird pro Sekunde, in der keine API-Abfrage gestellt wird, um einen Credit erhöht solange das Credit-Maximum noch nicht erreicht wurde.

Sofern nicht mehr genügend Credits für eine API-Abfrage zur Verfügung stehen oder ein negatives Credit-Kontingent erreicht wurde, erhalten Sie im Response als HTTP-Statuscode 429 (Too many requests) und einen Header namens Retry-After, der die Sekundenanzahl beinhaltet, nach der die aktuelle API-Abfrage (auf die gewünschte API-Funktion) aufgrund ausreichender Credits wieder durchgeführt werden kann.

Ausnahme (neu ab API-Version v4): Die Methode deleteOrder kann jederzeit, d.h. auch bei einem negativen Credit-Stand ausgeführt werden. Es wird also nie ein HTTP-Statuscode 429 zurückgegeben. Die Credits werden für den Aufruf von deleteOrder selbstverständlich immer berechnet - bei einem bereits negativen Credit-Stand doppelt (vgl. Absatz oben).

Sollten Sie trotz bereits negativem Credit-Kontingent und daraus resultierenden *429 (Too many requests)* Statuscodes weitere API-Requests stellen (außer deleteOrder - vgl. vorherigen Absatz), so behalten wir uns vor Ihre API-Zugänge temporär zu sperren, wodurch weitere API-Requests mit einem HTTP-Status *403 (Forbidden)* beantwortet werden würden.

Credit-Übersicht
Aufruf	Anzahl Credits
showOrderbook	2
createOrder	1
showOrderDetails	2
deleteOrder	2
deleteOrder (instant*)	10
showMyOrders	2
showMyOrderDetails	2
showOrderbookCompact	3
executeTrade	1
showMyTradeDetails	3
markTradeAsPaid	1
showMyTrades	3
markTradeAsPaymentReceived	1
addTradeRating	1
markCoinsAsTransferred	1
showPublicTradeHistory	3
markCoinsAsReceived	1
showAccountInfo	2
showRates	3
showAccountLedger	3
showPermissions	2
deleteWithdrawal	2
showWithdrawal	2
showWithdrawals	2
createWithdrawal	2
showWithdrawalMinNetworkFee	2
showOutgoingAddresses	2
requestDepositAddress	2
showDeposit	2
showDeposits	2
*Orders die nicht älter als 60 Sekunden sind.

Allgemeine Informationen zu der Rückgabe (API Response)
General Response Format
JSON

General HTTP Response Codes
Code	Message
200	GET-/ DELETE-Request wurde erfolgreich durchgeführt
201	POST-Request wurde erfolgreich durchgeführt und die neue Ressource angelegt (z.B. Trade)
400	Bad Request
403	Forbidden
404	Angefragte Entität konnte nicht gefunden werden
422	Anfrage konnte nicht erfolgreich durchgeführt werden. Für weitere Gründe bitte die im Response aufgeführten Fehler im Array-Eintrag "errors" untersuchen.
429	Too many requests
Hinweis: Sofern ein Response den Statuscode 200 oder 201 trägt, konnte Ihr korrespondierender Request ohne Fehler abgearbeitet werden. Sollte der Statuscode abweichen, so finden Sie weiterführende Informationen im Eintrag "errors" im Response.

Location-Header im Response
Sofern ein Response den Location-Header beinhaltet, kann der im Header hinterlegte URI verwendet werden, um nähere Infos zur verknüpften Ressource (z.B. eine Order oder einen Trade) zu erhalten.

Globale Werte im Response
Name	Required	Type	Value	Notes
errors	true	array	[{"message":"abc","code":123, "field" => "field_abs"}]	Liste mit Error-Meldungen und dazugehörigen Error-Codes.
credits	true	integer	--	Anzahl aktuell verbleibender Credits
maintenance	false	array	array	Infos bzgl. Wartungsarbeiten (s. Tabelle "Maintenance-Details"
nonce	false	integer	--	Sofern der "Error-Code 4 (Invalid nonce)" auftritt, wird das letzte gültige Nonce in diesem Feld ausgegeben
Error-Details
Name	Required	Type	Value	Notes
message	true	string	--	Infotext
code	true	string	--	Fehlercode
field	false	string	--	Feld, auf den sich der Fehler bezieht.
Auflistung der Error-Codes
Request
Error-Code	Message
1	Missing header
2	Inactive api key
3	Invalid api key
4	Invalid nonce
5	Invalid signature
6	Insufficient credits
7	Invalid route
8	Unkown api action
9	Additional agreement not accepted
32	Api key banned
33	Ip banned
94	Ip access restricted
10	No 2 factor authentication
11	No beta group user
12	Technical reason
13	Trading api currently unavailable
14	No action permission for api key
15	Missing post parameter
16	Missing get parameter
17	Invalid number
18	Number too low
19	Number too big
20	Too many decimal places
21	Invalid boolean value
22	Forbidden parameter value
23	Invalid min amount
24	Invalid datetime format
25	Date lower than min date
26	Invalid value
27	Forbidden value for get parameter
28	Forbidden value for post parameter
29	Express trade temporarily not available
30	End datetime younger than start datetime
31	Page greater than last page
34	Invalid trading pair
35	Invalid currency
36	Forbidden value for query parameter
37	Too many characters
44	No kyc full
45	Operation currently not possible
46	Has to accept additional agreement
47	Not part of beta group for api version
113	Futurum not possible
114	Futurum outside business hours
116	Trading pair is delisted
117	Currency is delisted
Order
Error-Code	Message
50	Order not found
51	Order not possible
52	Invalid order type
53	Payment option not allowed for type buy
54	Cancellation not allowed
55	Trading suspended
56	Express trade not possible
106	Sepa trade not possible
57	No bank account
58	Order not possible for trading pair
59	Order not possible due supplementary agreement
107	Sepa instant not allowed for type buy
108	Sepa instant not allowed for payment option
109	Sepa instant order not possible
Trade
Error-Code	Message
70	No active reservation
71	Express trade not allowed
72	Express trade failure temporary
73	Express trade failure
74	Invalid trade state
75	Trade not found
76	Reservation amount insufficient
77	Volume currency to pay after fee deviates
78	Already marked as paid
79	Payment already marked as received
100	Trade already rated
101	Trade not possible for trading pair
103	Already marked as transferred
104	Coins already marked as received
110	Sepa instant trade not possible
115	Confirmation of payment receipt currently not possible
Withdrawal
Error-Code	Message
80	Withdrawal not found
81	Withdrawal cancellation not allowed
82	Withdrawal conditions have not accepted
83	Withdrawals disabled
111	Withdrawals invalid recipient purpose
120	Withdrawal tapi not possible
130	Withdrawal missing information
118	Withdrawal recipient address not whitelisted
Deposit
Error-Code	Message
90	Requesting deposit address currenty not possible
91	Deposit not found
92	Invalid address
93	Comments only allowed for newly created deposit addresses
112	Watching deposits currently not possible
Crypto (Marketplace Wallet) - to - Crypto (External Customer Wallet)
Error-Code	Message
95	No address available
96	Address not valid
97	Address can not be used
98	Address is used in another trade
99	Address not found
102	No address for remaining order available
105	Amount currency to trade after fee deviates
Response mit Fehlerbeispiel
{
    "errors": [
        {
            "message": "Order not found",
            "code": 50,
            "field": "order_id"
        }
    ]
}

Maintenance-Details
Name	Required	Type	Value	Notes
message	true	string	--	Infotext
start	true	string	--	Start der Arbeiten (Format: 2015-04-07T12:23:04+02:00 gemäß RFC 3339)
end	true	string	--	Voraussichtliches Ende der Arbeiten (Format: 2015-04-07T12:23:04+02:00 gemäß RFC 3339)

Bankenländerliste
Ländercode ISO 3166-2	Land
AT	Österreich
BE	Belgien
BG	Bulgarien
CH	Schweiz
CY	Zypern
CZ	Tschechische Republik
DE	Deutschland
DK	Dänemark
EE	Estland
ES	Spanien
FI	Finnland
FR	Frankreich
GB	Großbritannien
GR	Griechenland
HR	Kroatien
HU	Ungarn
IE	Irland
IS	Island
IT	Italien
LI	Liechtenstein
LT	Litauen
LU	Luxemburg
LV	Lettland
MT	Malta
MQ	Martinique
NL	Niederlande
NO	Norwegen
PL	Polen
PT	Portugal
RO	Rumänien
SE	Schweden
SI	Slowenien
SK	Slowakei
Handelspaare P2P-Marktplatz (Krypto/Euro)
Handelspaar-Kürzel	Bezeichnung
btceur	BTC / EUR
etheur	ETH / EUR
usdceur	USDC / EUR
soleur	SOL / EUR
xrpeur	XRP / EUR
bcheur	BCH / EUR
ltceur	LTC / EUR
dogeeur	DOGE / EUR
trxeur	TRX / EUR
btgeur	BTG / EUR
Handelspaare C2C-Marktplatz (Krypto/Krypto)
Handelspaar-Kürzel	Bezeichnung
btcusdc	BTC / USDC
ethusdc	ETH / USDC
ethbtc	ETH / BTC
xrpbtc	XRP / BTC
dogebtc	DOGE / BTC
Kryptowährungen
Kryptowährungen-Kürzel	Bezeichnung
btc	Bitcoin
bch	"Bitcoin Cash"
btg	"Bitcoin Gold"
eth	Ether
ltc	Litecoin
xrp	Ripple
doge	Dogecoin
sol	Solana
trx	Tron
usdt	Tether - ETH-Chain
usdc	USD Coin
Unterstützung der Option "recipient_purpose"
Kryptowährungen-Kürzel	Einzahlungen *	Auszahlungen	Währungsspezifische Bezeichnung
btc	Nicht unterstützt	Nicht unterstützt	---
bch	Nicht unterstützt	Nicht unterstützt	---
btg	Nicht unterstützt	Nicht unterstützt	---
eth	Nicht unterstützt	Nicht unterstützt	---
ltc	Nicht unterstützt	Nicht unterstützt	---
xrp	Pflicht	Optional	Destination-Tag
doge	Nicht unterstützt	Nicht unterstützt	---
sol	Nicht unterstützt	Nicht unterstützt	---
trx	Nicht unterstützt	Nicht unterstützt	---
usdt	Nicht unterstützt	Nicht unterstützt	---
usdc	Nicht unterstützt	Nicht unterstützt	---
* = Bitte beachten Sie: Einzahlungen, bei deren Währung die Option "recipient_purpose" Pflicht ist, können nur Ihrem Konto gutgeschrieben werden, wenn Sie auch das entsprechende "recipient_purpose" bei Ihrer Einzahlung verwenden.

Orders
Orders - showOrderbook
P2P (Krypto/Euro)
C2C (Krypto/Krypto)
Durchsuchen des Orderbooks nach passenden Angeboten

Credits:	2
GET
https://api.bitcoin.de/v4/:trading_pair/orderbook
URL-Parameter
Name	Type	Values	Notes
trading_pair	String		
s. Tabelle Handelspaare

GET - Parameter
Name	Type	Values	Default	Notes
type	String	
buy

 
sell

Angebots-Typ.
“buy” liefert Verkaufsangebote, “sell” Kaufangebote

amount_currency_to_tradeOPTIONAL	Float			
Menge der Coins

priceOPTIONAL	Float			
Preis pro Coin.

Entspricht bei "buy" dem maximalen Kaufpreis und bei "sell" dem minimalen Verkaufspreis.

order_requirements_fullfilledOPTIONAL	Integer	
1

 
0

0

Nur Angebote anzeigen, deren Anforderungen ich erfülle (bspw. Legitimationsstatus, Trust-Level, Sitz der Bank, Zahlungsart).

only_kyc_fullOPTIONAL	Integer	
1

 
0

0

Nur Angebote von vollständig identifizierten Usern anzeigen.

only_express_ordersOPTIONAL	Integer	
1

 
0

0

Nur Angebote anzeigen, die über Express-Handel gehandelt werden können.
Achtung:
Dieser Parameter wird nur ausgewertet wenn der Parameter "payment_option" nicht gesetzt ist.

payment_optionOPTIONAL	Integer	
1

 
2

 
3

Ist der Parameter 'payment_option' gesetzt, so wird der Parameter "only_express_orders" bei der Abfrage ignoriert.

1 => Express-Only
2 => SEPA-Only
3 => Express & SEPA

sepa_optionOPTIONAL	Integer	
0

 
1

0

Diese Option ist nur verfügbar, wenn type="buy" und payment_option=2 oder payment_option=3 gesetzt wurde!

0 => keine SEPA-Beschränkungen
1 => Nur Angebote von Handelspartnern anzeigen, die eine beschleunigte Zahlungsabwicklung via SEPA-Echtzeitüberweisung anbieten

only_same_bankgroupOPTIONAL	Integer	
1

 
0

0

Nur Angebote von Handelspartnern anzeigen, die ein Bankkonto bei derselben Bankgruppe (BIC-Nummernkreis) wie ich haben.

only_same_bicOPTIONAL	Integer	
1

 
0

0

Nur Angebote von Handelspartnern anzeigen, die ein Bankkonto bei derselben Bank wie ich haben.

seat_of_bankOPTIONAL	Array	
Bankenländerliste

Alle möglichen Länder aus der Tabelle Bankenländerliste

Nur Angebote mit bestimmtem Sitz der Bank anzeigen. (ISO 3166-2). s. Tabelle Bankenländerliste

page_sizeOPTIONAL	String	
small

 
medium

 
large

small

Anzahl der Angebote, die geladen werden.
Je nach Größe werden teilweise zusätzliche Credits berechnet.

small => 20 Ergebnisse
medium => 50 Ergebnisse, +1 Credit
large => 100 Ergebnisse, +2 Credits

Response
Success 200
Name	Type	Value	Notes
orders	Array		
Gefundene Angebote

Orders
Name	Type	Value	Notes
order_id	String		
ID des Angebots

is_external_wallet_order	Boolean		
Zeigt an ob sich die Order auf einen "Krypto-zu-Krypto (mit eigener Wallet)" Marktplatz bezieht.

trading_pair	String		
Handelspaar (s. Tabelle Handelspaare)

type	String	
buy

 
sell

Typ des Angebots

max_amount_currency_to_trade	Float		
Maximal handelbare Coin-Menge

min_amount_currency_to_trade	Float		
Mindestens handelbare Coin-Menge

price	Float		
Preis pro Coin

max_volume_currency_to_pay	Float		
Max. Volumen des Angebots

min_volume_currency_to_pay	Float		
Min. Volumen des Angebots

order_requirements_fullfilled	Boolean		
Zeigt an, ob das Angebot bedient werden könnte oder nicht (Trust-Level, KYC-Full, Sitz der Bank etc.).

sepa_option	Integer	
0

 
1

Optionen zur Abwicklung via SEPA

0 => keine Optionen vorhanden
1 => Beschleunigte Zahlungsabwicklung via SEPA-Echtzeitüberweisung möglich

trading_partner_information	Array		
Infos zum User des Angebots (s. Tabelle Trading Partner Information)

order_requirements	Array		
Voraussetzungen zum Bedienen des Angebots (s. Tabelle Order Requirements)

Trading-Partner-Information (beziehen sich auf den Ersteller des Angebots)
Name	Type	Value	Notes
username	String		
User-Name

is_kyc_full	Boolean		
Vollständig identifizierter User

trust_level	String	
bronze

 
silver

 
gold

 
platin

Trust-Level

bank_name	String		
Name der Bank

bic	String		
BIC der Bank

rating	Integer		
Prozentualer Anteil an positiven Bewertungen durch die Handelspartner

amount_trades	Integer		
Anzahl bereits getätigter Trades

Order Requirements
Name	Type	Value	Notes
min_trust_level	String	
bronze

 
silver

 
gold

 
platin

Mindest-Trust-Level des Handelspartners

only_kyc_fullOPTIONAL	Boolean		
Handelspartner muss vollständig identifiziert sein

seat_of_bankOPTIONAL	Array	
Bankenländerliste

Erlaubte Länder, in denen die Bank des Handelspartners ihren Sitz haben darf (ISO 3166-2) s. Tabelle Bankenländerliste

payment_optionOPTIONAL	Integer	
1

 
2

 
3

1 => Express-Only
2 => SEPA-Only
3 => Express & SEPA

Success-Response:
HTTP/1.1 200 OK
{
   "orders": [{
       "order_id": "A1B2D3",
       "is_external_wallet_order":false,
       "trading_pair": "btceur",
       "type": "buy",
       "max_amount":0."max_amount_currency_to_trade":0.5,
       "min_amount":0."min_amount_currency_to_trade":0.1,
       "price":230.55,
       "max_volume":115."max_volume_currency_to_pay":115.28,
       "min_volume":23."min_volume_currency_to_pay":23.06,
       "order_requirements_fullfilled":true,
       "sepa_option":0,
       "trading_partner_information":{
           "username":"bla",
           "is_kyc_full":true,
           "trust_level":"gold",
           "bank_name":"Sparkasse",
           "bic":"HASPDEHHXXX",
           "seat_of_bank":"DE",
           "rating": 99,
           "amount_trades": 52
       },
       "order_requirements":{
           "min_trust_level":"gold",
           "only_kyc_full":true,
           "seat_of_bank":[
               "DE",
               "NL"
           ],
           "payment_option":1
       }
   }],
   "errors":[

   ],
   "credits":12
}
Error
Http-Status 422
Code	Note
57	
no bank account

52	
Invalid order type

107	
Flag sepa_instant not allowed for order-type "buy"

108	
Flag sepa_instant is only allowed in combination with payment_option "2" or "3"

114	
Futurum-Trading outside of business hours is not possible

Orders - showOrderDetails
P2P (Krypto/Euro)
C2C (Krypto/Krypto)
Details zu einem Angebot abrufen

Credits:	2
GET
https://api.bitcoin.de/v4/:trading_pair/orders/public/details/:order_id
URL-Parameter
Name	Type	Values	Notes
trading_pair	String		
s. Tabelle Handelspaare

order_id	String		
ID des abzufragenden Angebots

Response
Success 200
Name	Type	Value	Notes
order	Array		
Gefundenes Angebot

Order
Name	Type	Value	Notes
order_id	String		
ID des Angebots

is_external_wallet_order	Boolean		
Zeigt an ob sich die Order auf einen "Krypto-zu-Krypto (mit eigener Wallet)" Marktplatz bezieht.

trading_pair	string		
Handelspaar (s. Tabelle Handelspaare)

type	String	
buy

 
sell

Typ des Angebots

max_amount_currency_to_trade	Float		
Maximal handelbare Coin-Menge

min_amount_currency_to_trade	Float		
Mindestens handelbare Coin-Menge

price	Float		
Preis pro Coin

max_volume_currency_to_pay	Float		
Max. Volumen des Angebots

min_volume_currency_to_pay	Float		
Min. Volumen des Angebots

order_requirements_fullfilled	Boolean		
Zeigt an, ob das Angebot bedient werden könnte oder nicht (Trust-Level, KYC-Full, Sitz der Bank etc.).

sepa_option	Integer	
0

 
1

Zeigt an, welche SEPA-Optionen für das Angebot vorliegen (nur in Kombination mit der payment_option "2" oder "3" möglich, s. Tabelle Order Requirements).

0 => keine SEPA-Option vorhanden
1 => beschleunigte Zahlungsabwicklung via SEPA-Echtzeitüberweisung möglich.

trading_partner_information	Array		
Infos zum User des Angebots (s. Tabelle Trading Partner Information)

order_requirements	Array		
Voraussetzungen zum Bedienen des Angebots (s. Tabelle Order Requirements)

Trading-Partner-Information (beziehen sich auf den Ersteller des Angebots)
Name	Type	Value	Notes
username	String		
User-Name

is_kyc_full	Boolean		
Vollständig identifizierter User

trust_level	String	
bronze

 
silver

 
gold

 
platin

Trust-Level

bank_name	String		
Name der Bank

bic	String		
BIC der Bank

rating	Integer		
Prozentualer Anteil an positiven Bewertungen durch die Handelspartner

amount_trades	Integer		
Anzahl bereits getätigter Trades

Order Requirements
Name	Type	Value	Notes
min_trust_level	String	
bronze

 
silver

 
gold

 
platin

Mindest-Trust-Level des Handelspartners

only_kyc_full	Boolean		
Handelspartner muss vollständig identifiziert sein

seat_of_bank	Array	
Bankenländerliste

Erlaubte Länder, in denen die Bank des Handelspartners ihren Sitz haben darf (ISO 3166-2) s. Tabelle Bankenländerliste

payment_option	Integer	
1

 
2

 
3

1 => Express-Only
2 => SEPA-Only
3 => Express & SEPA

Success-Response:
HTTP/1.1 200 OK
{
   "order":{
       "order_id": "A1B2D3",
       "trading_pair":"btceur",
       "type": "buy",
       "max_amount":0.5,
       "min_amount":0.1,
       "price":230.55,
       "max_volume":115.28,
       "min_volume":23.06,
       "order_requirements":{
           "min_trust_level":"gold",
           "only_kyc_full":true,
           "seat_of_bank":[
               "DE",
               "NL"
           ],
           "payment_option":1,
       }
       "trading_partner_information":{
           "username":"mustermann",
           "is_kyc_full":true,
           "trust_level":"gold",
           "bank_name":"Sparkasse",
           "bic":"HASPDEHHXXX",
           "seat_of_bank":"DE",
           "rating": 99,
           "amount_trades": 52
       },

       "order_requirements_fullfilled":true,
      "order_id":"82NW88",
      "trading_pair":"btceur",
      "is_external_wallet_order":false,
      "type":"sell",
      "max_amount_currency_to_trade":"0.015",
      "min_amount_currency_to_trade":"0.015",
      "price":8660,
      "max_volume_currency_to_pay":129.9,
      "min_volume_currency_to_pay":129.9,
      "order_requirements":{
         "min_trust_level":"bronze",
         "only_kyc_full":true,
         "seat_of_bank":[ "AT", "DE" ],
         "payment_option":3
      },
      "trading_partner_information":{
         "username":"MusterMann",
         "is_kyc_full":true,
         "trust_level":"gold",
         "bank_name":"Fidor Bank",
         "bic":"FDDODEMMXXX",
         "seat_of_bank":"DE",
         "amount_trades":90,
         "rating":97
      },
      "order_requirements_fullfilled":true,
      "sepa_option":0
   },
   "errors":[

   ],
   "credits":12
"errors":[],
   "credits":62
}
Error
Http-Status 404
Code	Note
50	
Order not found

Orders - createOrder
P2P (Krypto/Euro)
C2C (Krypto/Krypto)
Anlegen einer neuen Order

Credits:	1
POST
https://api.bitcoin.de/v4/:trading_pair/orders
URL-Parameter
Name	Type	Values	Notes
trading_pair	string	
Handelspaare

Handelspaar (s. Tabelle Handelspaare)

POST - Parameter
Name	Type	Values	Default	Notes
type	String	
buy

 
sell

max_amount_currency_to_trade	Float			
Maximale Menge der zu handelnden Coins

price	Float			
Preis pro Coin

min_amount_currency_to_tradeOPTIONAL	Float		
max_amount_currency_to_trade/2

Mindest-Menge der zu handelnden Coins

end_datetimeOPTIONAL	String		
akt. Datum + 2 Tage

Enddatum (mindestens 2 Tage in der Zukunft) des Angebots.
Format gemäß RFC 3339 (Bsp: 2015-01-20T15:00:00+02:00).
Zulässige Werte für die Minuten sind: 00, 15 , 30, 45

new_order_for_remaining_amountOPTIONAL	Integer		
0

Neues Angebot mit Restmenge anlegen, wenn nur eine Teilmenge aus dem Angebot bedient wurde.

min_trust_levelOPTIONAL	String	
bronze

 
silver

 
gold

 
platin

Default-Einstellung im User-Profil

Mindest-Trust-Level des Handelspartners

only_kyc_fullOPTIONAL	Integer		
0

Handelspartner muss vollständig identifiziert sein.

payment_optionOPTIONAL	Integer	
1

 
2

 
3

1

Diese Option wirkt sich nur bei type="sell" aus!

1 => Express-Only
2 => SEPA-Only
3 => Express & SEPA

Bei type="buy" ist Ihre Vorgabe unter "Express-Handel-Einstellungen" (bei ausreichender Reservierung!) maßgeblich

sepa_optionOPTIONAL	Integer	
0

 
1

0

Diese Option ist nur verfügbar, wenn type="sell" und payment_option=2 oder payment_option=3 gesetzt wurde!

0 => keine SEPA-Option
1 => Beschleunigte Zahlungsabwicklung via SEPA-Echtzeitüberweisung möglich

seat_of_bankOPTIONAL	Array	
Bankenländerliste

Alle möglichen Länder aus der Tabelle Bankenländerliste

Erlaubte Länder, in denen die Bank des Handelspartners ihren Sitz haben darf (ISO 3166-2)

Response
Success 201
Name	Type	Value	Notes
order_id	String		
Die ID des angelegten Angebots.

Location-Header
Sofern die Details zu der neu angelegten Order abgerufen werden sollen, kann der hier im Location-Header enthaltene URI verwendet werden, der auf die API-Methode "showMyOrderDetails" der konkreten Order zeigt.

https://api.bitcoin.de/v4/:trading_pairs/orders/:order_id
Success-Response:
HTTP/1.1 201 Created
{
 "order_id": "A1234BC",
 "errors": [],
 "credits": 8
}
Error
Http-Status 422
Code	Note
29	
Express trade is temporary not available.

34	
Invalid trading_pair

52	
Invalid order type

53	
payment_option not allowed for order-type "buy"

55	
Trading on the marketplace is currently suspended.

59	
Order not possible due to §7 of Supplementary agreement for the implementation of accelerated transaction processing functions.

71	
Express trade not allowed

107	
Flag sepa_instant not allowed for order-type "buy"

108	
Flag sepa_instant is only allowed in combination with payment_option "2" or "3"

109	
SEPA-instant order is not possible

Orders - deleteOrder
Löschen einer Order

Credits:	2
Credits (instant*):	10
*Orders die nicht älter als 60 Sekunden sind.
Bitte beachten Sie (neu ab API-Version v4): Die Methode deleteOrder kann jederzeit, d.h. auch bei einem negativen Credit-Stand ausgeführt werden. Es wird also nie ein HTTP-Statuscode 429 zurückgegeben.

DELETE
https://api.bitcoin.de/v4/:trading_pair/orders/:order_id
URL-Parameter
Name	Type	Values	Notes
trading_pair	String	
Handelspaare

Handelspaar (s. Tabelle Handelspaare)

order_id	String		
ID des Angebots

Response
Success-Response:
HTTP/1.1 200 OK
{
 "errors": [],
 "credits": 5
}
Error
Http-Status 403
Code	Note
54	
Cancellation not allowed anymore

Http-Status 404
Code	Note
50	
Order not found

Http-Status 422
Code	Note
55	
Trading on the marketplace is currently suspended.

Orders - showMyOrders
P2P (Krypto/Euro)
C2C (Krypto/Krypto)
Abrufen und Filtern meiner Orders

Credits:	2
Berücksichtigt alle Handelspaare
GET
https://api.bitcoin.de/v4/orders
Berücksichtigt ein spezifisches Handelspaar
GET
https://api.bitcoin.de/v4/:trading_pair/orders
URL-Parameter
Name	Type	Values	Notes
trading_pairOPTIONAL	String	
Handelspaare

Nur Orders für ein bestimmtes Handelspaar abrufen.

GET - Parameter
Name	Type	Values	Default	Notes
typeOPTIONAL	String	
buy

 
sell

Angebots-Typ

stateOPTIONAL	Integer	
-2

 
-1

 
0

0

Aktueller Status (s. Tabelle Possible Order-State-Values)

date_startOPTIONAL	String			
Startzeitpunkt, ab dem die Orders zurückgeliefert werden.
Format gemäß RFC 3339 (Bsp: 2015-01-20T15:00:00+02:00).

date_endOPTIONAL	String			
Endzeitpunkt, bis zu dem die Orders zurückgeliefert werden.
Format gemäß RFC 3339 (Bsp: 2015-01-20T15:00:00+02:00).

pageOPTIONAL	Integer		
1

Seitenzahl zum Blättern innerhalb der Ergebnisseiten

Response
Success 200
Name	Type	Value	Notes
orders	Array		
Max. 20 Angebote mit ihren Details (s. Tabelle Order-Details)

page	Array		
Informationen zu den möglichen Ergebnisseiten (s. Tabelle Page-Details)

Page Details
Name	Type	Value	Notes
current	Integer		
Aktuell zurückgelieferte Seite

last	Integer		
Letzte verfügbare Seite zu den Suchkriterien

Success-Response:
HTTP/1.1 200 OK
{
   "orders":
   [
     {
       "order_id': "2EDYNS",
       "trading_pair": "btceur",
       "type": "sell",
       "max_amount": 0.      {
         "order_id":"6784S7",
         "trading_pair":"btceur",
         "is_external_wallet_order":false,
         "type":"sell",
         "max_amount_currency_to_trade":"0.015",
         "min_amount_currency_to_trade":"0.007",
         "price":8700,
         "max_volume_currency_to_pay":130.5,
       "min_amount": 0.2,
       "price": 250.55,
       "max_volume": 125.28,
       "min_volume": 50.11,
       "end_datetime": "2015-01-20T15:00:00+02:00",
       "new_order_for_remaining_amount": true,
       "state": 0,
        "order_requirements":
        {
           "min_trust_level":"silver",
           "only_kyc_full": true,
           "payment_option": 1,
                    "min_volume_currency_to_pay":60.9,
         "order_requirements":
         {
            "min_trust_level":"bronze",
            "only_kyc_full":true,
            "seat_of_bank": {"DE", "NL"}
        },
        "created_at": "2015-01-10T15:00:00+02:00"
[ "AT", "DE" ],
            "payment_option":3
         },
         "new_order_for_remaining_amount":false,
         "state":0,
         "sepa_option":1,
         "end_datetime":"2019-09-16T23:45:00+02:00",
         "created_at":"2019-08-12T08:33:24+02:00"
      },
      {
         "order_id":"4XDM7A",
         "trading_pair":"btceur",
         "is_external_wallet_order":false,
         "type":"buy",
         "max_amount_currency_to_trade":"0.15",
         "min_amount_currency_to_trade":"0.075",
         "price":8590,
         "max_volume_currency_to_pay":1288.5,
         "min_volume_currency_to_pay":644.25,
         "order_requirements":
         {
            "min_trust_level":"bronze",
            "only_kyc_full":false,
            "seat_of_bank":["DE"],
            "payment_option":1
         },
         "new_order_for_remaining_amount":true,
         "state":0,
         "sepa_option":0,
         "end_datetime":"2019-09-16T23:45:00+02:00",
         "created_at":"2019-08-12T08:32:53+02:00"
      },
      {
         "order_id":"FZ2VA7",
         "trading_pair":"btceur",
         "is_external_wallet_order":false,
         "type":"buy",
         "max_amount_currency_to_trade":"0.01",
         "min_amount_currency_to_trade":"0.01",
         "price":8500,
         "max_volume":85,
         "min_volume":85,
         "order_requirements":
         {
            "min_trust_level":"bronze",
            "only_kyc_full":false,
            "seat_of_bank":[ "AT", "DE", "NL" ]
            "payment_option":1
         },
         "new_order_for_remaining_amount":true,
         "state":0,
         "sepa_option":0,
         "end_datetime":"2019-09-11T23:45:00+02:00",
         "created_at":"2019-08-07T12:18:00+02:00"
      }
   ],
   "page": {
       "current": 1,
       "last": 2
"page":{
      "current":1,
      "last":1
   },
   "errors": [],
   "credits": 15
"errors":[],
   "credits":68
}
Error
Http-Status 404
Code	Note
50	
Order not found

Http-Status 422
Code	Note
31	
Page is greater than last page.

Orders - showMyOrderDetails
P2P (Krypto/Euro)
C2C (Krypto/Krypto)
Details zu einer meiner Order abrufen

Credits:	2
GET
https://api.bitcoin.de/v4/:trading_pair/orders/:order_id
URL-Parameter
Name	Type	Values	Notes
trading_pair	String		
s. Tabelle Handelspaare

order_id	String		
ID des Angebots

Response
Success 200
Name	Type	Value	Notes
order	Array		
Details zum Angebot (s. Tabelle Order-Details)

Order Details
Name	Type	Value	Notes
order_id	String		
ID des Angebots

trading_pair	String		
Handelspaar (s. Tabelle Handelspaare)

is_external_wallet_order	Boolean		
Zeigt an ob sich die Order auf einen "Krypto-zu-Krypto (mit eigener Wallet)" Marktplatz bezieht.

type	String	
buy

 
sell

Typ des Angebots

max_amount_currency_to_trade	Float		
Maximal zu kaufende/verkaufende Coin-Menge

min_amount_currency_to_trade	Float		
Minimal zu kaufende/verkaufende Coin-Menge

price	Float		
Preis pro Coin in Euro

max_volume_currency_to_pay	Float		
Max. Euro-Volumen der Order

min_volume_currency_to_pay	Float		
Min. Euro-Volumen der Order

end_datetime	String		
Ablaufzeitpunkt des Angebots. Format gemäß RFC 3339 (Bsp: 2015-01-20T15:00:00+02:00).

new_order_for_remaining_amount	Boolean		
Neues Angebot mit Restmenge anlegen, wenn nur eine Teilmenge aus dem Angebot bedient wurde.

state	Integer		
Aktueller Status (s. Tabelle Possible Order-State-Values)

order_requirements	Array		
Voraussetzungen zum Bedienen des Angebots (s. Tabelle Order Requirements)

sepa_option	Integer	
0

 
1

Gibt zusätzliche SEPA-Optionen an (nur in Kombination mit der payment_option "2" oder "3" möglich, s. Tabelle Order Requirements).

0 => keine SEPA-Optionen vorhanden
1 => beschleunigte Zahlungsabwicklung via SEPA-Echtzeitüberweisung möglich

created_at	String		
Erstellzeitpunkt des Angebots. Format gemäß RFC 3339 (Bsp: 2015-01-20T15:00:00+02:00)

Order requirements
Name	Type	Value	Notes
min_trust_level	String	
bronze

 
silver

 
gold

 
platin

Mindest-Trust-Level des Handelspartners

only_kyc_full	Boolean		
Handelspartner muss vollständig identifiziert sein

seat_of_bank	Array	
Bankenländerliste

Erlaubte Länder, in denen die Bank des Handelspartners ihren Sitz haben darf (ISO 3166-2)

payment_option	Integer		
1 => Express-Only
2 => SEPA-Only
3 => Express & SEPA