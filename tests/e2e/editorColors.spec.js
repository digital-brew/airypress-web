import { test, expect } from '@playwright/test';
import { login } from './helpers/loginHelper.js';

test('editor color red-500 exists', async ({ page }) => {
  await login(page);
  await page.goto("/wp/wp-admin/post-new.php");

  const editorFrame = page.frameLocator('iframe[name="editor-canvas"]');

  await editorFrame
    .locator('p[aria-label="Add default block"]')
    .first()
    .click();

  await editorFrame
    .locator(".editor-styles-wrapper p, p.wp-block-paragraph")
    .fill("Example text");

  await page.click(
    'button.block-editor-panel-color-gradient-settings__dropdown div[title="Text"]'
  );
  await page.click('[aria-label="Color: Red (500)"]');
});
