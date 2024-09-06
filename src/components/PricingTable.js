import React from "react";
import clsx from "clsx";
import Link from "@docusaurus/Link";
import styles from "./PricingTable.module.css";
const PriceList = [
  {
    name: "Basic plan",
    price: ["£1.25 / month", "€1.50 / month", "US$1.50 / month"],
    description: "A basic plan for small operations",
    features: [
      "Add up to 2 users",
      "Track up to 50 assets",
      "Manage up to 50 projects",
      "Data stored securely and automatically backed up",
      "Auto updates, so you're always running the latest version",
      "Cancel anytime",
    ],
  },
  {
    name: "Standard plan",
    price: ["£7.50 / month", "€10 / month", "US$10 / month"],
    description: "Popular with businesses just getting started",
    features: [
      "Add up to 20 users",
      "Track up to 500 assets",
      "Manage up to 500 projects",
      "Upload up to 250MB of files",
      "Data stored securely and automatically backed up",
      "Auto updates, so you're always running the latest version",
      "Email support provided",
      "Cancel anytime",
    ],
  },
  {
    name: "Advanced plan",
    price: ["£20 / month", "€25 / month", "US$25 / month"],
    description: "Our recommended plan for medium sized businesses",
    features: [
      "Add up to 100 users (equivalent to 20p per user per month!)",
      "Track up to 2000 assets",
      "Manage up to 1000 projects",
      "Upload up to 1GB of files",
      "Data stored securely and automatically backed up",
      "Auto updates, so you're always running the latest version",
      "Email support provided",
      "Cancel anytime",
    ],
  },
];

function Price({ name, price, description, features }) {
  return (
    <div className={clsx("col col--4")} style={{ padding: "1rem" }}>
      <div className={styles.feature}>
        <div className="text--center padding-horiz--md">
          <h1>{name}</h1>
          <h2>
            {price.map((p, idx) => (
              <>
                {p}
                <br />
              </>
            ))}
          </h2>
          <p>{description}</p>
          <Link
            style={{ marginBottom: "1rem" }}
            className="button button--secondary"
            href="https://dash.adam-rms.com"
          >
            Start Trial
          </Link>
        </div>
        <div className="padding-horiz--md">
          <ul>
            {features.map((feature, idx) => (
              <li key={idx}>{feature}</li>
            ))}
          </ul>
        </div>
      </div>
    </div>
  );
}

export default function PricingTable() {
  return (
    <section
      className={[
        clsx("hero hero--primary", styles.heroBanner),
        styles.features,
      ]}
    >
      <div className="container">
        <div className="row text--center">
          <h1 className="hero__title" style={{ width: "100%" }}>
            Pricing
          </h1>
          <p className="hero__subtitle">
            AdamRMS is currently offered as a paid hosted solution and as a{" "}
            <Link to="/docs/v1/hosting/intro">free self-hosted solution</Link>.
            We are able to offer discounts to educational institutions - sign-up
            for a trial and <Link to="/support">get in touch for a quote</Link>.
          </p>
        </div>
        <div className="row">
          {PriceList.map((props, idx) => (
            <Price key={idx} {...props} />
          ))}
        </div>
        <div className="row ">
          <p className="hero__subtitle text--right">
            Pricing is charged per business, not per user. Need More of
            anything? <Link to="/support">Contact us for a quote</Link>
          </p>
        </div>
      </div>
    </section>
  );
}
