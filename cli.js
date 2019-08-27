#!/usr/bin/env node
const path = require('path');
const sao = require('sao');
const cac = require('cac');
const chalk = require('chalk');
const { version, name } = require('./package.json');

const generator = path.resolve(__dirname, './');

const cli = cac('create-wordpress-project');

cli
  .command('[out-dir]', 'Generate in a custom directory or current directory')
  .option('--verbose', 'Show debug logs')
  .action((outDir = '.', cliOptions) => {
    console.log();
    console.log(chalk`{cyan ${name}@${version}}`);
    console.log(chalk`✨  Generating WordPress project in {cyan ${outDir}}`);
    console.log();

    const { verbose } = cliOptions;
    const logLevel = verbose ? 4 : 2;
    // See https://saojs.org/api.html#standalone-cli
    sao({ generator, outDir, logLevel, cliOptions })
      .run()
      .catch(err => {
        console.trace(err);
        process.exit(1);
      });
  });

cli.help();

cli.version(version);

cli.parse();
