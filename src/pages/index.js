import React from "react";
import clsx from "clsx";
import Layout from "@theme/Layout";
import Link from "@docusaurus/Link";
import useDocusaurusContext from "@docusaurus/useDocusaurusContext";
import styles from "./index.module.css";
import HomepageFeatures from "../components/HomepageFeatures";
import Image from "@theme/IdealImage";

import Video from "../components/Video";

function HomepageHeader() {
  const { siteConfig } = useDocusaurusContext();
  return (
    <header className={clsx("hero hero--primary", styles.heroBanner)}>
      <div className="container">
        <h1 className="hero__title">{siteConfig.title}</h1>
        <p className="hero__subtitle">{siteConfig.tagline}</p>
      </div>
    </header>
  );
}

function Pricing() {
  return (
    <header className={clsx("hero hero--primary", styles.heroBanner)}>
      <div className="container">
        <h1 className="hero__title">Pricing</h1>
        <p className="hero__subtitle">
          AdamRMS is currently offered as a hosted solution, by Bithell Studios
          Ltd, and as a self-hosted solution using the docker images published
          on Github.
          <br />
          We are not currently offering the hosted solution to new customers,
          but instead encourage you to self-host the project.
        </p>
      </div>
    </header>
  );
}

function PartsOfTheSite() {
  return (
    <header className={clsx("hero hero--secondary", styles.heroBanner)}>
      <div className="container">
        <h1 className="hero__title">Getting Started</h1>
        <div className="row">
          <div className={clsx("col col--4")}>
            <div className="text--center padding-horiz--md">
              <h2>User Guide</h2>
              <p>Getting started as a new user of the system</p>
              <div className={styles.buttons}>
                <Link
                  className="button button--secondary button--lg"
                  to="/docs/v1/user-guide/intro"
                >
                  User Guide
                </Link>
              </div>
            </div>
          </div>
          <div className={clsx("col col--4")}>
            <div className="text--center padding-horiz--md">
              <h2>Self-Hosting</h2>
              <p>Getting started with hosting AdamRMS</p>
              <div className={styles.buttons}>
                <Link
                  className="button button--secondary button--lg"
                  to="/docs/v1/hosting/intro"
                >
                  Self Hosting Guide
                </Link>
              </div>
            </div>
          </div>
          <div className={clsx("col col--4")}>
            <div className="text--center padding-horiz--md">
              <h2>Contributing</h2>
              <p>Contributing to the development of AdamRMS</p>
              <div className={styles.buttons}>
                <Link
                  className="button button--secondary button--lg"
                  to="/docs/v1/contributor/intro"
                >
                  Contribution Guide
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
  );
}

export default function Home() {
  const { siteConfig } = useDocusaurusContext();
  return (
    <Layout
      title={`${siteConfig.title} | Open Source Advanced Rental Management System for Theatre, AV & Broadcast`}
      description="AdamRMS is an advanced Rental Management System for Theatre, AV & Broadcast. Free & Open Source"
    >
      <HomepageHeader />
      <Video />
      <main>
        <HomepageFeatures />
      </main>
      <Pricing />
      <PartsOfTheSite />
    </Layout>
  );
}
