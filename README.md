# User Subscription into Sendy List on Registration for concrete5

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

The possibility to offer subscription to a Sendy List on User Registration at the concrete5 site.
The subscription is sent as a POST request after the user goes through the on_user_validate event, after clicking the confirmation E-Mail which simultaneously acts as a Double-Opt-In switch for the list.

## Installation
You must install the composer dependencies before installing this addon.

## Community Store
If you use the Community Store Add-On for your concrete5 project, you can offer billing_first_name and billing_last_name on the registration page and they will be added as "Name" to your Sendy List.

## GDPR
According to the european GDPR legislation, you need to offer the user sufficient information on how to unsubscribe from your list if wished so. This is your responsibility as a Mailing List Processor.
