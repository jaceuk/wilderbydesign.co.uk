# Important

Cannot use the new blocks Checkout page until the Prtinful plugin supports the latest version Woocommerce,
a the last time of checking this was a problem with WooCoomerce > 8.2.2 which was no supported by the Printful plugin.

The Checkout error in question is “There are no shipping options available. Please ensure that your address has been entered correctly, or contact us if you need any help.”.

The site has a default currency/location of US but this will be overridden if Geolocating detects the user is in the UK.
Localhost IP address does not resolve to a geolocation so will default to the US.

## Caching and CURCY had issues:

- CURCY uses the 'wmc_current_currency' cookie to get the current currency however on first load this isn't set.
- Changing CURCY to 'Use cache plugin' seems to make it set this cookie on first load but only after a delay.
- The theme JS has to wait for the cookie to appear before using it's value to determine the state of the currency toggle flag.

Note:

An early attempt using PHP to get the users country and add it to the markup failed as the rendered PHP value will be cached so all other users will see the same country.

JS, on the other hand, can modify the site after render for each user.

## Newsletter signup

Really doesn't like incognito mode, seems to default to thinking the user is a bot and redirects to the 'Please confirm you're not a robot' page.

## Currency selector

If it stops working check the console for javascript errors causing main.js to fail.
