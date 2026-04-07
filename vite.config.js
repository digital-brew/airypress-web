import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";
import laravel from "laravel-vite-plugin";
import { wordpressPlugin, wordpressThemeJson } from "@roots/vite-plugin";

export default defineConfig({
  base: "/build/",
  plugins: [
    tailwindcss(),
    laravel({
      input: [
        "resources/css/app.css",
        "resources/js/app.js",
        "resources/css/editor.css",
        "resources/js/editor.js",
      ],
      refresh: true,
      assets: ["resources/images/**", "resources/fonts/**"],
    }),

    wordpressPlugin(),

    wordpressThemeJson({
      disableTailwindColors: false,
      disableTailwindFonts: false,
      disableTailwindFontSizes: false,
      disableTailwindBorderRadius: false,
    }),
  ],
  resolve: {
    alias: {
      "@scripts": "/resources/js",
      "@styles": "/resources/css",
      "@fonts": "/resources/fonts",
      "@images": "/resources/images",
    },
  },
});
