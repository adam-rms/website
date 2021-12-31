---
sidebar_position: 4
title: CI/CD
---

## CI

When submitting PRs, the folder is run through:

- eslint
- secret detection
- spelling checker
- [alex](https://alexjs.com/) - insensitive & inconsiderate writing detector

## CD

The production site is deployed to production through Cloudflare pages, kept up-to-date with the `v2` branch.

When submitting PRs, a build is generated by Netlify, which provides a demo url to test in a browser