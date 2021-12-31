---
sidebar_position: 1
title: Introduction
---

# Local Development

:::caution

This documentation assumes a strong grounding in both client side and server side Javascript, as well as Typescript

:::

## The Repos

AdamRMS has a set of repos, the main one for `v2` is a [monorepo](https://www.atlassian.com/git/tutorials/monorepos), containing two distinct applications:

Directory|Description||
:-----|:-----|:----
`/api`|NestJS API|[Docs](./api/intro)
`/app`|React App|[Docs](./app/intro)

The Website and docs are a separate repo, with a guide here [Docs](./../contributor/website/intro)

## Visual Studio Code

[VSCode](https://github.com/microsoft/vscode) is recommended for development, and debug profiles are provided for both applications as part of the workspace file. 

:::tip

Be sure to run `npm install` first before attempting to use the debug profiles

:::
 