import React from "react";
import styles from "./Video.module.css";
import clsx from "clsx";

export default function Video() {
  return (
    <section className={styles.video}>
      <div className="text--center  padding-horiz--md">
        <iframe width="840" height="472" src="https://www.youtube-nocookie.com/embed/iBvYVlspz3E" title="YouTube video player" frameBorder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowFullScreen></iframe>
      </div>
    </section>
  );
}
