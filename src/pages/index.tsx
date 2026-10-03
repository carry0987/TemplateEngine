import type { ReactNode } from 'react';
import Link from '@docusaurus/Link';
import useDocusaurusContext from '@docusaurus/useDocusaurusContext';
import Heading from '@theme/Heading';
import Layout from '@theme/Layout';

import styles from './index.module.css';

export default function Home(): ReactNode {
    const { siteConfig } = useDocusaurusContext();
    return (
        <Layout title={siteConfig.title} description={siteConfig.tagline}>
            <main>
                <section className={styles.hero}>
                    <div className={styles.heroInner}>
                        <div className={styles.heroCopy}>
                            <p className={styles.kicker}>PHP TEMPLATE TOOLKIT</p>
                            <Heading as="h1">Templates that stay close to your markup.</Heading>
                            <p className={styles.lede}>
                                Compile familiar HTML tags into fast PHP cache files, with versioned assets and optional Redis or database metadata.
                            </p>
                            <div className={styles.actions}>
                                <Link className="button button--primary button--lg" to="/docs/getting-started">
                                    Get started
                                </Link>
                                <Link className={styles.textLink} to="/docs/template-syntax">
                                    Explore template syntax <span aria-hidden="true">→</span>
                                </Link>
                            </div>
                            <dl className={styles.stats}>
                                <div><dt>Source</dt><dd>HTML-first</dd></div>
                                <div><dt>Metadata</dt><dd>File, Redis, SQL</dd></div>
                                <div><dt>Assets</dt><dd>CSS, JS, static</dd></div>
                            </dl>
                        </div>
                        <div className={styles.compiler} aria-label="Template compilation example">
                            <div className={styles.windowBar}>
                                <span></span><span></span><span></span><code>template/home.html</code>
                            </div>
                            <pre className={styles.sourceCode}><code>{`<h1>Hello {$name}</h1>
<link href="{loadcss app.css}">
<!--{if $signedIn}-->
  <p>Welcome back.</p>
<!--{/if}-->`}</code></pre>
                            <div className={styles.compileLine}><span>compile</span><i></i><span>cache/home.cache.php</span></div>
                            <div className={styles.backendRow}><span>FILE CACHE</span><span>REDIS</span><span>POSTGRESQL</span><span>MYSQL</span></div>
                        </div>
                    </div>
                </section>
                <section className={styles.featureSection}>
                    <div className={styles.sectionHeading}>
                        <p className={styles.kicker}>THE WORKFLOW</p>
                        <Heading as="h2">One compact layer between HTML and PHP.</Heading>
                    </div>
                    <div className={styles.features}>
                        <article>
                            <p className={styles.index}>01</p>
                            <Heading as="h3">Write markup</Heading>
                            <p>Use variables, includes, conditions, loops, and blocks directly in trusted HTML templates.</p>
                            <Link to="/docs/template-syntax">Read the syntax</Link>
                        </article>
                        <article>
                            <p className={styles.index}>02</p>
                            <Heading as="h3">Version assets</Heading>
                            <p>Generate cache-aware CSS, JavaScript, and static paths without hand-managed query strings.</p>
                            <Link to="/docs/assets-and-caching">Handle assets</Link>
                        </article>
                        <article>
                            <p className={styles.index}>03</p>
                            <Heading as="h3">Choose storage</Heading>
                            <p>Keep metadata on disk or move it to Redis, PostgreSQL, or MySQL as your deployment requires.</p>
                            <Link to="/docs/cache-backends">Configure backends</Link>
                        </article>
                    </div>
                </section>
                <section className={styles.callout}>
                    <div>
                        <p className={styles.kicker}>START SMALL</p>
                        <Heading as="h2">A local cache is enough to begin.</Heading>
                        <p>Switch to Redis or a relational backend only when you need shared cache metadata.</p>
                    </div>
                    <Link className="button button--secondary button--lg" to="/docs/cache-backends">
                        Compare cache backends
                    </Link>
                </section>
            </main>
        </Layout>
    );
}
