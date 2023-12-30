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
          label: "User Guide",
        },
        {
          label: "Support",
          to: "/support",
        },
        {
          type: "doc",
          docId: "hosting/intro",
          position: "left",
          label: "Self Hosting",
        },
        {
          to: "/api",
          label: "API Documentation",
        },
        {
          type: "doc",
          docId: "contributor/intro",
          position: "left",
          label: "Contributing",
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
      ],
    },
    footer: {
      style: "dark",
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
            spec: "api/adamrms.yaml",
            route: "/api/",
          },
        ],
        theme: {
          options: {
            hideDownloadButton: true,
          },
        },
      },
    ],
  ],
};
