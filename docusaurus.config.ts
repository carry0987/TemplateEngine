import type * as Preset from '@docusaurus/preset-classic';
import type { Config } from '@docusaurus/types';
import { themes as prismThemes } from 'prism-react-renderer';

const config: Config = {
    title: 'TemplateEngine',
    tagline: 'A lightweight PHP template engine with asset and cache management',
    favicon: 'img/favicon.ico',

    // Set the production url of your site here
    url: 'https://carry0987.github.io',
    // Set the /<baseUrl>/ pathname under which your site is served
    // For GitHub pages deployment, it is often '/<projectName>/'
    baseUrl: '/TemplateEngine/',

    // GitHub pages deployment config.
    // If you aren't using GitHub pages, you don't need these.
    organizationName: 'carry0987',
    projectName: 'TemplateEngine',

    // The broken links detection is only available for a production build
    onBrokenLinks: 'throw',

    // Global markdown configuration
    markdown: {
        hooks: {
            onBrokenMarkdownLinks: 'warn',
            onBrokenMarkdownImages: 'throw',
        },
    },

    // Add custom tags to the HTML head
    headTags: [
        {
            tagName: 'meta',
            attributes: {
                name: 'algolia-site-verification',
                content: 'FF632C4F50D1F3EB',
            },
        },
    ],

    // Even if you don't use internationalization, you can use this field to set
    // useful metadata like html lang. For example, if your site is Chinese, you
    // may want to replace "en" with "zh-Hans".
    i18n: {
        defaultLocale: 'en',
        locales: ['en'],
    },

    presets: [
        [
            '@docusaurus/preset-classic',
            {
                sitemap: {
                    changefreq: 'weekly',
                    priority: 0.5,
                },
                docs: {
                    sidebarPath: './sidebars.ts',
                    showLastUpdateAuthor: true,
                    showLastUpdateTime: true,
                    editUrl: 'https://github.com/carry0987/TemplateEngine/tree/gh-pages/',
                },
                blog: false,
                theme: {
                    customCss: './src/css/global.custom.css',
                },
            } satisfies Preset.Options,
        ],
    ],

    themeConfig: {
        navbar: {
            title: 'TemplateEngine',
            items: [
                {
                    type: 'docSidebar',
                    sidebarId: 'tutorialSidebar',
                    position: 'left',
                    label: 'Docs',
                },
                {
                    href: 'https://github.com/carry0987/TemplateEngine',
                    label: 'GitHub',
                    position: 'right',
                },
            ],
        },
        footer: {
            style: 'light',
            links: [
                {
                    title: 'Docs',
                    items: [
                        {
                            label: 'Introduction',
                            to: '/docs/intro',
                        },
                        {
                            label: 'Getting Started',
                            to: '/docs/getting-started',
                        },
                    ],
                },
                {
                    title: 'API',
                    items: [
                        {
                            label: 'Template Syntax',
                            to: '/docs/template-syntax',
                        },
                        {
                            label: 'Cache Backends',
                            to: '/docs/cache-backends',
                        },
                    ],
                },
                {
                    title: 'More',
                    items: [
                        {
                            label: 'GitHub',
                            href: 'https://github.com/carry0987/TemplateEngine',
                        },
                        {
                            label: 'Packagist',
                            href: 'https://packagist.org/packages/carry0987/template-engine',
                        },
                    ],
                },
            ],
            copyright: `Copyright © ${new Date().getFullYear()} carry0987. Built with Docusaurus.`,
        },
        colorMode: {
            defaultMode: 'light',
            disableSwitch: false,
            respectPrefersColorScheme: true,
        },
        prism: {
            theme: prismThemes.oneDark,
            darkTheme: prismThemes.oneDark,
            additionalLanguages: ['tsx', 'css', 'json', 'bash', 'php'],
        },
        liveCodeBlock: {
            /**
             * The position of the live playground, above or under the editor
             * Possible values: "top" | "bottom"
             */
            playgroundPosition: 'bottom',
        },
        algolia: {
            appId: '7NY89HNJIP',
            apiKey: 'b5e165f21bea4bfe0be9876659b4f2e9',
            indexName: 'TemplateEngine Index',
            contextualSearch: true,
            externalUrlRegex: 'external\\.com|domain\\.com',
            searchParameters: {},
            searchPagePath: 'search',
            insights: false,
        },
    } satisfies Preset.ThemeConfig,
    themes: ['@docusaurus/theme-live-codeblock'],
};

export default config;
