Module: Bounteous_StoreLocations

Features
Allows you to create a list of store locations and get our position

Magento version >= 2.4.3

Installation

1.- Create a new foler "Bounteous" in the path /app/code/

2.- Enter the module folder in the path /app/code/Bounteous/

The path should be the following:
   */app/code/Bounteous/StoreLocations/*

3.- bin/magento module:enable Bounteous_StoreLocations

4.- php bin/magento setup:upgrade

Magento admin

Settings
1.- Go to magento administrator
2.- In the main menu, you must choose the option "STORE LOCATIONS"
3.- Add new store via admin


Frontend

To enter the list of stores from the frontend, it is necessary to enter the following route:

(change the main url to your testing url)

{http://local.magento.com}/stores

In this url you can get position through longitude and latitude.

NOTES:
* To simulate an error, permissions for geolocation must be blocked, from the browser
* The service only responds to an environment with an SSL certificate

Error if the environment does not have SSL:
Only secure origins are allowed (see: https://goo.gl/Y0ZkNV).
