---
id: projects
title: Projects
sidebar_position: 1
---

# Projects 

:::caution This documentation is a work in progress.

This file was written by volunteers and then programmatically organized into this site, so there may be errors and typos. Hit "Edit this Page" at the bottom to correct them.

:::

## archive.php

Archive project
```
projects/archive.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projects_id
```

## changeClient.php

Update project client
```
projects/changeClient.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projects_id
clients_id
```

## changeDescription.php

Update project description
```
projects/changeDescription.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projects_id
projects_description
```

## changeInvoiceNotes.php

Update project invoice notes
```
projects/changeInvoiceNotes.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projects_id
projects_invoiceNotes
```

## changeName.php

Update project name
```
projects/changeName.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projects_id
projects_name
```

## changeProjectDates.php

Update project date
```
projects/changeProjectDates.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projects_id
projects_dates_use_start
projects_dates_use_end
```

## changeProjectDeliverDates.php

Update assets in use date&&&cascade update project finance data
```
projects/changeProjectDeliverDates.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projects_id
projects_dates_deliver_start
projects_dates_deliver_end
```

## changeProjectManager.php

Update project manager
```
projects/changeProjectManager.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
users_userid
projects_id
```

## changeProjectType.php

Update project type
```
projects/changeProjectType.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projects_id
projectsTypes_id
```

## changeSelectedProject.php

Change current user's selected project. &&&updates thisproject in $pagedata
```
projects/changeSelectedProject.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projectid
```

## changeStatus.php

Update project status
```
projects/changeStatus.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projects_id
projects_status
```

## changeSubProject.php

Update whether project is a sub project or main project
```
projects/changeSubProject.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projects_id
projects_parent_project_id
```

## changeVenue.php

Update project location
```
projects/changeVenue.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projects_id
locations_id
```

## data.php

Get data about project - used by most project pages
```
projects/data.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
formData
id
```

## delete.php

Remove project
```
projects/delete.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projects_id
```

## deletePayment.php

"Remove project payments
```
projects/deletePayment.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
payments_id
```

## editNote.php

Update a project note
```
projects/editNote.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projectsNotes_id
projects_id
projectsNotes_text
```

## getComments.php

get comments for given project
```
projects/getComments.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projects_id
```

## list.php

List all projects
```
projects/list.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
none
```

## new.php

Create new project
```
projects/new.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projects_name
projects_manager
projectsType_id
projects_parent_project_id
```

## newNote.php

Add new note to project
```
projects/newNote.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projects_id
projectsNotes_title
```

## newPayment.php

Add new payment information
```
projects/newPayment.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
formData
```

## newQuickComment.php

Add a comment to a project
```
projects/newQuickComment.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projects_id
text
```

## unArchive.php

Remove project from project archive
```
projects/unArchive.php
```

 **Parameters**

Parameters are POST unless otherwise noted

```
projects_id
```