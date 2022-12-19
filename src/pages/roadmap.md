# The AdamRMS Roadmap

This roadmap sets out the plans and direction of the AdamRMS Project. 

Feel free to [edit this page](https://github.com/adam-rms/website/edit/main/src/pages/roadmap.md) by opening a PR, it's very much a living breathing document and we welcome contributions.

## Objectives

- For some, it's a daily driver - it must perform well for those who use it regularly and offer good functionality for power users. For others, it's used rarely, so by default is should offer simple, uniform and intuitive UI interactions.
- Performance trumps functionality.
- It's a product, not a project. Features should only be added where there is a good reason to do so and should serve the user need.
- It should be most usable on devices that users most commonly use.

## Medium Term

### API

The API will remain the `v1` PHP project in the [`adam-rms`](https://github.com/adam-rms/adam-rms) repository. 

- [ ] _unassigned, likely `@jbithell`_ - Standardize and improve API response & request schema.
- [ ] _unassigned_ - Create new security model, implementing CSRF protection. 

### Dashboard

The dashboard will remain the `v1` project in the [`adam-rms`](https://github.com/adam-rms/adam-rms) repository, and retain mostly the same structure. 

- [x] [`@jbithell`](https://github.com/jbithell) - Review and improve dashboard functionality with targeted "quick win" improvements. Please suggest these by opening an issue.
- [x] [`@jbithell`](https://github.com/jbithell) - Review feasibility of a migration to a router or framework, such as Lumen/Symphony, or indeed writing a router. 
- [x] [`@jbithell`](https://github.com/jbithell) - Review serverless deployment (for the 4th time).

### Public Sites

The public sites functionally will be rewritten and moved to a embed based system, rather than distinct websites. 

- [x] [`@jbithell`](https://github.com/jbithell) - Move to a embed based system, rather than distinct websites

### Mobile App

The Mobile App [`app`](https://github.com/adam-rms/app) will be maintained, but only to keep existing features usable to the extent they already are. 

#### `v2` app

The Mobile App will be replaced by the `v2` app. This is a React project, in the[`adam-rms-v2`](https://github.com/adam-rms/adam-rms-v2) repository. This will utilise the exiting API (`v1`) and the standardization of this will support the app's development.

With a view to the [long term](#long-term) it is expected that the `v2` app will support phones, tablets and desktop devices as when mature it __may__ replace the dashboard. 

- [ ] [`@cherry-john`](https://github.com/cherry-john) [`@robert-watts`](https://github.com/Robert-Watts) - Continue to develop functionality, in line with existing mobile app.

### Website

The website has been moved to its own repository [`website`](https://github.com/adam-rms/website), with no further major changes planned. Incremental changes will be made to the docs and content. 

## Long Term

The long term is an indeterminate point, but will be triggered once the `v2` mobile app reaches a certain maturity where it supports the majority of `v1` dashboard functionality. It will be triggered __if__ there is sufficient energy/will to develop a v2 API, and to continue development of the app sufficiently for it to replace the dashboard. 

### API

The API will be re-written as `v2` in the [`adam-rms-v2`](https://github.com/adam-rms/adam-rms-v2) repository. 

### Dashboard

The dashboard will no longer be offered. The [`adam-rms`](https://github.com/adam-rms/adam-rms) repository will be archived.

### Mobile App

The mobile app in the [`adam-rms-v2`](https://github.com/adam-rms/adam-rms-v2) repository will continue to be offered, and will also become the new dashboard.

### Website

The website will continue to be offered in the [`website`](https://github.com/adam-rms/website) repository.
