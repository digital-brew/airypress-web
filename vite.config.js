import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";
import laravel from "laravel-vite-plugin";
import { wordpressPlugin, wordpressThemeJson } from "@roots/vite-plugin";
import fs from "fs";
import path from "path";

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
    }),

    wordpressPlugin(),

    wordpressThemeJson({
      disableTailwindColors: false,
      disableTailwindFonts: false,
      disableTailwindFontSizes: false,
    }),
    {
      name: "merge-theme-json",
      async closeBundle() {
        const out = path.resolve("public/build/assets/theme.json");
        const dir = path.resolve("resources/views/blocks/");
        if (!fs.existsSync(out)) return;
        const theme = JSON.parse(fs.readFileSync(out, "utf8"));
        theme.styles ??= {};
        for (const f of fs.readdirSync(dir).filter(f => f.endsWith('.theme.js'))) {
          try {
            Object.assign(theme.styles, (await import(path.join(dir, f))).default);
          } catch {}
        }
        fs.writeFileSync(out, JSON.stringify(theme, null, 2));
      },
    },
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
