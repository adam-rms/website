---
sidebar_position: 34
title: Business Export
---

# Business Export
AdamRMS has a customisable export feature that allows you to be selective about what data you export from the platform. All exports are based on a base export table, and can join with any relevant table for that base table.

:::note Export permissions  
134 - Access business export page  
:::

The Export page will change depending on what you want to export, and what other tables are associated with your base export table. Therefore, the final export buttons, which allow you to select a file format for the export, will only appear once you have selected a base table, at least one export column and a column to sort the results by. 


![Sample Export](/img/tutorial/businesses/export-clients.png)


Once you have selected a base table, you can select which columns you wish to include in the export, and re-arrange those columns within each table. You should also select a sorting column to arrange returned rows by.  

## Export Overview
The export overview panel summarises what your export will contain and is split into four sections. They are:
 - Base Table -> The table your export is based on
 - Columns -> A list of table columns that will be included in the export
 - Sorting -> How the results will be sorted
 - Joined Tables -> Any linked tables to your base table that are included in the export.


## Supported Base Tables
- Assets
- Asset Types
- Projects
- Locations
- Clients

# Larger Exports
---
If the Business Export feature is not suitable, you can ask your server administrator to export your data for you.

## Hosted AdamRMS ([dash.adam-rms.com](https://dash.adam-rms.com/))
If you are using the hosted version of AdamRMS, a full export of your data can be requested from [AdamRMS support](https://adam-rms.com/support)

## Self-Hosted AdamRMS
If you are hosting AdamRMS yourself, the following steps can be followed to do a full export of your data:

1. Export the AdamRMS database from your database server
2. Delete all instances from the export except the instance requested
3. Delete all `users` where `userInstances == null` (their instances have been deleted)
4. Delete all `assetsBarcodes` where `instanceID == null`
5. Truncate the following tables:
    - auditLog
    - authTokens
    - emailSent
    - emailVerificationCodes
    - loginAttempts
    - passwordResetCodes