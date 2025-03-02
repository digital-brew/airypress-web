import domReady from '@wordpress/dom-ready';
import { registerBlockType } from "@wordpress/blocks";
import * as modalBlock from "./editor/modal.block";

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
});
