import { test } from "@playwright/test";
import { login, dismissWelcomeModal } from "./helpers/loginHelper.js";

test("editor brand color exists", async ({ page }) => {
  await login(page);
  await page.goto("/wp/wp-admin/post-new.php");
  await dismissWelcomeModal(page);

  await page.waitForSelector('iframe[name="editor-canvas"]');
  const editorFrame = page.frameLocator('iframe[name="editor-canvas"]');

  await editorFrame
    .locator('p[aria-label="Add default block"], p.wp-block-paragraph')
    .first()
    .click();

  await editorFrame.locator(".editor-styles-wrapper p, p.wp-block-paragraph").fill("Example text");

  // Click the color dropdown button that contains "Text" to open the color dialog
  await page.click(
    'button.components-button.block-editor-panel-color-gradient-settings__dropdown:has(div:text("Text"))',
  );

  // Wait for the dropdown to be open and click the Brand color button
  await page.click('button[aria-label="Brand"]');
});
