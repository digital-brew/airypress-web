import domReady from '@wordpress/dom-ready';
import { registerBlockType } from "@wordpress/blocks";
import * as modalBlock from "./editor/modal.block";
import * as latestSeedsBlock from "./editor/latest-seeds.block";

domReady(() => {
  /**
   * Register blocks
   */
  registerBlockType(modalBlock.name, {
    apiVersion: 3,
    title: modalBlock.title,
    category: modalBlock.category,
    attributes: modalBlock.attributes,
    edit: modalBlock.edit,
    save: modalBlock.save,
  });

  registerBlockType(latestSeedsBlock.name, {
    apiVersion: 3,
    title: latestSeedsBlock.title,
    category: latestSeedsBlock.category,
    attributes: latestSeedsBlock.attributes,
    edit: latestSeedsBlock.edit,
    save: latestSeedsBlock.save,
  });
});
