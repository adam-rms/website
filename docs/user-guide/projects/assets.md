---
sidebar_position: 23
title: Assets in Projects
---

# Assets in Projects
---

Assets determine billing for the project, and can be tracked through [Asset Statuses](../business/business-settings.md#basic-settings)  
They can be assigned on a cross-business basis, to include local sub-hires.

:::note Permissions Required
PROJECTS:PROJECT_ASSETS:CREATE:ASSIGN_AND_UNASSIGN  
PROJECTS:PROJECT_ASSETS:CREATE:ASSIGN_ALL_BUSINESS_ASSETS  
PROJECTS:PROJECT_ASSETS:EDIT:ASSIGNMNET_COMMENT  
PROJECTS:PROJECT_ASSETS:EDIT:CUSTOM_PRICE  
PROJECTS:PROJECT_ASSETS:EDIT:DISCOUNT  
PROJECTS:PROJECT_ASSETS:EDIT:ASSIGNMENT_STATUS  
:::

## Adding Assets to Projects
---
Assets are assigned using the [Asset Search functionality](../assets/finding-assets).  
To select the project you are assigning assets to, either use the `+ Add Assets` button on the project toolbar, or select a project when searching assets.
You can also assign all assets to the project, using the add all button.

![Select Project on the Project information page](/img/tutorial/projects/assets-shopping.png)
*Shopping buttons are highlighted: Add All Assets to Project in blue, Add assets to this project in red*


## Asset List
---

The Asset list shows all assets associated with the project, organised by Category and Asset Type.  

![Example project asset list](/img/tutorial/projects/assets-list.png)
*A Project's asset list*

### Asset List functions

There are a number of functions that can be used to alter project asset properties.  
Some require additional permissions so may not be visible to you.

![Project asset functions](/img/tutorial/projects/assets-functions.png)  
*Assignment Comment | Discount | Custom Price | Set asset Statuses | Swap Asset | Remove Asset | Expand List*

#### Comments
Assignment comments can be used to highlight specific things about the asset assignment.  
For example, requesting a particular DMX address or gel colour.

#### Discount & Custom Price  
By default, AdamRMS calculates hire costs based on the asset's value.   
You can override the hire price in two ways:
1. Discounts
   - Set price based on a percentage of the asset's cost
2. Custom Price
   - Set price using any value

#### Set Status for assets
This function allows you to set the asset status for selected assets or all assets (if no assets are selected) associated with the project. 

![Setting status for selected assets](/img/tutorial/projects/assets-setStatus.png)  
*Setting asset status*

#### Swap Assets
If you have multiple assets of the same type, you may want to swap assets to the ones picked rather than finding the exact asset listed by the Project Manager.  
This function lists available assets to the project, and you can select a new asset based on the asset Tag.

![Asset Swap](/img/tutorial/projects/assets-swap.png)
*Swapping assets. The value in brackets is the first custom field of the asset type.*

#### Remove Asset
Remove an asset from the project.

## Asset Dispatch
---

Asset dispatch is a board layout view of all assets assigned to your project.  

![Asset Dispatch](/img/tutorial/projects/assets-dispatch.png)
*Asset Dispatch*

You can update an asset's status by moving it between status columns, using the arrow buttons or by dragging and dropping the asset. 
