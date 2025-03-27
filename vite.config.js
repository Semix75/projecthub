import {resolve} from 'path';
import prefreshPlugin from '@prefresh/vite';

const root = "./assets";

/**
 * @type { import('vite').UserConfig }
 */
const config= {
  resolve: {
    alias: {
      react: 'preact/compat',
      'react-dom': 'preact/compat',
    }
  },
  emitManifest : true,
  cors : true,
  optimizeDeps : {
    include : ['preact/compat', 'preact/hooks']
  },
  esbuild : {
    jsxFactory: 'h',
    jsxFrament: 'Fragment',
    jsxInject: `import { h, Fragment } from 'preact'`,
  },
  base : '/assets/',
  build : {
    polyfillDynamicImport : false,
    assetsDir : '',
    manifest : true,
    outDir : '../public/assets',
    rollupOptions : {
      output : {
        manualChunks : undefined,
      },
      input: {
        app: resolve(__dirname, 'assets/app.js'),
      }
    },

  },
  plugin: [prefreshPlugin()],
  root
};

export default config;