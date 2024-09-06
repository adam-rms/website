---
sidebar_position: 10
title: Authentication Providers
---

AdamRMS uses Google as an alternative authentication provider, which requires a Google Developer account to generate client secrets.
We use the HybridAuth library, and its [Google Provider](https://hybridauth.github.io/hybridauth/userguide/IDProvider_info_Google.html) has good documentation on how to set this up.

You'll need a configured Client, and to set the following Environment Variables:

```
bCMS__OAUTH__GOOGLEKEY - The Client ID
bCMS__OAUTH__GOOGLESECRET - The Client Secret
```
