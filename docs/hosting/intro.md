---
sidebar_position: 1
title: Self-Hosting
---

import Tabs from "@theme/Tabs";
import TabItem from "@theme/TabItem";

# Self-Hosting AdamRMS

The AdamRMS dashboard is packaged as a Docker image, which is stored in the Github Image repository. We recommend you deploy this on managed infrastructure (such as AWS or DigitalOcean), but this guide will be generic, and not make use of platform-specific tools where possible.

:::note Before you start
This guide assumes you have a good understanding of deploying web infrastructure, and it will not give specific commands, or guidance for how to manage areas such as DNS.
:::

:::info
AdamRMS is distributed under the [GNU Affero General Public License v3.0](https://github.com/adam-rms/adam-rms/blob/main/LICENSE) and therefore is provided "AS IS".  
The documentation on this page is delivered as guidance and advice, and it is believed to be correct and working at the time of writing. Any comments are greatly appreciated, and should be [submitted as an issue.](https://github.com/adam-rms/website/issues/new?assignees=&labels=documentation&projects=&template=doc_issue.yaml&title=%5BDocs+Issue%5D+%3Ctitle%3E)
:::

## What You need

- A Domain AdamRMS will be deployed to - eg. `dash.adam-rms.com`
- [The AdamRMS docker image](https://github.com/adam-rms/adam-rms/pkgs/container/adam-rms)
- A MySQL or MariaDB Database

### Optional Features you can setup later on

- S3-compatible storage - if you want to store images & files
- A SendGrid account - for emails
- A Developer Google account - for Google Sign In
- AWS Cloudfront credentials
- Sentry

The Docker image of AdamRMS can be found in the project's [Github package repository](https://github.com/adam-rms/adam-rms/pkgs/container/adam-rms), and you can pull it by running:

```sh
docker pull ghcr.io/adam-rms/adam-rms:latest
```

The Docker image requires a number of environment variable to be set. These variables can be found in [example.dev.env](https://raw.githubusercontent.com/adam-rms/adam-rms/main/example.dev.env), and you can copy this to a `.env` file, or set each variable individually. There are a handful of development-related environment variables, which are discussed in [Contributing](/docs/v1/contributor/intro)

A MySQL-compatible database is required by the docker image, and we know of success with both MySQL and MariaDB deployments. As with all projects, we recommend you follow security best practices when it comes to your database, as this will be the main store of user data.
Database migrations are applied each time the docker image is run, and so updates will be automatically applied.
