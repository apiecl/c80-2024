import path from "path";
import { resolve } from "path";

export default {
  root: resolve(__dirname, "src"),
  build: {
    manifest: true,
    assetsDir: ".",
    emptyOutDir: true,
    sourcemap: true,
    outDir: "../dist",
    rollupOptions: {
      input: ["src/js/main.js", "src/scss/styles.scss"],
      output: {
        entryFileNames: "scripts-[hash].js",
        assetFileNames: ({ name }) => {
          if (/\.(gif|jpe?g|png|svg)$/.test(name ?? '')) {
            return 'img/[name]-[hash][extname]';
          }
          return 'styles-[hash].[ext]';
        },
      },
    },
  },
  server: {
    port: 8080,
  },
};
