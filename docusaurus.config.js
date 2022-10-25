/* eslint-disable max-len */
const lightCodeTheme = require("prism-react-renderer/themes/github");
const darkCodeTheme = require("prism-react-renderer/themes/dracula");

const production = process.env.CONTEXT === "production"; // Netlify/Cloudflare Pages set environment variable "CONTEXT" to "production"/"deploy-preview"

/** @type {import('@docusaurus/types').DocusaurusConfig} */
module.exports = {
  title: "AdamRMS",
  tagline:
    "AdamRMS is a free, open source advanced Rental Management System for Theatre, AV & Broadcast",
  url: "https://adam-rms.com",
  baseUrl: "/",
  onBrokenLinks: "warn",
  noIndex: !production,
  onBrokenMarkdownLinks: "warn",
  favicon: "img/favicon.ico",
  organizationName: "adam-rms",
  projectName: "adam-rms",
  plugins: ["@docusaurus/plugin-ideal-image"],
  themeConfig: {
    navbar: {
      title: "AdamRMS",
      logo: {
        alt: "The AdamRMS Logo",
        src: "img/logoicon.svg",
        srcDark: "img/logoicon-white.svg",
      },
      items: [
        {
          type: "doc",
          docId: "user-guide/intro",
          position: "left",
          label: "Users",
        },
        {
          to: "/api",
          label: "API",
        },
        {
          type: "doc",
          docId: "contributor/intro",
          position: "left",
          label: "Contributors",
        },
        {
          label: "Support",
          to: "/support",
        },
        {
          label: "Environment",
          to: "/environment",
        },
        {
          href: "https://dash.adam-rms.com",
          label: "Login",
          position: "right",
        },
        {
          type: "docsVersionDropdown",
          position: "right",
        },
      ],
    },
    footer: {
      style: "dark",
      links: [
        {
          title: "Docs",
          items: [
            {
              label: "User Guide",
              to: "/docs/v1/user-guide/intro",
            },
            {
              label: "API Documentation",
              to: "/api/",
            },
            {
              label: "Service Status",
              href: "https://status.bithell.studio/",
            },
          ],
        },
        {
          title: "Repos",
          items: [
            {
              label: "Dashboard & API",
              href: "https://github.com/adam-rms/adam-rms",
            },
            {
              label: "v2",
              href: "https://github.com/adam-rms/adam-rms-v2",
            },
            {
              label: "Mobile App",
              href: "https://github.com/adam-rms/app",
            },
          ],
        },
        {
          title: "More",
          items: [
            {
              label: "Support",
              to: "/support",
            },
            {
              label: "Privacy & Terms",
              to: "/legal",
            },
            {
              label: "Bithell Studios Ltd",
              href: "https://bithell.studio/",
            },
          ],
        },
      ],
      copyright: `Copyright © 2019-${new Date().getFullYear()} Bithell Studios Ltd.`,
    },
    prism: {
      theme: lightCodeTheme,
      darkTheme: darkCodeTheme,
    },
    image: "img/banner.jpg",
    ...(!production && {
      announcementBar: {
        id: "dev_build", // Any value that will identify this message.
        content:
          'This is a draft version of our website, to view the current version please visit <a href="https://adam-rms.com/">adam-rms.com</a>',
        backgroundColor: "#fafbfc", // Defaults to `#fff`.
        textColor: "#091E42", // Defaults to `#000`.
        isCloseable: false,
      },
    }),
    colorMode: {
      defaultMode: "light",
      disableSwitch: false,
      // using user system preferences, instead of the hardcoded defaultMode
      respectPrefersColorScheme: true,
    },
    ...(process.env.AGOLIA_API_KEY &&
      process.env.AGOLIA_INDEX &&
      process.env.AGOLIA_APP_ID && {
        algolia: {
          appId: process.env.AGOLIA_APP_ID,
          apiKey: process.env.AGOLIA_API_KEY,
          indexName: process.env.AGOLIA_INDEX,
          contextualSearch: true,
          searchParameters: {},
          disableUserPersonalization: true,
        },
      }),
  },
  presets: [
    [
      "@docusaurus/preset-classic",
      {
        docs: {
          sidebarPath: require.resolve("./sidebars.js"),
          editUrl: "https://github.com/adam-rms/website/edit/main/",
          editCurrentVersion: true,
          // includeCurrentVersion: !production,
          showLastUpdateTime: true,
          showLastUpdateAuthor: true,
          versions: {
            current: {
              label: "v1",
              path: "v1",
            },
          },
        },
        blog: {
          showReadingTime: true,
        },
        theme: {
          customCss: require.resolve("./src/css/custom.css"),
        },
      },
    ],
    [
      "redocusaurus",
      {
        specs: [
          {
            spec: "static/api/adamrmsv1.yaml",
            route: "/api/",
          },
        ],
        theme: {
          options: {
            downloadDefinitionUrl: "/api/adamrmsV1.yaml",
          },
        },
      },
    ],
  ],
};
