---
sidebar_position: 15
title: Maintenance
---
# Maintenance

Asset Maintenance is a way to track issues with assets as well as managing compliance such as PAT and LOLER.

All maintenance jobs are associated with an asset and can be assigned to a user.

## New Jobs
---

All Jobs need:
- A job title
- Description of the fault
- Associated Asset(s)
- Job Priority

![New Maintenance Job](/img/tutorial/assets/maintenance-new.png "Reporting an asset as broken in Demo Hire Services")
*Adding a new Maintenance Job*

Once the job has been created, there is additional information that can be added:
- Job Assignment - Give the job to a user to fix
- Flag - Notify project managers that there is a fault with the assets in the job
- Block - Stop the asset from being assigned to projects
- Due Date
- Watching Users - Users can watch a job to receive updates on progress

Each of these fields has a dedicated permission.


## Managing Jobs
---
Progress on a job can be logged using the job thread. This can be in the form of a text entry or by uploading files to the job.
It can also be tracked by updating the job status.

![Maintenance Job details](/img/tutorial/assets/maintenance-details.png "Full details of maintenance job")
*Job details page*

:::note Permissions Required
MAINTENANCE_JOBS:VIEW  
MAINTENANCE_JOBS:EDIT:JOB_DUE_DATE  
MAINTENANCE_JOBS:EDIT:USER_ASSIGNED_TO_JOB  
MAINTENANCE_JOBS:EDIT:USERS_TAGGED_IN_JOB  
MAINTENANCE_JOBS:EDIT:NAME  
MAINTENANCE_JOBS:EDIT:STATUS  
MAINTENANCE_JOBS:MAINTENANCE_JOBS_FILE_ATTACHMENTS:CREATE  
MAINTENANCE_JOBS:EDIT:ASSET_FLAGS  
MAINTENANCE_JOBS:EDIT:ASSET_BLOCKS  
:::
