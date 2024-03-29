---
sidebar_position: 33
title: Business Settings
---

# Business Settings

## Basic Settings
---
Basic settings cover a number of useful settings about your business, including business information and invoice settings.

:::note Permissions Required
BUSINESS:BUSINESS_SETTINGS:VIEW  
BUSINESS:BUSINESS_SETTINGS:EDIT  
:::

![Basic Settings](/img/tutorial/businesses/settings-basic.png)
*Business Settings*

The Basic Settings page includes the following information:
- Basic Business settings:
  - Name
  - Address 
  - Email Address
  - Phone Number
  - Website
- Business Logo
- Email Header
- Invoice Footer - Note on the bottom of all generated invoices
- Cable length colours - assign a colour to each length for ease of identification
- Asset Statuses - used for asset dispatch
- Week Labels - Overrides the week label on calendars

### Week Labels
Calendars across AdamRMS usually use the week number of the year as the week number, but this can be overritten on a week-by-week basis. 

![Week Labels](/img/tutorial/businesses/settings-weekLabels.png)

The date of each label can be any date in the required week. If two labels for the same week are found, the one lower in the list will be used.

## Public Site
---
AdamRMS supports provides a number of widgets to business, to allow information about business assets to be shared publicly.  
For example, this can be used to show what assets are available for hire.

:::note Permissions Required
BUSINESS:BUSINESS_SETTINGS:VIEW  
BUSINESS:BUSINESS_SETTINGS:EDIT  
:::

![Public site settings](/img/tutorial/businesses/settings-publicSite.png)
*AdamRMS public site settings*

Currently, there are two widgets available:

- **Asset List and Seearch** - This shows a list of assets that are available for hire.
- **Crew Vacancies** - This shows a list of crew roles that are currently vacant.

You can enable different pieces of information to be shared from the Public site settings page for each of these widgets.
## Project Types
---
Project types are a way to change what elements of [Projects](./../projects/overview) are available to each project. AdamRMS provides a “Full Project” by default which has all elements enabled.

:::note Permissions Required
PROJECTS:PROJECT_TYPES:VIEW  
PROJECTS:PROJECT_TYPES:CREATE  
PROJECTS:PROJECT_TYPES:EDIT  
PROJECTS:PROJECT_TYPES:DELETE  
:::

![Custom project types](/img/tutorial/businesses/settings-types.png)
*Project types*

Each Project is split into the following sections that can be enabled or disabled on a Project Type basis:
- Finance - Should asset charge calculations occur, and is billing enabled.
- Files - Can projects have files associated with them
- Assets - Assign assets to projects
- Client Assignment - Is this project associated with a client or an internal event.
- Venue - Associate a venue with this project.
- Notes - Use notes and comments in the project
- Crew - Use Crew assignment and recruitment in this project.

## Custom Categories
---
All Assets have an associated category that groups assets. AdamRMS comes with 29 sub-categories by default, but you can add new subcategories on a business basis.

:::note Permissions Required
ASSETS:ASSET_CATEGORIES:VIEW  
ASSETS:ASSET_CATEGORIES:CREATE  
ASSETS:ASSET_CATEGORIES:EDIT  
ASSETS:ASSET_CATEGORIES:DELETE  
:::

![Custom asset categories](/img/tutorial/businesses/settings-category.png)
*Asset Categories*

All subcategories have:
- A Name
- An Icon ([AdamRMS uses the Font Awesome Icon Set](https://fontawesome.com/v5.15/icons?d=gallery&p=2&m=free))
- A parent Category.

If you want to add a new parent category, please contact AdamRMS support.
