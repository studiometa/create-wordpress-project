const slugify = require('slugify');
const path = require('path');

module.exports = {
  prompts: [
    {
      name: 'name',
      type: 'string',
      message: 'Project name',
      default: 'www.fqdn.com',
      store: true,
    },
    {
      name: 'projectSlug',
      type: 'string',
      message: 'Project slug',
      default: 'fqdn',
    },
    {
      name: 'description',
      type: 'string',
      message: 'Project description',
      default: ({ name }) => `Repository for ${name}.`,
    },
    {
      name: 'url',
      type: 'string',
      message: 'Project URL',
      default: ({ name }) => `https://${name}`,
    },
    {
      name: 'repository',
      type: 'string',
      message: 'Project repository',
      default: ({ name }) => `git@github.com:studiometa/${name}.git`,
    },
    {
      name: 'themeName',
      type: 'string',
      message: 'Project theme name',
      default: ({ name }) => name,
      store: true,
    },

    {
      name: 'themeSlug',
      type: 'string',
      message: 'Project theme slug',
      default: ({ themeName }) => slugify(themeName),
    },

    {
      name: 'themeDescription',
      type: 'string',
      message: 'Project theme description',
      default: ({ name }) => `Theme for ${name}.`,
    },

    {
      name: 'features',
      message: 'Choose features to add',
      type: 'checkbox',
      choices: [
        { name: 'ACF', value: 'acf' },
        { name: 'Classic editor', value: 'classicEditor' },
        { name: 'Wordfence', value: 'wordfence' },
        { name: 'WP Rocket', value: 'wpRocket' },
      ],
      default: [],
    },
  ],
  templateData() {
    const { features } = this.answers;
    const acf = features.includes('acf');
    const classicEditor = features.includes('classicEditor');
    const wordfence = features.includes('wordfence');
    const wpRocket = features.includes('wpRocket');

    const huskyName = 'husky';

    return {
      acf,
      classicEditor,
      wordfence,
      wpRocket,
      huskyName,
    };
  },
  actions() {
    const actions = [
      {
        type: 'add',
        files: '**',
        filters: {
          '*.DS_Store': false,
          '/node_modules/*': false,
          '/vendor/*': false,
        },
        templateDir: 'template',
      },
      {
        type: 'move',
        patterns: {
          'web/wp-content/themes/<%= themeSlug %>': `web/wp-content/themes/${this.answers.themeSlug}`,
          '_gitignore': '.gitignore',
        },
      },
    ];

    return actions;
  },
  async completed() {
    const { outDir } = this.sao.opts;

    // Allow execution of the shell scripts
    [
      'bin/cleanup-composer-install.sh',
      'bin/db-export.sh',
      'bin/db-import.sh',
      'bin/generate-wp-config.sh',
      'bin/get-wp-salts.sh',
    ].forEach(file => {
      this.fs.chmodSync(path.resolve(outDir, file), 0o765);
    });

    // Init Git and install NPM dependencies
    this.gitInit();
    await this.npmInstall({ npmClient: 'npm' });

    // Display useful informations
    const { chalk } = this;
    const isNewFolder = this.outDir !== process.cwd();
    const relativeOutFolder = path.relative(process.cwd(), this.outDir);
    const tab = '    ';

    console.log();
    console.log(
      chalk`${tab}🎉 {bold Successfully created project} {cyan ${this.answers.name}}!`
    );
    console.log();
    console.log(chalk`${tab}{bold To get started:}\n`);
    if (isNewFolder) {
      console.log(chalk`${tab}1. Go in your project's directory`);
      console.log(chalk`${tab}{cyan cd ${relativeOutFolder}}\n`);
    }
    console.log(chalk`${tab}2. Create your .env file and fill it`);
    console.log(chalk`${tab}{cyan cp .env.example .env}\n`);
    console.log(chalk`${tab}Generate your project's salt keys`);
    console.log(chalk`${tab}{cyan bin/get-wp-salts.sh}\n`);
    console.log(chalk`${tab}3. Install the composer dependencies`);
    console.log(chalk`${tab}{cyan composer install}\n`);
    console.log(chalk`${tab}4. Start the development server`);
    console.log(chalk`${tab}{cyan npm run dev}\n`);
    console.log(chalk`${tab}🎊 {bold Happy coding!}\n`);
  },
};
