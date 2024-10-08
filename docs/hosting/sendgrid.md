---
sidebar_position: 10
title: Sendgrid
---

[Sendgrid](https://sendgrid.com/en-us) is an email provider that is used to send notifications from AdamRMS. It is required to send emails from AdamRMS.

For many deployments of AdamRMS the free tier provided by Sendgrid should be sufficient.

You will need to generate a [Sendgrid API Key](https://app.sendgrid.com/settings/api_keys) and store this in the configuration settings under Sendgrid API key.

You must also set from email to be the email address that these emails are sent from. This should be an address that is known to Sendgrid and has had [Domain Authentication](https://docs.sendgrid.com/ui/account-and-settings/how-to-set-up-domain-authentication) set up, otherwise your emails are likely to be blocked or send to spam.
