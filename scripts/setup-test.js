#!/usr/bin/env node
const path = require('path');
const sao = require('sao');

const generator = path.resolve(__dirname, '../');
const outDir = path.resolve(__dirname, '../__test-project__/');

process.env.NODE_ENV = 'test';

sao({ generator, outDir, logLevel: 4, debug: true, yes: true })
  .run()
  .catch((err) => {
    console.trace(err);
    process.exit(1);
  });
